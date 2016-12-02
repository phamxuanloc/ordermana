<?php
namespace app\models\search;

use app\models\Order;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * OrderSearch represents the model behind the search form about `app\models\Order`.
 */
class OrderSearch extends Order {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'id',
					'user_id',
					'status',
					'update_by',
					'type',
					'parent_id',
				],
				'integer',
			],
			[
				['total_amount'],
				'number',
			],
			[
				[
					'note',
					'created_date',
					'update_at',
					'start_date',
					'end_date',
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
		$query = Order::find();
		// add conditions that should always apply here
		if($this->user->role_id != $this::ROLE_ADMIN) {
			$query->where(['parent_id' => $this->id]);
		}
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort'  => ['defaultOrder' => ['id' => SORT_DESC]],
		]);
		$this->load($params);
		if(!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}
		if($this->start_date != null) {
			$query->andFilterWhere([
				'>=',
				'created_date',
				$this->start_date,
			]);
		}
		if($this->end_date != null) {
			$query->andFilterWhere([
				'<=',
				'created_date',
				$this->end_date,
			]);
		}
		// grid filtering conditions
		$query->andFilterWhere([
			'id'           => $this->id,
			'user_id'      => $this->user_id,
			'total_amount' => $this->total_amount,
			'created_date' => $this->created_date,
			'update_at'    => $this->update_at,
			'status'       => $this->status,
			'update_by'    => $this->update_by,
			'type'         => $this->type,
			'parent_id'    => $this->parent_id,
		]);
		$query->andFilterWhere([
			'like',
			'note',
			$this->note,
		]);
		return $dataProvider;
	}

	public function getInfo($params, $attribute) {
		$query = Order::find();
		// add conditions that should always apply here
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort'  => ['defaultOrder' => ['id' => SORT_DESC]],
		]);
		$this->load($params);
		if(!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}
		if($this->start_date != null) {
			$query->andFilterWhere([
				'>=',
				'created_date',
				$this->start_date,
			]);
		}
		if($this->end_date != null) {
			$query->andFilterWhere([
				'<=',
				'created_date',
				$this->end_date,
			]);
		}
		// grid filtering conditions
		$query->andFilterWhere([
			'id'           => $this->id,
			'user_id'      => $this->user_id,
			'total_amount' => $this->total_amount,
			'created_date' => $this->created_date,
			'update_at'    => $this->update_at,
			'status'       => $this->status,
			'update_by'    => $this->update_by,
			'type'         => $this->type,
			'parent_id'    => $this->parent_id,
		]);
		$query->andFilterWhere([
			'like',
			'note',
			$this->note,
		]);
		if($attribute == 'quantity') {
			return $query->count();
		} elseif($attribute == 'pre_quantity') {
			return $query->andWhere(['type' => $this::ROLE_PRE])->count();
		} elseif($attribute == 'big_quantity') {
			return $query->andWhere(['type' => $this::ROLE_BIGA])->count();
		} elseif($attribute == 'age_quantity') {
			return $query->andWhere(['type' => $this::ROLE_A])->count();
		} elseif($attribute == 'dis_quantity') {
			return $query->andWhere(['type' => $this::ROLE_D])->count();
		} elseif($attribute == 'total_money') {
			return $query->sum('total_amount');
		} else {
			return '0';
		}
	}
}
