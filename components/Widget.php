<?php
namespace app\components;

use Yii;

class Widget extends \yii\bootstrap\Widget {

	/**@var \app\models\User $user */
	public $user;

	/**
	 * Khởi tạo người dùng đã đăng nhập
	 * {@inheritDoc}
	 */
	public function init() {
		parent::init();
		if(!\Yii::$app->user->isGuest) {
			$this->user = \Yii::$app->user->identity;
		} else {
			$this->user = null;
		}
	}

	/**
	 * Render view cho widget
	 * @return mixed
	 */
	public function run() {
		$name = explode('\\', self::className());
		return $this->render(lcfirst(end($name)));
	}
}