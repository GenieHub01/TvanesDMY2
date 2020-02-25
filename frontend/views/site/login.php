<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app','MY ACCOUNT');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="inner-pag">

    <div class="container">

        <h1 class="my-account"><?= Html::encode($this->title) ?></h1>


        <div class="al-login">
            <p class="log">LOGIN</p>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
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
                        <?= Html::submitButton('Log In', ['class' => 'log-in hvr-bounce-to-top', 'name' => 'login-button']) ?>
                    </div>
                    <div class="bt-inline">
                        <?= Html::activeCheckbox($model, 'rememberMe', ['class' => 'check-inp', 'id'=>'check-inp', 'label'=> false]) ?>
                        <?= Html::activeLabel($model, 'rememberMe', ['class' => 'remember']) ?>
                    </div>
                </div>
                    <?= Html::a(Yii::t('app','Lost your password?'), ['site/request-password-reset'],['class'=>'lost-pas']) ?>
                <?= Html::a('Sign Up','/site/signup' ,['class' => 'log-in hvr-bounce-to-top', 'name' => 'login-button']) ?>
                <?php ActiveForm::end(); ?>
            </div>

        </div>

    </div>

</div>