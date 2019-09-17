<?php

namespace frontend\components;

use common\models\Promocodes;
use frontend\models\Goods;
use yii\helpers\Json;

class Cart extends \yii\base\Component
{


    private $_cart = [];
    private $_promocode_id ;

    public function init()
    {
        $session = \Yii::$app->session;

        $items = $session->get('cart');
        if ($items) {
            $this->_cart = Json::decode($items);
        }

//        $session->get('promocode');
//        $this->_promocode_id = $session->get('promocode');
    }

    public function addItem($id, $count = 1)
    {
        $session = \Yii::$app->session;
        $this->_cart[$id] = isset($this->_cart[$id]) ? $this->_cart[$id] + 1 : 1;
        $session->set('cart', Json::encode($this->_cart));
    }


    public function deleteItem($id, $count = 1)
    {
        $session = \Yii::$app->session;

        if (isset($this->_cart[$id])) {
            if ($this->_cart[$id] <= $count) {
                unset($this->_cart[$id]);
            } else {
                $this->_cart[$id] -= $count;
            }

            $session->set('cart', Json::encode($this->_cart));
        }

    }

    public function deleteItemFull($id)
    {
        $session = \Yii::$app->session;
        $this->deleteItem($id, 10000000);
    }

    public function destroyCart()
    {
        $session = \Yii::$app->session;
        $session->set('cart', Json::encode([]));
    }

    public function getCount()
    {
        return count($this->_cart);
    }

    public function getItemCount($id)
    {
        return isset($this->_cart[$id]) ? $this->_cart[$id] : 0;
    }

    public function getItems()
    {
        return count($this->_cart) > 0 ? $this->_cart : [];
    }


    public function getSum()
    {

        $sum = 0;
        $models = Goods::find()->andWhere(['id' => array_keys($this->_cart)])->indexBy('id')->all();
        if ($this->_cart) {
            foreach ($this->_cart as $key => $count) {

                if (isset($models[$key])) {
                    $sum += $models[$key]->totalPrice * $count;
                }
            }
        }

        return $sum;
    }
}



