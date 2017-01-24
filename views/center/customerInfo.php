<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 1/24/2017
 * Time: 7:49 AM
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
	'layout' => 'horizontal',
]); ?>
<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
<div class="form-group">
	<?= Html::submitButton( 'Kiểm tra',  ['class' =>  'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>


