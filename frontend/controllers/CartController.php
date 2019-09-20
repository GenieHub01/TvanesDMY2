<?php

namespace frontend\controllers;

use common\components\BaseController;
use common\models\OrderItems;
use common\models\Promocodes;
use frontend\models\Goods;
use frontend\models\Order;
use Yii;

/**
 * Site controller
 */
class CartController extends BaseController
{


    public function actionIndex()
    {
        $items = \Yii::$app->cart->items;

        $models = false;
        if ($items) {
            $models = Goods::find()->andWhere(['id' => array_keys($items)])->indexBy('id')->all();
        }


        $order = new Order();



        if ($order->load(\Yii::$app->request->post()) && $items && $models  && $order->save()){
            $sum = 0; $discountSum = 0;
                foreach ($items  as $key => $count) {
                    if (isset($models[$key])) {
                        $sum += $models[$key]->totalPrice*$count;

                        $orderItem = new OrderItems();
                        $orderItem->link('goods',$models[$key]);
                        $orderItem->link('order',$order);
                        $orderItem->count = $count ;
                        $orderItem->price = $models[$key]->totalPrice;
                        $orderItem->save(false);
                    }

                }


                if ($order->promocodes_id){
                    $promocode = Promocodes::find()
//            ->andWhere(['>=','start_date',date('Y-m-d')])->orWhere(['start_date'=>null])
                        ->andWhere("start_date<=".date('Y-m-d').' or start_date is null')
                        ->andWhere(['id'=>$order->promocodes_id,'status'=>Promocodes::STATUS_ACTIVE])
                        ->andWhere(['>=','end_date',date('Y-m-d')])->one();

                        if ($promocode){
                            if ($promocode->sum){
                                $discountSum = $sum - $promocode->sum;
                                $discountSum = $sum >0 ? $sum : 0;
                            } elseif ($promocode->percent){
                                $discountSum = $sum - ($sum*$promocode->percent/100);
                            }
                        }
                }

                $order->updateAttributes([
                    'total_sum'=>$sum,
                    'total_sum_discount'=>$discountSum,
                    'shipping_cost'=>\Yii::$app->params['SHIPPINGCOST'],
                ]);

            Yii::$app->cart->destroyCart();
            Yii::$app
                ->mailer
                ->compose()
//                ->compose(
//                    ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
//                    ['user' => $user]
//                )

                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo($order->email)
                ->setSubject('New order at ' . Yii::$app->name)
                ->setTextBody('New order #'.$this->id)
                ->send();
            return $this->redirect($order->url);
        }

        return $this->render('cart', ['items' => $items, 'models' => $models,'order'=>$order]);

    }

    public function actionAddItem($id)
    {
        \Yii::$app->response->format = 'json';

        $model = Goods::findOne(['id' => $id]);

        if (!$model) {
            return self::returnError(self::ERROR_NOTFOUND, "Can't add item to cart");
        }

        \Yii::$app->cart->addItem($id);

        return [
            'id' =>$id,
            'count' => \Yii::$app->cart->count,
            'sum' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->sum),
            'tax' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->tax),
            'sumtotal' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->sum + Yii::$app->params['SHIPPINGCOST']),
            'line'=>$this->renderPartial('_cart_view',['model'=>$model,'count'=>\Yii::$app->cart->getItemCount($id)])
        ];
    }

    public function actionPromocodeApply($promocode)
    {
        \Yii::$app->response->format = 'json';
        $model = Promocodes::findPromocode($promocode);
        if (!$model) {
            return self::returnError(self::ERROR_NOTFOUND, 'Promocode expired or not found.');
        }


        $sum = \Yii::$app->cart->sum;

        if ($model->sum){
            $totalSum = $sum - $model->sum;
            $totalSum = $totalSum >0 ? $totalSum : 0;
        } elseif ($model->percent){
            $totalSum = $sum - ($sum*$model->percent/100);
        }


        return [
            'id' => $model->id,
            'code' => $model->code,
            'desc' => $model->sum ?  \Yii::$app->formatter->asCurrency($model->sum) : \Yii::$app->formatter->asPercent($model->percent/100),
            'discount_sum' => \Yii::$app->formatter->asCurrency($model->sum),
            'discount_percent' => \Yii::$app->formatter->asPercent($model->percent/100),
            'sum'=>\Yii::$app->formatter->asCurrency($sum),
            'sumtotal' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->tax + Yii::$app->params['SHIPPINGCOST']), // todo rewrite this
            'totalSum'=>\Yii::$app->formatter->asCurrency($totalSum),

        ];


    }

    public function actionDeleteItem($id)
    {
        \Yii::$app->response->format = 'json';

        $model = Goods::findOne(['id' => $id]);

        if (!$model) {
            return self::returnError(self::ERROR_NOTFOUND, "Can't add item to cart");
        }

        \Yii::$app->cart->deleteItem($id);

        return [
            'id' =>$id,
            'count' => \Yii::$app->cart->count,
            'sum' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->sum),
            'tax' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->tax),
            'sumtotal' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->sum + Yii::$app->params['SHIPPINGCOST']),
            'line'=>$this->renderPartial('_cart_view',['model'=>$model,'count'=>\Yii::$app->cart->getItemCount($id)])
        ];
    }

    public function actionDeleteCart()
    {
    }



}