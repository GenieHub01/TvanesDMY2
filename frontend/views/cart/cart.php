<?php
/**
 * @var $order \common\models\Order
 */
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html; ?>


<div class="  border border-info  p-3 y-3 " style="min-height: 75vh">


    <?if (count($items) <> 0){?>
    <h5>Cart (<?= count($items) ?>)</h5>
    <? if ($items): ?>

        <? foreach ($items as $key => $count): ?>

            <? if (isset($models[$key])) : ?>
                <div class="d-flex   border-info border-bottom py-2 justify-content-between" id="cartItem_<?=$key?>">
                    <? $model = $models[$key]; ?>

                    <?= $this->render('_cart_view', ['model' => $model, 'count' => $count]) ?>
                </div>

            <? else: ?>
                <div class="d-flex   border-info border-bottom py-2 justify-content-between">
                    <div>Some problem with this Product. Its no longer available.</div>
                </div>
            <? endif; ?>

        <? endforeach; ?>

    <? endif; ?>

    <div class="d-flex justify-content-end my-2">
        <div class="w-50">
<!--            --><?//= \yii\helpers\Html::a('Proceed To Checkout',['/cart/order'],['class'=>'btn btn-sm btn-primary float-right']) ?>
            Total: <span class="cart_total_sum"><?= Yii::$app->formatter->asCurrency(Yii::$app->cart->sum) ?></span>
        </div>
    </div>


    <div class="newOrder">
        <h5>Proceed To Checkout</h5>
        <?php $form = ActiveForm::begin(['id' => 'newOrder']); ?>

        <?= $form->field($order,'first_name') ?>
        <?= $form->field($order,'last_name') ?>
        <?= $form->field($order,'company_name') ?>
        <?= $form->field($order,'note')->textarea() ?>
        <?= $form->field($order,'country') ?>
        <?= $form->field($order,'address') ?>
        <?= $form->field($order,'address_optional') ?>
        <?= $form->field($order,'city') ?>
        <?= $form->field($order,'postcode') ?>
        <?= $form->field($order,'phone') ?>
        <?= $form->field($order,'email') ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <?}else {?>
        <h5>Cart is empty</h5>
    <?}?>


</div>
