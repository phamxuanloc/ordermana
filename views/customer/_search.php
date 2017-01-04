<?php
use app\models\User;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\search\CustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
		'layout' => 'inline',
	]); ?>

	<div class="col-sm-4">
		<?= $form->field($model, 'name')->textInput(['placeholder' => 'Tên']) ?>
	</div>
	<div class="col-sm-4">

		<?php echo $form->field($model, 'phone')->textInput(['placeholder' => 'Số điện thoại']) ?>
	</div>
	<div class="col-sm-4">
		<?php echo $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(\app\models\City::find()->all(), 'name', 'name'), ['prompt' => 'Thành phố']) ?>
	</div>
	<div class="col-sm-4" style="margin-top: 15px">
		<?php echo $form->field($model, 'start_date')->widget(DatePicker::className(), [
			'pluginOptions' => [
				'format' => 'yyyy-mm-dd',
			],
			'options'       => ['placeholder' => 'Từ ngày',],
		]) ?>
	</div>
	<div class="col-sm-4" style="margin-top: 15px">

		<?php echo $form->field($model, 'end_date')->widget(DatePicker::className(), [
			'pluginOptions' => [
				'format' => 'yyyy-mm-dd',
			],
			'options'       => ['placeholder' => 'Đến ngày',],
		]) ?>
	</div>
	<div class="col-sm-4" style="margin-top: 15px">
		<?php echo $form->field($model, 'user_id')->widget(Select2::className(), [
			'data'    => Yii::$app->user->identity->role_id != $model::ROLE_CARE ? ArrayHelper::merge([Yii::$app->user->id => Yii::$app->user->identity->username], ArrayHelper::map(User::find()->where([
				'IN',
				'id',
				$model->getTotalChildren(Yii::$app->user->id),
			])->all(), 'id', 'username')) : $model->getTotalUser(),
			'options' => ['placeholder' => 'Người tạo khách hàng']
			//			,
		]) ?>
	</div>
	<div class="col-sm-4" style="margin-top: 15px">
		<?php echo $form->field($model, 'is_phone_num')->dropDownList([
			'Không có sđt',
			'Có sđt',
		], ['prompt' => 'Trạng thái sđt']) ?>
	</div>
	<div class="col-sm-4" style="margin-top: 15px">
		<?php echo $form->field($model, 'source')->textInput(['placeholder' => 'Nguồn khách']) ?>
	</div>
	<?php // echo $form->field($model, 'point') ?>

	<?php // echo $form->field($model, 'parent_id') ?>

	<?php // echo $form->field($model, 'is_move') ?>

	<?php // echo $form->field($model, 'link_fb') ?>

	<?php // echo $form->field($model, 'sale') ?>

	<?php // echo $form->field($model, 'note') ?>

	<?php // echo $form->field($model, 'is_call') ?>

	<?php // echo $form->field($model, 'call_by') ?>

	<?php // echo $form->field($model, 'call_at') ?>

	<div class="col-sm-4" style="margin-top: 10px">
		<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
