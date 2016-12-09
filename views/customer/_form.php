<?php
use kartik\select2\Select2;
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
		'layout' => 'horizontal',
	]); ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'phone')->textInput() ?>

	<?= $form->field($model, 'city_id')->widget(Select2::className(), [
		'data' => ArrayHelper::map(\app\models\City::find()->andWhere([
			'status' => 1,
		])->all(), 'id', 'name'),
	])->label('Thành phố') ?>

	<?= $form->field($model, 'parent_id')->widget(Select2::className(), [
		'data' => ArrayHelper::map(\app\models\User::find()->where(['blocked_at' => null])->all(), 'id', 'username'),
	])->label('Người sở hữu') ?>

	<?= $form->field($model, 'link_fb')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'is_call')->dropDownList($model::IS_CALL) ?>

	<?= $form->field($model, 'call_by')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'call_at')->widget(\kartik\date\DatePicker::className(), [
		'pluginOptions' => [
			'autoclose' => true,
			'format'    => 'yyyy-mm-dd',
		],
	]) ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
