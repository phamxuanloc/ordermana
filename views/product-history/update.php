<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductHistory */
$this->title                   = 'Cập nhật thông tin nhập hàng ';
$this->params['breadcrumbs'][] = [
	'label' => 'Product Histories',
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
<div class="product-history-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
