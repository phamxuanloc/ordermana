<?php
use kartik\file\FileInput;
use navatech\roxymce\widgets\RoxyMceWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

	<?php $form = ActiveForm::begin([
		'layout'  => 'horizontal',
		'options' => [
			'enctype' => 'multipart/form-data',
		],
	]); ?>
	<div class="panel panel-primary">
		<div class="panel-heading">Thông tin cơ bản</div>
		<div class="panel-body">
			<?= $form->field($model, 'supplier')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'category_id')->textInput() ?>
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'code')->textInput() ?>

			<?= $form->field($model, 'image')->widget(FileInput::className(), [
				'options'       => ['accept' => 'image/*'],
				'pluginOptions' => [
					'allowedFileExtensions' => [
						'jpg',
						'gif',
						'png',
					],
					'showUpload'            => false,
					//					$model->getIsNewRecord() ? '' : 'initialPreview' => [
					//						Html::img($model->getPictureUrl('image'), ['class' => 'file-preview-image']),
					//					],
				],
			]); ?>

			<?= $form->field($model, 'description')->widget(RoxyMceWidget::className(), [
				'model'     => $model,
				'attribute' => 'description',
			]) ?>
			<?= $form->field($model, 'status')->textInput() ?>
		</div>
	</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading">Thông tin nhập hàng</div>
	<div class="panel-body">
		<div class="col-sm-12" style="margin-bottom: 20px">

			<?= $form->field($model, 'bill_image')->widget(FileInput::className(), [
				'options'       => ['accept' => 'image/*'],
				'pluginOptions' => [
					'allowedFileExtensions' => [
						'jpg',
						'gif',
						'png',
					],
					'showUpload'            => false,
					//					$model->getIsNewRecord() ? '' : 'initialPreview' => [
					//						Html::img($model->getPictureUrl('image'), ['class' => 'file-preview-image']),
					//					],
				],
			]); ?>
		</div>
		<div class="col-sm-6" style="margin-bottom: 15px">

			<?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-sm-6" style="margin-bottom: 15px">

			<?= $form->field($model, 'weight')->textInput() ?>
		</div>
		<div class="col-sm-6" style="margin-bottom: 15px">

			<?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-sm-6" style="margin-bottom: 15px">

			<?= $form->field($model, 'in_stock')->textInput() ?>
		</div>
		<div class="col-sm-6" style="margin-bottom: 15px">

			<?= $form->field($model, 'order_number')->textInput() ?>
		</div>
		<div class="col-sm-6" style="margin-bottom: 15px">

			<?= $form->field($model, 'bill_number')->textInput(['maxlength' => true]) ?>
		</div>

		<div class="col-sm-6" style="margin-bottom: 15px">

			<?= $form->field($model, 'receiver')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-sm-6" style="margin-bottom: 15px">

			<?= $form->field($model, 'deliver')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-sm-6" style="margin-bottom: 15px">

			<?= $form->field($model, 'base_price')->textInput() ?>
		</div>
		<div class="col-sm-6" style="margin-bottom: 15px">

			<?= $form->field($model, 'price_tax')->textInput() ?>
		</div>
		<div class="col-sm-6" style="margin-bottom: 15px">

			<?= $form->field($model, 'supplier_discount')->textInput() ?>
		</div>
	</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading">Thông tin xuất hàng</div>
	<div class="panel-body">
		<div class="col-sm-12">
			<?= $form->field($model, 'distribute_sale')->textInput() ?>
		</div>
		<div class="col-sm-12">

			<?= $form->field($model, 'agent_sale')->textInput() ?>
		</div>
		<div class="col-sm-12">

			<?= $form->field($model, 'retail_sale')->textInput() ?>
		</div>
	</div>
</div>
<div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
