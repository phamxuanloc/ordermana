<?php
/**
 * Created by PhpStorm.
 * User: Yamon-PC
 * Date: 06-Dec-16
 * Time: 2:29 PM
 */
namespace app\components\widgets;

use app\components\Model;
use app\components\Widget;
use app\models\Notification;

class TopBar extends Widget {

	public function run() {
		$name  = explode('\\', self::className());
		$model = new Model();
		$notis = Notification::find()->where(['user_id' => $this->user->id])->limit(5)->all();
		$count = Notification::find()->where([
			'user_id' => $this->user->id,
			'status'  => Notification::NOT_SEEN,
		])->count();
		return $this->render(lcfirst(end($name)), [
			'model' => $model,
			'notis' => $notis,
			'count' => $count,
		]);
	}
}