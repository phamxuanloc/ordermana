<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Point */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="point-form">

	<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

	<?= $form->field($model, 'point_begin')->textInput() ?>

	<?= $form->field($model, 'point_end')->textInput() ?>
	<?= $form->field($model, 'discount')->textInput() ?>

	<?= $form->field($model, 'prize')->textInput(['maxlength' => true]) ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Tạo' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
