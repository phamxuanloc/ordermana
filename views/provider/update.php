<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Provider */
$this->title = 'Cập nhật nhà cung cấp: ' . $model->name;
$this->params['breadcrumbs'][] = [
	'label' => 'Providers',
	'url'   => ['index'],
];
$this->params['breadcrumbs'][] = [
	'label' => $model->name,
	'url'   => [
		'view',
		'id' => $model->id,
	],
];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="provider-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
