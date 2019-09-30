
<h5>Menu</h5>
<?echo \yii\bootstrap4\Nav::widget([

    'items' => [
        [
            'label' => 'Orders',
            'url' => ['/orders/index'],
            'active'=> Yii::$app->controller->id == 'orders',
            'linkOptions' => [ 'class'=>'nav-item'],
        ],

        [
            'label' => 'Promo',
            'url' => ['/promocodes/index'],
            'active'=> Yii::$app->controller->id == 'promocodes',
            'linkOptions' => [ 'class'=>'nav-item'],
        ],

        [
            'label' => 'Login',
            'url' => ['/site/login'],
            'visible' => Yii::$app->user->isGuest
        ],
        [
            'label' => 'Users',
            'url' => ['/user/index'],
            'active'=> Yii::$app->controller->id == 'user',
            'linkOptions' => [ 'class'=>'nav-item'],
//            'visible' => Yii::$app->user->isGuest
        ],
    ],
    'options' => ['class' =>'nav flex-column nav-pills'], // set this to nav-tab to get tab-styled navigation
]);?>

<?//var_dump(Yii::$app->controller->id)?>
