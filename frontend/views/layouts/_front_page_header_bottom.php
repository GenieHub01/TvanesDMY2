<?php
use yii\helpers\Html;
?>

<h2 class="findd text-center">FIND WHAT ARE YOU LOOKING FOR</h2>

<h3 class="overr text-center">Over 29000+ Turbo Products</h3>

<div class="container">
    <div class="categos text-center">

        <h4 class="i-buy">I WANT TO BUY...</h4>

        <div class="selectss row">
            <div class="col-xl-2 pad-less">
                <?= \yii\helpers\Html::dropDownList('brand',null,$this->context->brandList,['class'=>'select-form','prompt'=>'make']) ?>
            </div>
            <div class="col-xl-2 pad-less">
                <?= \yii\helpers\Html::dropDownList('model',null,$this->context->brandList,['class'=>'select-form','disabled'=>'disabled','prompt'=>'Model']) ?>
            </div>
            <div class="col-xl-2 pad-less">
                <?= \yii\helpers\Html::dropDownList('capacity',null,$this->context->brandList,['class'=>'select-form','disabled'=>'disabled','prompt'=>'Engine Capacity']) ?>
            </div>
            <div class="col-xl-2 pad-less">
                <?= \yii\helpers\Html::dropDownList('year',null,$this->context->brandList,['class'=>'select-form','disabled'=>'disabled','prompt'=>'Year']) ?>
            </div>
            <div class="col-xl-2 pad-less">
                <?= \yii\helpers\Html::dropDownList('fuel',null,$this->context->brandList,['class'=>'select-form','disabled'=>'disabled','prompt'=>'-- Fuel --']) ?>
            </div>
            <div class="col-xl-2 pad-less">
                <?= \yii\helpers\Html::dropDownList('product',null,$this->context->brandList,['class'=>'select-form','disabled'=>'disabled','prompt'=>'-- Product --']) ?>
            </div>
        </div>
        <?= \yii\helpers\Html::a('Show','#',['id'=>'showproduct','class'=>'find-bt hvr-bounce-to-top']) ?>

    </div>
    <div class="th-want text-center">
        <input type="text" class="want-gen" placeholder="I want to buy...">
    </div>
</div>