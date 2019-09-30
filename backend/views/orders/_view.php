<?php

use yii\helpers\Url;
use yii\helpers\Html;

/**
 * @var $model \backend\models\Order
 */

?>
<div id="id<?=$model->id?>" class="link_view my-1 p-3 border <?= $model::$_statusClass[$model->status] ?>" style="">
    <div>
        <?= Html::a(Yii::$app->formatter->asDatetime($model->created_ts),['/orders/view','id'=>$model->id],['class'=>' ']) ?>

        <div class="float-right">Status: <span class="label label-info"><?=\common\models\Order::$_status[$model->status];?></span></div>

    </div>
    <div class="d-flex">
        <div class="w-50">Total sum: <?= Yii::$app->formatter->asCurrency(100) ?></div>
        <div class="w-25">Items: <?= Yii::$app->formatter->asInteger(5) ?></div>
        <div class="w-25">Email: <?= Yii::$app->formatter->asEmail($model->email) ?></div>
    </div>
    <div>

    </div>

</div>