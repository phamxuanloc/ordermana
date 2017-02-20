<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "order_center".
 *
 * @property integer      $id
 * @property integer      $user_id
 * @property double       $total_amount
 * @property string       $note
 * @property string       $created_date
 * @property string       $update_at
 * @property integer      $status
 * @property integer      $update_by
 * @property integer      $customer_id
 *
 * @property CenterItem[] $centerItems
 */
class OrderCenter extends \app\components\Model {

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

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'order_center';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'user_id',
					'total_amount',
					'status',
				],
				'required',
			],
			[
				[
					'user_id',
					'status',
					'update_by',
					'customer_id',
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
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'           => 'ID',
			'user_id'      => 'User ID',
			'total_amount' => 'Total Amount',
			'note'         => 'Note',
			'created_date' => 'Created Date',
			'update_at'    => 'Update At',
			'status'       => 'Status',
			'update_by'    => 'Update By',
			'customer_id'  => 'Customer ID',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCenterItems() {
		return $this->hasMany(CenterItem::className(), ['order_id' => 'id']);
	}

	public function getUsers() {
		return $this->hasOne(User::className(), ['id' => 'user_id']);
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
