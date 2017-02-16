<?php
namespace app\models;

use app\components\Model;
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
 * @property double      $center_sale
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
 * @property string      $start_date
 * @property string      $receipted_date
 * @property string      $end_date
 * @property double      $representative_sale
 * @property double      $big_agent_sale
 *
 * @property OrderItem[] $orderItems
 * @property Category    $category
 * @property UserStock[] $userStocks
 */
class Product extends Model {

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

	public $product_bill;

	public $product_img;

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
					'center_sale',
					'representative_sale',
					'big_agent_sale',
					'in_stock',
				],
				'required',
			],
			[
				[
					'category_id',
					'in_stock',
					'order_number',
					'weight',
					'status',
					'supplier_discount',
					'provider_id',
				],
				'integer',
			],
			//			[
			//				[
			//					'base_price',
			//					'distribute_sale',
			//					'agent_sale',
			//					'retail_sale',
			//					'price_tax',
			//					'representative_sale',
			//					'big_agent_sale',
			//				],
			//				'number',
			//			],
			[
				['description'],
				'string',
			],
			[
				[
					'created_date',
					'updated_date',
					'product_img',
					'product_bill',
					'start_date',
					'end_date',
					'receipted_date',
				],
				'safe',
			],
			[
				['product_img'],
				'file',
				'extensions' => 'jpg, gif, png',
			],
			[
				['product_bill'],
				'file',
				'extensions' => 'jpg, gif, png',
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
					'code',
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
			'id'                  => 'ID',
			'category_id'         => 'Danh mục',
			'name'                => 'Tên sản phẩm',
			'code'                => 'Mã sản phẩm',
			'product_img'         => 'Ảnh sản phẩm',
			'in_stock'            => 'Số lượng nhập kho',
			'base_price'          => 'Giá nhập',
			'description'         => 'Mô tả',
			'representative_sale' => 'Giá cho đại diện',
			'big_agent_sale'      => 'Giá cho đại lí buôn',
			'distribute_sale'     => 'Giá cho điểm phân phối',
			'agent_sale'          => 'Giá bán cho đại lí',
			'retail_sale'         => 'Giá bán lẻ',
			'center_sale'         => 'Giá cho center',
			'created_date'        => 'Ngày tạo',
			'supplier'            => 'Nhà cung cấp',
			'order_number'        => 'Mã đơn nhập',
			'bill_number'         => 'Số hóa đơn',
			'product_bill'        => 'Ảnh hóa đơn',
			'receiver'            => 'Người nhận',
			'deliver'             => 'Người giao',
			'color'               => 'Màu sắc',
			'weight'              => 'Khối lượng',
			'unit'                => 'Đơn vị',
			'status'              => 'Trạng thái',
			'price_tax'           => 'Giá đã có thuế',
			'supplier_discount'   => 'Chiết khấu của nhà cung cấp',
			'receipted_date'      => 'Ngày nhập hàng về',
			'excel'               => 'File excel',
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

	public function convertPrice($attribute) {
		return str_replace(',', '', $attribute);
	}

	public function beforeSave($insert) {
		return parent::beforeSave($insert);
	}
}
