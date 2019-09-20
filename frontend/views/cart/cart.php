<?php
/**
 * @var $order \frontend\models\Order
 */
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html; ?>


<div class="  border border-info  p-3 y-3 " style="min-height: 75vh">


    <?if (count($items) <> 0){?>
    <h5>Cart (<?= count($items) ?>)</h5>
    <? if ($items): ?>

        <? foreach ($items as $key => $count): ?>

            <? if (isset($models[$key])) : ?>

                    <? $model = $models[$key]; ?>

                    <?= $this->render('_cart_view', ['model' => $model, 'count' => $count,'key'=>$key]) ?>


            <? else: ?>
                <div class="d-flex   border-info border-bottom py-2 justify-content-between">
                    <div>Some problem with this Product. Its no longer available.</div>
                </div>
            <? endif; ?>

        <? endforeach; ?>

    <? endif; ?>

    <div class="d-flex justify-content-end my-2">
        <div class="w-50">
            <?$sum =Yii::$app->cart->sum ?>
            <?$tax =Yii::$app->cart->tax ?>
<!--            --><?//= \yii\helpers\Html::a('Proceed To Checkout',['/cart/order'],['class'=>'btn btn-sm btn-primary float-right']) ?>
            <div>
                Subtotal: <span class="cart_total_sum"><?= Yii::$app->formatter->asCurrency(Yii::$app->cart->sum) ?></span>
            </div>
            <div>
                Tax: <span class="cart_total_tax"><?= Yii::$app->formatter->asCurrency(Yii::$app->cart->tax) ?></span>
            </div>

            <div>
                Shipping: <?= Yii::$app->formatter->asCurrency(Yii::$app->params['SHIPPINGCOST']) ?>
            </div>
            <div>
                Total: <span class="cart_total_sumtotal"><?= Yii::$app->formatter->asCurrency(Yii::$app->cart->sum + Yii::$app->params['SHIPPINGCOST']) ?></span>
            </div>
            <div class="promocode_apply hidden border  border-warning p-2">
                After Applied Promocode: <span id="promocodeSum"></span> <span id="promocodeDesc"></span>
            </div>
            <br>
            <br>

            <?php $form = ActiveForm::begin(['id' => 'promocodeApply','action'=>'/cart/promocode-apply']); ?>
            Do you have Promocode?
            <div class="d-flex">
                <?= Html::textInput('promocode','',['class'=>'form-control','placeholder'=>'Promocode']) ?>
                <?= Html::submitButton('Apply',['class'=>'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

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
        <?= $form->field($order,'promocode') ?>
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


<?
$js = <<<JS
$('#promocodeApply').on('beforeSubmit', function () {
        var form = jQuery(this);
        jQuery.get(
            form.attr("action"),
            form.serialize()
        )
            .done(function (respond) { 
                
                    // data is saved
                    $.growl({ title: "Success", message: "Promocode applied!" });
                     // $('#id' + respond.id).replaceWith(respond.html);
                     $('#promocodeSum').html(respond.totalSum);
                     $('#promocodeDesc').html('code :'+respond.code+' -'+respond.desc);
                     $('#order-promocode').val(respond.code);
                
            })
            .fail(function (xhr, status, error) {
                showError(xhr, status, error);
            });
        return false;
    });

JS;
$this->registerJs($js, \yii\web\View::POS_READY);

?>
