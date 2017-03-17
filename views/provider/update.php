<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Provider */
$this->title = 'Cập nhật nhà cung cấp: ' . $model->name;
$this->params['breadcrumbs'][] = [
	'label' => 'Nhà cung cấp',
	'url'   => ['index'],
];
$this->params['breadcrumbs'][] = [
	'label' => $model->name,
	'url'   => [
		'view',
		'id' => $model->id,
	],
];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="provider-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
