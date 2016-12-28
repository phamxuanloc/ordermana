<?php
use app\models\Product;
use kartik\widgets\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductHistory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-history-form">

	<div class="panel panel-info">
		<div class="panel-heading">Thông tin nhập hàng</div>
		<div class="panel-body">
			<?php $form = ActiveForm::begin([
				'layout'  => 'horizontal',
				'options' => [
					'enctype' => 'multipart/form-data',
				],
			]); ?>
			<div class="col-sm-6" style="margin-bottom: 15px">

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
			</div>
			<div class="col-sm-6" style="margin-bottom: 15px">
				<?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(Product::find()->all(), 'id', 'name'), [
					'value'    => $product_id,
					'disabled' => !$model->isNewRecord ? true : false,
				]) ?>
			</div>
			<div class="col-sm-6" style="margin-bottom: 15px">
				<?= $form->field($model, 'base_price')->widget('\yii\widgets\MaskedInput', [
					'options'       => [
						'class' => 'col-sm-12 form-control',
					],
					'clientOptions' => [
						'alias'              => 'decimal',
						'groupSeparator'     => ',',
						'autoGroup'          => true,
						'removeMaskOnSubmit' => true,
					],
				]) ?>
			</div>
			<div class="col-sm-6" style="margin-bottom: 15px">

				<?= $form->field($model, 'quantity')->textInput([
					'disabled' => !$model->isNewRecord ? true : false,
				]) ?>
			</div>
			<div class="col-sm-6" style="margin-bottom: 15px">

				<?= $form->field($model, 'status')->dropDownList($model::STATUS) ?>
			</div>

			<div class="col-sm-6" style="margin-bottom: 15px">

				<?= $form->field($model, 'receipted_date')->widget(\kartik\widgets\DateTimePicker::className(), [
					'pluginOptions' => [
						'autoclose' => true,
					],
				]) ?>
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

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Nhập thêm hàng' : 'Cập nhật thông tin', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
