<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

$this->title = Yii::t('app','SIGN UP');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="inner-pag">

    <div class="container">

        <h1 class="my-account"><?= Html::encode($this->title) ?></h1>


        <div class="al-login">
            <p class="log">SIGN UP</p>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="login-box">

                <div class="log-form">
                    <p class="form-nam">Username or email address <span>*</span></p>
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'class' => 'inp-form'])->label(false) ?>
                </div>

                <div class="log-form">
                    <p class="form-nam">Password <span>*</span></p>
                    <?= $form->field($model, 'password')->passwordInput(['class' => 'inp-form'])->label(false) ?>
                </div>

                <div class="log-form">
                    <div class="bt-inline">
                        <?= Html::submitButton('Sign Up', ['class' => 'log-in hvr-bounce-to-top', 'name' => 'signup-button']) ?>
                    </div>
                </div>
                <?= Html::a(Yii::t('app','Lost your password?'), ['site/request-password-reset'],['class'=>'lost-pas']) ?>
                <?php ActiveForm::end(); ?>
            </div>

        </div>

    </div>

</div>