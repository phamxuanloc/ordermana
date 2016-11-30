<?php
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\search\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
		'layout' => 'horizontal',
	]); ?>

	<div class="col-sm-6">

		<?= $form->field($model, 'start_date')->widget(DatePicker::className(), [
			'pluginOptions' => [
				'autoclose' => true,
				'format'    => 'yyyy-mm-dd',
			],
		])->label('Từ ngày') ?>
	</div>
	<div class="col-sm-6">

		<?= $form->field($model, 'end_date')->widget(DatePicker::className(), [
			'pluginOptions' => [
				'autoclose' => true,
				'format'    => 'yyyy-mm-dd',
			],
		])->label('Đến ngày') ?>
	</div>
	<?php // echo $form->field($model, 'update_at') ?>

	<?php // echo $form->field($model, 'status') ?>

	<?php // echo $form->field($model, 'update_by') ?>

	<?php // echo $form->field($model, 'type') ?>

	<?php // echo $form->field($model, 'parent_id') ?>

	<div class="form-group">
		<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
