<?php
/**
 * Created by PhpStorm.
 * User: Yamon-PC
 * Date: 28-Dec-16
 * Time: 12:01 PM
 */
namespace app\models;

use app\components\Form;
use app\components\Model;
use DateInterval;
use DateTime;
use Yii;
use yii\helpers\ArrayHelper;

class ReportForm extends Form {

	public $start_date;

	public $end_date;

	public function rules() {
		return [
			[
				[
					'start_date',
					'end_date',
				],
				'safe',
			],
			[
				'end_date',
				'compare',
				'compareAttribute' => 'start_date',
				'operator'         => '>=',
				'message'          => 'Start Date must be less than End Date',
			],
			[
				'start_date',
				'required',
			],
		];
	}

	public function getProfitChart($params) {
		$number = array();
		$this->load($params);
		if($this->start_date != null) {
			if($this->end_date != null) {
				$oStart = new DateTime($this->start_date);
				$oEnd   = new DateTime($this->end_date);
			} else {
				$oStart = new DateTime($this->start_date);
				$oEnd   = new DateTime(date('Y-m-d'));
			}
		} else {
			$oStart = new DateTime(date('Y-m-d', strtotime('monday this week')));
			$oEnd   = new DateTime(date('Y-m-d', strtotime('sunday this week')));
		}
		while($oStart->getTimestamp() <= $oEnd->getTimestamp()) {
			$value    = Order::find();
			$customer = OrderCustomer::find();
			if($this->user->role_id == Model::ROLE_ADMIN) {
				$value->joinWith('parent');
				$value->andFilterWhere(['user.role_id' => Model::ROLE_ADMIN])->andFilterWhere([
					'between',
					'created_date',
					$oStart->format('Y-m-d') . ' 00:00:00',
					$oStart->format('Y-m-d') . ' 23:59:59',
				]);
				$order = $value->sum('total_amount');
				$customer->joinWith('users');
				$customer->andFilterWhere(['user.role_id' => Model::ROLE_ADMIN])->andFilterWhere([
					'between',
					'created_date',
					$oStart->format('Y-m-d') . ' 00:00:00',
					$oStart->format('Y-m-d') . ' 23:59:59',
				]);
				$order_customer = $customer->sum('total_amount');
				$total          = $order_customer + $order;
			} else {
				$order          = $value->where(['parent_id' => $this->user->id])->andWhere([
					'between',
					'created_date',
					$oStart->format('Y-m-d') . ' 00:00:00',
					$oStart->format('Y-m-d') . ' 23:59:59',
				])->sum('total_amount');
				$order_customer = $customer->where(['user_id' => $this->user->id])->andWhere([
					'between',
					'created_date',
					$oStart->format('Y-m-d') . ' 00:00:00',
					$oStart->format('Y-m-d') . ' 23:59:59',
				])->sum('total_amount');
				$total          = $order + $order_customer;
			}
			$number[] = [
				$oStart->format('d'),
				$total != null ? (int) $total : 0,
			];
			$oStart->add(new DateInterval("P1D"));
		}
		return $number;
		//		}
	}

	public function getTopProduct($params) {
		//		$top_product = OrderItem::find()->select('product.name,SUM(order_item.quantity)')->innerJoinWith('product', 'order_item.product_id=product.id')->innerJoinWith('order', 'order_item.order_id=order.id')->where(['order.parent_id' => $this->user->id])->asArray()->groupBy('product.name')->all();
		$query = OrderItem::find();
		$this->load($params);
		$query->select('product.name,SUM(order_item.quantity) as total');
		$query->innerJoin('product', 'order_item.product_id=product.id');
		$query->innerJoin('order', 'order_item.order_id=order.id');
		$query->andFilterWhere(['order.parent_id' => $this->user->id]);
		if($this->start_date != null) {
			if($this->end_date == null) {
				$this->end_date = date('Y-m-d');
			}
			$query->andFilterWhere([
				'>=',
				'order.created_date',
				$this->start_date,
			]);
			$query->andFilterWhere([
				'<=',
				'order.created_date',
				$this->end_date,
			]);
			//			$query->andFilterWhere([
			//				'between',
			//				'order.created_date',
			//				$this->start_date,
			//				$this->end_date,
			//			]);
			//			$query->andFilterWhere([
			//				'between',
			//				'order_item.created_date',
			//				$this->start_date,
			//				$this->end_date,
			//			]);
		}
		$query->asArray()->groupBy('product.name');
		$query->orderBy('total DESC');
		$top_products = $query->limit(10)->all();
		$top          = [];
		if($top_products != null) {
			foreach($top_products as $top_product) {
				$top[] = [
					$top_product['name'],
					(int) $top_product['total'],
				];
			}
		} else {
			$top[] = [
				'Không có',
				0,
			];
		}
		$top = ArrayHelper::merge([
			[
				'Top sản phẩm bán chạy',
				'Số lượng',
			],
		], $top);
		return $top;
	}

	/**
	 *Trả về mảng tiền hàng đại diện nhập
	 */
	public function getPreArray($params) {
		$this->load($params);
		$query = User::find();
		$query->select('user.id,user.username,sum(order.total_amount) AS total');
		$query->innerJoinWith('orders0', 'user.id=order.user_id');
		$query->andFilterWhere(['role_id' => Model::ROLE_PRE]);
		if($this->start_date != null) {
			if($this->end_date == null) {
				$this->end_date = date('Y-m-d');
			}
			$query->andFilterWhere([
				'between',
				'order.created_date',
				$this->start_date,
				$this->end_date,
			]);
		}
		$query->asArray();
		$array_pres = $query->groupBy('user.id')->orderBy('total DESC')->all();
		$pre        = [];
		foreach($array_pres as $array_pre) {
			$pre[] = [
				$array_pre['username'],
				(int) $array_pre['total'],
			];
		}
		if($array_pres == null) {
			$pre[] = [
				'Không có dữ liệu',
				1,
			];
		}
		$pre = ArrayHelper::merge([
			[
				'Doanh số bán ra',
				'VNĐ',
			],
		], $pre);
		return $pre;
	}

	/**
	 *Trả về mảng tiền hàng đại diện lý
	 */
	public function getAgeArray($params) {
		$model = new  Model();
		$this->load($params);
		$query = User::find();
		$query->select('user.id,user.username,sum(order.total_amount) AS total');
		$query->innerJoinWith('orders0', 'user.id=order.user_id');
		$children = $model->getTotalChildren(Yii::$app->user->id);
		$query->andFilterWhere([
			'IN',
			'user.id',
			$children,
		]);
		$query->andFilterWhere(['role_id' => Model::ROLE_A]);
		if($this->start_date != null) {
			if($this->end_date == null) {
				$this->end_date = date('Y-m-d');
			}
			$query->andFilterWhere([
				'between',
				'order.created_date',
				$this->start_date,
				$this->end_date,
			]);
		}
		$query->asArray();
		$array_pres = $query->groupBy('user.id')->orderBy('total DESC')->all();
		$pre        = [];
		foreach($array_pres as $array_pre) {
			$pre[] = [
				$array_pre['username'],
				(int) $array_pre['total'],
			];
		}
		if($array_pres == null) {
			$pre[] = [
				'Không có dữ liệu',
				1,
			];
		}
		$pre = ArrayHelper::merge([
			[
				'Doanh số bán ra',
				'VNĐ',
			],
		], $pre);
		return $pre;
	}

	/**
	 *Trả về tổng số đơn hàng theo thời gian
	 *
	 * @param $params
	 *
	 * @return int|string
	 */
	public function getTotalOrder($params) {
		$this->load($params);
		if($this->start_date != null) {
			$oStart = new DateTime($this->start_date);
			$oEnd   = new DateTime($this->end_date);
		} else {
			$oStart = new DateTime(date('Y') . '-' . date('m') . '-1');
			$oEnd   = clone $oStart;
			$oEnd->add(new DateInterval("P1M"));
		}
		if($this->user->role_id == Model::ROLE_ADMIN) {
			$order          = Order::find()->andFilterWhere(['parent_id' => $this->user->id])->andFilterWhere([
				'>=',
				'created_date',
				$oStart->format('Y-m-d'),
			])->andFilterWhere([
				'<=',
				'created_date',
				$oEnd->format('Y-m-d'),
			])->count();
			$customer_order = OrderCustomer::find()->andFilterWhere(['user_id' => $this->user->id])->andFilterWhere([
				'>=',
				'created_date',
				$oStart->format('Y-m-d'),
			])->andFilterWhere([
				'<=',
				'created_date',
				$oEnd->format('Y-m-d'),
			])->count();
			$total          = $order + $customer_order;
		} else {
			$order          = Order::find()->where(['parent_id' => $this->user->id])->andFilterWhere([
				'>=',
				'created_date',
				$oStart->format('Y-m-d'),
			])->andFilterWhere([
				'<=',
				'created_date',
				$oEnd->format('Y-m-d'),
			])->count();
			$customer_order = OrderCustomer::find()->andFilterWhere(['user_id' => $this->user->id])->andFilterWhere([
				'>=',
				'created_date',
				$oStart->format('Y-m-d'),
			])->andWhere([
				'<=',
				'created_date',
				$oEnd->format('Y-m-d'),
			])->count();
			$total          = $order + $customer_order;
		}
		return $total;
	}

	public function getTreeInfo($params, $role = null) {
		$model = new  Model();
		$this->load($params);
		if($this->user->role_id != $model::ROLE_ADMIN) {
			$children = $model->getTotalChildren(Yii::$app->user->id);
			$child    = User::find();
			$child->andFilterWhere(['role_id' => $role]);
		} else {
			$children = ArrayHelper::map(User::find()->where(['role_id' => $role])->all(), 'id', 'id');
			$child    = User::find();
		}
		$child->andFilterWhere([
			'IN',
			'id',
			$children,
		]);
		if($this->start_date != null) {
			if($this->end_date == null) {
				$this->end_date = date('Y-m-d');
			}
			$date_s = new DateTime($this->start_date);
			$date_e = new DateTime($this->end_date);
			$child->andFilterWhere([
				'>=',
				'created_at',
				(int) $date_s->getTimestamp(),
			])->andFilterWhere([
				'<=',
				'created_at',
				$date_e->getTimestamp(),
			]);
		}
		return $child->count();
	}

	public function getAllCustomer($params) {
		$this->load($params);
		$query = Customer::find();
		if($this->user->role_id != Model::ROLE_ADMIN) {
			$query->andFilterWhere([
				'user_id' => $this->user->id,
			])->orFilterWhere([
				'parent_id' => $this->user->id,
			])->orFilterWhere([
				'last_parent_id' => $this->user->id,
			]);
		}
		if($this->start_date != null) {
			if($this->end_date == null) {
				$this->end_date = date('Y-m-d');
			}
			$query->andFilterWhere([
				'between',
				'created_date',
				$this->start_date,
				$this->end_date,
			]);
		}
		return $query->count();
	}

	/**
	 * Trả về tổng thu hàng tháng
	 */
	public function getProfit($params) {
		$this->load($params);
		$query_order    = Order::find();
		$query_customer = OrderCustomer::find();
		$query_order->where(['parent_id' => $this->user->id]);
		$query_customer->where(['user_id' => $this->user->id]);
		if($this->start_date != null) {
			$oStart = $this->start_date;
			if($this->end_date != null) {
				$oEnd = $this->end_date;
			} else {
				$oEnd = date('Y-m-d');
			}
			$query_order->where([
				'>=',
				'created_date',
				$oStart,
			])->andWhere([
				'<=',
				'created_date',
				$oEnd,
			])->sum('total_amount');
			$query_customer->where([
				'>=',
				'created_date',
				$oStart,
			])->andWhere([
				'<=',
				'created_date',
				$oEnd,
			]);
		}
		$query_customer->andFilterWhere(['status' => Order::RECEIPTED]);
		$query_order->andFilterWhere(['status' => OrderCustomer::RECEIPTED]);
		$profit          = $query_order->sum('total_amount');
		$profit_customer = $query_customer->sum('total_amount');
		return $total = $profit + $profit_customer;
	}

	/**
	 * lấy ra số sp trong kho
	 */
	public function getStock($params) {
		$this->load($params);
		if($this->user->role_id != Model::ROLE_ADMIN) {
			$query = UserStock::find();
			if($this->start_date != null) {
				if($this->end_date == null) {
					$this->end_date = date('Y-m-d');
				}
				$query->andFilterWhere([
					'between',
					'created_date',
					$this->start_date,
					$this->end_date,
				]);
			}
			$products      = $query->all();
			$product_array = [];
			if($products != null) {
				foreach($products as $product) {
					$product_array[] = [
						$product->product->name,
						$product->in_stock,
					];
				}
			} else {
				$product_array = [
					[
						'Không có sản phẩm nào',
						1,
					],
				];
			}
		} else {
			$query = Product::find();
			$query->andFilterWhere(['status' => Product::RECEIPTED]);
			if($this->start_date != null) {
				if($this->end_date == null) {
					$this->end_date = date('Y-m-d');
				}
				$query->andFilterWhere([
					'between',
					'created_date',
					$this->start_date,
					$this->end_date,
				]);
			}
			$products      = $query->all();
			$product_array = [];
			if($products != null) {
				foreach($products as $product) {
					$product_array[] = [
						$product->name,
						$product->in_stock,
					];
				}
			} else {
				$product_array = [
					[
						'Không có sản phẩm nào',
						1,
					],
				];
			}
		}
		return ArrayHelper::merge([
			[
				'Sản phẩm trong kho',
				'Sản phẩm',
			],
		], $product_array);
	}

	/**
	 *Thống kê top khách hàng
	 */
	public function getTopCustomer($params) {
		$this->load($params);
		$query = Customer::find();
		$query->innerJoin('customer_item', 'customer.id=customer_item.customer_id');
		if($this->user->role_id == Model::ROLE_ADMIN) {
			if($this->start_date != null) {
				if($this->end_date == null) {
					$this->end_date = date('Y-m-d');
				}
				$query->andFilterWhere([
					'between',
					'customer_item.created_date',
					$this->start_date,
					$this->end_date,
				]);
			}
		} else {
			$model    = new Model();
			$children = $model->getTotalChildren($this->user->id);
			$query->andFilterWhere([
				'IN',
				'user_id',
				$children,
			]);
			$query->andFilterWhere([
				'IN',
				'parent_id',
				$children,
			]);
			$query->andFilterWhere([
				'IN',
				'last_parent_id',
				$children,
			]);
			$query->orFilterWhere(['user_id' => $this->user->id]);
			if($this->start_date != null) {
				if($this->end_date == null) {
					$this->end_date = date('Y-m-d');
				}
				$query->andFilterWhere([
					'between',
					'customer_item.created_date',
					$this->start_date,
					$this->end_date,
				]);
			}
		}
		$customers      = $query->select('customer.name,SUM(customer_item.total_price) AS total')->asArray()->groupBy('customer.name')->orderBy('total DESC')->limit(10)->all();
		$customer_array = [];
		if($customers != null) {
			foreach($customers as $customer) {
				$customer_array[] = [
					$customer['name'],
					$customer['total'],
				];
			}
		} else {
			$customer_array = [
				[
					'Không có khách hàng nào',
					1,
				],
			];
		}
		return ArrayHelper::merge([
			[
				'Top khách mua hàng',
				'VNĐ',
			],
		], $customer_array);
	}
}