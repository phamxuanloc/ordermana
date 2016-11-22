<?php
namespace app\components;

use app\models\User;

class View extends \yii\web\View {

	/**@var User */
	public $user;

	/**
	 *  * Khởi tạo người dùng đã đăng nhập
	 */
	public function init() {
		parent::init();
		$this->user = \Yii::$app->getUser()->getIdentity();
	}
}