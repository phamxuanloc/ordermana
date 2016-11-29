<?php
namespace app\models\search;

use app\models\UserStock;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserStockSearch represents the model behind the search form about `app\models\UserStock`.
 */
class UserStockSearch extends UserStock {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'id',
					'user_id',
					'product_id',
					'in_stock',
				],
				'integer',
			],
			[
				[
					'created_date',
					'update_at',
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
		$query = UserStock::find();
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
		// grid filtering conditions
		$query->andFilterWhere([
			'id'           => $this->id,
			'user_id'      => $this->user_id,
			'product_id'   => $this->product_id,
			'in_stock'     => $this->in_stock,
			'created_date' => $this->created_date,
			'update_at'    => $this->update_at,
		]);
		return $dataProvider;
	}
}
