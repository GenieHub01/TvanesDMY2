<?php
?>

<div class="row">
    <div class="col-sm-2">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-sm-10">

        <div class="d-flex p-3 border-bottom">
            <?= \yii\helpers\Html::a('<i class="fas fa-arrow-left"></i> Return to My Orders',['/orders/index'],['class'=>'']) ?>

        </div>

        <div class="d-flex p-3 flex-column border-bottom ">
            <div>№<?=$model->id?></div>
            <div>Status: <?=$model::$_status[$model->status]?></div>
            <div>Time: <?=Yii::$app->formatter->asDatetime($model->created_ts)?></div>
            <div>Sum: <?=Yii::$app->formatter->asCurrency($model->total_sum)?></div>
            <?if ($model->total_sum_discount):?>
               <div>Sum After Discount: <?=Yii::$app->formatter->asCurrency($model->total_sum_discount)?></div>
            <?endif;?>
            <div>Shipping: <?=Yii::$app->formatter->asCurrency($model->shipping_cost)?></div>
            <div>Total: <?=Yii::$app->formatter->asCurrency(  ($model->total_sum_discount ? $model->total_sum_discount : $model->total_sum) + $model->shipping_cost)?></div>




        </div>
        <div class="d-flex p-3 flex-column border-bottom ">
            <?if ($model->orderItems):?>
                <?foreach ($model->orderItems as $item):?>
                    <div class="d-flex">
                        <?=  $item->goods->title?> | <?= Yii::$app->formatter->asCurrency($item->price) ?> | Count: <?= Yii::$app->formatter->asInteger($item->count)?> | Sum: <?= Yii::$app->formatter->asCurrency($item->price* $item->count) ?>
                    </div>
                <?endforeach;?>
            <?endif;?>

        </div>



    </div>
</div>
