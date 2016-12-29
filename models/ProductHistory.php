<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "product_history".
 *
 * @property integer  $id
 * @property integer  $category_id
 * @property string   $name
 * @property string   $code
 * @property integer  $old_value
 * @property integer  $new_value
 * @property string   $created_date
 * @property string   $receipted_date
 * @property integer  $product_id
 * @property string   $supplier
 * @property string   $bill_image
 * @property string   $bill_number
 * @property string   $order_number
 * @property string   $receiver
 * @property string   $deliver
 * @property string   $color
 * @property integer  $weight
 * @property integer  $quantity
 * @property integer  $supplier_discount
 * @property string   $unit
 * @property double   $price_tax
 * @property double   $base_price
 * @property integer  $status
 *
 * @property Category $category
 * @property Product  $product
 * @property Product  $product0
 */
class ProductHistory extends \app\components\Model {

	public $product_bill;

	const STATUS        = [
		'Chưa thanh toán',
		'Đã thanh toán',
		'Chưa nhận đủ',
		'Đã nhận đủ',
	];

	const NOT_PAID      = 0;

	const PAID          = 1;

	const NOT_RECEIPTED = 2;

	const RECEIPTED     = 3;

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'product_history';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'base_price',
					'quantity',
				],
				'required',
			],
			[
				['product_bill'],
				'file',
				'extensions' => 'jpg, gif, png',
			],
			[
				[
					'category_id',
					'old_value',
					'new_value',
					'quantity',
					'product_id',
					'weight',
					'status',
					'supplier_discount',
				],
				'integer',
			],
			[
				[
					'created_date',
					'receipted_date',
				],
				'safe',
			],
			//			[
			//				[
			//					'price_tax',
			//					'base_price',
			//				],
			//				'number',
			//			],
			[
				[
					'name',
					'code',
					'supplier',
					'bill_image',
					'bill_number',
					'order_number',
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
			[
				['product_id'],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => Product::className(),
				'targetAttribute' => ['product_id' => 'id'],
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
			'id'                => 'ID',
			'category_id'       => 'Category ID',
			'name'              => 'Tên sản phẩm',
			'code'              => 'Mã sản phẩm',
			'old_value'         => 'Số lượng trước nhập',
			'new_value'         => 'Số lượng sau nhập',
			'quantity'          => 'Số lượng nhập',
			'base_price'        => 'Giá nhập',
			'created_date'      => 'Ngày tạo',
			'product_id'        => 'Sản phẩm',
			'supplier'          => 'Supplier',
			'bill_image'        => 'Bill Image',
			'product_bill'      => 'Ảnh hóa đơn',
			'order_number'      => 'Mã đơn nhập',
			'bill_number'       => 'Số hóa đơn',
			'receiver'          => 'Người nhận',
			'deliver'           => 'Người giao',
			'color'             => 'Màu sắc',
			'weight'            => 'Khối lượng',
			'unit'              => 'Đơn vị',
			'status'            => 'Trạng thái',
			'price_tax'         => 'Giá đã có thuế',
			'supplier_discount' => 'Chiết khấu của nhà cung cấp',
			'receipted_date'    => 'Ngày nhập hàng về',
		];
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
	public function getProduct() {
		return $this->hasOne(Product::className(), ['id' => 'product_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProduct0() {
		return $this->hasOne(Product::className(), ['id' => 'product_id']);
	}
}
