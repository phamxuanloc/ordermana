<?php
/**
 * Created by PhpStorm.
 * User: Yamon-PC
 * Date: 15-Dec-16
 * Time: 8:55 AM
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/** @var app\models\ChangeForm $model */
$this->title = 'Chuyển tài khoản tuyến dưới';
?>
<h1><?= Html::encode($this->title) ?></h1>
<?= $this->render('/_alert', [
	'module' => Yii::$app->getModule('user'),
]) ?>
<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
<?= $form->field($model, 'from_user')->dropDownList($model->getAllUser()) ?>
<?= $form->field($model, 'to_user')->dropDownList($model->getAllUser()) ?>
<div class="col-sm-offset-3">
	<?= Html::submitButton('Chuyển', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>

