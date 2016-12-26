<?php
namespace app\controllers;

use app\components\Controller;
use app\models\Customer;
use app\models\search\CustomerSearch;
use app\models\UploadExcel;
use app\models\User;
use navatech\role\filters\RoleFilter;
use Yii;
use yii\base\Exception;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller {

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
				'name'    => 'Trang quản lý khách lẻ',
				//NOT REQUIRED, only if you want to translate
				'actions' => [
					//without translate
					'index'  => 'Danh sách khách ',
					'update' => 'Cập nhật khách ',
					'delete' => 'Xóa khách ',
					'move'   => 'Chuyển khách'
					//with translated, which will display on role _form
				],
			],
		];
	}

	/**
	 * Lists all Customer models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new CustomerSearch();
		$file        = new UploadExcel();
		if(isset($_POST['UploadExcel']['excel'])) {
			$file->excel = UploadedFile::getInstance($file, 'excel');
			$input       = $file->uploadExcel();
			try {
				$inputFileType  = \PHPExcel_IOFactory::identify($input);
				$objectReader   = \PHPExcel_IOFactory::createReader($inputFileType);
				$objectPHPExcel = $objectReader->load($input);
			} catch(Exception $e) {
				die('Error');
			}
			$sheet         = $objectPHPExcel->getSheet(0);
			$highestRow    = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();
			Yii::$app->session->setFlash('success', 'Upload thành công');
			for($row = 8; $row <= $highestRow; $row ++) {
				$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, false, false);
				if($rowData[0][2] != null && $rowData[0][3] != null) {
					if($customer = Customer::findOne(['phone' => '' . $rowData[0][3]])) {
						$customer->updateAttributes([
							'name'     => $rowData[0][2],
							'birthday' => date('Y-m-d', \PHPExcel_Shared_Date::ExcelToPHP($rowData[0][4])),
							'email'    => $rowData[0][5],
							'link_fb'  => $rowData[0][6],
							'source'   => $rowData[0][7],
							'city_id'  => $rowData[0][9],
							'product'  => $rowData[0][10],
							'note'     => $rowData[0][13],
						]);
					} else {
						$customer            = new Customer();
						$customer->name      = $rowData[0][2];
						$customer->phone     = '' . $rowData[0][3];
						$customer->birthday  = date('Y-m-d', \PHPExcel_Shared_Date::ExcelToPHP($rowData[0][4]));
						$customer->email     = $rowData[0][5];
						$customer->link_fb   = $rowData[0][6];
						$customer->source    = $rowData[0][7];
						$customer->id_number = '' . $rowData[0][8];
						$customer->city_id   = $rowData[0][9];
						$customer->product   = $rowData[0][10];
						$customer->note      = $rowData[0][13];
						$customer->parent_id = Yii::$app->user->id;
						$customer->user_id   = Yii::$app->user->id;
						if(!$customer->save()) {
//							echo '<pre>';
//							print_r($customer->errors);
//							die;
						};
					}
				}
			}
		}
		if(isset($_POST['hasEditable'])) {
			// use Yii's response format to encode output as JSON
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			$model                       = $this->findModel($_POST['editableKey']);
			// read your posted model attributes
			// read or convert your posted information
			$model->updateAttributes(['name' => $_POST['Customer'][$_POST['editableIndex']]['name']]);
			// return JSON encoded output in the below format
			// alternatively you can return a validation error
			// return ['output'=>'', 'message'=>'Validation error'];
		}
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
			'file'         => $file,
		]);
	}

	/**
	 * Displays a single Customer model.
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
	 * Creates a new Customer model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model          = new Customer();
//		$children       = $model->getTotalChildren(Yii::$app->user->id);
//		$total_children = ArrayHelper::merge([Yii::$app->user->id => Yii::$app->user->identity->username], ArrayHelper::map(User::find()->where([
//			'IN',
//			'id',
//			$children,
//		])->all(), 'id', 'username'));
		$total_children=['admin'];
		if($model->load(Yii::$app->request->post()) && $model->save()) {
			$model->updateAttributes(['user_id' => Yii::$app->user->id]);
			return $this->redirect(['index']);
		} else {
			return $this->render('create', [
				'model'          => $model,
				'total_children' => $total_children,
			]);
		}
	}

	public function actionMove() {
		$model    = new Customer();
		$children = $model->getTotalChildren(Yii::$app->user->id);
		if($model->load(Yii::$app->request->post())) {
			$customer = Customer::findOne($model->list_customer);
			if($customer->is_move >= 2) {
				Yii::$app->session->setFlash('danger', 'Chỉ được chuyển tối đa 2 lần');
				return $this->render('move', [
					'model'    => $model,
					'children' => $children,
				]);
			} elseif($customer->is_move == 1) {
				$customer->updateAttributes(['last_parent_id' => $customer->parent_id]);
				$customer->updateAttributes(['parent_id' => $model->parent_id]);
				return $this->redirect(['index']);
			} else {
				$customer->updateAttributes(['parent_id' => $model->parent_id]);
				$customer->updateAttributes(['is_move' => 1]);
				return $this->redirect(['index']);
			}
		}
		return $this->render('move', [
			'model'    => $model,
			'children' => $children,
		]);
	}

	/**
	 * Updates an existing Customer model.
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
				'index',
			]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Customer model.
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
	 * Finds the Customer model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Customer the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if(($model = Customer::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
