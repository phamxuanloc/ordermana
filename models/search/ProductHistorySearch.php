<?php
namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductHistory;

/**
 * ProductHistorySearch represents the model behind the search form about `app\models\ProductHistory`.
 */
class ProductHistorySearch extends ProductHistory {

	public $start_date;

	public $end_date;

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'id',
					'category_id',
					'old_value',
					'quantity',
					'new_value',
					'product_id',
					'weight',
					'status',
				],
				'integer',
			],
			[
				[
					'name',
					'start_date',
					'end_date',
					'code',
					'created_date',
					'receipted_date',
					'supplier',
					'bill_image',
					'bill_number',
					'order_number',
					'receiver',
					'deliver',
					'color',
					'unit',
				],
				'safe',
			],
			[
				['price_tax'],
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
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = ProductHistory::find();
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
			'id'             => $this->id,
			'category_id'    => $this->category_id,
			'old_value'      => $this->old_value,
			'new_value'      => $this->new_value,
			'quantity'       => $this->quantity,
			'created_date'   => $this->created_date,
			'receipted_date' => $this->receipted_date,
			'product_id'     => $this->product_id,
			'weight'         => $this->weight,
			'price_tax'      => $this->price_tax,
			'status'         => $this->status,
		]);
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
		$query->andFilterWhere([
			'like',
			'name',
			$this->name,
		])->andFilterWhere([
				'like',
				'code',
				$this->code,
			])->andFilterWhere([
				'like',
				'supplier',
				$this->supplier,
			])->andFilterWhere([
				'like',
				'bill_image',
				$this->bill_image,
			])->andFilterWhere([
				'like',
				'bill_number',
				$this->bill_number,
			])->andFilterWhere([
				'like',
				'order_number',
				$this->order_number,
			])->andFilterWhere([
				'like',
				'receiver',
				$this->receiver,
			])->andFilterWhere([
				'like',
				'deliver',
				$this->deliver,
			])->andFilterWhere([
				'like',
				'color',
				$this->color,
			])->andFilterWhere([
				'like',
				'unit',
				$this->unit,
			]);
		return $dataProvider;
	}
}
