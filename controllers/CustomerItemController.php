<?php
namespace app\controllers;

use app\components\Controller;
use app\models\CustomerItem;
use app\models\search\CustomerItemSearch;
use navatech\role\filters\RoleFilter;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * CustomerItemController implements the CRUD actions for CustomerItem model.
 */
class CustomerItemController extends Controller {

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
				'name'    => 'Trang sản phẩm khách lẻ',
				//NOT REQUIRED, only if you want to translate
				'actions' => [
					//without translate
					'detail' => 'Danh sách hàng ',
					//with translated, which will display on role _form
				],
			],
		];
	}

	/**
	 * Lists all CustomerItem models.
	 * @return mixed
	 */
	//	public function actionIndex() {
	//		$searchModel  = new CustomerItemSearch();
	//		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	//		return $this->render('index', [
	//			'searchModel'  => $searchModel,
	//			'dataProvider' => $dataProvider,
	//		]);
	//	}
	public function actionDetail($id) {
		$searchModel  = new CustomerItemSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
		return $this->render('index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
			'id'           => $id,
		]);
	}

	/**
	 * Displays a single CustomerItem model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	//	public function actionView($id) {
	//		return $this->render('view', [
	//			'model' => $this->findModel($id),
	//		]);
	//	}
	//
	//	/**
	//	 * Creates a new CustomerItem model.
	//	 * If creation is successful, the browser will be redirected to the 'view' page.
	//	 * @return mixed
	//	 */
	//	public function actionCreate() {
	//		$model = new CustomerItem();
	//		if($model->load(Yii::$app->request->post()) && $model->save()) {
	//			return $this->redirect([
	//				'view',
	//				'id' => $model->id,
	//			]);
	//		} else {
	//			return $this->render('create', [
	//				'model' => $model,
	//			]);
	//		}
	//	}
	/**
	 * Updates an existing CustomerItem model.
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
	 * Deletes an existing CustomerItem model.
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
	 * Finds the CustomerItem model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return CustomerItem the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if(($model = CustomerItem::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
