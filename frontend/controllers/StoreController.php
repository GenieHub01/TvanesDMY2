<?php

namespace frontend\controllers;

use common\components\BaseController;
use frontend\models\Goods;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class StoreController extends BaseController
{
    public $stylesName;

    public function actionView($id){
        $model = Goods::findOne(['id'=>$id]);
        $this->stylesName = 'product-p';
        if (!$model){
            throw  new NotFoundHttpException('Not Found');
        }

        return $this->render('view',['model'=>$model]);
    }


}