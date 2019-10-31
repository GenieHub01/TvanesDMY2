<?php

namespace backend\controllers;

use backend\models\search\OrderSearch;
use Yii;
use backend\models\Order;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Worldpay\Worldpay;
use Worldpay\WorldpayException;

/**
 * OrdersController implements the CRUD actions for Order model.
 */
class OrdersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
//                    [
//                        'actions' => ['login', 'error'],
//                        'allow' => true,
//                    ],
                    [
//                        'actions' => ['*'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {


        $findModel= new OrderSearch();


        $dataProvider = $findModel->search(Yii::$app->request->queryParams);
        $pages = new Pagination(['totalCount' => $dataProvider->totalCount  ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'findModel'=>$findModel,
            'pages'=>$pages
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $oldStatus = $model->status;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            if ($oldStatus<>$model->status) {
                Yii::debug( Yii::$app
                    ->mailer
                    ->compose()
                    //                ->compose(
                    //                    ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                    //                    ['user' => $user]
                    //                )

                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                    ->setTo($model->email)
                    ->setSubject('New status of order #'.$model->id  )
                    ->setTextBody('New order status: '.Order::$_status[$model->status])
                    ->send());
            }


            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Refund money order
     * If
     * @param integer $worldpay_order_id
     * @return
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionRefund($worldpay_order_id) {

        $worldpay = new Worldpay(Yii::$app->params['worldpay_api_service_key']);

        // Sometimes your SSL doesnt validate locally
        // DONT USE IN PRODUCTION
        $worldpay->disableSSLCheck(true);

        $worldpayOrderCode = $worldpay_order_id;

        try {

            $worldpay->refundOrder($worldpayOrderCode);
            $model = Order::find()
                ->where(['worldpay_order_id' => $worldpay_order_id])
                ->one();
            if ($model) {
                $model->worldpay_order_status = 'REFUNDED';
                $model->save();
                Yii::$app
                    ->mailer
                    ->compose()
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                    ->setTo($model->email)
                    ->setSubject('Refund on order #'.$model->id  )
                    ->setTextBody('Dear ' . $model->first_name . ' ' . $model->last_name .' We refund you amount '.($model->total_sum+$model->shipping_cost).' GBP, for orderOrder refunded for you.')
                    ->send();
            }

        }
        catch (WorldpayException $e) {
            // Worldpay has thrown an exception
            echo 'Error code: ' . $e->getCustomCode() . '<br/>
                HTTP status code:' . $e->getHttpStatusCode() . '<br/>
                Error description: ' . $e->getDescription()  . ' <br/>
                 Error message: ' . $e->getMessage();
        }
        return $this->redirect(['index']);
    }
}
