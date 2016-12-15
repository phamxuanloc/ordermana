<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Alert */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alert-form">

	<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

	<?= $form->field($model, 'content')->textInput(['maxlength' => true])->label('Nội dung') ?>

	<?= $form->field($model, 'role_id')->widget(\kartik\select2\Select2::className(), [
		'data'    => \yii\helpers\ArrayHelper::merge(['All'], $model::ROLE),
		'options' => ['multiple' => true],
	])->label('Gửi đến') ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
