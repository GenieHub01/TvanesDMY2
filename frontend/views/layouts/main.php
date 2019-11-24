<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

?>
<? unset($this->assetBundles['yii\bootstrap\BootstrapAsset']);?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="electric turbo actuator, turbo actuator, turbo vanes, turbo parts, wastegate, garret turbo, turbo wastegate, turbo car, turbo kit, turbocharger, mondeo turbo actuator, jaguar turbo actuator, ford turbo actuator, mercedes turbo actuator, turbo actuator bmw, turbo actuator replacement, turbo actuator audi, how a turbo actuator works, changing a turbo actuator">
    <meta name="description" content="Turbo Vanes sell a wide range of turbo actuators. We are based in Birmingham, UK. Also sell electronic turbo actuators, vacuum turbocharger wastegate and turbo gaskets. Branded turbo actuator on sale!">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="./img/favicon.ico" type="image/x-icon" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?=  Yii::$app->name.' - '.Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <script>

        var looper;
        var degrees = 0;
        function rotateAnimation(el,speed){
            var elem = document.getElementById(el);
            elem.style.transform = "rotate("+degrees+"deg)";

            looper = setTimeout('rotateAnimation(\''+el+'\','+speed+')',speed);
            degrees++;
            if(degrees > 359){
                degrees = 1;
            }
        }

    </script>

</head>
<body <?= empty($this->context->brandList) ? 'class="side-pages"' : null?> >
<?php $this->beginBody() ?>
    <?= $this->render('header') ?>
    <?= \common\widgets\Alert::widget() ?>
    <?= $content ?>
    <?= $this->render('footer') ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
