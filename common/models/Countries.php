<?php

namespace common\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "countries".
 *
 * @property int $id
 * @property string $title
 * @property string $shortcode
 * @property int $tax
 * @property string $shipping
 * @property int $created_ts
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries';
    }

    static function getList(){
        return ArrayHelper::map(self::find()->orderBy('title')->all(), 'id','title');
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_ts',
//                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_ts',
                    // ActiveRecord::EVENT_BEFORE_UPDATE => 'date_updated',
                ],
                'value' => function () {
                    return time(); //
                },
            ],

//            'user_id' => [
//                'class' => AttributeBehavior::className(),
//                'attributes' => [
//                    ActiveRecord::EVENT_BEFORE_INSERT => 'user_id',
//                    //  ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_ts',
//                    // ActiveRecord::EVENT_BEFORE_UPDATE => 'date_updated',
//                ],
//                'value' => function () {
//                    return !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
//                }
//            ],
//            'status' => [
//                'class' => AttributeBehavior::className(),
//                'attributes' => [
//                    ActiveRecord::EVENT_BEFORE_INSERT => 'status',
//                    //  ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_ts',
//                    // ActiveRecord::EVENT_BEFORE_UPDATE => 'date_updated',
//                ],
//                'value' => function () {
//                    return self::STATUS_DEFAULT; //
//                }
//            ],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tax', 'created_ts'], 'integer'],
            [['shipping'], 'number'],
            [['title'], 'string', 'max' => 100],
            [['shortcode'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'shortcode' => 'Shortcode',
            'tax' => 'Tax',
            'shipping' => 'Shipping',
            'created_ts' => 'Created Ts',
        ];
    }
}
