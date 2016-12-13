<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer         $id
 * @property string          $name
 * @property string          $address
 * @property string          $email
 * @property string          $company_name
 * @property integer         $phone
 * @property integer         $city_id
 * @property integer         $user_id
 * @property integer         $point
 * @property integer         $parent_id
 * @property integer         $last_parent_id
 * @property integer         $is_move
 * @property string          $link_fb
 * @property string          $sale
 * @property string          $note
 * @property string          $is_call
 * @property string          $call_by
 * @property string          $call_at
 * @property string          $source
 * @property string          $id_number
 * @property string          $product
 *
 * @property User            $parent
 * @property User            $lastParent
 * @property City            $city
 * @property User            $user
 * @property OrderCustomer[] $orderCustomers
 */
class Customer extends \app\components\Model {

	const IS_CALL     = [
		'Chưa gọi',
		'Đã gọi',
	];

	const CALLED      = 0;

	const NOT_CALL    = 1;

	const IS_MOVE     = [
		'Mới tạo',
		'Chuyển lần 1',
		'Chuyển lần 2',
	];

	const CREATED     = 0;

	const MOVE_FIRST  = 1;

	const MOVE_SECOND = 2;

	public $list_customer;

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'customer';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'name',
					'phone',
				],
				'required',
			],
			[
				[
					'phone',
					'user_id',
					'point',
					'parent_id',
					'is_move',
					'last_parent_id',
					'list_customer',
				],
				'integer',
			],
			[
				[
					'note',
					'product',
				],
				'string',
			],
			[
				[
					'call_at',
					'created_date',
					'birthday',
					'name',
				],
				'safe',
			],
			[
				[
					'name',
					'address',
					'email',
					'company_name',
					'link_fb',
					'sale',
					'is_call',
					'call_by',
					'source',
					'id_number',
					'city_id',
				],
				'string',
				'max' => 255,
			],
			[
				['parent_id'],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => User::className(),
				'targetAttribute' => ['parent_id' => 'id'],
			],
			[
				['user_id'],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => User::className(),
				'targetAttribute' => ['user_id' => 'id'],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'             => 'ID',
			'name'           => 'Họ tên',
			'address'        => 'Địa chỉ',
			'email'          => 'Email',
			'company_name'   => 'Company Name',
			'phone'          => 'Số điện thoại',
			'city_id'        => 'Thành phố',
			'user_id'        => 'Người tạo',
			'point'          => 'Điểm',
			'parent_id'      => 'Người sở hữu',
			'last_parent_id' => 'Người sở hữu trước',
			'is_move'        => 'Trạng thái',
			'link_fb'        => 'Link Fb',
			'sale'           => 'Sale',
			'note'           => 'Ghi chú phản hồi',
			'is_call'        => 'Trạng thái gọi',
			'call_by'        => 'Người gọi',
			'call_at'        => 'Ngày gọi',
			'product'        => 'Sản phầm đăng ký mua',
			'source'         => 'Nguồn khách hàng',
			'id_number'      => 'Số cmt',
			'created_date'   => 'Ngày tạo',
			'birthday'       => 'Ngày sinh',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getParent() {
		return $this->hasOne(User::className(), ['id' => 'parent_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getLastParent() {
		return $this->hasOne(User::className(), ['id' => 'last_parent_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser() {
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrderCustomers() {
		return $this->hasMany(OrderCustomer::className(), ['customer_id' => 'id']);
	}
}
