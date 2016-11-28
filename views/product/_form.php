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
			<?= $form->field($model, 'category_id')->dropDownList($model->getCategoryOrder(), ['prompt' => 'Please choose category']) ?>
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'code')->textInput() ?>

			<?= $form->field($model, 'product_bill')->widget(FileInput::className(), [
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
						Html::img($model->getPictureUrl('bill_image'), ['class' => 'file-preview-image']),
					],
				],
			]); ?>
			<?= $form->field($model, 'product_img')->widget(FileInput::className(), [
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
						Html::img($model->getPictureUrl('image'), ['class' => 'file-preview-image']),
					],
				],
			]); ?>
			<?= $form->field($model, 'description')->widget(RoxyMceWidget::className(), [
				'model'     => $model,
				'attribute' => 'description',
			]) ?>
			<?= $form->field($model, 'status')->dropDownList($model::STATUS) ?>
		</div>
	</div>
</div>
<div class="panel panel-info">
	<div class="panel-heading">Thông tin nhập hàng</div>
	<div class="panel-body">

		<div class="col-sm-6" style="margin-bottom: 15px">

			<?= $form->field($model, 'base_price')->textInput() ?>
		</div>
		<div class="col-sm-6" style="margin-bottom: 15px">

			<?= $form->field($model, 'in_stock')->textInput() ?>
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

			<?= $form->field($model, 'supplier_discount')->textInput() ?>
		</div>
	</div>
</div>
<div class="panel panel-warning">
	<div class="panel-heading">Thông tin xuất hàng</div>
	<div class="panel-body">
		<div class="col-sm-12" style="margin-bottom: 15px">
			<?= $form->field($model, 'representative_sale')->textInput() ?>
		</div>
		<div class="col-sm-12" style="margin-bottom: 15px">

			<?= $form->field($model, 'big_agent_sale')->textInput() ?>
		</div>
		<div class="col-sm-12" style="margin-bottom: 15px">

			<?= $form->field($model, 'agent_sale')->textInput() ?>
		</div>
		<div class="col-sm-12" style="margin-bottom: 15px">
			<?= $form->field($model, 'distribute_sale')->textInput() ?>
		</div>
		<div class="col-sm-12" style="margin-bottom: 15px">

			<?= $form->field($model, 'retail_sale')->textInput() ?>
		</div>
	</div>
</div>
<div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? 'Nhập sản phẩm' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
