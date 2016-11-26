<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer     $id
 * @property integer     $category_id
 * @property string      $name
 * @property integer     $code
 * @property string      $image
 * @property integer     $in_stock
 * @property double      $base_price
 * @property string      $description
 * @property double      $distribute_sale
 * @property double      $agent_sale
 * @property double      $retail_sale
 * @property string      $created_date
 * @property string      $supplier
 * @property integer     $order_number
 * @property string      $bill_number
 * @property string      $bill_image
 * @property string      $receiver
 * @property string      $deliver
 * @property string      $color
 * @property integer     $weight
 * @property string      $unit
 * @property integer     $status
 * @property double      $price_tax
 * @property integer     $supplier_discount
 * @property string      $updated_date
 *
 * @property OrderItem[] $orderItems
 * @property Category    $category
 * @property UserStock[] $userStocks
 */
class Product extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'product';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'category_id',
					'name',
					'base_price',
					'distribute_sale',
					'agent_sale',
					'retail_sale',
				],
				'required',
			],
			[
				[
					'category_id',
					'code',
					'in_stock',
					'order_number',
					'weight',
					'status',
					'supplier_discount',
				],
				'integer',
			],
			[
				[
					'base_price',
					'distribute_sale',
					'agent_sale',
					'retail_sale',
					'price_tax',
				],
				'number',
			],
			[
				[
					'description',
					'created_date',
					'updated_date',
				],
				'safe',
			],
			[
				[
					'name',
					'image',
					'supplier',
					'bill_number',
					'bill_image',
					'receiver',
					'deliver',
					'color',
					'unit',
				],
				'string',
				'max' => 255,
			],
			[
				['category_id'],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => Category::className(),
				'targetAttribute' => ['category_id' => 'id'],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'                => 'ID',
			'category_id'       => 'Danh mục',
			'name'              => 'Tên sản phẩm',
			'code'              => 'Mã sản phẩm',
			'image'             => 'Ảnh',
			'in_stock'          => 'Số lượng nhập kho',
			'base_price'        => 'Giá nhập',
			'description'       => 'Mô tả',
			'distribute_sale'   => 'Giá cho đại diện',
			'agent_sale'        => 'Giá bán cho đại lí',
			'retail_sale'       => 'Giá bán lẻ',
			'created_date'      => 'Ngày nhập',
			'supplier'          => 'Nhà cung cấp',
			'order_number'      => 'Mã đơn nhập',
			'bill_number'       => 'Số hóa đơn',
			'bill_image'        => 'Ảnh hóa đơn',
			'receiver'          => 'Người nhận',
			'deliver'           => 'Người giao',
			'color'             => 'Màu sắc',
			'weight'            => 'Khối lượng',
			'unit'              => 'Đơn vị',
			'status'            => 'Trạng thái',
			'price_tax'         => 'Giá đã có thuế',
			'supplier_discount' => 'Chiết khấu của nhà cung cấp',
			'updated_date'      => 'Ngày cập nhật',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrderItems() {
		return $this->hasMany(OrderItem::className(), ['product_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory() {
		return $this->hasOne(Category::className(), ['id' => 'category_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUserStocks() {
		return $this->hasMany(UserStock::className(), ['product_id' => 'id']);
	}
}
