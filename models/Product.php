<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property integer $code
 * @property string $image
 * @property integer $in_stock
 * @property double $base_price
 * @property string $description
 * @property double $distribute_sale
 * @property double $agent_sale
 * @property double $retail_sale
 * @property string $created_date
 *
 * @property OrderItem[] $orderItems
 * @property Category $category
 * @property UserStock[] $userStocks
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'base_price', 'distribute_sale', 'agent_sale', 'retail_sale'], 'required'],
            [['category_id', 'code', 'in_stock'], 'integer'],
            [['base_price', 'distribute_sale', 'agent_sale', 'retail_sale'], 'number'],
            [['description', 'created_date'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'code' => 'Code',
            'image' => 'Image',
            'in_stock' => 'In Stock',
            'base_price' => 'Base Price',
            'description' => 'Description',
            'distribute_sale' => 'Distribute Sale',
            'agent_sale' => 'Agent Sale',
            'retail_sale' => 'Retail Sale',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['product_id' => 'id']);
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
    public function getUserStocks()
    {
        return $this->hasMany(UserStock::className(), ['product_id' => 'id']);
    }
}
