<div id="totalCartItem_<?=$model->id?>" class="row">
    <div class="col-md-9 col-sm-8 col-7 text-right pad-col">
        <p class="col-titl"><?= \yii\helpers\Html::a($model->title,$model->url) ?> <span class="num-prods">x <?= (int)$count ?></span></p>
    </div>
    <div class="col-md-3 col-sm-4 col-5 text-right pad-col">
        <p class="col-titl"> <?= Yii::$app->formatter->asCurrency($count * $model->price) ?></p>
    </div>
</div>