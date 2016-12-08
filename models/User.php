<?php
namespace app\models;

use dektrium\user\helpers\Password;
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
 * @property string          $address
 * @property integer         $created_at
 * @property integer         $updated_at
 * @property integer         $flags
 * @property integer         $role_id
 * @property integer         $parent_id
 * @property integer         $city
 * @property integer         $id_number
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
			'register'     => [
				'username',
				'email',
				'password',
			],
			'connect'      => [
				'username',
				'email',
			],
			'create'       => [
				'username',
				'email',
				'password',
				'city',
				'role_id',
				'phone',
				'facebook_link',
				'parent_id',
				'address',
				'id_number',
			],
			'admin_create' => [
				'username',
				'email',
				'password',
				'city',
				'role_id',
				'phone',
				'facebook_link',
				'parent_id',
				'address',
				'id_number',
			],
			'update'       => [
				'username',
				'email',
				'password',
				'city',
				'role_id',
				'phone',
				'facebook_link',
				'parent_id',
				'address',
				'id_number',
			],
			'settings'     => [
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
					'phone',
					'id_number'
					//					'email',
				],
				'required',
				'message' => 'Không được để trống {attribute}',
			],
			[
				['parent_id'],
				'required',
				'on'      => 'create',
				'message' => 'Không được để trống {attribute}',
			],
			[
				['password'],
				'required',
				'on'      => 'create',
				'message' => 'Không được để trống {attribute}',
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
					'phone',
					//					'email',
				],
				'unique',
				'message' => '{attribute} phải duy nhất',
			],
			[
				['username'],
				'unique',
				'message' => '{attribute} phải duy nhất',
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
			'password'          => 'Mật khẩu',
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
			'id_number'         => 'Số cmt',
			'address'           => 'Địa chỉ hiện tại',
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

	public function create() {
		if($this->getIsNewRecord() == false) {
			throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
		}
		$transaction = $this->getDb()->beginTransaction();
		try {
			$this->confirmed_at = time();
			$this->password     = $this->password == null ? Password::generate(8) : $this->password;
			$this->trigger(self::BEFORE_CREATE);
			if(!$this->save()) {
				$transaction->rollBack();
				return false;
			}
			$this->trigger(self::AFTER_CREATE);
			$transaction->commit();
			return true;
		} catch(\Exception $e) {
			$transaction->rollBack();
			\Yii::warning($e->getMessage());
			return false;
		}
	}

	//	public function getUserList($role) {
	//		$user        = Yii::$app->user->identity;
	//		$child_array = [];
	//		if($role - $user->role_id == 1) {
	//			return ArrayHelper::map(User::find()->where(['id' => $user->getId()])->all(), 'id', 'username');
	//		} elseif($role - $user->role_id == 2) {
	//			$children = User::find()->where(['parent_id' => $user->getId()])->all();
	//			foreach($children as $child) {
	//			}
	//		}
	//	}
	//
	//	public function getUserByLv() {
	//	
	//	}
	public static function getUsername($user_id) {
		$user = User::findOne(['id' => $user_id]);
		return $user->username;
	}
}
