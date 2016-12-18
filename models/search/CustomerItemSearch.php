<?php
namespace app\models\search;

use app\models\CustomerItem;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CustomerItemSearch represents the model behind the search form about `app\models\CustomerItem`.
 */
class CustomerItemSearch extends CustomerItem {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'id',
					'order_customer_id',
					'product_id',
					'quantity',
					'customer_id',
				],
				'integer',
			],
			[
				['total_price'],
				'number',
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
	 * @param array   $params
	 * @param integer $id
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params, $id = null) {
		$query = CustomerItem::find();
		// add conditions that should always apply here
		if($id != null) {
			$query->andFilterWhere(['customer_id' => $id]);
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
		// grid filtering conditions
		$query->andFilterWhere([
			'id'                => $this->id,
			'order_customer_id' => $this->order_customer_id,
			'product_id'        => $this->product_id,
			'quantity'          => $this->quantity,
			'total_price'       => $this->total_price,
		]);
		return $dataProvider;
	}
}
