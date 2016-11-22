<?php
namespace app\components;

use Yii;
use yii\base\Model as BaseForm;
use app\models\User;

/**
 * ActivePinForm
 */
class Form extends BaseForm {

	/**@var User $loggedUser */
	public $user;

	public function __construct($config = []) {
		parent::__construct($config);
		$this->user = Yii::$app->user->identity;
	}
	/**
	 * @param $tPassword
	 *
	 * @return bool
	 */
}