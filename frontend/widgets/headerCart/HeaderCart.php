<?php
/**
 * Created by PhpStorm.
 * User: elimar
 * Date: 29.11.2019
 * Time: 0:44
 */

namespace frontend\widgets\headerCart;

use frontend\models\Goods;
use yii\base\Widget;

class HeaderCart extends Widget
{
    public function run()
    {
        $items = \Yii::$app->cart->items;
        $products = [];
        $total_sum = 0;
        $count = 0;

        if(!empty($items))
        {
            foreach ($items as $id=>$quantity){
                $good = Goods::findOne($id);
                if(!empty($good)){
                    $count += $quantity;
                    $product = [];
                    $product['quantity'] = $quantity;
                    $product['item'] = $good;
                    $product['id'] = $id;
                    $products[] = $product;
                    $total_sum += $quantity * $good->regular_price;
                }
            }
        }

        return $this->render('header_cart', [
            'product_count' => $count,
            'products' => $products,
            'total_sum' => $total_sum,
        ]);
    }
}