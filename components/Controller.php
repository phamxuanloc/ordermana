<?php
namespace app\components;

use app\models\User;
use Yii;

class Controller extends \yii\web\Controller {

	/**@var User */
	public $user;
	
	/**
	 * {@inheritDoc}
	 */
	public function beforeAction($action) {
		return parent::beforeAction($action);
	}
}