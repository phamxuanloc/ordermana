<?php
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
/**
 * @var yii\widgets\ActiveForm    $form
 * @var dektrium\user\models\User $user
 */
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

?>
<?= $form->field($user, 'phone')->textInput(['type' => 'number']) ?>
<?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'facebook_link')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'city')->widget(Select2::className(), [
	'data' => ArrayHelper::map(\app\models\City::find()->andWhere([
		'status' => 1,
	])->all(), 'id', 'name'),
])->label('Thành phố') ?>
<?= $form->field($user, 'role_id')->widget(Select2::className(), [
	'data' => ArrayHelper::map(\navatech\role\models\Role::find()->all(), 'id', 'name'),
])->label('Quyền hạn') ?>
<?= $form->field($user, 'password')->passwordInput() ?>
