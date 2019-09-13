<?php

namespace frontend\controllers;

use common\components\BaseController;
use common\models\OrderItems;
use frontend\models\Goods;
use common\models\Order;

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



            $sum = 0;

                foreach ($items  as $key => $count) {
                    if (isset($models[$key])) {
                        $sum += $models[$key]->regular_price;

                        $orderItem = new OrderItems();
                        $orderItem->link('goods',$models[$key]);
                        $orderItem->link('order',$order);
                        $orderItem->count = $count ;
                        $orderItem->price = $models[$key]->regular_price; ;
                        $orderItem->save(false);
                    }

                }
                $order->updateAttributes(['total_sum'=>$sum]);
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
            'line'=>$this->renderPartial('_cart_view',['model'=>$model,'count'=>\Yii::$app->cart->getItemCount($id)])
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
            'line'=>$this->renderPartial('_cart_view',['model'=>$model,'count'=>\Yii::$app->cart->getItemCount($id)])
        ];
    }

    public function actionDeleteCart()
    {
    }



}