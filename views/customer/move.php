<?php
/**
 * Created by Navatech.
 * @project ordermana
 * @author  LocPX
 * @email   loc.xuanphama1t1[at]gmail.com
 * @date    12/10/2016
 * @time    11:34 PM
 */
use app\models\User;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Chuyển khách hàng';
/** @var \app\models\Customer $model */
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php $form = ActiveForm::begin(['layout' => 'horizontal']) ?>

<?= $form->field($model, 'parent_id')->widget(Select2::className(), [
	'data' => Yii::$app->user->identity->role_id != $model::ROLE_CARE ? $children : $model->getTotalUser(),
])->label('Người nhận') ?>

<?= $form->field($model, 'list_customer')->widget(Select2::className(), [
	'data' => $model->getOwnerCustomer(),
])->label('Khách hàng') ?>

<div class="col-sm-offset-3">
	<?= Html::submitButton('Chuyển', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
