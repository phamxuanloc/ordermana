<?php
use app\models\User;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\widgets\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

//use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

	<?php $form = ActiveForm::begin([
		'layout'  => 'horizontal',
		'options' => [
			'enctype' => 'multipart/form-data',
		],
	]); ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
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
	]); ?>
	<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'birthday')->widget(DatePicker::className(), [
		'pluginOptions' => [
			'autoclose' => true,
			'format'    => 'yyyy-mm-dd',
		],
	]) ?>
	<?= $form->field($model, 'phone')->textInput() ?>
	<?= $form->field($model, 'id_number')->textInput() ?>

	<?= $form->field($model, 'city_id')->widget(Select2::className(), [
		'data' => ArrayHelper::map(\app\models\City::find()->andWhere([
			'status' => 1,
		])->all(), 'name', 'name'),
	])->label('Thành phố') ?>
	<?php if($model->isNewRecord) { ?>
		<?= $form->field($model, 'parent_id')->widget(Select2::className(), [
			'data' => (Yii::$app->user->identity->role_id != $model::ROLE_ADMIN && Yii::$app->user->identity->role_id != $model::ROLE_CARE) ? $total_children : $model->getTotalUser(),
		])->label('Người sở hữu') ?>
	<?php } ?>
	<?= $form->field($model, 'link_fb')->textInput(['maxlength' => true]) ?>
	<?php echo $form->field($model, 'source')->textInput() ?>
	<?php echo $form->field($model, 'product')->textInput() ?>
	<?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'is_call')->dropDownList($model::IS_CALL) ?>
	<?php if(Yii::$app->user->identity->role_id != $model::ROLE_CARE) { ?>
		<?= $form->field($model, 'call_by')->textInput(['maxlength' => true]) ?>
	<?php } ?>
	<?= $form->field($model, 'call_at')->widget(DatePicker::className(), [
		'pluginOptions' => [
			'autoclose' => true,
			'format'    => 'yyyy-mm-dd',
		],
	]) ?>

	<div class="col-sm-offset-3">
		<?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
