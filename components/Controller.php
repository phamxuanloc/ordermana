<?php
namespace app\components;

use app\models\User;
use Yii;
use yii\helpers\Url;

class Controller extends \yii\web\Controller {

	/**@var User */
	public $user;

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
		if(Yii::$app->user->isGuest && Yii::$app->controller->action->id !== 'login' && Yii::$app->controller->action->id !== 'check-point') {
			$this->redirect(Url::to(['/user/security/login']));
			return false;
		} else {
			return parent::beforeAction($action);
		}
	}
}