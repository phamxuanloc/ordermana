<?php
namespace app\controllers;

use app\components\Controller;
use app\models\Order;
use app\models\OrderItem;
use app\models\Product;
use app\models\search\OrderSearch;
use app\models\UserStock;
use navatech\role\filters\RoleFilter;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller {

	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'verbs' => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
			'role'  => [
				'class'   => RoleFilter::className(),
				'name'    => 'Trang xuất kho',
				//NOT REQUIRED, only if you want to translate
				'actions' => [
					'order-item' => 'Xuất kho công ty',
					//without translate
					'index'      => 'Danh sách đơn hàng xuất kho',
					'view'       => 'Chi tiết đơn hàng',
					'delete'     => 'Xóa đơn hàng',
					'receipted'  => 'Danh sách đơn hàng nhập kho'
					//with translated, which will display on role _form
				],
			],
		];
	}

	/**
	 * Lists all Order models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel  = new OrderSearch();
		$params       = Yii::$app->request->queryParams;
		$dataProvider = $searchModel->search($params);
		$order_num    = $searchModel->getInfo($params, 'quantity');
		$order_sum    = $searchModel->getInfo($params, 'total_money');
		$order_pre    = $searchModel->getInfo($params, 'pre_quantity');
		$order_big    = $searchModel->getInfo($params, 'big_quantity');
		$order_age    = $searchModel->getInfo($params, 'age_quantity');
		$order_dis    = $searchModel->getInfo($params, 'dis_quantity');
		return $this->render('index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
			'order_num'    => $order_num,
			'order_sum'    => $order_sum,
			'order_pre'    => $order_pre,
			'order_big'    => $order_big,
			'order_age'    => $order_age,
			'order_dis'    => $order_dis,
		]);
	}

	public function actionReceipted() {
		$searchModel  = new OrderSearch();
		$params       = Yii::$app->request->queryParams;
		$dataProvider = $searchModel->searchClient($params);
		$order_num    = $searchModel->getInfoClient($params, 'quantity');
		$order_sum    = $searchModel->getInfoClient($params, 'total_money');
		$order_pre    = $searchModel->getInfoClient($params, 'pre_quantity');
		$order_big    = $searchModel->getInfoClient($params, 'big_quantity');
		$order_age    = $searchModel->getInfoClient($params, 'age_quantity');
		$order_dis    = $searchModel->getInfoClient($params, 'dis_quantity');
		return $this->render('receipted', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
			'order_num'    => $order_num,
			'order_sum'    => $order_sum,
			'order_pre'    => $order_pre,
			'order_big'    => $order_big,
			'order_age'    => $order_age,
			'order_dis'    => $order_dis,
		]);
	}

	/**
	 * Displays a single Order model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionViewClient($id) {
		$model = $this->findModel($id);
		$items = $model->orderItems;
		Yii::$app->session->setFlash('warning', 'Chú ý: Bấm xác nhận để xác nhận đã nhận đủ hàng');
		if($model->load(Yii::$app->request->post())) {
			$model->scenario  = 'update_status';
			$model->update_at = date('Y-m-d H:i:s');
			$model->update_by = $this->user->id;
			if($model->save()) {
				Yii::$app->session->setFlash('success', 'Chú ý: Đã xác nhận thành công');
				return $this->redirect([
					'view-client',
					'id' => $id,
				]);
			};
		}
		return $this->render('view-client', [
			'model' => $model,
			'items' => $items,
		]);
	}

	public function actionView($id) {
		$model = $this->findModel($id);
		$items = $model->orderItems;
		Yii::$app->session->setFlash('warning', 'Chú ý: Chuyển trạng thái qua "Đã nhận đủ" để xuất kho');
		if($this->user->role_id != $model::ROLE_ADMIN) {
			if($model->parent_id != $this->user->id) {
				return $this->goHome();
			}
		}
		if($model->load(Yii::$app->request->post())) {
			$model->scenario  = 'update_status';
			$model->update_at = date('Y-m-d H:i:s');
			$model->update_by = $this->user->id;
			if($model->getOldAttribute('status') != $model::CONFIRM && $model->status == $model::RECEIPTED) {
				Yii::$app->session->setFlash('danger', 'Chú ý: Bạn phải đợi khách hàng xác nhận mới có thể xuất kho');
				return $this->redirect([
					'view',
					'id' => $id,
				]);
			}
			if($model->status == $model::CONFIRM) {
				Yii::$app->session->setFlash('danger', 'Chú ý: Chỉ khách hàng mới có thể xác nhận');
				return $this->redirect([
					'view',
					'id' => $id,
				]);
			}
			if($model->save()) {
				if($model->status == $model::RECEIPTED) {
					foreach($items as $item) {
						if($item->status != $item::STATUS_RECEIPTED) {
							if($item->quantity > $item->product->in_stock) {
								Yii::$app->session->setFlash('danger', 'Chú ý: Sản phẩm ' . $item->product->name . ' không đủ số lượng để xuất');
								$model->updateAttributes(['status' => $model::NOT_RECEIPTED]);
								$item->updateAttributes(['status' => $item::STATUS_NOT_RECEIPTED]);
								//							return $this->redirect(['/view','id'=>$id]);
							} else {
								$isset_stock = UserStock::findOne([
									'product_id' => $item->product_id,
									'user_id'    => $item->order->user_id,
								]);
								if($isset_stock != null) {
									$isset_stock->updateAttributes(['in_stock' => $isset_stock->in_stock + $item->quantity]);
								} else {
									$stock             = new UserStock();
									$stock->user_id    = $item->order->user_id;
									$stock->product_id = $item->product_id;
									$stock->in_stock   = $item->quantity;
									$stock->save();
								}
								$item->updateAttributes(['status' => $item::STATUS_RECEIPTED]);
								$item->product->updateAttributes(['in_stock' => $item->product->in_stock - $item->quantity]);
							}
						}
					}
				}
				return $this->redirect([
					'view',
					'id' => $id,
				]);
			} else {
				echo '<pre>';
				print_r($model->errors);
				die;
			}
		}
		return $this->render('view', [
			'model' => $model,
			'items' => $items,
		]);
	}

	/**
	 * Creates a new Order model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionOrderItem($role = null) {
		$orderItem = new OrderItem();
		$order     = new Order();
		$children  = $order->getTotalChildren($this->user->id);
		if($role == null) {
			return $this->render('issue', [
				'orderItem' => $orderItem,
				'order'     => $order,
			]);
		} else {
			if(\Yii::$app->user->identity->role_id != $order::ROLE_ADMIN) {
				if(\Yii::$app->user->identity->role_id >= $role) {
					return $this->redirect([
						'order-item',
						'role' => \Yii::$app->user->identity->role_id + 1,
					]);
				}
			}
		}
		if(isset($_POST['OrderItem'])) {
			$order->load(Yii::$app->request->post());
			$order->user_id   = $_POST['Order']['downline'];
			$order->parent_id = $this->user->id;
			$order->status    = $order::NOT_PAID;
			$order->type      = $role;
			if($order->save()) {
				$order_id = $order->getPrimaryKey();
				foreach($_POST['OrderItem'] as $item) {
					if($order->save()) {
						$orderItem = new OrderItem();
						$orderItem->setAttributes($item);
						$product = Product::findOne($item['product_id']);
						if($product) {
							$orderItem->total_price = $product->getPrice($role, $product->id) * ($orderItem->quantity);
						}
						if(($orderItem->quantity) <= 0) {
							$orderItem->quantity    = 0;
							$orderItem->total_price = 0;
						}
						$orderItem->order_id = $order_id;
						if($orderItem->save()) {
							Yii::$app->session->setFlash('success', 'Thành công');
						}
					} else {
						if($orderItem->save() == false) {
							Yii::$app->session->setFlash('failed', 'Thất bại');
						}
					}
				}
				$check_order = OrderItem::findOne(['order_id' => $order_id]);
				if($check_order == null) {
					$this->findModel($order_id)->delete();
				} else {
					$count = OrderItem::find()->where(['order_id' => $order_id])->sum('total_price');
					$order->updateAttributes(['total_amount' => $count]);
				}
				return $this->redirect(Url::to([
					'/order/view',
					'id' => $order_id,
				]));
			} else {
				echo '<pre>';
				print_r($order->errors);
				die;
			}
		}
		if(isset($_POST['category'])) {
			$products = Product::findAll([
				'category_id' => $_POST['category'],
				'status'      => $order::RECEIPTED,
			]);
			$html     = '<option value>Chọn sản phẩm</option>';
			foreach($products as $product) {
				$html .= '<option value="' . $product->id . '">' . $product->name . '</option>';
			}
			return $html;
		} elseif(isset($_POST['product'])) {
			/**@var Product $product */
			$product = Product::find()->where(['id' => $_POST['product']])->one();
			$value   = [
				'product_code'  => $product->code,
				'product_price' => $product->getPrice($role, $product->id),
			];
			return json_encode($value);
		}
		return $this->render('orderItem', [
			'orderItem' => $orderItem,
			'order'     => $order,
			'children'  => $children,
		]);
	}

	/**
	 * Updates an existing Order model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	//	public function actionUpdate($id) {
	//		$model = $this->findModel($id);
	//		if($model->load(Yii::$app->request->post()) && $model->save()) {
	//			return $this->redirect([
	//				'view',
	//				'id' => $model->id,
	//			]);
	//		} else {
	//			return $this->render('update', [
	//				'model' => $model,
	//			]);
	//		}
	//	}
	/**
	 * Deletes an existing Order model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();
		return $this->redirect(['index']);
	}

	/**
	 * Finds the Order model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Order the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if(($model = Order::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
