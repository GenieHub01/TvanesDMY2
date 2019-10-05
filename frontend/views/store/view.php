<?php
/**
 * @var $model \frontend\models\Goods
 */?>


<div class="row">
    <div class="col">
        <h1><?= $model->title ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?if ($model->images):?>
            <?foreach ($model->images as $image):?>
                <?= \yii\helpers\Html::img($image,['class'=>'img-fluid']) ?>
            <?endforeach;?>
        <?endif;?>



    </div>

    <div class="col-md-6">
        <?= \yii\helpers\Html::a('Add to CART','#',['class'=>'btn btn-primary add_to_cart ','data-id'=>$model->id])  ?>

        <p>Category: <?= $model->category_string ?></p>
        <p>Price: <?= Yii::$app->formatter->asCurrency($model->total) ?> (incl. tax <?= Yii::$app->formatter->asCurrency($model->tax) ?>)</p>
         <?php if ($model->virtualItem):?>
            <p>Holding charge: <?= Yii::$app->formatter->asCurrency($model->virtualItem['total']) ?> (incl. tax <?= Yii::$app->formatter->asCurrency($model->virtualItem['tax']) ?>) </p>

        <?php endif; ?>
        <p>Description: <?= $model->description ?></p>
        <p>Brand: <?= $model->brand ?></p>
        <p>Model: <?= $model->model ?></p>
        <p>Fuel: <?= $model->fuel ?></p>
        <p>Engine type: <?= $model->engine_type ?></p>
        <p>Additional information: <?= $model->add_info ?></p>
        <p>OEM excahne: <?= $model->oem_exchange ?></p>
        <p>Engine capacity: <?= $model->engine_capacity ?></p>
        <p>Engine power: <?= $model->engine_power ?></p>
        <p>Part number list: <?= join(',',$model->part_number_list) ?></p>
        <p>Comparison number list: <?= join(',',$model->comparison_number_list) ?></p>
    </div>
</div>
