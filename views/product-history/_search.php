<?php
use kartik\widgets\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\search\ProductHistorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-history-search">
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
	<div class="col-sm-6">

		<?= $form->field($model, 'name') ?>
	</div>
	<div class="col-sm-6">

		<?= $form->field($model, 'code') ?>
	</div>
	<?php // echo $form->field($model, 'created_date') ?>

	<?php // echo $form->field($model, 'receipted_date') ?>

	<?php // echo $form->field($model, 'product_id') ?>
	<div class="col-sm-6">

		<?php echo $form->field($model, 'quantity') ?>
	</div>
	<?php // echo $form->field($model, 'bill_image') ?>

	<?php // echo $form->field($model, 'bill_number') ?>

	<?php // echo $form->field($model, 'order_number') ?>

	<?php // echo $form->field($model, 'receiver') ?>

	<?php // echo $form->field($model, 'deliver') ?>

	<?php // echo $form->field($model, 'color') ?>

	<?php // echo $form->field($model, 'weight') ?>

	<?php // echo $form->field($model, 'unit') ?>

	<?php // echo $form->field($model, 'price_tax') ?>

	<?php // echo $form->field($model, 'status') ?>

	<div class="form-group">
		<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
