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
use app\components\Model;
use app\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

?>
<?= $form->field($user, 'phone')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'facebook_link')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'city')->widget(Select2::className(), [
	'data' => ArrayHelper::map(\app\models\City::find()->andWhere([
		'status' => 1,
	])->all(), 'id', 'name'),
])->label('Thành phố') ?>
<?php if($role != Model::ROLE_ADMIN) { ?>
	<?= $form->field($user, 'parent_id')->widget(Select2::className(), [
		'data' => $_GET['role'] != Model::ROLE_ADMIN ? (Yii::$app->user->identity->role_id == Model::ROLE_ADMIN ? ArrayHelper::map(User::find()->where(['role_id' => $role - 1])->all(), 'id', 'username') : ArrayHelper::map(User::find()->where([
			'role_id' => $role - 1,
			'id'      => Yii::$app->user->id,
		])->all(), 'id', 'username')) : null,
	])->label(Model::ROLE[$role - 1]) ?>
<?php } ?>
<?= $form->field($user, 'password')->passwordInput() ?>
