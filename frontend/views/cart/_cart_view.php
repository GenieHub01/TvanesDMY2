<tr id="cartItem_<?=$model->id?>" >
    <th class="md-screen-ico"><i class="fas fa-times remove-ico"></i></th>
    <th class="js-remove-item" data-id="<?= $model->id ?>" data-title="Product"><i class="fas fa-times remove-ico"></i>
        <p>
            <?= \yii\helpers\Html::a($model->title,$model->url) ?>
        </p>
    </th>
    <th data-title="Price">
        <?= Yii::$app->formatter->asCurrency($model->price) ?>
    </th>
    <th data-title="Quantity">
        <input type="number" class="prod-number" data-id="<?= $model->id ?>" value="<?= (int)$count ?>">
    </th>
    <th class="tot-price" data-title="Total">
        <?= Yii::$app->formatter->asCurrency($count * $model->price) ?>
    </th>
</tr>