<?php
namespace app\controllers;

use app\components\Controller;
use app\models\CustomerItem;
use app\models\OrderCustomer;
use app\models\Point;
use app\models\Product;
use app\models\search\OrderCustomerSearch;
use app\models\UserStock;
use navatech\role\filters\RoleFilter;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * OrderCustomerController implements the CRUD actions for OrderCustomer model.
 */
class OrderCustomerController extends Controller {

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
				'name'    => 'Trang Đơn hàng khách lẻ',
				//NOT REQUIRED, only if you want to translate
				'actions' => [
					//without translate
					'index'   => 'Danh sách ',
					'view'  => 'Chi tiết đơn hàng ',
					'order-item'=>'Tạo đơn hàng'
					//with translated, which will display on role _form
				],
			],
		];
	}

	/**
	 * Lists all OrderCustomer models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel  = new OrderCustomerSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single OrderCustomer model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionView($id) {
		$model = $this->findModel($id);
		$items = $model->customerItem;
		Yii::$app->session->setFlash('warning', 'Chú ý: Chuyển trạng thái qua "Đã nhận đủ" để xuất kho');
		if($model->load(Yii::$app->request->post())) {
			$model->scenario  = 'update_status';
			$model->update_at = date('Y-m-d H:i:s');
			$model->update_by = $this->user->id;
			if($model->save()) {
				if($model->status == $model::RECEIPTED) {
					foreach($items as $item) {
						if($item->status != $item::STATUS_RECEIPTED) {
							$product_stock = UserStock::findOne(['product_id' => $item->product_id]);
							if($item->quantity > $product_stock->in_stock) {
								Yii::$app->session->setFlash('danger', 'Chú ý: Sản phẩm ' . $item->product->name . ' không đủ số lượng để xuất');
								$model->updateAttributes(['status' => $model::NOT_RECEIPTED]);
								$item->updateAttributes(['status' => $item::STATUS_NOT_RECEIPTED]);
								//							return $this->redirect(['/view','id'=>$id]);
							} else {
								$item->updateAttributes(['status' => $item::STATUS_RECEIPTED]);
								$product_stock->updateAttributes(['in_stock' => $product_stock->in_stock - $item->quantity]);
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

	public function actionOrderItem() {
		$orderItem = new CustomerItem();
		$order     = new OrderCustomer();
		$children  = $order->getOwnerCustomer();
		//        if(Yii::$app->request->post()){
		//            echo '<pre>';
		//            print_r(Yii::$app->request->post());
		//            die;
		//        }
		if(isset($_POST['CustomerItem'])) {
			$order->load(Yii::$app->request->post());
			$order->customer_id = $_POST['OrderCustomer']['customer_id'];
			$order->user_id     = $this->user->id;
			$order->status      = $order::NOT_PAID;
			if($order->save()) {
				$order_id = $order->getPrimaryKey();
				foreach($_POST['OrderItem'] as $item) {
					if($order->save()) {
						$orderItem = new CustomerItem();
						$orderItem->setAttributes($item);
						$product = Product::findOne($item['product_id']);
						if($product) {
							$orderItem->total_price = $product->retail_sale * $orderItem->quantity;
						}
						if(($orderItem->quantity) <= 0) {
							$orderItem->quantity    = 0;
							$orderItem->total_price = 0;
						}
						$orderItem->order_customer_id = $order_id;
						if($orderItem->save()) {
							Yii::$app->session->setFlash('success', 'Thành công');
						}
					} else {
						if($orderItem->save() == false) {
							Yii::$app->session->setFlash('failed', 'Thất bại');
						}
					}
				}
				$check_order = CustomerItem::findOne(['order_customer_id' => $order_id]);
				if($check_order == null) {
					$this->findModel($order_id)->delete();
				} else {
					$count = CustomerItem::find()->where(['order_customer_id' => $order_id])->sum('total_price');
					$point = Point::find()->where([
						'<=',
						'point_begin',
						$order->customer->point,
					])->andWhere([
						'>=',
						'point_end',
						$order->customer->point,
					])->one();
					if($point != null) {
						$discount = ($point->discount) * $count;
						$order->updateAttributes(['total_amount' => $count - $discount]);
					} else {
						$order->updateAttributes(['total_amount' => $count]);
					}
					$order->customer->updateAttributes(['point' => round($order->total_amount / 100000) * Yii::$app->setting->get('point_change')]);
				}
				return $this->redirect(Url::to([
					'/order-customer/view',
					'id' => $order_id,
				]));
			} else {
				echo '<pre>';
				print_r($order->errors);
				die;
			}
		}
		if(isset($_POST['category'])) {
			$html        = '<option value>Chọn sản phẩm</option>';
			$user_stocks = $this->user->userStocks;
			foreach($user_stocks as $user_stock) {
				$product = Product::findOne([
					'id'          => $user_stock->product_id,
					'category_id' => $_POST['category'],
				]);
				if($product) {
					$html .= '<option value="' . $product->id . '">' . $product->name . '</option>';
				}
			}
			return $html;
		} elseif(isset($_POST['product'])) {
			/**@var Product $product */
			$product = Product::find()->where(['id' => $_POST['product']])->one();
			$value   = [
				'product_code'  => $product->code,
				'product_price' => $product->retail_sale,
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
	 * Updates an existing OrderCustomer model.
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
	 * Deletes an existing OrderCustomer model.
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
	 * Finds the OrderCustomer model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return OrderCustomer the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if(($model = OrderCustomer::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
