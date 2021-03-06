<?php
use app\assets\LoginAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

Yii::$app->layout = false;
LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php
$this->title                   = 'Tra cứu điểm khách hàng';
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

	<body class=" login">
	<?php $this->beginBody() ?>
	<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
	<div class="menu-toggler sidebar-toggler">
	</div>
	<!-- END SIDEBAR TOGGLER BUTTON -->
	<!-- BEGIN LOGO -->
	<div class="logo">
		<a href="<?= \yii\helpers\Url::home() ?>">
			<img src="https://myphamlinhnham.vn/wp-content/themes/thietkewebwordpress/img/logo.png" alt=""/>
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
		<h3 class="form-title">Tra cứu điểm số</h3>
		<div class="form-group">
			<?= $form->field($model, 'phone', ['labelOptions' => ['class' => 'control-label visible-ie8 visible-ie9']])->textInput([
				'autofocus'   => 'autofocus',
				'class'       => 'form-control form-control-solid placeholder-no-fix',
				'placeholder' => 'Số điện thoại',
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
		2016 © Myphamlinhnham.vn. Admin Dashboard.
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