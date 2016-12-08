<?php
namespace app\models;

use app\components\ModelTrail;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "order".
 *
 * @property integer     $id
 * @property integer     $user_id
 * @property double      $total_amount
 * @property string      $note
 * @property string      $created_date
 * @property string      $update_at
 * @property integer     $status
 * @property integer     $update_by
 * @property integer     $type
 * @property integer     $parent_id
 *
 * @property User        $parent
 * @property User        $users
 * @property OrderItem[] $orderItems
 */
class Order extends ModelTrail {

	const STATUS        = [
		'Chưa thanh toán',
		'Đã thanh toán',
		'Chưa nhận đủ',
		'Đã nhận đủ',
		'Đã hủy',
		'Đã xác nhận',
	];

	const NOT_PAID      = 0;

	const PAID          = 1;

	const NOT_RECEIPTED = 2;

	const RECEIPTED     = 3;

	const CANCEL        = 4;

	const CONFIRM       = 5;

	public $downline;

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'order';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'user_id',
					'status',
					'downline',
				],
				'required',
			],
			[
				[
					'user_id',
					'status',
					'update_by',
					'type',
					'parent_id',
				],
				'integer',
			],
			[
				['total_amount'],
				'number',
			],
			[
				[
					'created_date',
					'update_at',
				],
				'safe',
			],
			[
				['note'],
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

	public function scenarios() {
		// TODO: Change the auto generated stub
		return ArrayHelper::merge(parent::scenarios(), [
			'update_status' => [
				'status',
				'update_at',
				'update_by',
			],
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'           => 'ID',
			'user_id'      => 'Người mua',
			'total_amount' => 'Tổng tiền',
			'note'         => 'Ghi chú',
			'created_date' => 'Ngày mua',
			'update_at'    => 'Ngày cập nhật',
			'status'       => 'Trạng thái',
			'update_by'    => 'Cập nhật bởi',
			'type'         => 'Loại đơn hàng',
			'parent_id'    => 'Người bán',
			'downline'     => 'Xuất cho',
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
	public function getUsers() {
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrderItems() {
		return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
	}

	public function getType() {
		if($this->type == $this::ROLE_ADMIN) {
			return 'Đơn hàng lỗi';
		} elseif($this->type == $this::ROLE_PRE) {
			return 'Xuất kho cho đại diện';
		} elseif($this->type == $this::ROLE_BIGA) {
			return 'Xuất kho cho đại lí bán buôn';
		} elseif($this->type == $this::ROLE_A) {
			return 'Xuất kho cho đại lí bán lẻ';
		} elseif($this->type == $this::ROLE_D) {
			return 'Xuất kho cho điểm phân phối';
		} else {
			return 'Đơn hàng lẻ';
		}
	}

	public function getColorStatus() {
		if($this->status == $this::RECEIPTED) {
			return 'btn-success';
		} elseif($this->status == $this::CONFIRM) {
			return 'btn-info';
		} elseif($this->status == $this::NOT_PAID || $this->status == $this::NOT_RECEIPTED) {
			return 'btn-danger';
		} else {
			return 'btn-warning';
		}
	}
}
