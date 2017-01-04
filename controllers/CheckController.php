<?php
/**
 * Created by PhpStorm.
 * User: Yamon-PC
 * Date: 04-Jan-17
 * Time: 5:12 PM
 */
namespace app\controllers;

use app\models\Customer;
use Yii;
use yii\web\Controller;

class CheckController extends Controller {

	public function actionCheckPoint() {
		if(!Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		$model = new Customer();
		if($model->load(Yii::$app->request->post())) {
			$customer = $model->findOne(['phone' => $model->phone]);
			if($customer != null) {
				Yii::$app->session->setFlash('check', 'Số điểm hiện tại của quý khách là ' . $customer->point);
			} else {
				Yii::$app->session->setFlash('check', 'Số điện thoại không đúng, vui lòng nhập lại');
			}
			return $this->refresh();
		}
		return $this->render('check-point', [
			'model' => $model,
		]);
	}
}