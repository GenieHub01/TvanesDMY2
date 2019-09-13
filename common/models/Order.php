<?php

namespace common\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $company_name
 * @property string $note
 * @property string $admin_note
 * @property string $country
 * @property string $address
 * @property string $address_optional
 * @property string $city
 * @property string $postcode
 * @property string $phone
 * @property string $email
 * @property string $user_id
 * @property string $md5_link
 * @property string $total_sum
 * @property int $created_ts
 * @property int $updated_ts
 * @property int $status
 *
 * @property OrderItems[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{
    private $_user;



    public function getUser()
    {
        if ($this->_user == null) {
            $this->_user = Yii::$app->user->identity;
        }

        return $this->_user;
    }

    const STATUS_NEW = 1;

    const STATUS_END = 10;
    const STATUS_DEFAULT = self::STATUS_NEW;

    static $_status = [
      self::STATUS_NEW => 'New',
      self::STATUS_END => 'END',
    ];

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_ts',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_ts',
                    // ActiveRecord::EVENT_BEFORE_UPDATE => 'date_updated',
                ],
                'value' => function () {
                    return time(); //
                },
            ],

            'user_id' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'user_id',
                    //  ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_ts',
                    // ActiveRecord::EVENT_BEFORE_UPDATE => 'date_updated',
                ],
                'value' => function () {
                    return !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
                }
            ],
            'status' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'status',
                    //  ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_ts',
                    // ActiveRecord::EVENT_BEFORE_UPDATE => 'date_updated',
                ],
                'value' => function () {
                    return self::STATUS_DEFAULT; //
                }
            ],
            'md5_link' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'md5_link',
                    //  ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_ts',
                    // ActiveRecord::EVENT_BEFORE_UPDATE => 'date_updated',
                ],
                'value' => function () {
                    return Yii::$app->security->generateRandomString() ;//
                }
            ]
        ];
    }


    /** @inheritdoc */
    public function __construct( $config = [])
    {



        $this->setAttributes([
            'first_name' => $this->user->first_name,
            'last_name'    => $this->user->last_name,
            'email'    => $this->user->email,
            'address'    => $this->user->shipping_address,
            'address_optional'    => $this->user->shipping_address_optional,
            'city'    => $this->user->shipping_city,
            'postcode'    => $this->user->shipping_postcode,
            'phone'    => $this->user->shipping_phone,
        ], false);
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'country', 'address', 'city'], 'required'],
//            [['total_sum'], 'number'],

            [['first_name', 'last_name', 'company_name', 'country', 'address', 'address_optional', 'city'], 'string', 'max' => 255],
            [['note' ], 'string', 'max' => 250],
            [['postcode', 'phone', 'email'], 'string', 'max' => 40],
            ['email','email']
        ];
    }

    public function getUrl(){
        return  $this->user_id?  ['/orders/view','id'=>$this->id] : ['/orders/view','id'=>$this->id,'hash'=>$this->md5_link] ;
    }

    public function afterSave($insert, $changedAttributes)
    {

        if ($insert){

            Yii::$app->cart->destroyCart();
            Yii::$app
                ->mailer
                ->compose()
//                ->compose(
//                    ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
//                    ['user' => $user]
//                )

                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo($this->email)
                ->setSubject('New order at ' . Yii::$app->name)
                ->setTextBody('New order #'.$this->id)
                ->send();
        }

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'company_name' => 'Company Name',
            'note' => 'Note',
            'admin_note' => 'Admin Note',
            'country' => 'Country',
            'address' => 'Address',
            'address_optional' => 'Address Optional',
            'city' => 'City',
            'postcode' => 'Postcode',
            'phone' => 'Phone',
            'email' => 'Email',
            'total_sum' => 'Total Sum',
            'created_ts' => 'Created Ts',
            'updated_ts' => 'Updated Ts',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }
}
