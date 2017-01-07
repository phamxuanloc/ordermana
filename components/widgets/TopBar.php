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

class TopBar extends Widget {

	public function run() {

		$name  = explode('\\', self::className());
		$model = new Model();
		return $this->render(lcfirst(end($name)), ['model' => $model]);
	}
}