<?php
?>

<div class="row">
    <div class="col-sm-2">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-sm-10">
        <? if ($models): ?>

            <? foreach ($models as $model): ?>
                <div class="d-flex m-3 p-3  border-bottom">
                    <div class="px-3">
                        <span class="badge-info"><?= Yii::$app->formatter->asDate($model->created_ts) ?></span>
                    </div>
                    <div class="px-3">
                        <?= Yii::$app->formatter->asCurrency($model->total_sum) ?>
                    </div>
                    <div class="px-3">
                        <?= \yii\helpers\Html::a('link',$model->url) ?>
                    </div>
                </div>
            <? endforeach; ?>
        <? else: ?>

            <h5>You haven't orders yet.</h5>

        <? endif; ?>
    </div>
</div>
