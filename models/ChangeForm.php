<?php
/**
 * Created by PhpStorm.
 * User: Yamon-PC
 * Date: 15-Dec-16
 * Time: 9:41 AM
 */
namespace app\models;

use app\components\Form;
use yii\helpers\ArrayHelper;

/**
 * @property integer $from_user
 *  * @property integer $to_user
 */
class ChangeForm extends Form {

	public $from_user;

	public $to_user;

	public function rules() {
		return [
			[
				[
					'from_user',
					'to_user',
				],
				'required',
			],
			[
				[
					'from_user',
					'to_user',
				],
				'integer',
			],
		];
	}

	public function attributeLabels() {
		return [
			'from_user' => 'Từ tài khoản',
			'to_user'   => 'Tới tài khoản',
		];
	}

	public function getUserParent() {
		return User::find()->where(['parent_id' => $this->from_user])->all();
	}

	public function getAllUser() {
		return ArrayHelper::map(User::find()->where(['blocked_at' => null])->all(), 'id', 'username');
	}

	public function changeParent() {
		$children = $this->getUserParent();
		if(count($children) > 0 && $this->from_user != $this->to_user) {
			foreach($children as $child) {
				$child->updateAttributes(['parent_id' => $this->to_user]);
			}
			return true;
		} else {
			return false;
		}
	}
}