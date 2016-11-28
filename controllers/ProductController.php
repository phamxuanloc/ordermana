<?php
namespace app\controllers;

use app\components\Controller;
use app\models\Product;
use app\models\search\ProductSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

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
		];
	}

	/**
	 * Lists all Product models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel  = new ProductSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('index', [
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
			if($model->save()) {
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
		$oldBill  = $model->bill_image;
		if($model->load(Yii::$app->request->post()) && $model->save()) {
			$img      = $model->uploadPicture('image', 'product_img');
			$bill_img = $model->uploadPicture('bill_image', 'bill_img');
			if($img == false) {
				$model->image = $oldImage;
			}
			if($bill_img == false) {
				$model->bill_image = $oldBill;
			}
			if($model->save()) {
				if($img !== false) {
					$path = $model->getPictureFile('image');
					$img->saveAs($path);
				}
				if($bill_img !== false) {
					$path = $model->getPictureFile('bill_image');
					$bill_img->saveAs($path);
				}
				return $this->redirect(['index']);
			}
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
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
