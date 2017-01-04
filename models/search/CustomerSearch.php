<?php
namespace app\models\search;

use app\models\Customer;
use phpDocumentor\Reflection\Types\Null_;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CustomerSearch represents the model behind the search form about `app\models\Customer`.
 */
class CustomerSearch extends Customer {

	public $start_date;

	public $end_date;

	public $is_phone_num;

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'id',
					'phone',
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
					'phone',
					'city_id',
					'created_date',
					'start_date',
					'end_date',
					'is_phone_num',
					'source',
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
		if(Yii::$app->user->identity->role_id != $this::ROLE_ADMIN && Yii::$app->user->identity->role_id != $this::ROLE_CARE) {
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
			'user_id' => $this->user_id,
		])->andFilterWhere([
			'like',
			'phone',
			$this->phone,
		])->andFilterWhere([
			'like',
			'city_id',
			$this->city_id,
		])->andFilterWhere([
			'like',
			'source',
			$this->source,
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
		if($this->is_phone_num != null) {
			if($this->is_phone_num == 0) {
				$query->andWhere(['phone' => '']);
			} else {
				$query->andWhere([
					'NOT',
					['phone' => ''],
				]);
			}
		}
		if($this->start_date != null) {
			if($this->end_date == null) {
				$this->end_date = date('Y-m-d H:i:s');
			} else {
				$this->end_date = $this->end_date . ' 23:59:59';
			}
			$query->andFilterWhere([
				'between',
				'created_date',
				$this->start_date . ' 00:00:00',
				$this->end_date,
			]);
		}
		return $dataProvider;
	}

	public function searchData($params, $attribute = null) {
		$query = Customer::find();
		if(Yii::$app->user->identity->role_id != $this::ROLE_ADMIN && Yii::$app->user->identity->role_id != $this::ROLE_CARE) {
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
			'user_id' => $this->user_id,
		])->andFilterWhere([
			'like',
			'phone',
			$this->phone,
		])->andFilterWhere([
			'like',
			'city_id',
			$this->city_id,
		])->andFilterWhere([
			'like',
			'link_fb',
			$this->link_fb,
		])->andFilterWhere([
			'like',
			'source',
			$this->source,
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
		if($this->start_date != null) {
			if($this->end_date == null) {
				$this->end_date = date('Y-m-d H:i:s');
			} else {
				$this->end_date = $this->end_date . ' 23:59:59';
			}
			$query->andFilterWhere([
				'between',
				'created_date',
				$this->start_date . ' 00:00:00',
				$this->end_date,
			]);
		}
		if($this->is_phone_num != null) {
			if($this->is_phone_num == 0) {
				$query->andWhere(['phone' => '']);
			} else {
				$query->andWhere([
					'NOT',
					['phone' => ''],
				]);
			}
		}
		if($attribute == 'quantity') {
			return $query->count();
		} elseif($attribute == 'item') {
			$query->joinWith('items');
			return $query->sum('customer_item.quantity') != null ? $query->sum('customer_item.quantity') : 0;
		} else {
			return $dataProvider;
		}
	}
}
