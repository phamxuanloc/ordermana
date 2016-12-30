<?php
namespace app\controllers;

use app\components\Controller;
use app\components\Model;
use app\models\Alert;
use app\models\ContactForm;
use app\models\Customer;
use app\models\LoginForm;
use app\models\Order;
use app\models\Product;
use app\models\ReportForm;
use DateTime;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

class SiteController extends Controller {

	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'  => ['logout'],
				'rules' => [
					[
						'actions' => ['logout'],
						'allow'   => true,
						'roles'   => ['@'],
					],
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions() {
		return [
			'error'   => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class'           => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex() {
		$model            = new Model();
		$profit_month     = ArrayHelper::merge([
			[
				'Doanh thu tuần này',
				'VNĐ',
				['role' => 'style'],
			],
		], $model->getProfitChart());
		$top_product      = $model->getTopProduct();
		$data             = $model->getPreArray();
		$product_quantity = $model->getProductQuantity();
		$revenue          = $model->getProfit();
		$order            = $model->getTotalOrder();
		$change_revenue   = $model->getChangeRevenue();
		$alert_all        = Alert::find()->where(['role_id' => 0])->orderBy('id DESC')->one();
		if($alert_all != null) {
			Yii::$app->session->setFlash('danger', '<span style="font-weight: bolder; font-size: medium">Thông báo: </span>' . $alert_all->content);
		}
		$alert_role = Alert::find()->where(['role_id' => $this->user->role_id])->orderBy('id DESC')->one();
		if($alert_role != null) {
			Yii::$app->session->setFlash('success', '<span style="font-weight: bolder; font-size: medium">Thông báo: </span>' . $alert_role->content);
		}
		//		$total_order =
		return $this->render('index', [
			'data'             => $data,
			'product_quantity' => $product_quantity,
			'revenue'          => $revenue,
			'order'            => $order,
			'change_revenue'   => $change_revenue,
			'top_product'      => $top_product,
			'profit_month'     => $profit_month,
		]);
	}

	public function actionCheckPoint() {
		if(!Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		$model = new Customer();
		if($model->load(Yii::$app->request->post())) {
			$customer = $model->findOne(['phone' => $model->phone]);
			if($customer != null) {
				Yii::$app->session->setFlash('check', 'Số điểm hiện tại của quý khách là ' . $customer->point);
			} else {
				Yii::$app->session->setFlash('check', 'Số điện thoại không đúng, vui lòng nhập lại');
			}
			return $this->refresh();
		}
		return $this->render('check-point', [
			'model' => $model,
		]);
	}

	/**
	 * Login action.
	 *
	 * @return string
	 */
	public function actionLogin() {
		if(!Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		$model = new LoginForm();
		if($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		}
		return $this->render('login', [
			'model' => $model,
		]);
	}

	/**
	 * Logout action.
	 *
	 * @return string
	 */
	public function actionLogout() {
		Yii::$app->user->logout();
		return $this->goHome();
	}

	/**
	 * Displays contact page.
	 *
	 * @return string
	 */
	public function actionContact() {
		$model = new ContactForm();
		if($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
			Yii::$app->session->setFlash('contactFormSubmitted');
			return $this->refresh();
		}
		return $this->render('contact', [
			'model' => $model,
		]);
	}

	/**
	 * Displays about page.
	 *
	 * @return string
	 */
	public function actionAbout() {
		return $this->render('about');
	}

	public function actionReport() {
		$model        = new ReportForm();
		$queryParams  = Yii::$app->request->queryParams;
		$profit_month = ArrayHelper::merge([
			[
				'Doanh thu',
				'VNĐ',
			],
		], $model->getProfitChart($queryParams));
		//		echo '<pre>';
		//		print_r($profit_month);
		//		die;
		$top_product    = $model->getTopProduct($queryParams);
		$data           = $model->getPreArray($queryParams);
		$order          = $model->getTotalOrder($queryParams);
		$total_children = $model->getTreeInfo($queryParams);
		$total_children = 0;
//		$admin_count    = $model->getTreeInfo($queryParams, Model::ROLE_ADMIN);
//		$pre_count      = $model->getTreeInfo($queryParams, Model::ROLE_PRE);
//		$big_count      = $model->getTreeInfo($queryParams, Model::ROLE_BIGA);
//		$age_count      = $model->getTreeInfo($queryParams, Model::ROLE_A);
//		$dis_count      = $model->getTreeInfo($queryParams, Model::ROLE_D);
		$admin_count    = 0;
		$pre_count      =0;
		$big_count      = 0;
		$age_count      = 0;
		$dis_count      = 0;
//		$customer       = $model->getAllCustomer($queryParams);
		$customer       = 0;
		$revenue        = $model->getProfit($queryParams);
		return $this->render('report', [
			'model'          => $model,
			'top_product'    => $top_product,
			'profit_month'   => $profit_month,
			'data'           => $data,
			'order'          => $order,
			'total_children' => $total_children,
			'admin_count'    => $admin_count,
			'pre_count'      => $pre_count,
			'big_count'      => $big_count,
			'age_count'      => $age_count,
			'dis_count'      => $dis_count,
			'customer'       => $customer,
			'revenue'        => $revenue,
		]);
	}
}
