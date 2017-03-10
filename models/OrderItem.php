<?php
namespace app\models;

use app\components\Model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "order_item".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $quantity
 * @property double  $total_price
 * @property double  $discount
 *
 * @property Order   $order
 * @property Product $product
 */
class OrderItem extends Model {

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
		return 'order_item';
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
					'status',
				],
				'integer',
			],
			[
				[
					'total_price',
					'discount',
				],
				'number',
			],
			[
				['order_id'],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => Order::className(),
				'targetAttribute' => ['order_id' => 'id'],
			],
			[
				['product_id'],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => Product::className(),
				'targetAttribute' => ['product_id' => 'id'],
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
			'status'      => 'Trạng thái',
			'discount'    => 'Giảm giá(VNĐ)',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrder() {
		return $this->hasOne(Order::className(), ['id' => 'order_id']);
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

	public function getItemStatus() {
		if($this->status == self::STATUS_RECEIPTED) {
			return 'Đã nhận';
		} else {
			return 'Chưa nhận';
		}
	}
}
