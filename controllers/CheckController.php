<?php
/**
 * Created by PhpStorm.
 * User: Yamon-PC
 * Date: 04-Jan-17
 * Time: 5:12 PM
 */
namespace app\controllers;

use app\models\Customer;
use app\models\User;
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

	public function actionCheckStore() {
		$model = new User();
		if($model->load(Yii::$app->request->post())) {
			$model = User::findOne(['code' => 'code']);
			if($model) {
				return $this->redirect([
					'/check/info-store',
					'code' => $model->code,
				]);
			} else {
				Yii::$app->session->setFlash('check', 'Mã số đại diện không đúng');
				return $this->refresh();
			}
		}
		return $this->render('check-store', ['model' => $model]);
	}

	public function actionInfoStore($code) {
		$model = User::findOne(['code' => $code]);
		if(!$model) {
			$model = new User();
		}
		return $this->render('info-store', ['model' => $model]);
	}
}