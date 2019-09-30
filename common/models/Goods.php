<?php

namespace common\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "goods".
 *
 * @property int $id
 * @property string $title
 * @property string $uri
 * @property int $import_id
 * @property string $description
 * @property string $purchase_price
 * @property string $regular_price
 * @property string $sale_price
 * @property array $images
 * @property int $category_id
 * @property string $brand
 * @property string $model
 * @property int $fuel
 * @property string $engine_type
 * @property string $add_info
 * @property string $oem_exchange
 * @property string $engine_capacity
 * @property string $engine_power
 * @property array $part_number_list
 * @property array $comparison_number_list
 * @property string $years_string
 * @property string $category_string
 * @property string $sku
 * @property int $stock_status
 * @property int $tax_status
 * @property int $status
 *
 * @property Category $category
 * @property Years[] $years
 */
class Goods extends \yii\db\ActiveRecord
{

    const FUEL_PETROL = 2;
    const FUEL_DIESEL = 3;

    const STATUS_DISABLE= 1;
    const STATUS_ACTIVE = 10;
    const STATUS_DEFAULT = self::STATUS_ACTIVE;

    static $_status = [
        self::STATUS_DISABLE =>'Inactive',
        self::STATUS_ACTIVE =>'Active',
    ];

    public $_images;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods';
    }


    public function getPrice(){
        $price = $this->regular_price;


        $charge = $this->use_holdingcharge ? \Yii::$app->params['HOLDINGCHARGE'] : 0;

        return $price+$charge;
    }

    public function getTax(){
       return  $this->tax_id ?    \Yii::$app->params['tax'][$this->tax_id]  : 0 ;
    }



     public function getTotalPrice(){
        $price = $this->getPrice();
        $tax = $this->tax;

        if ($tax){
            return $price + ($price*$tax/100);
        } else {
            return $price;
        }

     }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['import_id', 'category_id', 'fuel', 'stock_status', 'tax_status', 'status'], 'integer'],
            [['purchase_price', 'regular_price', 'sale_price'], 'number'],
            [['images', 'part_number_list', 'comparison_number_list'], 'safe'],
            [['title', 'brand', 'model', 'add_info', 'years_string', 'category_string','uri'], 'string', 'max' => 255],
            [['images'], 'each', 'rule' => ['string']],
            [['description'], 'string', 'max' => 1000],
            [['engine_type', 'engine_capacity'], 'string', 'max' => 50],
            [['oem_exchange'], 'string', 'max' => 40],
            [['engine_power'], 'string', 'max' => 20],
            [['sku'], 'string', 'max' => 30],
//            [['years-array'], 'each', 'integer'],
            ['yearsArray', 'each', 'rule' => ['integer']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function getUrl(){
        return ['/store/view','id'=>$this->id];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'uri' => 'Uri',
            'import_id' => 'Import ID',
            'description' => 'Description',
            'purchase_price' => 'Purchase Price',
            'regular_price' => 'Regular Price',
            'sale_price' => 'Sale Price',
            'images' => 'Images',
            'category_id' => 'Category ID',
            'brand' => 'Brand',
            'model' => 'Model',
            'fuel' => 'Fuel',
            'engine_type' => 'Engine Type',
            'add_info' => 'Add Info',
            'oem_exchange' => 'Oem Exchange',
            'engine_capacity' => 'Engine Capacity',
            'engine_power' => 'Engine Power',
            'part_number_list' => 'Part Number List',
            'yearsArray' => 'Years',
            'comparison_number_list' => 'Comparison Number List',
            'sku' => 'Sku',
            'stock_status' => 'Stock Status',
            'tax_status' => 'Tax Status',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYears()
    {
        return $this->hasMany(Years::className(), ['goods_id' => 'id']);
    }

    public function getYearsArray(){

        if ($this->_yearsArray)
            return$this->_yearsArray;

        $this->_yearsArray =ArrayHelper::map($this->years,'year','year');
        return $this->_yearsArray;
    }

    private $_yearsArray;
    public function setYearsArray($value){
        $this->_yearsArray = $value;
//        return ArrayHelper::map($this->years,'year','year');
    }


  public function afterSave($insert, $changedAttributes)
  {
      if ($this->_yearsArray){

          if (!$insert){
              Years::deleteAll(['goods_id'=>$this->id]);
          }

          foreach ($this->_yearsArray as $year){
              $y = new Years();
              $y->goods_id = $this->id;
              $y->year = $year;
              $y->save(false);

          }
      }

      parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
  }


}
