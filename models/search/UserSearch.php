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
use yii\data\ActiveDataProvider;

class UserSearch extends \dektrium\user\models\UserSearch {

	public function search($params) {
		$query = $this->finder->getUserQuery();
//		if(\Yii::$app->user->identity->role_id != Model::ROLE_ADMIN) {
//		$query->where([''])
//		}
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
		])->andFilterWhere(['registration_ip' => $this->registration_ip]);
		return $dataProvider;
	}
}