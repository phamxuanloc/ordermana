<?php
namespace app\models;

use navatech\role\models\Role;
use navatech\role\models\User as BaseUser;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property integer         $id
 * @property string          $username
 * @property string          $email
 * @property string          $password_hash
 * @property string          $auth_key
 * @property integer         $confirmed_at
 * @property string          $unconfirmed_email
 * @property string          $facebook_link
 * @property string          $phone
 * @property integer         $blocked_at
 * @property string          $registration_ip
 * @property integer         $created_at
 * @property integer         $updated_at
 * @property integer         $flags
 * @property integer         $role_id
 * @property integer         $parent_id
 * @property integer         $city
 *
 * @property Customer[]      $customers
 * @property Order[]         $orders
 * @property Order[]         $orders0
 * @property OrderCustomer[] $orderCustomers
 * @property Profile         $profile
 * @property SocialAccount[] $socialAccounts
 * @property Token[]         $tokens
 * @property Role            $role
 * @property UserStock[]     $userStocks
 */
class User extends BaseUser {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'user';
	}

	public function scenarios() {
		$scenarios = parent::scenarios();
		return ArrayHelper::merge($scenarios, [
			'register' => [
				'username',
				'email',
				'password',
			],
			'connect'  => [
				'username',
				'email',
			],
			'create'   => [
				'username',
				'email',
				'password',
				'city',
				'role_id',
				'phone',
				'facebook_link',
				'parent_id',
			],
			'update'   => [
				'username',
				'email',
				'password',
				'city',
				'role_id',
				'phone',
				'facebook_link',
				'parent_id',
			],
			'settings' => [
				'username',
				'email',
				'password',
			],
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'username',
					'password_hash',
					'auth_key',
					'created_at',
					'updated_at',
					'role_id',
					'phone',
				],
				'required',
			],
			[
				[
					'confirmed_at',
					'blocked_at',
					'created_at',
					'updated_at',
					'flags',
					'role_id',
					'parent_id',
					'city',
				],
				'integer',
			],
			[
				[
					'username',
					'email',
					'unconfirmed_email',
					'phone',
					'facebook_link',
				],
				'string',
				'max' => 255,
			],
			[
				['password_hash'],
				'string',
				'max' => 60,
			],
			[
				['auth_key'],
				'string',
				'max' => 32,
			],
			[
				['registration_ip'],
				'string',
				'max' => 45,
			],
			[
				[
					'email',
					'phone',
				],
				'unique',
			],
			[
				['username'],
				'unique',
			],
			[
				['role_id'],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => Role::className(),
				'targetAttribute' => ['role_id' => 'id'],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'                => 'ID',
			'username'          => 'Tên đăng nhập',
			'email'             => 'Email',
			'password_hash'     => 'Password Hash',
			'auth_key'          => 'Auth Key',
			'confirmed_at'      => 'Confirmed At',
			'unconfirmed_email' => 'Unconfirmed Email',
			'blocked_at'        => 'Blocked At',
			'registration_ip'   => 'Registration Ip',
			'created_at'        => 'Created At',
			'updated_at'        => 'Updated At',
			'flags'             => 'Flags',
			'role_id'           => 'Role ID',
			'parent_id'         => 'Tuyến trên',
			'city'              => 'Thành phố',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCustomers() {
		return $this->hasMany(Customer::className(), ['user_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrders() {
		return $this->hasMany(Order::className(), ['parent_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrders0() {
		return $this->hasMany(Order::className(), ['user_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrderCustomers() {
		return $this->hasMany(OrderCustomer::className(), ['user_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUserStocks() {
		return $this->hasMany(UserStock::className(), ['user_id' => 'id']);
	}

	public function getCities() {
		return $this->hasOne(City::className(), ['id' => 'city']);
	}
}
