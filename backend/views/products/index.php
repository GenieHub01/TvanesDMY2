<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SearchGoods */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="   border my-1 p-3 ">

    <div class="row">
        <div class="col-md-2 col-sm-3 border-right">
            <?= $this->render('../site/_menu') ?>
        </div>
        <div class="col-md-10 col-sm-9">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
//                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'title',
//                    'uri',
                    'import_id',
//                    'description',
                    //'purchase_price',
                    //'regular_price',
                    //'sale_price',
                    //'images',
                    'category_id',
                    'brand',
                    'model',
                    'fuel',
                    'engine_type',
                    //'add_info',
                    //'oem_exchange',
                    //'engine_capacity',
                    //'engine_power',
                    //'part_number_list',
                    //'comparison_number_list',
                    //'sku',
                    //'stock_status',
                    //'tax_status',
                    //'status',
                    //'category_string',
                    //'years_string',
                    //'tax_id',
                    //'use_holdingcharge',

                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view}  {update}  ',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                $customurl = Yii::$app->getUrlManager()->createUrl(['/products/view', 'id' => $model['id']]);
                                return \yii\helpers\Html::a('<i class="far fa-eye "></i>', $customurl,
                                    ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                            },
                            'update' => function ($url, $model) {
                                $customurl = Yii::$app->getUrlManager()->createUrl(['/products/update', 'id' => $model['id']]);
                                return \yii\helpers\Html::a('<i class="far fa-edit "></i>', $customurl,
                                    ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                            },
//                            'delete'=>function ($url, $model) {
//                                $customurl=Yii::$app->getUrlManager()->createUrl(['/user/delete','id'=>$model['id'] ]);
//                                return \yii\helpers\Html::a( '<i class="fas fa-trash "></i>', $customurl,
//                                    ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
//                            }
                        ],
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>
