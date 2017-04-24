<?php
namespace app\models;

use dektrium\user\helpers\Password;
use navatech\role\models\Role;
use navatech\role\models\User as BaseUser;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

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
 * @property string          $code
 * @property string          $zalo
 * @property string          $viber
 * @property string          $store_address
 * @property string          $store_image
 * @property string          $store_description
 * @property integer         $blocked_at
 * @property integer         $code_number
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

	public $image;

	public $last_login_at;

	const BEST_NUMBER = [
		1111,
		2222,
		3333,
		4444,
		5555,
		6666,
		7777,
		8888,
		9999,
		6868,
		8686,
		6886,
		1234,
		5678,
		1102,
		6789,
		8668,
		2468,
		1357,
	];

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'user';
	}

	public $re_pass;

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
				'birthday',
				're_pass',
				'image',
				'avatar',
				'code',
				'code_number',
				'zalo',
				'viber',
				'store_image',
				'store_address',
				'store_description',
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
				'birthday',
				're_pass',
				'image',
				'avatar',
				'zalo',
				'viber',
				'store_image',
				'store_address',
				'store_description',
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
				'birthday',
				'image',
				'avatar',
				'zalo',
				'viber',
				'store_image',
				'store_address',
				'store_description',
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
					'id_number',
					'birthday',
					're_pass'
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
					'code',
					'code_number',
				],
				'safe',
			],
			[
				're_pass',
				'compare',
				'compareAttribute' => 'password',
				'message'          => 'Mật khẩu xác nhận không đúng',
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
				['image'],
				'file',
				'extensions' => 'jpg, gif, png',
			],
			[
				['store_image'],
				'file',
				'extensions' => 'jpg, gif, png',
			],
			[
				[
					'username',
					'email',
					'unconfirmed_email',
					'phone',
					'facebook_link',
					'id_number',
					'image',
					'avatar',
					'zalo',
					'viber',
					'store_address',
					'store_description',
				],
				'string',
				'max' => 1000,
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
			'role_id'           => 'Loại tài khoản',
			'parent_id'         => 'Tuyến trên',
			'city'              => 'Thành phố',
			'id_number'         => 'Số cmt',
			'address'           => 'Địa chỉ hiện tại',
			'birthday'          => 'Sinh nhật',
			're_pass'           => 'Xác nhận mật khẩu',
			'image'             => 'Ảnh đại diện',
			'avatar'            => 'Ảnh đại diện',
			'code'              => 'Mã',
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

	public function uploadPicture($picture = '', $attribute) {
		// get the uploaded file instance. for multiple file uploads
		// the following data will return an array (you may need to use
		// getInstances method)
		$img = UploadedFile::getInstance($this, $attribute);
		// if no image was uploaded abort the upload
		if(empty($img)) {
			return false;
		}
		// generate a unique file name
		$dir = Yii::getAlias('@app/web') . '/uploads/' . $this->tableName() . '/';
		if(!is_dir($dir)) {
			@mkdir($dir, 0777, true);
		}
		$ext            = $img->getExtension();
		$this->$picture = $this->getPrimaryKey() . '_' . "$picture" . ".{$ext}";
		// the uploaded image instance
		return $img;
	}

	public function getPictureUrl($picture = '') {
		Yii::$app->params['uploadUrl'] = Yii::$app->urlManager->baseUrl . '/uploads/' . $this->tableName() . '/';
		$image                         = !empty($this->$picture) ? $this->$picture : Yii::$app->urlManager->baseUrl . '/uploads/no_image_thumb.gif';
		clearstatcache();
		if(is_file(Yii::getAlias("@app/web") . '/uploads/' . $this->tableName() . '/' . $image)) {
			return Yii::$app->params['uploadUrl'] . $image;
		} else {
			return $image;
		}
	}

	public function getPictureFile($picture = '') {
		$dir = Yii::getAlias('@app/web') . '/uploads/' . $this->tableName() . '/';
		return isset($this->$picture) ? $dir . $this->$picture : null;
	}

	public function getCodeNumber() {
		if($this->city != null) {
			$last = User::find()->where(['city' => $this->city])->andFilterWhere([
				'!=',
				'code',
				null,
			])->orderBy('id DESC')->one();
			if($last) {
				echo $last->username;die;
				$number         = $last->code_number;
				$current_number = $number + 1;
				if(in_array($current_number, User::BEST_NUMBER)) {
					$current_number = $current_number + 1;
				};
			} else {
				$current_number = 0001;
			}
			return $current_number;
		}
		return null;
	}
}
