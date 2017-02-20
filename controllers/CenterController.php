<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 1/24/2017
 * Time: 6:58 AM
 */
namespace app\controllers;

use app\components\Controller;
use app\models\CenterItem;
use app\models\Customer;
use app\models\Order;
use app\models\OrderCenter;
use app\models\OrderItem;
use app\models\Product;
use app\models\UserStock;
use kartik\mpdf\Pdf;
use navatech\role\filters\RoleFilter;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class CenterController extends Controller {

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
				'name'    => 'Trang center',
				//NOT REQUIRED, only if you want to translate
				'actions' => [
					'create' => 'Tạo đơn hàng',
					//without translate
					//					'index'  => 'Danh sách',
					//					'view'       => 'Chi tiết đơn hàng',
					//					'delete' => 'Xóa danh mục',
					//					'update' => 'Cập nhật danh mục'
					//with translated, which will display on role _form
				],
			],
		];
	}

	public function actionCreate() {
		$orderItem = new CenterItem();
		$order     = new OrderCenter();
		$stock     = new UserStock();
		if(isset($_POST['CenterItem'])) {
			$order->load(Yii::$app->request->post());
			$order->user_id      = $this->user->id;
			$order->status       = $order::NOT_PAID;
			$order->total_amount = 0;
			if($order->save()) {
				$order_id = $order->getPrimaryKey();
				foreach($_POST['CenterItem'] as $item) {
					if($order->save()) {
						$orderItem = new CenterItem();
						$orderItem->setAttributes($item);
						$product = Product::findOne($item['product_id']);
						if($product) {
							$orderItem->total_price = $product->retail_sale * $orderItem->quantity;
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
				$check_order = CenterItem::findOne(['order_id' => $order_id]);
				if($check_order == null) {
					$this->findModel($order_id)->delete();
				} else {
					$count = CenterItem::find()->where(['order_id' => $order_id])->sum('total_price');
					$order->updateAttributes(['total_amount' => $count]);
				}
				return $this->redirect(Url::to([
					'/center/customer-info',
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
				'product_price' => $product->retail_sale,
			];
			return json_encode($value);
		}
		$products = UserStock::find()->where(['user_id' => $this->user->id])->all();
		return $this->render('create', [
			'orderItem' => $orderItem,
			'order'     => $order,
			'products'  => $products,
			'stock'     => $stock,
		]);
	}

	public function actionCustomerInfo($id) {
		$model           = new Customer();
		$model->scenario = 'center';
		if($model->load(Yii::$app->request->post())) {
			$this->redirect(Url::to([
				'info',
				'id'    => $id,
				'phone' => $model->phone,
			]));
		}
		return $this->render('customerInfo', ['model' => $model]);
	}

	public function actionInfo($id, $phone) {
		$customer = Customer::findOne(['phone' => $phone]);
		$order    = $this->findModel($id);
		if($customer) {
			$model = $customer;
		} else {
			$model = new Customer();
		}
		if($model->load(Yii::$app->request->post())) {
			if($model->isNewRecord) {
				$model->parent_id = $this->user->id;
				if($model->save()) {
				} else {
					echo '<pre>';
					print_r($model->errors);
					die;
				};
			}
			$order->updateAttributes([
				'customer_id' => $model->id,
				'status'      => $order::PAID,
			]);
			$model->updateAttributes([
				'point' => round($order->total_amount / 100000) * Yii::$app->setting->get('point_change'),
			]);
			$this->redirect(Url::to([
				'finish',
				'id' => $order->id,
			]));
		}
		return $this->render('info', [
			'model' => $model,
			'order' => $order,
			'phone' => $phone,
		]);
	}

	public function actionFinish($id) {
		$model = $this->findModel($id);
		return $this->render('finish', ['model' => $model]);
	}

	public function actionSale($id) {
		$this->layout = false;
		$model        = $this->findModel($id);
		$items        = $model->centerItems;
		$pdf          = new Pdf([
			'content' => $this->renderPartial('_finish', [
				'model' => $model,
				'items' => $items,
			]),
			'mode'    => Pdf::MODE_UTF8,
			'format'  => Pdf::FORMAT_FOLIO,
			'cssFile' => '@web/global/plugins/bootstrap/css/bootstrap.min.css',
		]);
		return $pdf->render();
	}

	protected function findModel($id) {
		if(($model = OrderCenter::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}