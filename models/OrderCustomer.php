<?php
namespace app\models;

use app\components\Model;
use Yii;

/**
 * This is the model class for table "order_customer".
 *
 * @property integer      $id
 * @property integer      $user_id
 * @property double       $total_amount
 * @property string       $note
 * @property string       $created_date
 * @property string       $update_at
 * @property integer      $status
 * @property integer      $update_by
 * @property integer      $type
 * @property integer      $customer_id
 *
 * @property Customer     $customer
 * @property User         $user
 * @property CustomerItem[] $customerItem
 */
class OrderCustomer extends Model {

	const STATUS        = [
		'Chưa thanh toán',
		'Đã thanh toán',
		'Chưa nhận đủ',
		'Đã nhận đủ',
		'Đã hủy',
	];

	const NOT_PAID      = 0;

	const PAID          = 1;

	const NOT_RECEIPTED = 2;

	const RECEIPTED     = 3;

	const CANCEL        = 4;
	
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'order_customer';
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
					'type',
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
			[
				['customer_id'],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => Customer::className(),
				'targetAttribute' => ['customer_id' => 'id'],
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
			'id'           => 'ID',
			'user_id'      => 'User ID',
			'total_amount' => 'Total Amount',
			'note'         => 'Note',
			'created_date' => 'Created Date',
			'update_at'    => 'Update At',
			'status'       => 'Status',
			'update_by'    => 'Update By',
			'type'         => 'Type',
			'customer_id'  => 'Customer ID',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCustomer() {
		return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
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
	public function getCustomerItem() {
		return $this->hasMany(CustomerItem::className(), ['order_customer_id' => 'id']);
	}
}
