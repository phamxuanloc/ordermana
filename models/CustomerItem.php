<?php
namespace app\models;

use app\components\Model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "customer_item".
 *
 * @property integer       $id
 * @property integer       $order_customer_id
 * @property integer       $product_id
 * @property integer       $quantity
 * @property integer       $customer_id
 * @property integer       $status
 * @property double        $total_price
 * @property double        $discount
 *
 * @property OrderCustomer $orderCustomer
 * @property Product       $product
 * @property customer      $customer
 */
class CustomerItem extends Model {

	const STATUS               = [
		'Chưa nhận',
		'Đã nhận',
	];

	const STATUS_RECEIPTED     = 1;

	const STATUS_NOT_RECEIPTED = 0;

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
					'customer_id',
				],
				'integer',
			],
			[
				'created_date',
				'safe',
			],
			[
				[
					'total_price',
					'discount',
				],
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
			'product_id'        => 'Tên sản phẩm',
			'quantity'          => 'Số lượng',
			'total_price'       => 'Tổng tiền',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrderCustomer() {
		return $this->hasOne(OrderCustomer::className(), ['id' => 'order_customer_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProduct() {
		return $this->hasOne(Product::className(), ['id' => 'product_id']);
	}

	public function getProductByCategory() {
		$category = Category::findOne($this->product->category_id);
		return ArrayHelper::map($category->products, 'id', 'name');
	}

	public function getCustomer() {
		return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
	}

	public function getItemStatus() {
		if($this->status == self::STATUS_RECEIPTED) {
			return 'Đã nhận';
		} else {
			return 'Chưa nhận';
		}
	}
}
