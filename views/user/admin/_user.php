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
 * @var yii\widgets\ActiveForm $form
 * @var app\models\User        $user
 */
use app\components\Model;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<?php if(!isset($_GET['id'])) { ?>
	<?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
<?php } ?>
<?= $form->field($user, 'image')->widget(FileInput::className(), [
	'options'       => ['accept' => 'image/*'],
	'pluginOptions' => [
		'allowedFileExtensions' => [
			'jpg',
			'gif',
			'png',
		],
		'showUpload'            => false,
		'initialPreview'        => $user->getIsNewRecord() ? [
			Html::img(Yii::$app->urlManager->baseUrl . '/uploads/no_image_thumb.gif', ['class' => 'file-preview-image']),
		] : [
			Html::img($user->getPictureUrl('avatar'), ['class' => 'file-preview-image']),
		],
	],
]); ?>
<?= $form->field($user, 'phone')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'id_number')->textInput() ?>
<?= $form->field($user, 'birthday')->widget(DatePicker::className(), [
	'pluginOptions' => [
		'autoclose' => true,
		'format'    => 'yyyy-mm-dd',
	],
]) ?>
<?= $form->field($user, 'address')->textInput() ?>
<?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'facebook_link')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'city')->widget(Select2::className(), [
	'data' => ArrayHelper::map(\app\models\City::find()->andWhere([
		'status' => 1,
	])->all(), 'id', 'name'),
])->label('Thành phố') ?>
<?php if($role != Model::ROLE_ADMIN) { ?>
	<?= $form->field($user, 'parent_id')->widget(Select2::className(), [
		'data' => Model::getUserLv($role),
	])->label('Người quản lý') ?>
<?php } ?>
<?= $form->field($user, 'password')->passwordInput() ?>

<?php if(!$user->isNewRecord) { ?>
	<?= $form->field($user, 'role_id')->dropDownList(Model::ROLE, ['disabled' => Yii::$app->user->identity->role_id != Model::ROLE_ADMIN ? true : false]) ?>
<?php } else { ?>
	<?= $form->field($user, 're_pass')->passwordInput() ?>
<?php } ?>