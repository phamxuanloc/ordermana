<?php
namespace app\models;

use app\components\Model;
use Yii;

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
 * @property User        $user
 * @property OrderItem[] $orderItems
 */
class Order extends Model {

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
			'parent_id'    => 'Parent ID',
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
	public function getUser() {
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrderItems() {
		return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
	}
}
