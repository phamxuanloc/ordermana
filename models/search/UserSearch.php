<?php
/**
 * Created by Navatech.
 * @project ordermana
 * @author  LocPX
 * @email   loc.xuanphama1t1[at]gmail.com
 * @date    12/3/2016
 * @time    10:01 AM
 */
namespace app\models\search;

use app\components\Model;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class UserSearch extends \dektrium\user\models\UserSearch {

	public $role_id;

	public function rules() {
		$role_id[] = [
			'role_id',
			'safe',
		];
		return ArrayHelper::merge($role_id, parent::rules()); // TODO: Change the autogenerated stub
	}

	public function search($params, $care = false, $center = false) {
		$query = $this->finder->getUserQuery();
		if(Yii::$app->user->identity->role_id != Model::ROLE_ADMIN && Yii::$app->user->identity->role_id != Model::ROLE_CARE) {
			$model    = new Model();
			$children = $model->getTotalChildren(Yii::$app->user->id);
			$query->where([
				'IN',
				'id',
				$children,
			]);
		}
		if($care == true) {
			$query->where(['role_id' => Model::ROLE_CARE]);
		}
		if($center == true) {
			$query->where(['role_id' => Model::ROLE_CENTER]);
		}
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort'  => ['defaultOrder' => ['id' => SORT_DESC]],
		]);
		if(!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}
		if($this->created_at !== null) {
			$date = strtotime($this->created_at);
			$query->andFilterWhere([
				'between',
				'created_at',
				$date,
				$date + 3600 * 24,
			]);
		}
		$query->andFilterWhere([
			'like',
			'username',
			$this->username,
		])->andFilterWhere([
			'like',
			'email',
			$this->email,
		])->andFilterWhere([
			'registration_ip' => $this->registration_ip,
		])->andFilterWhere([
			'role_id' => $this->role_id,
		]);
		return $dataProvider;
	}
}