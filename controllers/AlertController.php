<?php
namespace app\controllers;

use navatech\role\filters\RoleFilter;
use Yii;
use app\models\Alert;
use app\models\search\AlertSearch;
use app\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AlertController implements the CRUD actions for Alert model.
 */
class AlertController extends Controller {

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
				'name'    => 'Chức năng thông báo',
				//NOT REQUIRED, only if you want to translate
				'actions' => [
					//without translate
					'index'  => 'Danh sách ',
					'create' => 'Tạo thông báo',
					'update' => 'Cập nhật thông báo',
					//with translated, which will display on role _form
				],
			],
		];
	}

	/**
	 * Lists all Alert models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel  = new AlertSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Alert model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	//    public function actionView($id)
	//    {
	//        return $this->render('view', [
	//            'model' => $this->findModel($id),
	//        ]);
	//    }
	/**
	 * Creates a new Alert model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Alert();
		if($model->load(Yii::$app->request->post())) {
			$role_array = $model->role_id;
			foreach($role_array as $role) {
				$alert          = new Alert();
				$alert->role_id = $role;
				$alert->content = $model->content;
				$alert->save();
			}
			return $this->redirect(['index']);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Alert model.
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
	 * Deletes an existing Alert model.
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
	 * Finds the Alert model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Alert the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if(($model = Alert::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
