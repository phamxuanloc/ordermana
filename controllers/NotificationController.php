<?php
/**
 * Created by PhpStorm.
 * User: Yamon-PC
 * Date: 09-Jan-17
 * Time: 1:46 PM
 */
namespace app\controllers;

use app\components\Controller;

class NotificationController extends Controller {

	public function actionIndex() {
		return $this->render('index');
	}
}