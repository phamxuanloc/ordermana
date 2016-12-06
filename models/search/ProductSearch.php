<?php
namespace app\models\search;

use app\models\Product;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'id',
					'category_id',
					'code',
					'in_stock',
					'order_number',
					'weight',
					'status',
					'supplier_discount',
				],
				'integer',
			],
			[
				[
					'name',
					'image',
					'description',
					'created_date',
					'supplier',
					'bill_number',
					'bill_image',
					'receiver',
					'deliver',
					'color',
					'unit',
					'updated_date',
					'start_date',
					'end_date',
				],
				'safe',
			],
			[
				[
					'base_price',
					'distribute_sale',
					'representative_sale',
					'big_agent_sale',
					'agent_sale',
					'retail_sale',
					'price_tax',
				],
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
		$query = Product::find();
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
			'category_id'       => $this->category_id,
			'code'              => $this->code,
			'in_stock'          => $this->in_stock,
			'base_price'        => $this->base_price,
			'description'       => $this->description,
			'distribute_sale'   => $this->distribute_sale,
			'agent_sale'        => $this->agent_sale,
			'retail_sale'       => $this->retail_sale,
			'created_date'      => $this->created_date,
			'order_number'      => $this->order_number,
			'weight'            => $this->weight,
			'status'            => $this->status,
			'price_tax'         => $this->price_tax,
			'supplier_discount' => $this->supplier_discount,
			'updated_date'      => $this->updated_date,
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
			'image',
			$this->image,
		])->andFilterWhere([
			'like',
			'supplier',
			$this->supplier,
		])->andFilterWhere([
			'like',
			'bill_number',
			$this->bill_number,
		])->andFilterWhere([
			'like',
			'bill_image',
			$this->bill_image,
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

	public function getInfo($params, $attribute) {
		$query = Product::find();
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
			'category_id'       => $this->category_id,
			'code'              => $this->code,
			'in_stock'          => $this->in_stock,
			'base_price'        => $this->base_price,
			'description'       => $this->description,
			'distribute_sale'   => $this->distribute_sale,
			'agent_sale'        => $this->agent_sale,
			'retail_sale'       => $this->retail_sale,
			'created_date'      => $this->created_date,
			'order_number'      => $this->order_number,
			'weight'            => $this->weight,
			'status'            => $this->status,
			'price_tax'         => $this->price_tax,
			'supplier_discount' => $this->supplier_discount,
			'updated_date'      => $this->updated_date,
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
			'image',
			$this->image,
		])->andFilterWhere([
			'like',
			'supplier',
			$this->supplier,
		])->andFilterWhere([
			'like',
			'bill_number',
			$this->bill_number,
		])->andFilterWhere([
			'like',
			'bill_image',
			$this->bill_image,
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
		$query->andFilterWhere(['status' => $this::RECEIPTED]);
		if($attribute == 'quantity') {
			return $query->sum('in_stock');
		} elseif($attribute == 'total_money') {
			return $query->sum('in_stock*base_price');
		} else {
			return $dataProvider;
		}
	}
}
