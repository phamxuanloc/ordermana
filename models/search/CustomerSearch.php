<?php
namespace app\models\search;

use app\models\Customer;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CustomerSearch represents the model behind the search form about `app\models\Customer`.
 */
class CustomerSearch extends Customer {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'id',
					'phone',
					'city_id',
					'user_id',
					'point',
					'parent_id',
					'is_move',
				],
				'integer',
			],
			[
				[
					'name',
					'address',
					'email',
					'company_name',
					'link_fb',
					'sale',
					'note',
					'is_call',
					'call_by',
					'call_at',
				],
				'safe',
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios() {
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = Customer::find();
		if(Yii::$app->user->identity->role_id != $this::ROLE_ADMIN) {
			$children = $this::getTotalChildren(Yii::$app->user->id);
			$query->where([
				'IN',
				'parent_id',
				$children,
			])->orWhere(['parent_id' => Yii::$app->user->id])->orWhere([
				'IN',
				'last_parent_id',
				$children,
			]);
		}
		// add conditions that should always apply here
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);
		$this->load($params);
		if(!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}
		// grid filtering conditions
		$query->andFilterWhere([
			'id'        => $this->id,
			'phone'     => $this->phone,
			'city_id'   => $this->city_id,
			'user_id'   => $this->user_id,
			'point'     => $this->point,
			'parent_id' => $this->parent_id,
			'is_move'   => $this->is_move,
			'call_at'   => $this->call_at,
		]);
		$query->andFilterWhere([
			'like',
			'name',
			$this->name,
		])->andFilterWhere([
			'like',
			'address',
			$this->address,
		])->andFilterWhere([
			'like',
			'email',
			$this->email,
		])->andFilterWhere([
			'like',
			'company_name',
			$this->company_name,
		])->andFilterWhere([
			'like',
			'link_fb',
			$this->link_fb,
		])->andFilterWhere([
			'like',
			'sale',
			$this->sale,
		])->andFilterWhere([
			'like',
			'note',
			$this->note,
		])->andFilterWhere([
			'like',
			'is_call',
			$this->is_call,
		])->andFilterWhere([
			'like',
			'call_by',
			$this->call_by,
		]);
		return $dataProvider;
	}
}
