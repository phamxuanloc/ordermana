<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
$this->title                   = 'Thêm mới khách hàng';
$this->params['breadcrumbs'][] = [
	'label' => 'Khách hàng',
	'url'   => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create">

	<h1><?= Html::encode($this->title) ?></h1>
	<?= $this->render('/_alert', [
		'module' => Yii::$app->getModule('user'),
	]) ?>
	<?= $this->render('_form', [
		'model'          => $model,
		'total_children' => $total_children,
	]) ?>

</div>
