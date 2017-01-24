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
}
