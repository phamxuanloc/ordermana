<?php
/**
 * Created by Navatech.
 * @project ordermana
 * @author  LocPX
 * @email   loc.xuanphama1t1[at]gmail.com
 * @date    11/29/2016
 * @time    11:13 PM
 */
namespace app\controllers;

use app\components\Model;
use app\models\ChangeForm;
use app\models\OrderCustomer;
use app\models\Product;
use app\models\ProductHistory;
use app\models\search\UserSearch;
use app\models\User;
use DateInterval;
use DateTime;
use dektrium\user\controllers\AdminController as BaseAdminController;
use navatech\role\filters\RoleFilter;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class AdminController extends BaseAdminController {

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
				'name'    => 'Trang Admin',
				//NOT REQUIRED, only if you want to translate
				'actions' => [
					//without translate
					'index'         => 'Danh sách ',
					'update'        => 'Cập nhật ',
					'create'        => 'Thêm mới người dùng',
					'create-admin'  => 'Tạo admin',
					'create-pre'    => 'Tạo đại diện',
					'create-big'    => 'Tạo đại lý bán buôn',
					'create-age'    => 'Tạo đại lý bán lẻ',
					'create-dis'    => 'Tạo điểm phân phối',
					'create-care'   => 'Tạo tài khoản cs khách hàng',
					'care'          => 'Ds tài khoản cs khách hàng',
					'tree'          => 'Xem cây hệ thống',
					'delete'        => 'Xóa người dùng',
					'block'         => 'Khóa người dùng',
					'change-parent' => 'Di chuyển hệ thống'
					//with translated, which will display on role _form
				],
			],
		];
	}

	public function beforeAction($action) {
		if(Yii::$app->user->isGuest && Yii::$app->controller->action->id !== 'login') {
			$this->redirect(Url::to(['/user/security/login']));
			return false;
		} else {
			return parent::beforeAction($action);
		}
	}

	public function actionIndex() {
		// TODO: Change the auto generated stub
		return parent::actionIndex();
	}

	public function actionBlock($id) {
		// TODO: Change the auto generated stub
		return parent::actionBlock($id);
	}

	public function actionConfirm($id) {
		// TODO: Change the auto generated stub
		return parent::actionConfirm($id);
	}

	public function actionInfo($id) {
		// TODO: Change the auto generated stub
		return parent::actionInfo($id);
	}

	public function actionUpdate($id) {
		Url::remember('', 'actions-redirect');
		$user           = $this->findModel($id);
		$role           = $user->role_id;
		$model          = new Model();
		$user->scenario = 'update';
		if(Yii::$app->user->identity->role_id != $model::ROLE_ADMIN) {
			if($id != $model->user->id) {
				if(!ArrayHelper::isIn($user->id, $model->getTotalChildren($model->user->id))) {
					return $this->goHome();
				}
			}
		}
		$event = $this->getUserEvent($user);
		$this->performAjaxValidation($user);
		$this->trigger(self::EVENT_BEFORE_UPDATE, $event);
		$oldImage = $user->avatar;
		if($user->load(\Yii::$app->request->post()) && $user->save()) {
			$img = $user->uploadPicture('avatar', 'image');
			if($img == false) {
				$user->avatar = $oldImage;
			}
			if($user->save()) {
				if($img !== false) {
					$path = $user->getPictureFile('avatar');
					$img->saveAs($path);
				}
			}
			\Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Account details have been updated'));
			$this->trigger(self::EVENT_AFTER_UPDATE, $event);
			return $this->redirect(['index']);
		}
		return $this->render('_account', [
			'user' => $user,
			'role' => $role,
		]);
	}

	public function actionAssignments($id) {
		// TODO: Change the auto generated stub
		return parent::actionAssignments($id);
	}

	public function actionDelete($id) {
		// TODO: Change the auto generated stub
		return parent::actionDelete($id);
	}

	public function actionUpdateProfile($id) {
		// TODO: Change the auto generated stub
		return parent::actionUpdateProfile($id);
	}

	public function actionCreate() {
		/** @var User $user */
		return $this->render('create_role');
	}

	public function actionCreateAdmin() {
		$user  = \Yii::createObject([
			'class'    => User::className(),
			'scenario' => 'admin_create',
		]);
		$role  = Model::ROLE_ADMIN;
		$event = $this->getUserEvent($user);
		$this->performAjaxValidation($user);
		$this->trigger(self::EVENT_BEFORE_CREATE, $event);
		if($user->load(\Yii::$app->request->post())) {
			$user->role_id      = Model::ROLE_ADMIN;
			$user->confirmed_at = 1456114858;
			if($user->create()) {
				$img = $user->uploadPicture('avatar', 'image');
				if($user->save()) {
					if($img !== false) {
						$path = $user->getPictureFile('avatar');
						$img->saveAs($path);
					}
				}
				\Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'User has been created'));
				$this->trigger(self::EVENT_AFTER_CREATE, $event);
				if(\Yii::$app->user->identity->role_id != Model::ROLE_ADMIN) {
					return $this->redirect([
						'tree',
					]);
				} else {
					return $this->redirect([
						'index',
					]);
				}
			} else {
				echo '<pre>';
				print_r($user->errors);
				die;
			}
		}
		return $this->render('create', [
			'user' => $user,
			'role' => $role,
		]);
	}

	public function actionCreatePre() {
		$user  = \Yii::createObject([
			'class'    => User::className(),
			'scenario' => 'create',
		]);
		$role  = Model::ROLE_PRE;
		$event = $this->getUserEvent($user);
		$this->performAjaxValidation($user);
		$this->trigger(self::EVENT_BEFORE_CREATE, $event);
		if($user->load(\Yii::$app->request->post())) {
			$user->role_id      = $role;
			$user->confirmed_at = 1456114858;
			if($user->create()) {
				$img = $user->uploadPicture('avatar', 'image');
				if($user->save()) {
					if($img !== false) {
						$path = $user->getPictureFile('avatar');
						$img->saveAs($path);
					}
				}
				\Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'User has been created'));
				$this->trigger(self::EVENT_AFTER_CREATE, $event);
				if(\Yii::$app->user->identity->role_id != Model::ROLE_ADMIN) {
					return $this->redirect([
						'tree',
					]);
				} else {
					return $this->redirect([
						'index',
					]);
				}
			} else {
				echo '<pre>';
				print_r($user->errors);
				die;
			}
		}
		return $this->render('create', [
			'user' => $user,
			'role' => $role,
		]);
	}

	public function actionCreateBig() {
		$user  = \Yii::createObject([
			'class'    => User::className(),
			'scenario' => 'create',
		]);
		$role  = Model::ROLE_BIGA;
		$event = $this->getUserEvent($user);
		$this->performAjaxValidation($user);
		$this->trigger(self::EVENT_BEFORE_CREATE, $event);
		if($user->load(\Yii::$app->request->post())) {
			$user->role_id      = $role;
			$user->confirmed_at = 1456114858;
			$img                = $user->uploadPicture('avatar', 'image');
			if($user->save()) {
				if($img !== false) {
					$path = $user->getPictureFile('avatar');
					$img->saveAs($path);
				}
			}
			if($user->create()) {
				\Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'User has been created'));
				$this->trigger(self::EVENT_AFTER_CREATE, $event);
				if(\Yii::$app->user->identity->role_id != Model::ROLE_ADMIN) {
					return $this->redirect([
						'tree',
					]);
				} else {
					return $this->redirect([
						'index',
					]);
				}
			} else {
				echo '<pre>';
				print_r($user->errors);
				die;
			}
		}
		return $this->render('create', [
			'user' => $user,
			'role' => $role,
		]);
	}

	public function actionCreateAge() {
		$user  = \Yii::createObject([
			'class'    => User::className(),
			'scenario' => 'create',
		]);
		$role  = Model::ROLE_A;
		$event = $this->getUserEvent($user);
		$this->performAjaxValidation($user);
		$this->trigger(self::EVENT_BEFORE_CREATE, $event);
		if($user->load(\Yii::$app->request->post())) {
			$user->role_id      = $role;
			$user->confirmed_at = 1456114858;
			if($user->create()) {
				$img = $user->uploadPicture('avatar', 'image');
				if($user->save()) {
					if($img !== false) {
						$path = $user->getPictureFile('avatar');
						$img->saveAs($path);
					}
				}
				\Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'User has been created'));
				$this->trigger(self::EVENT_AFTER_CREATE, $event);
				if(\Yii::$app->user->identity->role_id != Model::ROLE_ADMIN) {
					return $this->redirect([
						'tree',
					]);
				} else {
					return $this->redirect([
						'index',
					]);
				}
			} else {
				echo '<pre>';
				print_r($user->errors);
				die;
			}
		}
		return $this->render('create', [
			'user' => $user,
			'role' => $role,
		]);
	}

	public function actionCreateDis() {
		$user  = \Yii::createObject([
			'class'    => User::className(),
			'scenario' => 'create',
		]);
		$role  = Model::ROLE_D;
		$event = $this->getUserEvent($user);
		$this->performAjaxValidation($user);
		$this->trigger(self::EVENT_BEFORE_CREATE, $event);
		if($user->load(\Yii::$app->request->post())) {
			$user->role_id      = $role;
			$user->confirmed_at = 1456114858;
			if($user->create()) {
				$img = $user->uploadPicture('avatar', 'image');
				if($user->save()) {
					if($img !== false) {
						$path = $user->getPictureFile('avatar');
						$img->saveAs($path);
					}
				}
				\Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'User has been created'));
				$this->trigger(self::EVENT_AFTER_CREATE, $event);
				if(\Yii::$app->user->identity->role_id != Model::ROLE_ADMIN) {
					return $this->redirect([
						'tree',
					]);
				} else {
					return $this->redirect([
						'index',
					]);
				}
			} else {
				echo '<pre>';
				print_r($user->errors);
				die;
			}
		}
		return $this->render('create', [
			'user' => $user,
			'role' => $role,
		]);
	}

	public function actionCreateCare() {
		$user  = \Yii::createObject([
			'class'    => User::className(),
			'scenario' => 'create',
		]);
		$role  = Model::ROLE_CARE;
		$event = $this->getUserEvent($user);
		$this->performAjaxValidation($user);
		$this->trigger(self::EVENT_BEFORE_CREATE, $event);
		if($user->load(\Yii::$app->request->post())) {
			$user->role_id      = $role;
			$user->confirmed_at = 1456114858;
			if($user->create()) {
				$img = $user->uploadPicture('avatar', 'image');
				if($user->save()) {
					if($img !== false) {
						$path = $user->getPictureFile('avatar');
						$img->saveAs($path);
					}
				}
				\Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'User has been created'));
				$this->trigger(self::EVENT_AFTER_CREATE, $event);
				if(\Yii::$app->user->identity->role_id != Model::ROLE_ADMIN) {
					return $this->redirect([
						'tree',
					]);
				} else {
					return $this->redirect([
						'care',
					]);
				}
			} else {
				echo '<pre>';
				print_r($user->errors);
				die;
			}
		}
		return $this->render('create', [
			'user' => $user,
			'role' => $role,
		]);
	}

	public function actionCare() {
		$searchModel  = \Yii::createObject(UserSearch::className());
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams, true);
		return $this->render('care', ['dataProvider' => $dataProvider]);
	}

	public function actionTree() {
		$model = new  Model();
		//		$children = $model->getTotalChildren(Yii::$app->user->id);
		$previous_month   = $model->getPreviousMonth(date('Y-m'));
		$p_previous_month = $model->getPreviousMonth($previous_month);
		$p_previous_month = new DateTime($p_previous_month);
		$p_previous_month = $p_previous_month->format('m');
		$previous_month   = new DateTime($previous_month);
		$previous_month   = $previous_month->format('m');
		if(Yii::$app->user->identity->role_id != $model::ROLE_ADMIN) {
			$child   = $model->getTotalChildren(Yii::$app->user->id);
			$adm_num = 0;
			$pre_num = count(User::find()->where([
				'IN',
				'id',
				$child,
			])->andWhere(['role_id' => $model::ROLE_PRE])->all());
			$big_num = count(User::find()->where([
				'IN',
				'id',
				$child,
			])->andWhere(['role_id' => $model::ROLE_BIGA])->all());
			$age_num = count(User::find()->where([
				'IN',
				'id',
				$child,
			])->andWhere(['role_id' => $model::ROLE_A])->all());;
			$dis_num = count(User::find()->where([
				'IN',
				'id',
				$child,
			])->andWhere(['role_id' => $model::ROLE_D])->all());;
		} else {
			$adm_num = User::find()->where(['role_id' => $model::ROLE_ADMIN])->count();
			$pre_num = User::find()->where(['role_id' => $model::ROLE_PRE])->count();
			$big_num = User::find()->where(['role_id' => $model::ROLE_BIGA])->count();
			$age_num = User::find()->where(['role_id' => $model::ROLE_A])->count();
			$dis_num = User::find()->where(['role_id' => $model::ROLE_D])->count();
		}
		//		echo $pre_num;die;
		return $this->render('tree', [
			'previous_month'   => $previous_month,
			'p_previous_month' => $p_previous_month,
			'model'            => $model,
			'adm_num'          => $adm_num,
			'pre_num'          => $pre_num,
			'big_num'          => $big_num,
			'age_num'          => $age_num,
			'dis_num'          => $dis_num,
		]);
	}

	public function actionProfile($id) {
		if(isset($_POST['a'])) {
			$oStart = new DateTime(date('Y') . '-' . date('m') . '-1');
			$oEnd   = clone $oStart;
			$oEnd->add(new DateInterval("P1M"));
			$account         = User::findOne($id);
			$model           = new Model();
			$children        = $model->getTotalChildren($id);
			$fb_link         = $account->facebook_link;
			$quantity_stock  = 0;
			$current_stock   = 0;
			$customer_issue  = 0;
			$issue           = 0;
			$customer_system = 0;
			if($account->role_id != Model::ROLE_ADMIN) {
				foreach($account->userStocks as $stock) {
					$quantity_stock += $stock->in_stock;
				};
				foreach($account->orders0 as $receipted) {
					if($receipted->created_date >= $oStart->format('Y-m-d') && $receipted->created_date <= $oEnd->format('Y-m-d')) {
						foreach($receipted->orderItems as $item) {
							$current_stock += $item->quantity;
						}
					}
				}
			} else {
				foreach(Product::find()->all() as $stock) {
					$quantity_stock += $stock->in_stock;
				};
				$pro_history = ProductHistory::find()->where([
					'between',
					'created_date',
					$oStart->format('Y-m-d'),
					$oEnd->format('Y-m-d'),
				])->all();
				foreach($pro_history as $stock) {
					$current_stock += $stock->quantity;
				}
			}
			$previous_month            = $model->getPreviousMonth(date('Y-m'));
			$p_previous_month          = $model->getPreviousMonth($previous_month);
			$customer_issue            = $model->getCustomerAmount($id, date('Y-m'));
			$previous_customer_issue   = $model->getCustomerAmount($id, $previous_month);
			$p_previous_customer_issue = $model->getCustomerAmount($id, $p_previous_month);
			$issue                     = $model->getOrderAmount($id, date(' Y-m'));
			$previous_issue            = $model->getOrderAmount($id, $previous_month);
			$p_previous_issue          = $model->getOrderAmount($id, $p_previous_month);
			$total_amount              = $customer_issue + $issue;
			$previous_total_amount     = $previous_customer_issue + $previous_issue;
			$p_previous_total_amount   = $p_previous_customer_issue + $p_previous_issue;
			$query                     = OrderCustomer::find();
			$query->andFilterWhere([
				'IN',
				'user_id',
				$children,
			]);
			if($query->sum('total_amount') != null) {
				$customer_system = $query->sum('total_amount');
			}
			$change_revenue = $model->getChangeRevenue();
			$value          = [
				'username'                  => $account->username,
				'quantity'                  => $quantity_stock,
				'current_stock'             => $current_stock,
				'issue'                     => $issue,
				'previous_issue'            => $previous_issue,
				'p_previous_issue'          => $p_previous_issue,
				'customer_issue'            => $customer_issue,
				'previous_customer_issue'   => $previous_customer_issue,
				'p_previous_customer_issue' => $p_previous_customer_issue,
				'customer_system'           => $customer_system,
				'change_revenue'            => $change_revenue,
				'fb_link'                   => $fb_link,
				'amount'                    => $total_amount,
				'previous_amount'           => $previous_total_amount,
				'p_previous_amount'         => $p_previous_total_amount,
			];
			return json_encode($value);
		}
	}

	public function actionChangeParent() {
		$model = new ChangeForm();
		if($model->load(Yii::$app->request->post())) {
			if($model->changeParent()) {
				Yii::$app->session->setFlash('success', 'Chuyển thành công');
				return $this->redirect(['/user/admin/tree']);
			} else {
				Yii::$app->session->setFlash('danger', 'Không thành công');
				return $this->refresh();
			}
		}
		return $this->render('change-parent', ['model' => $model]);
	}

	protected function findModel($id) {
		if(($model = User::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}