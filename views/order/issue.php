<?php
use app\components\Model;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\Order $order */
?>
<?php if(Yii::$app->user->identity->role_id == Model::ROLE_ADMIN || Yii::$app->user->identity->role_id == $order::ROLE_PRE) { ?>
	<?= Html::a('Xuất kho cho đại diện', Url::to([
		'/order/order-item',
		'role' => $order::ROLE_PRE,
	]), ['class' => 'btn btn-warning']) ?>
<?php } ?>
<?php if(Yii::$app->user->identity->role_id < Model::ROLE_BIGA) { ?>
	<?= Html::a('Xuất kho cho đại lý', Url::to([
		'/order/order-item',
		'role' => $order::ROLE_BIGA,
	]), ['class' => 'btn btn-success']) ?>
<?php } ?>
<?php if(Yii::$app->user->identity->role_id < Model::ROLE_A) { ?>

	<?= Html::a('Xuất kho cho đại lý bán lẻ| NPP', Url::to([
		'/order/order-item',
		'role' => $order::ROLE_A,
	]), ['class' => 'btn btn-primary']) ?>
<?php } ?>
<?php if(Yii::$app->user->identity->role_id < Model::ROLE_A) { ?>

	<?= Html::a('Xuất kho cho điểm phân phối', Url::to([
		'/order/order-item',
		'role' => $order::ROLE_D,
	]), ['class' => 'btn btn-default']) ?>
<?php } ?>

<?php if(Yii::$app->user->identity->role_id == Model::ROLE_ADMIN) { ?>

	<?= Html::a('Xuất kho cho center', Url::to([
		'/order/order-item',
		'role' => $order::ROLE_CENTER,
	]), ['class' => 'btn btn-center']) ?>
<?php } ?>

