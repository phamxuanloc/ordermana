<?php
namespace app\components;

use app\models\User;
use yii\console\Application;
use yii\db\ActiveRecord;

class Model extends ActiveRecord {

	/**@var User */
	public $user;

	/**
	 *  * Khởi tạo người dùng đã đăng nhập
	 */
	/**
	 * {@inheritDoc}
	 */
	public function __construct($config = []) {
		parent::__construct($config);
		if(!\Yii::$app instanceof Application) {
			$this->user = \Yii::$app->user->identity;
		}
	}
}