<?php
namespace app\controllers;

use app\components\Controller;
use app\models\Customer;
use app\models\Notification;
use app\models\search\CustomerSearch;
use app\models\UploadExcel;
use app\models\User;
use navatech\role\filters\RoleFilter;
use Yii;
use yii\base\Exception;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\helpers\json;

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
		$searchModel   = new CustomerSearch();
		$quantity_item = $searchModel->searchData(Yii::$app->request->queryParams, 'item');
		$quantity      = $searchModel->searchData(Yii::$app->request->queryParams, 'quantity');
		$file          = new UploadExcel();
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
				if($rowData[0][3] != null) {
					$customer_update = Customer::findOne(['phone' => '' . $rowData[0][3]]);
				} elseif($rowData[0][6] != null) {
					$customer_update = Customer::findOne(['link_fb' => '' . $rowData[0][6]]);
				} else {
					$customer_update = false;
				}
				if($customer_update != false) {
					$customer_update->updateAttributes([
						'name'     => $rowData[0][2],
						'birthday' => date('Y-m-d', \PHPExcel_Shared_Date::ExcelToPHP($rowData[0][4])),
						'email'    => $rowData[0][5],
						'link_fb'  => $rowData[0][6],
						'source'   => $rowData[0][7],
						'city_id'  => $rowData[0][9],
						'product'  => '' . $rowData[0][10],
						'note'     => $rowData[0][13],
						'phone'    => '' . $rowData[0][3],
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
					$customer->product   = '' . $rowData[0][10];
					$customer->note      = $rowData[0][13];
					$customer->parent_id = Yii::$app->user->id;
					$customer->user_id   = Yii::$app->user->id;
					if(!$customer->save()) {
						//													echo '<pre>';
						//													print_r($customer->errors);
						//													die;
					};
				}
			}
		}
		if(isset($_POST['hasEditable'])) {
			// use Yii's response format to encode output as JSON
			//			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			$model = $this->findModel($_POST['editableKey']);
			// read your posted model attributes
			// read or convert your posted information
			if(isset($_POST['Customer'][$_POST['editableIndex']]['name'])) {
				$model->updateAttributes(['name' => $_POST['Customer'][$_POST['editableIndex']]['name']]);
				$model->updateAttributes(['update_user' => $model->user->username]);
			}
			if(isset($_POST['Customer'][$_POST['editableIndex']]['city_id'])) {
				$model->updateAttributes(['city_id' => $_POST['Customer'][$_POST['editableIndex']]['city_id']]);
				$model->updateAttributes(['update_user' => $model->user->username]);
			}
			if(isset($_POST['Customer'][$_POST['editableIndex']]['phone'])) {
				$model->updateAttributes(['phone' => $_POST['Customer'][$_POST['editableIndex']]['phone']]);
				$model->updateAttributes(['update_user' => $model->user->username]);
			}
			// return JSON encoded output in the below format
			// alternatively you can return a validation error
			return true;
		}
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('index', [
			'searchModel'   => $searchModel,
			'dataProvider'  => $dataProvider,
			'file'          => $file,
			'quantity_item' => $quantity_item,
			'quantity'      => $quantity,
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
		$children       = $model->getTotalChildren(Yii::$app->user->id);
		$total_children = ArrayHelper::merge([Yii::$app->user->id => Yii::$app->user->identity->username], ArrayHelper::map(User::find()->where([
			'IN',
			'id',
			$children,
		])->all(), 'id', 'username'));
		if($model->load(Yii::$app->request->post())) {
			if($model->phone != null) {
				$check = Customer::findOne(['phone' => $model->phone]);
			} elseif($model->link_fb != null) {
				$check = Customer::findOne(['phone' => $model->link_fb]);
			} else {
				$check = false;
			}
			if($check == false) {
				if($model->save()) {
					$img = $model->uploadPicture('avatar', 'image');
					if($model->save()) {
						if($img !== false) {
							$path = $model->getPictureFile('avatar');
							$img->saveAs($path);
						}
					}
					$model->updateAttributes(['user_id' => Yii::$app->user->id]);
					return $this->redirect(['index']);
				}
			} else {
				Yii::$app->session->setFlash('danger', 'Số điện thoại hoặc link fb không được trùng');
				return $this->refresh();
			}
		}
		return $this->render('create', [
			'model'          => $model,
			'total_children' => $total_children,
		]);
	}

	public function actionMove() {
		$model    = new Customer();
		$children = $model->getTotalChildren(Yii::$app->user->id, [], null, 'username');
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
				$customer->updateAttributes(['update_user' => $model->user->username]);
				$admins = User::find()->where(['role_id' => $model::ROLE_ADMIN])->all();
				if($admins != null) {
					foreach($admins as $admin) {
						$noti          = new Notification();
						$noti->user_id = $admin->id;
						$noti->content = $model->user->username . ' đã chuyển khách hàng thành công vào lúc ' . date('H:i:s d-m-Y');
						//								$noti->url= Url::to(['/product-history/update','id'=>$history->id);
						if($noti->save()) {
							$noti->updateAttributes([
								'url' => Url::to([
									'/customer/update',
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
				$noti          = new Notification();
				$noti->user_id = $model->parent_id;
				$noti->content = $model->user->username . ' đã chuyển 1 khách hàng cho bạn vào lúc ' . date('d-m-Y H:i:s');
				//								$noti->url= Url::to(['/product-history/update','id'=>$history->id);
				if($noti->save()) {
					$noti->updateAttributes([
						'url' => Url::to([
							'/customer/update',
							'id'   => $model->id,
							'noti' => $noti->id,
						]),
					]);
				} else {
					//							echo '<pre>';
					//							print_r($noti->errors);
					//							die;
				}
				return $this->redirect(['index']);
			} else {
				$customer->updateAttributes(['parent_id' => $model->parent_id]);
				$customer->updateAttributes(['is_move' => 1]);
				$customer->updateAttributes(['update_user' => $model->user->username]);
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
		if(Yii::$app->request->get('noti')) {
			$noti = Notification::findOne(Yii::$app->request->get('noti'));
			if($noti) {
				$noti->updateAttributes(['status' => $noti::SEEN]);
			}
		}
		$model    = $this->findModel($id);
		$oldImage = $model->avatar;
		if($model->load(Yii::$app->request->post())) {
			if($model->getOldAttribute('is_call') == 0 && $model->is_call == 1) {
				if($this->user->role_id == $model::ROLE_CARE) {
					$model->call_by = $this->user->username;
				}
			}
			if($model->save()) {
				$img = $model->uploadPicture('avatar', 'image');
				if($img == false) {
					$model->avatar = $oldImage;
				}
				if($model->save()) {
					if($img !== false) {
						$path = $model->getPictureFile('avatar');
						$img->saveAs($path);
					}
				}
				$model->updateAttributes(['update_user' => $model->user->username]);
				return $this->redirect([
					'index',
				]);
			}
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
