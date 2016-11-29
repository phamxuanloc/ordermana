<?php
namespace app\controllers;

use app\models\OrderItem;
use app\models\Product;
use Yii;
use app\models\Order;
use app\models\search\OrderSearch;
use app\components\Controller;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
		];
	}

	/**
	 * Lists all Order models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel  = new OrderSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Order model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			'model' => $this->findModel($id),
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
							$orderItem->total_price = $product->getPrice($role, $product->id);
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
				}
				return $this->redirect(Url::to(['/order']));
			} else {
				echo '<pre>';
				print_r($order->errors);
				die;
			}
		}
		if(isset($_POST['category'])) {
			$products = Product::findAll(['category_id' => $_POST['category']]);
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
	public function actionUpdate($id) {
		$model = $this->findModel($id);
		if($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect([
				'view',
				'id' => $model->id,
			]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

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
