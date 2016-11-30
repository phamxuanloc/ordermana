<?php
namespace app\models;

use app\components\Model;
use Yii;

/**
 * This is the model class for table "customer_item".
 *
 * @property integer       $id
 * @property integer       $order_customer_id
 * @property integer       $product_id
 * @property integer       $quantity
 * @property double        $total_price
 *
 * @property OrderCustomer $orderCustomer
 */
class CustomerItem extends Model {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'customer_item';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'order_customer_id',
					'product_id',
					'quantity',
					'total_price',
				],
				'required',
			],
			[
				[
					'order_customer_id',
					'product_id',
					'quantity',
					'status',
				],
				'integer',
			],
			[
				['total_price'],
				'number',
			],
			[
				['order_customer_id'],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => OrderCustomer::className(),
				'targetAttribute' => ['order_customer_id' => 'id'],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'                => 'ID',
			'order_customer_id' => 'Order Customer ID',
			'product_id'        => 'Product ID',
			'quantity'          => 'Quantity',
			'total_price'       => 'Total Price',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrderCustomer() {
		return $this->hasOne(OrderCustomer::className(), ['id' => 'order_customer_id']);
	}
}
