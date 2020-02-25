<?php
/**
 * @var $order \frontend\models\Order
 */

    use yii\bootstrap4\ActiveForm;
    use yii\helpers\Html;

    $this->title = 'CART';

?>

<div class="inner-pag">

    <div class="container">
        <?if (count($items) <> 0){?>
            <!--start products table -->

            <table class="prods-table">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                </thead>

                <tbody>
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
                </tbody>

            </table>

            <div class="done-cart">
                <div class="row">
                    <div class="col-md-8 center-tex">
                        <?php $form = ActiveForm::begin(['id' => 'promocodeApply','action'=>'/cart/promocode-apply']); ?>
                        <?= Html::textInput('promocode',Yii::$app->cart->promocode ? Yii::$app->cart->promocode->code : null,['class'=>'coupon-cod','placeholder'=>'Coupon code']) ?>
                        <?= Html::submitButton('Apply Coupon',['class'=>'apply-c hvr-bounce-to-top']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="col-md-4 text-right center-tex">
                        <button class="update-cart" disabled>Update Cart</button>
                    </div>
                </div>

            </div>

            <div class="row justify-content-end cart-total">
                <div class="col-md-6">
                    <h1 class="th-total">CART TOTALS</h1>
                    <table class="price-table">
                        <tbody>
                        <tr>
                            <th>Subtotal</th>
                            <td>
                                <span id="subTotal" class="subTotal">
                                    <?= Yii::$app->formatter->asCurrency(Yii::$app->cart->subAmount) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Holding Deposit</th>
                            <td>
                                <span class="holdingDeposit">
                                    <?= Yii::$app->formatter->asCurrency(Yii::$app->cart->subHoldingDeposit) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tax</th>
                            <td>
                                <span class="taxAmount">
                                    <?=Yii::$app->formatter->asCurrency(Yii::$app->cart->taxAmount)?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Shipping</th>
                            <td>
                                <span  class="shippingAmount" id="shippingAmount">
                                    <?= Yii::$app->formatter->asCurrency(Yii::$app->cart->shippingAmount) ?>
                                </span>
                                <?=  (Yii::$app->cart->extraShippingAmount>0) ? '<span class="extraShipping" id="extraShipping">*</span>' : '<span class="extraShipping" id="extraShipping" style="display: none;">*</span>' ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Total		</th>
                            <td class="total-price">
                                <span id="cartTotal" class="cartTotal"><?= Yii::$app->formatter->asCurrency(Yii::$app->cart->shippingAmount + Yii::$app->cart->totalAmount) ?></span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!--start the form  -->

            <div class="formm">
                <?php $form = ActiveForm::begin(['id' => 'newOrder']); ?>
                <div class="row">
                    <div class="col-md-6">
                        <p class="forms-titl">BILLING DETAILS</p>

                        <div class="eac-forms">
                            <div class="row">
                                <div class="col-6">
                                    <p class="form-nam">First name <span  data-toggle="tooltip" data-placement="right" title="Required">*</span></p>
                                    <?= $form->field($order,'first_name')->textInput(['class' => 'inp-form'])->label(false) ?>
                                </div>
                                <div class="col-6">
                                    <p class="form-nam">Last name <span  data-toggle="tooltip" data-placement="right" title="Required">*</span></p>
                                    <?= $form->field($order,'last_name')->textInput(['class' => 'inp-form'])->label(false) ?>
                                </div>
                            </div>
                        </div>

                        <div class="eac-forms">
                            <p class="form-nam">Company name (optional)</p>
                            <?= $form->field($order,'company_name')->textInput(['class' => 'inp-form'])->label(false) ?>
                        </div>

                        <div class="eac-forms">
                            <?= $form->field($order,'country_id')->dropDownList(\common\models\Countries::getList(),['prompt'=>'-- Country --' ]) ?>
                        </div>

                        <div class="eac-forms">
                            <p class="form-nam">Street address <span  data-toggle="tooltip" data-placement="right" title="Required">*</span></p>
                            <?= $form->field($order,'address')->textInput(['class' => 'inp-form'])->label(false) ?>
                            <?= $form->field($order,'address_optional')->textInput(['class' => 'inp-form'])->label(false) ?>
                        </div>

                        <div class="eac-forms">
                            <p class="form-nam">Town / City <span  data-toggle="tooltip" data-placement="right" title="Required">*</span></p>
                            <?= $form->field($order,'city')->textInput(['class' => 'inp-form'])->label(false) ?>
                        </div>

                        <div class="eac-forms">
                            <p class="form-nam">Postcode / ZIP <span  data-toggle="tooltip" data-placement="right" title="Required">*</span></p>
                            <?= $form->field($order,'postcode')->textInput(['class' => 'inp-form'])->label(false) ?>
                        </div>
                        <div class="eac-forms">
                            <p class="form-nam">Phone <span  data-toggle="tooltip" data-placement="right" title="Required">*</span></p>
                            <?= $form->field($order,'phone')->textInput(['class' => 'inp-form'])->label(false) ?>
                        </div>
                        <div class="eac-forms">
                            <p class="form-nam">Email address <span  data-toggle="tooltip" data-placement="right" title="Required">*</span></p>
                            <?= $form->field($order,'email')->textInput(['class' => 'inp-form','type'=>'email'])->label(false) ?>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <p class="forms-titl">ADDITIONAL INFORMATION</p>

                        <div class="eac-forms">
                            <p class="form-nam">Order notes (optional)</p>
                            <?= $form->field($order,'note')->textarea(['class'=>'inp-form','placeholder'=>'Notes about your order, e.g. special notes for delivery.']) ?>
                        </div>
                    </div>

                </div>
            </div>

            <!--end the form  -->

            <!--start your order -->

            <div class="your-order">
                <p class="forms-titl">YOUR ORDER</p>

                <div class="prod-tot">
                    <div class="head-row">
                        <div class="row">
                            <div class="col-md-9 col-sm-8 col-7 text-right">
                                <p class="col-titl">Product</p>
                            </div>
                            <div class="col-md-3 col-sm-4 col-5 text-right">
                                <p class="col-titl">Total</p>
                            </div>
                        </div>
                    </div>

                    <div class="prod-row">
                        <? if ($items): ?>
                            <? foreach ($items as $key => $count): ?>

                                <? if (isset($models[$key])) : ?>

                                    <? $model = $models[$key]; ?>

                                    <?= $this->render('_cart_total', ['model' => $model, 'count' => $count,'key'=>$key]) ?>


                                <? else: ?>
                                    <div class="d-flex   border-info border-bottom py-2 justify-content-between">
                                        <div>Some problem with this Product. Its no longer available.</div>
                                    </div>
                                <? endif; ?>

                            <? endforeach; ?>
                        <? endif; ?>
                    </div>

                    <div class="Subtot-row">
                        <div class="row">
                            <div class="col-md-9 col-sm-8 col-7 text-right pad-col">
                                <p class="col-titl">Subtotal	</p>
                            </div>
                            <div class="col-md-3 col-sm-4 col-5 text-right pad-col">
                                <p class="col-titl"> <?= Yii::$app->formatter->asCurrency(Yii::$app->cart->subAmount) ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9 col-sm-8 col-7 text-right pad-col">
                                <p class="col-titl">Holding Deposit</p>
                            </div>
                            <div class="col-md-3 col-sm-4 col-5 text-right pad-col">
                                <p class="col-titl">  <?= Yii::$app->formatter->asCurrency(Yii::$app->cart->subHoldingDeposit) ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9 col-sm-8 col-7 text-right pad-col">
                                <p class="col-titl">Tax</p>
                            </div>
                            <div class="col-md-3 col-sm-4 col-5 text-right pad-col">
                                <p class="col-titl"> <?=Yii::$app->formatter->asCurrency(Yii::$app->cart->taxAmount)?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9 col-sm-8 col-7 text-right pad-col">
                                <p class="col-titl">Shipping</p>
                            </div>
                            <div class="col-md-3 col-sm-4 col-5 text-right pad-col">
                                <p class="col-titl">
                                <span  class="shippingAmount" id="shippingAmount">
                                    <?= Yii::$app->formatter->asCurrency(Yii::$app->cart->shippingAmount) ?>
                                </span>
                                    <?=  (Yii::$app->cart->extraShippingAmount>0) ? '<span class="extraShipping" id="extraShipping">*</span>' : '<span class="extraShipping" id="extraShipping" style="display: none;">*</span>' ?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9 col-sm-8 col-7 text-right pad-col">
                                <p class="col-titl">Tax</p>
                            </div>
                            <div class="col-md-3 col-sm-4 col-5 text-right pad-col">
                                <p class="col-titl"> <?=Yii::$app->formatter->asCurrency(Yii::$app->cart->taxAmount)?></p>
                            </div>
                        </div>
                    </div>

                    <div class="total-row">
                        <div class="row">
                            <div class="col-md-9 col-sm-8 col-7 text-right pad-col">
                                <p class="col-titl">Total</p>
                            </div>
                            <div class="col-md-3 col-sm-4 col-5 text-right pad-col">
                                <p class="col-titl total-num"><span id="totalCartTotal" class="cartTotal"><?= Yii::$app->formatter->asCurrency(Yii::$app->cart->shippingAmount + Yii::$app->cart->totalAmount) ?></span></p>
                            </div>
                        </div>
                    </div>

                </div>
                <div id='paymentSection'></div>
                <div class="terms">
                    <p class="your-per">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#" class="privacy">privacy policy</a>.</p>

                    <input type="checkbox" class="terms-chec" id="terms-chec">

                    <label class="agree" for="terms-chec">I have read and agree to the website <a href="#" class="privacy">privacy policy</a> <span class="star">*</span> </label>

                    <div class="text-right">
                        <?= Html::submitButton('Place Order', ['class' => 'place hvr-bounce-to-top', 'name' => 'contact-button', 'onclick' => 'Worldpay.submitTemplateForm()']) ?>
                    </div>

                </div>
                <?php ActiveForm::end(); ?>
            </div>

            <!--end your order -->
        <?}else {?>
            <h5>Cart is empty</h5>
        <?}?>
    </div>

</div>


<script type='text/javascript'>
    window.onload = function() {
        Worldpay.useTemplateForm({
            'clientKey':'<?= Yii::$app->params['worldpay_api_client_key'] ?>',
            'form':'newOrder',
            'paymentSection':'paymentSection',
            'saveButton':false,
            'display':'inline',
            'reusable':false,
            'callback': function(obj) {
                if (obj && obj.token) {
                    var _el = document.createElement('input');
                    _el.value = obj.token;
                    _el.type = 'hidden';
                    _el.name = 'token';
                    document.getElementById('newOrder').appendChild(_el);
                    document.getElementById('newOrder').submit();
                }
            }
        });
    }
</script>
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
                     updateCartCount(respond.cart.count);
                    updateCartLine(respond.item);
                    updateCart(respond.cart);
                 $('#order-promocode').val(respond.cart.promocode.code);
            })
            .fail(function (xhr, status, error) {
                showError(xhr, status, error);
            });
        return false;
    });

JS;
$this->registerJs($js, \yii\web\View::POS_READY);

?>
