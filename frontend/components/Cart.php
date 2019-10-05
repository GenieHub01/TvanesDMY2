<?php

namespace frontend\components;

use Codeception\Exception\ConfigurationException;
use common\models\Countries;
use frontend\models\Goods;
use yii\helpers\Json;

class Cart extends \yii\base\Component
{


    private $_cart = [];
    private $_promocode_id ;
    public $country;
    public $country_id;

    public $tax = 0;
    public $shipping = 0;

    public function init()
    {
        $session = \Yii::$app->session;


        $country = null;
        $c = $session->get('country');

        if ($c) {
            $country = Countries::findOne(['id' => $c]);
        }


        if (!$country && !\Yii::$app->user->isGuest) {
            $country = Countries::findOne(['id' => \Yii::$app->user->identity->country_id]);
        }

        if (!$country && !\Yii::$app->params['default_country']) {

//            echo 1;
            throw new ConfigurationException('Default country not set.');
        }


//        var_dump(\Yii::$app->params['default_country']); exit;
        if (!$country) {
            $country = Countries::find()->andWhere(['shortcode' => \Yii::$app->params['default_country']])->one();
//            var_dump($country);
        }

        if (!$country) {
//            echo 1;
            throw new ConfigurationException('Country cannot set.');
        }


        $this->country = $country;
        $this->country_id = $country->id;


        $this->tax = $country->tax;
        $this->shipping = $country->shipping;

        $items = $session->get('cart');
        if ($items) {
            $this->_cart = Json::decode($items);
        }

        $this->loadModels();
//        $session->get('promocode');
//        $this->_promocode_id = $session->get('promocode');
    }

    public function updateCountry($id)
    {
        $country = Countries::findOne($id);
        if ($country):
            $session = \Yii::$app->session;
            $this->country = $country;
            $this->country_id = $country->id;


            $this->tax = $country->tax;
            $this->shipping = $country->shipping;
            $session->set('country', $id);
            return true;
        else:
            return false;
        endif;

    }

    public function addItem($id, $count = 1)
    {
        $session = \Yii::$app->session;


        $this->_models[$id] = Goods::find()->andWhere(['id' => $id])->limit(1)->one();
        $this->_cart[$id] = isset($this->_cart[$id]) ? $this->_cart[$id] + 1 : 1;

        $session->set('cart', Json::encode($this->_cart));


    }


    public function deleteItem($id, $count = 1)
    {
        $session = \Yii::$app->session;

        if (isset($this->_cart[$id])) {
            if ($this->_cart[$id] <= $count) {
                unset($this->_cart[$id]);
                if (isset($this->_models[$id])) {
                    unset($this->_models[$id]);
                }

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

    private $_models;


    protected function loadModels()
    {
        if ($this->_models === null) {
            $models = Goods::find()->andWhere(['id' => array_keys($this->_cart)])->indexBy('id')->all();
            $this->_models = $models;
        }

        return $this->_models;
    }

    public function getTotalAmount()
    {
        $sum = 0;

        $models = $this->_models;

        if ($this->_cart) {
            foreach ($this->_cart as $key => $count) {
                if (isset($models[$key])) {
                    $sum += $models[$key]->total * $count;
                    if ($models[$key]->virtualItem) {
                        $sum += $models[$key]->virtualItem['total'] * $count;
                    }
                }
            }
        }

        return $sum;
    }

//    public function getTotalAmount(){  }

    public function getTaxAmount()
    {
        $sum = 0;
        $models = $this->_models;
        if ($this->_cart) {
            foreach ($this->_cart as $key => $count) {
                if (isset($models[$key])) {
                    $sum += $models[$key]->tax * $count;
                    if ($models[$key]->virtualItem) {
                        $sum += $models[$key]->virtualItem['tax'] * $count;
                    }
                }
            }
        }
        return $sum;
    }


    public function getShippingAmount()
    {


        $sum = $this->shipping;
        $models = $this->_models;
//        var_dump($models[105]->attributes);
//        var_dump($models[106]->attributes);
//        echo $sum.'-';
        if ($this->_cart) {
            foreach ($this->_cart as $key => $count) {

                if (isset($models[$key]) && $models[$key]->extra_shipping) {
//                    var_dump($models[$key]->title);
                    $sum += $models[$key]->extra_shipping*$count;
//                    echo  $models[$key]->extra_shipping.'-';
//                    echo  $key.'-';
//                    if ($models[$key]->virtualItem){
//                        $sum += $models[$key]->virtualItem['tax'] * $count  ;
//                    }
                }
            }
        }
//        exit;
        return $sum;
    }

    public function getSum()
    {
        return $this->totalAmount;
    }

}



