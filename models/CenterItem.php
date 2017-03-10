<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "center_item".
 *
 * @property integer     $id
 * @property integer     $order_id
 * @property integer     $product_id
 * @property double     $discount
 * @property integer     $quantity
 * @property double      $total_price
 *
 * @property OrderCenter $order
 * @property Product     $product
 */
class CenterItem extends \app\components\Model {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'center_item';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'order_id',
					'product_id',
					'quantity',
					'total_price',
				],
				'required',
			],
			[
				[
					'order_id',
					'product_id',
					'quantity',
				],
				'integer',
			],
			[
				['total_price','discount'],
				'number',
			],
			[
				['order_id'],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => OrderCenter::className(),
				'targetAttribute' => ['order_id' => 'id'],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'          => 'ID',
			'order_id'    => 'Order ID',
			'product_id'  => 'Product ID',
			'quantity'    => 'Quantity',
			'total_price' => 'Total Price',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrder() {
		return $this->hasOne(OrderCenter::className(), ['id' => 'order_id']);
	}

	public function getProduct() {
		return $this->hasOne(Product::className(), ['id' => 'product_id']);
	}
}
