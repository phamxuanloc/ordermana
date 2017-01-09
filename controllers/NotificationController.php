<?php
/**
 * Created by PhpStorm.
 * User: Yamon-PC
 * Date: 09-Jan-17
 * Time: 1:46 PM
 */
namespace app\controllers;

use app\components\Controller;
use app\models\Notification;
use yii\data\Pagination;

class NotificationController extends Controller {

	public function actionIndex() {
		$query      = Notification::find()->where(['user_id' => $this->user->id]);
		$pagination = new Pagination([
			'totalCount' => $query->count(),
			'pageSize'   => 20,
		]);
		$models     = $query->offset($pagination->offset)->limit($pagination->limit)->orderBy(['id' => SORT_DESC])->all();
		return $this->render('index', [
			'pagination' => $pagination,
			'models'     => $models,
		]);
	}
}