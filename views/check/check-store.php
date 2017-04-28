<?php
use app\assets\LoginAsset;
use kartik\file\FileInput;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

Yii::$app->layout = false;
LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php
$this->title                   = 'Cổng tra cứu thông tin Đại diện, Đại lý, Đại lý bán lẻ,  Điểm phân phối Mỹ phẩm Linh Nhâm';
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
	<div class="logo">
		<a href="<?= \yii\helpers\Url::home() ?>">
			<img style="" src="<?= Url::base() ?>/logo.png" alt="logo" class="logo-default"/>
		</a>
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
		<?php $form = ActiveForm::begin([
			'id' => 'login-form',
			//			'enableAjaxValidation'   => true,
			//			'enableClientValidation' => false,
			//			'validateOnBlur'         => false,
			//			'validateOnType'         => false,
			//			'validateOnChange'       => false,
		]) ?>
		<h3 class="form-title"> Cổng tra cứu thông tin Đại diện, Đại lý, Đại lý bán lẻ,  Điểm phân phối Mỹ phẩm Linh Nhâm</h3>
		<div class="form-group">
			<?= $form->field($model, 'code', ['labelOptions' => ['class' => 'control-label visible-ie8 visible-ie9']])->textInput([
				'autofocus'   => 'autofocus',
				'class'       => 'form-control form-control-solid placeholder-no-fix',
				'placeholder' => 'Mã cửa hàng',
			]) ?>
		</div>
		<?php if(Yii::$app->session->hasFlash('check')) {
			echo Yii::$app->session->getFlash('check');
		} ?>
		<div class="form-actions">
			<?= Html::submitButton(Yii::t('user', 'Tra cứu'), [
				'class'    => 'btn green uppercase',
				'tabindex' => '3',
			]) ?>
		</div>
		<?php ActiveForm::end(); ?>

		<!-- END FORGOT PASSWORD FORM -->
		<!-- BEGIN REGISTRATION FORM -->
		<!-- END REGISTRATION FORM -->
	</div>
	<div class="copyright">
		2016 © Myphamlinhnham.vn
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