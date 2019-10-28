<?php

use yii\helpers\Url;
use yii\helpers\Html;

$count = 0;
if ($model->orderItems){
    foreach ($model->orderItems as $item){

      $count += $item->count;
    }
}
/**
 * @var $model \backend\models\Order
 */

?>
<div id="id<?=$model->id?>" class="link_view my-1 p-3 border <?= $model::$_statusClass[$model->status] ?>" style="">
    <div>
        <?= Html::a(Yii::$app->formatter->asDatetime($model->created_ts),['/orders/view','id'=>$model->id],['class'=>' ']) ?>

        <div class="float-right">
            Status: <span class="label label-info"><?=\common\models\Order::$_status[$model->status];?> <?= !empty($model->worldpay_order_status) ? '('.$model->worldpay_order_status.')' : ''; ?></span>
        </div>

    </div>
    <div class="d-flex">
        <div class="w-50">
            Total sum: <?= Yii::$app->formatter->asCurrency($model->total_sum_discount ? $model->total_sum_discount  + $model->shipping_cost: $model->total_sum) ?>
            <? if (!empty($model->worldpay_order_id)): ?>
                <br>
                <? if ($model->worldpay_order_status == 'SUCCESS'): ?>
                    Wordplay_code: <?= Html::a($model->worldpay_order_id,['/orders/refund','worldpay_order_id'=>$model->worldpay_order_id],['class'=>' ','title' => 'Refund']) ?>
                <? else: ?>
                    Wordplay_code: <?= $model->worldpay_order_id; ?>
                <? endif; ?>
            <? endif; ?>
        </div>
        <div class="w-25">Items: <?= Yii::$app->formatter->asInteger($count) ?></div>
        <div class="w-25">Email: <?= Yii::$app->formatter->asEmail($model->email) ?></div>
    </div>
    <div>

    </div>

</div>