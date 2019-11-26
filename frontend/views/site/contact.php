<?php

    use yii\captcha\Captcha;
    use yii\widgets\ActiveForm;

    $this->title = 'CONTACT';
?>
<div class="product-p side-pages">
    <div class="inner-pag">

        <div class="container">
            <span class="we-love">We’d Love to Hear From You</span>
            <h1 class="the-title">LET'S GET IN TOUCH!</h1>

            <div class="our-info row">
                <div class="col-md-4">
                    <div class="eac-info text-center">
                        <i class="fas fa-map-marker-alt info-icon"></i>
                        <h3 class="info-title">ADDRESS TURBOVANES LTD</h3>
                        <p class="info-detail">268 Bearwood Road Smethwick B66 4HR UK</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="eac-info text-center">
                        <i class="fas fa-phone-alt info-icon"></i>
                        <h3 class="info-title">PHONE</h3>
                        <p class="info-detail">0121 558 6868</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="eac-info text-center">
                        <i class="fas fa-map-marker-alt info-icon"></i>
                        <a href="mailto:info@turbovanesltd.com">
                            <h3 class="info-title">EMAIL</h3>
                        </a>
                        <p class="info-detail">info@turbovanesltd.com</p>
                    </div>
                </div>

            </div>


            <div class="row">

                <div class="col-md-6 col-xl-8 the-forms">
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <div class="row">
                        <div class="col-xl-6">
                            <span class="form-titl">YOUR NAME *</span>
                            <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'class' =>'inp-form'])->label(false); ?>
                        </div>
                        <div class="col-xl-6">
                            <span class="form-titl">YOUR EMAIL ADDRESS *</span>
                            <?= $form->field($model, 'email')->textInput(['class' =>'inp-form'])->label(false); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <span class="form-titl">MAKE</span>
                            <?= $form->field($model, 'make')->textInput(['class' =>'inp-form'])->label(false); ?>
                        </div>
                        <div class="col-xl-6">
                            <span class="form-titl">CAR REG:</span>
                            <?= $form->field($model, 'carReg')->textInput(['class' =>'inp-form'])->label(false); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <span class="form-titl">VIN/CHASSIS NUMBER:</span>
                            <?= $form->field($model, 'vinNumber')->textInput(['class' =>'inp-form'])->label(false); ?>
                        </div>
                        <div class="col-xl-6">
                            <span class="form-titl">PART NUMBER:</span>
                            <?= $form->field($model, 'partNumber')->textInput(['class' =>'inp-form'])->label(false); ?>
                        </div>
                    </div>


                    <span class="form-titl">SUBJECT *</span>
                    <?= $form->field($model, 'subject')->textInput(['class' =>'inp-form'])->label(false); ?>

                    <span class="form-titl">YOUR MESSAGE *</span>
                    <?= $form->field($model, 'body')->textarea(['class' =>'inp-form'])->label(false); ?>
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        'options' => ['class' => 'inp-form']
                    ]) ?>

                    <button class="send-message">Send Message</button>
                    <?php ActiveForm::end(); ?>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="call-part">
                        <a href="tel:+0121-558-6868">
                            <div class="call-btnn">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                        </a>

                        <p class="feel-free">FEEL FREE TO CALL US TODAY!</p>

                        <p class="available-time">We are available between <strong>| 10:00 AM To 5:00 PM |</strong> Monday to Friday |</p>
                        <div class="text-center">
                            <button class="call-now">Call us now +0121-558-6868</button>
                        </div>

                    </div>

                    <div class="supports">
                        <div class="eac-support row">
                            <div class="col-2">
                                <div class="icon-back">
                                    <i class="fas fa-truck"></i>
                                </div>
                            </div>
                            <div class="col-10">
                                <a href="delivery.html">
                                    <p class="support-title">DISPATCH &amp; DELIVERY</p>
                                </a>
                                <p class="support-sum">Delivery time may vary depending on other conditions: courier, weather, anything out of our control.No deliveries will be made on a bank holiday or on a Sunday.</p>
                            </div>
                        </div>

                        <div class="eac-support row">
                            <div class="col-2">
                                <div class="icon-back">
                                    <i class="fas fa-retweet"></i>
                                </div>
                            </div>
                            <div class="col-10">
                                <a href="return-policy.html">
                                    <p class="support-title">RETURNS POLICY</p>
                                </a>
                                <p class="support-sum">For turbo replacement cost, turbocharger, turbo & electronic turbo boost controller replacement, please check our RETURNS POLICY PAGE.</p>
                            </div>
                        </div>

                        <div class="eac-support row">
                            <div class="col-2">
                                <div class="icon-back">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                            </div>
                            <div class="col-10">
                                <a href="turbo-problrems.html">
                                    <p class="support-title">TURBO PROBLEMS</p>
                                </a>
                                <p class="support-sum">Variable Vane Turbo Problems – common Turbo faults please click here to check to view our TURBO PROBLEMS PAGE.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

