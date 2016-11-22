<?php
namespace app\components;

use app\models\User;
use Yii;

class Controller extends \yii\web\Controller {

	/**@var User */
	public $user;

	/**
	 * Khởi tạo người dùng đã đăng nhập
	 * {@inheritDoc}
	 */
	public function init() {
		parent::init();
		if(!Yii::$app->session->isActive) {
			Yii::$app->session->open();
		}
		$this->user         = \Yii::$app->user->identity;
		$this->view->params = array_merge_recursive($this->view->params, Yii::$app->params);
	}

	/**
	 * {@inheritDoc}
	 */
	public function beforeAction($action) {
		return parent::beforeAction($action);
	}
}