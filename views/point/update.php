<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Point */
$this->title = 'Cập nhật mốc điểm';
$this->params['breadcrumbs'][] = [
	'label' => 'Points',
	'url'   => ['index'],
];
$this->params['breadcrumbs'][] = [
	'label' => $model->id,
	'url'   => [
		'view',
		'id' => $model->id,
	],
];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="point-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
