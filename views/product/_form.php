<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

	<?php $form = ActiveForm::begin([
		'layout' => 'horizontal',
	]); ?>
	<?= $form->field($model, 'supplier')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'category_id')->textInput() ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'code')->textInput() ?>

	<?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'description')->textInput() ?>

	<?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'weight')->textInput() ?>

	<?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'in_stock')->textInput() ?>

	<?= $form->field($model, 'order_number')->textInput() ?>

	<?= $form->field($model, 'bill_number')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'bill_image')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'receiver')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'deliver')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'base_price')->textInput() ?>

	<?= $form->field($model, 'price_tax')->textInput() ?>

	<?= $form->field($model, 'supplier_discount')->textInput() ?>

	<?= $form->field($model, 'distribute_sale')->textInput() ?>

	<?= $form->field($model, 'agent_sale')->textInput() ?>

	<?= $form->field($model, 'retail_sale')->textInput() ?>

	<?= $form->field($model, 'status')->textInput() ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
