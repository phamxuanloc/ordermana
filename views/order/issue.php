<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\Order $order */
?>
<?= Html::a('Xuất kho cho đại diện', Url::to([
	'/order/order-item',
	'role' => $order::ROLE_PRE,
]), ['class' => 'btn btn-warning']) ?>
<?= Html::a('Xuất kho cho đại lý bán buôn', Url::to([
	'/order/order-item',
	'role' => $order::ROLE_BIGA,
]), ['class' => 'btn btn-info']) ?>
<?= Html::a('Xuất kho cho đại lý', Url::to([
	'/order/order-item',
	'role' => $order::ROLE_A,
]), ['class' => 'btn btn-default']) ?>
<?= Html::a('Xuất kho cho điểm phân phối', Url::to([
	'/order/order-item',
	'role' => $order::ROLE_D,
]), ['class' => 'btn btn-danger']) ?>

