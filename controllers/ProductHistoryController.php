<?php
namespace app\controllers;

use app\models\Notification;
use app\models\Product;
use app\models\User;
use navatech\role\filters\RoleFilter;
use Yii;
use app\models\ProductHistory;
use app\models\search\ProductHistorySearch;
use app\components\Controller;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductHistoryController implements the CRUD actions for ProductHistory model.
 */
class ProductHistoryController extends Controller {

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
				'name'    => 'Trang lịch sử nhập kho',
				//NOT REQUIRED, only if you want to translate
				'actions' => [
					'create' => 'Nhập thêm sản phẩm',
					//without translate
					'index'  => 'Danh sách ',
					'update' => 'Cập nhật thông tin nhập kho ',
					//with translated, which will display on role _form
				],
			],
		];
	}

	/**
	 * Lists all ProductHistory models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel  = new ProductHistorySearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single ProductHistory model.
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
	 * Creates a new ProductHistory model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate($product_id = null) {
		$model = new ProductHistory();
		if($model->load(Yii::$app->request->post())) {
			if($model->supplier_discount == null) {
				$model->supplier_discount = 0;
			}
			$model->save();
			$product_bill = $model->uploadPicture('bill_image', 'product_bill');
			if($model->save()) {
				$admins = User::find()->where(['role_id' => $model::ROLE_ADMIN])->all();
				if($admins != null) {
					if($model->status == $model::RECEIPTED) {
						foreach($admins as $admin) {
							$noti          = new Notification();
							$noti->user_id = $admin->id;
							$noti->content = $this->user->username . ' đã thêm sản phẩm ' . $model->name . ' vào kho thành công vào lúc ' . date('H:i:s d-m-Y');
							//								$noti->url= Url::to(['/product-history/update','id'=>$history->id);
							if($noti->save()) {
								$noti->updateAttributes([
									'url' => Url::to([
										'/product-history/update',
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
				$model->updateAttributes(['old_value' => $model->product->in_stock]);
				$model->updateAttributes(['new_value' => $model->product->in_stock + $model->quantity]);
				if($model->status = $model::RECEIPTED) {
					$model->product->updateAttributes(['in_stock' => $model->new_value]);
				}
				if($product_bill !== false) {
					$path = $model->getPictureFile('bill_image');
					$product_bill->saveAs($path);
				}
				return $this->redirect([
					'index',
				]);
			} else {
				echo '<pre>';
				print_r($model->errors);
				die;
			}
		} else {
			return $this->render('create', [
				'model'      => $model,
				'product_id' => $product_id,
			]);
		}
	}

	/**
	 * Updates an existing ProductHistory model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionUpdate($id) {
		if(Yii::$app->request->get('noti')) {
			$noti = Notification::findOne(Yii::$app->request->get('noti'));
			if($noti) {
				$noti->updateAttributes(['status' => $noti::SEEN]);
			}
		}
		$model   = $this->findModel($id);
		$oldBill = $model->bill_image;
		if($model->load(Yii::$app->request->post())) {
			$admins = User::find()->where(['role_id' => $model::ROLE_ADMIN])->all();
			if($admins != null) {
				if($model->getOldAttribute('status') != $model->status && $model->status == $model::RECEIPTED) {
					foreach($admins as $admin) {
						$noti          = new Notification();
						$noti->user_id = $admin->id;
						$noti->content = $this->user->username . ' đã thêm sản phẩm ' . $model->name . ' vào kho thành công vào lúc ' . date('H:i:s d-m-Y');
						//								$noti->url= Url::to(['/product-history/update','id'=>$history->id);
						if($noti->save()) {
							$noti->updateAttributes([
								'url' => Url::to([
									'/product-history/update',
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
			$model->save();
			$product_bill = $model->uploadPicture('bill_image', 'product_bill');
			if($model->supplier_discount == null) {
				$model->supplier_discount = 0;
			}
			if($model->save()) {
				if($product_bill == false) {
					$model->bill_image = $oldBill;
				}
				if($product_bill !== false) {
					$path = $model->getPictureFile('bill_image');
					$product_bill->saveAs($path);
				}
			}
			return $this->redirect(['index']);
		} else {
			return $this->render('update', [
				'model'      => $model,
				'product_id' => $id,
			]);
		}
	}

	/**
	 * Deletes an existing ProductHistory model.
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
	 * Finds the ProductHistory model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return ProductHistory the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if(($model = ProductHistory::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
