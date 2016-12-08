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
use app\models\User;
use dektrium\user\controllers\AdminController as BaseAdminController;
use navatech\role\filters\RoleFilter;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

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
					'index'        => 'Danh sách ',
					'update'       => 'Cập nhật ',
					'create'       => 'Thêm mới người dùng',
					'create-admin' => 'Tạo admin',
					'create-pre'   => 'Tạo đại diện',
					'create-big'   => 'Tạo đại lý bán buôn',
					'create-age'   => 'Tạo đại lý bán lẻ',
					'create-dis'   => 'Tạo điểm phân phối',
					'tree'         => 'Xem cây hệ thống',
					'delete'       => 'Xóa người dùng',
					'block'        => 'Khóa người dùng'
					//with translated, which will display on role _form
				],
			],
		];
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
		if($id != $model->user->id) {
			if(!ArrayHelper::isIn($user->id, $model->getTotalChildren($model->user->id))) {
				return $this->goHome();
			}
		}
		$event = $this->getUserEvent($user);
		$this->performAjaxValidation($user);
		$this->trigger(self::EVENT_BEFORE_UPDATE, $event);
		if($user->load(\Yii::$app->request->post()) && $user->save()) {
			\Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Account details have been updated'));
			$this->trigger(self::EVENT_AFTER_UPDATE, $event);
			return $this->refresh();
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
			$user->role_id = Model::ROLE_ADMIN;
			$user->confirmed_at = 1456114858;

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
			$user->role_id = $role;
			$user->confirmed_at = 1456114858;

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
			$user->role_id = $role;
			$user->confirmed_at = 1456114858;
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
			$user->role_id = $role;
			$user->confirmed_at = 1456114858;

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
			$user->role_id = $role;
			$user->confirmed_at = 1456114858;

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

	public function actionTree() {
		$model = new  Model();
		//		echo '<pre>';
		//		print_r($model::getUserTree());
		//		die;
		return $this->render('tree', ['model' => $model]);
	}
}