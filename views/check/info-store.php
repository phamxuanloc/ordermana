<?php
use app\assets\LoginAsset;
use kartik\file\FileInput;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use navatech\roxymce\widgets\RoxyMceWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\User $model */
Yii::$app->layout = false;
\app\assets\StoreAsset::register($this)
?>
<?php $this->beginPage() ?>
<?php
$this->title                   = 'Tra cứu Đại diện, đại lý';
$this->params['breadcrumbs'][] = $this->title; ?>
	<!DOCTYPE html>
	<html lang="en">
	<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
	<head>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
	</head>
	<!-- END HEAD -->

	<body class="login">
	<?php $this->beginBody() ?>
	<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
	<div class="menu-toggler sidebar-toggler">
	</div>
	<!-- END SIDEBAR TOGGLER BUTTON -->
	<!-- BEGIN LOGO -->
	<div class="container">
		<div class="text-center">
			<ul class="nav-inline">
				<li><a href="#">Trang chủ</a></li>
				<li><a href="#">Giới thiệu</a></li>
			</ul>
			<div class="logo" style="text-align: center; margin-bottom: 15px; display: inline-block">
				<a href="<?= \yii\helpers\Url::home() ?>">
					<img style="" src="<?= Url::base() ?>/logo.png" alt="logo" class="logo-default"/>
				</a>
			</div>
			<ul class="nav-inline">
				<li><a href="#">Sản phẩm</a></li>
				<li><a href="#">Tin tức</a></li>
			</ul>
		</div>
		<div class="text-center col-sm-12">
			<?php echo Html::img(Url::base() . '/uploads/store/gioi-thieu.png', ['style' => 'width:100%;']) ?>
		</div>
		<!-- END SIDEBAR TOGGLER BUTTON -->
		<!-- BEGIN LOGO -->
		<!-- END LOGO -->
		<!-- BEGIN LOGIN -->
		<div class="content col-sm-12">
			<!-- BEGIN LOGIN FORM -->

			<div class="col-sm-6 border-store">
				<div class="user-avatar text-center clearfix margin-store col-sm-12">
					<?= Html::img($model->getPictureUrl('avatar'), ['class' => 'file-preview-image img-circle img-responsive col-sm-8 col-sm-offset-2']) ?>
				</div>
				<div class="col-sm-5 col-sm-offset-1 margin-store">
					<span style="font-weight: bold">ID:</span><?= $model->code ?></div>
				<div class="col-sm-5 col-sm-offset-1 margin-store">
					<span style="font-weight: bold">SĐT:</span><?= $model->phone ?></div>
				<div class="col-sm-11 col-sm-offset-1 margin-store">
					<a><img src="<?= Url::base() ?>/uploads/store/facebook.png"></a><?= $model->facebook_link ?>
				</div>
				<div class="col-sm-11 col-sm-offset-1 row margin-store">
					<div class="col-sm-6 row">
						<a><img src="<?= Url::base() ?>/uploads/store/viber.png"></a><?= $model->viber ?>
					</div>
					<div class="col-sm-6 row">
						<a><img src="<?= Url::base() ?>/uploads/store/zalo.png"></a><?= $model->zalo ?>
					</div>
				</div>
				<div class="col-sm-5 margin-store col-sm-offset-1">
					<span style="font-weight: bold">Vai trò:</span><?= $model->role->name ?></div>
				<div class="col-sm-5 margin-store col-sm-offset-1">
					<span style="font-weight: bold">Tỉnh:</span><?= $model->cities->name ?></div>
				<div class="col-sm-11 margin-store col-sm-offset-1">
					<span style="font-weight: bold">Ngày tham gia:</span><?= date('d-m-Y', $model->created_at) ?></div>
				<div class="col-sm-11 margin-store col-sm-offset-1">
					<span style="font-weight: bold">Địa chỉ hiện tại:</span><?= $model->address ?>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="user-store text-center clearfix">

					<!--								Html::img(Yii::$app->urlManager->baseUrl . '/uploads/no_image_thumb.gif', ['class' => 'file-preview-image']),-->
					<?php echo Html::img($model->getPictureUrl('store_image'), [
						'class' => 'file-preview-image img-rounded img-responsive col-sm-8 col-sm-offset-2',
						'style' => 'max-height: 246px;',
					])
					?>
				</div>
				<div class="col-sm-12 margin-store text-center"><span class="">Ảnh cửa hàng</span></div>
				<div class="col-sm-12 margin-store">
					<span style="font-weight: bold">Địa chỉ cửa hàng:</span><?= $model->store_address ?></div>
				<div class="col-sm-12 margin-store"><?php echo $model->store_description ?></div>
				<!-- END FORGOT PASSWORD FORM -->
				<!-- BEGIN REGISTRATION FORM -->
				<!-- END REGISTRATION FORM -->
			</div>

		</div>
		<!--	<div class="copyright">-->
		<!--		2016 © Myphamlinhnham.vn-->
		<!--	</div>-->
	</div>
	<div>
		<?php echo Html::img(Url::base() . '/uploads/store/footer.png', ['class' => 'footer-store']) ?>
	</div>
	<?php $this->endBody() ?>
	</body>
	<script>
		//	jQuery(document).ready(function() {
		//		Metronic.init(); // init metronic core components
		//		Layout.init(); // init current layout
		//		Login.init();
		//		Demo.init();
		//	});
	</script>
	</html>
<?php $this->endPage() ?>