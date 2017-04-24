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
	<div class="logo" style="text-align: center; margin-bottom: 15px">
		<a href="<?= \yii\helpers\Url::home() ?>">
			<img style="" src="<?= Url::base() ?>/logo.png" alt="logo" class="logo-default"/>
		</a>
	</div>
	<!-- END SIDEBAR TOGGLER BUTTON -->
	<!-- BEGIN LOGO -->
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content col-sm-12">
		<!-- BEGIN LOGIN FORM -->

		<div class="col-sm-6">
			<div class="panel panel-success">
				<div class="panel-heading">Basic info</div>
				<div class="panel-body">
					<?php $form = ActiveForm::begin([
						'layout'                 => 'horizontal',
						'enableAjaxValidation'   => true,
						'enableClientValidation' => false,
						'options'                => [
							'enctype' => 'multipart/form-data',
						],
						'fieldConfig'            => [
							'horizontalCssClasses' => [
								'wrapper' => 'col-sm-9',
							],
						],
					]); ?>
					<?= $form->field($model, 'image')->widget(FileInput::className(), [
						'options'       => ['accept' => 'image/*'],
						'pluginOptions' => [
							'allowedFileExtensions' => [
								'jpg',
								'gif',
								'png',
							],
							'showUpload'            => false,
							'initialPreview'        => $model->getIsNewRecord() ? [
								Html::img(Yii::$app->urlManager->baseUrl . '/uploads/no_image_thumb.gif', ['class' => 'file-preview-image']),
							] : [
								Html::img($model->getPictureUrl('avatar'), ['class' => 'file-preview-image']),
							],
						],
						'disabled'      => true,
					]); ?>
					<?= $form->field($model, 'store_description')->widget(RoxyMceWidget::className(), [
						'model'         => $model,
						'clientOptions' => [
							'menubar'   => false,
							'statusbar' => false,
							'toolbar'   => false,
							'title'     => false,
						],
						//						'options'       => [
						//							'disabled' => true,
						//						],
					])->label('Mô tả') ?>

					<?= $form->field($model, 'address')->textInput([
						'disabled' => true,
					])->label('Địa chỉ') ?>

					<?= $form->field($model, 'phone')->textInput([
						'maxlength' => 255,
						'disabled'  => true,
					])->label('Số điện thoại') ?>
					<?= $form->field($model, 'created_at')->textInput([
						'value'    => date('Y-m-d H:i:s', $model->created_at),
						'disabled' => true,
					])->label('Ngày tham gia') ?>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="panel panel-info">
				<div class="panel-heading">Basic info</div>
				<div class="panel-body">
					<?= $form->field($model, 'store_image')->widget(FileInput::className(), [
						'options'       => ['accept' => 'image/*'],
						'pluginOptions' => [
							'allowedFileExtensions' => [
								'jpg',
								'gif',
								'png',
							],
							'showUpload'            => false,
							'initialPreview'        => $model->getIsNewRecord() ? [
								Html::img(Yii::$app->urlManager->baseUrl . '/uploads/no_image_thumb.gif', ['class' => 'file-preview-image']),
							] : [
								Html::img($model->getPictureUrl('store_image'), ['class' => 'file-preview-image']),
							],
						],
						'disabled'      => true,
					])->label('Ảnh cửa hàng'); ?>
					<?= $form->field($model, 'store_address')->textInput([
						'disabled' => true,
					])->label('Địa chỉ cửa hàng') ?>
					<?= $form->field($model, 'email')->textInput([
						'maxlength' => 255,
						'disabled'  => true,
					]) ?>
					<?= $form->field($model, 'facebook_link')->textInput([
						'maxlength' => 255,
						'disabled'  => true,
					]) ?>
					<?= $form->field($model, 'zalo')->textInput([
						'maxlength' => 255,
						'disabled'  => true,
					]) ?>
					<?= $form->field($model, 'viber')->textInput([
						'maxlength' => 255,
						'disabled'  => true,
					]) ?>
					<?= $form->field($model, 'city')->widget(Select2::className(), [
						'data'     => ArrayHelper::map(\app\models\City::find()->andWhere([
							'status' => 1,
						])->all(), 'id', 'name'),
						'disabled' => true,
					])->label('Thành phố') ?>


					<?php ActiveForm::end(); ?>

					<!-- END FORGOT PASSWORD FORM -->
					<!-- BEGIN REGISTRATION FORM -->
					<!-- END REGISTRATION FORM -->
				</div>
			</div>
		</div>
		<?= Html::a('Quay lại', ['/check/check-store'], ['class' => 'btn btn-success']) ?>
	</div>
	<!--	<div class="copyright">-->
	<!--		2016 © Myphamlinhnham.vn-->
	<!--	</div>-->
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