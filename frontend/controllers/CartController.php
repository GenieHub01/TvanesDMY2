<?php

namespace frontend\controllers;

use common\components\BaseController;
use common\models\Countries;
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

    private $_user;

    public function getUser()
    {
        if ($this->_user == null) {
            $this->_user = Yii::$app->user->identity;
        }
        return $this->_user;
    }



    public function actionIndex()
    {
        $items = \Yii::$app->cart->items;
        $models = false;
        if ($items) {
            $models = Goods::find()->andWhere(['id' => array_keys($items)])->indexBy('id')->all();
        }

        $order = new Order();
        $order->setAttributes([
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'email' => $this->user->email,
            'address' => $this->user->shipping_address,
            'address_optional' => $this->user->shipping_address_optional,
            'country_id' => Yii::$app->cart->country_id,
            'city' => $this->user->shipping_city,
            'postcode' => $this->user->shipping_postcode,
            'phone' => $this->user->shipping_phone,
        ], false);

        if ($order->load(\Yii::$app->request->post()) && $items && $models  && $order->save()){

            Yii::$app->cart->updateCountry($order->country_id);
            $sum = 0;
            $tax = 0;
            $discountSum = 0;
            $shipping = Yii::$app->cart->shipping;
                foreach ($items  as $key => $count) {
                    if (isset($models[$key])) {
                        $sum += $models[$key]->total * $count;
                        $tax += $models[$key]->tax * $count;
                        $shipping += $models[$key]->extra_shipping* $count;

                        $orderItem = new OrderItems();
                        $orderItem->link('goods',$models[$key]);
                        $orderItem->link('order',$order);
                        $orderItem->count = $count ;
                        $orderItem->price = $models[$key]->total;
                        $orderItem->price_tax = $models[$key]->tax;

                        if ($models[$key]->virtualItem) {
                            $orderItem->holding_charge = $models[$key]->virtualItem['total'];
                            $orderItem->holding_charge_tax = $models[$key]->virtualItem['tax'];

                            $sum += $orderItem->holding_charge * $count;
                            $tax += $orderItem->holding_charge_tax * $count;
                        }
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
//                                $discountTax = $tax - $promocode->sum;
                                $discountSum = $sum >0 ? $sum : 0;
                            } elseif ($promocode->percent){
                                $discountSum = $sum - ($sum*$promocode->percent/100);
                            }
                        }
                }

                $order->updateAttributes([
                    'total_sum'=>$sum,
                    'total_tax' => $tax,
                    'tax_percent' => Yii::$app->cart->tax,
//                    'total_tax_discount' => $discountTax,
                    'total_sum_discount'=>$discountSum,
                    'shipping_cost' => $shipping,
                ]);

            Yii::$app->cart->destroyCart();
            Yii::$app
                ->mailer
                ->compose()
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
            'shipping' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->shippingAmount),
            'tax' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->taxAmount),
            'sumtotal' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->sum + \Yii::$app->cart->shippingAmount),
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
            'shipping' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->shippingAmount),
            'tax' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->taxAmount),
            'sum'=>\Yii::$app->formatter->asCurrency($sum),
            'sumtotal' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->tax +\Yii::$app->cart->shippingAmount), // todo rewrite this
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
            'tax' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->taxAmount),
            'shipping' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->shippingAmount),
            'sumtotal' => \Yii::$app->formatter->asCurrency(\Yii::$app->cart->sum + \Yii::$app->cart->shippingAmount),
            'line'=>$this->renderPartial('_cart_view',['model'=>$model,'count'=>\Yii::$app->cart->getItemCount($id)])
        ];
    }

    public function actionDeleteCart()
    {
    }



}