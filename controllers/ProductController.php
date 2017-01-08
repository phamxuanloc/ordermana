<?php
namespace app\controllers;

use app\components\Controller;
use app\models\Notification;
use app\models\Product;
use app\models\ProductHistory;
use app\models\search\ProductSearch;
use app\models\User;
use navatech\role\filters\RoleFilter;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller {

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
				'name'    => 'Trang Nhập kho',
				//NOT REQUIRED, only if you want to translate
				'actions' => [
					'receipt' => 'Nhập kho công ty',
					//without translate
					'index'   => 'Danh sách ',
					'update'  => 'Cập nhật kho công ty ',
					//with translated, which will display on role _form
				],
			],
		];
	}

	/**
	 * Lists all Product models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel  = new ProductSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$product_num  = $searchModel->getInfo(Yii::$app->request->queryParams, 'quantity');
		$product_sum  = $searchModel->getInfo(Yii::$app->request->queryParams, 'total_money');
		return $this->render('index', [
			'product_num'  => $product_num,
			'product_sum'  => $product_sum,
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Product model.
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
	 * Creates a new Product model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionReceipt() {
		$model = new Product();
		if($model->load(Yii::$app->request->post()) && $model->save()) {
			$img          = $model->uploadPicture('image', 'product_img');
			$product_bill = $model->uploadPicture('bill_image', 'product_bill');
			$admins       = User::find()->where(['role_id' => $model::ROLE_ADMIN])->all();
			if($admins != null) {
				if($model->status == $model::RECEIPTED) {
					foreach($admins as $admin) {
						$noti          = new Notification();
						$noti->user_id = $admin->id;
						$noti->content = $this->user->username . ' đã nhập sản phẩm ' . $model->name . ' vào kho thành công vào lúc ' . date('d-m-Y H:i:s');
						//								$noti->url= Url::to(['/product-history/update','id'=>$history->id);
						if($noti->save()) {
							$noti->updateAttributes([
								'url' => Url::to([
									'/product/update',
									'id'   => $model->id,
									'noti' => $noti->id,
								]),
							]);
						} else {
//							echo '<pre>';
//							print_r($noti->errors);
//							die;
						}
					}
				}
			}
			if($model->save()) {
				$history                    = new ProductHistory();
				$history->category_id       = $model->category_id;
				$history->code              = $model->code;
				$history->name              = $model->name;
				$history->old_value         = 0;
				$history->new_value         = $model->in_stock;
				$history->product_id        = $model->id;
				$history->receipted_date    = $model->receipted_date;
				$history->base_price        = $model->base_price;
				$history->supplier_discount = $model->supplier_discount;
				$history->price_tax         = $model->price_tax;
				$history->bill_number       = $model->bill_number;
				$history->order_number      = $model->order_number;
				$history->quantity          = $model->in_stock;
				if(!$history->save()) {
					//					echo '<pre>';
					//					print_r($history->errors);
					//					die;
				}
				if($img !== false) {
					$path = $model->getPictureFile('image');
					$img->saveAs($path);
				}
				if($product_bill !== false) {
					$path = $model->getPictureFile('bill_image');
					$product_bill->saveAs($path);
				}
				return $this->redirect(['index']);
			}
			return $this->redirect(['index']);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Product model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model    = $this->findModel($id);
		$oldImage = $model->image;
		//		$oldBill  = $model->bill_image;
		if($model->load(Yii::$app->request->post())) {
			$admins = User::find()->where(['role_id' => $model::ROLE_ADMIN])->all();
			if($admins != null) {
				if($model->getOldAttribute('status') != $model->status && $model->status == $model::RECEIPTED) {
					foreach($admins as $admin) {
						$noti          = new Notification();
						$noti->user_id = $admin->id;
						$noti->content = $this->user->username . ' đã nhập sản phẩm ' . $model->name . ' vào kho thành công vào lúc ' . date('d-m-Y H:i:s');
						//								$noti->url= Url::to(['/product-history/update','id'=>$history->id);
						if($noti->save()) {
							$noti->updateAttributes([
								'url' => Url::to([
									'/product/update',
									'id'   => $model->id,
									'noti' => $noti->id,
								]),
							]);
						}
					}
				}
			}
			$model->save();
			$img = $model->uploadPicture('image', 'product_img');
			//			$bill_img = $model->uploadPicture('bill_image', 'bill_img');
			if($img == false) {
				$model->image = $oldImage;
			}
			//			if($bill_img == false) {
			//				$model->bill_image = $oldBill;
			//			}
			if($model->save()) {
				if($img !== false) {
					$path = $model->getPictureFile('image');
					$img->saveAs($path);
				}
				//				if($bill_img !== false) {
				//					$path = $model->getPictureFile('bill_image');
				//					$bill_img->saveAs($path);
				//				}if($bill_img !== false) {
				//					$path = $model->getPictureFile('bill_image');
				//					$bill_img->saveAs($path);
				//				}
				return $this->redirect(['index']);
			}
		}
		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing Product model.
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
	 * Finds the Product model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Product the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if(($model = Product::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
