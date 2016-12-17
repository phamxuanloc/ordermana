<?php
use app\models\OrderCustomer;
use navatech\role\helpers\RoleChecker;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrderCustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title                   = 'Đơn hàng cho khách';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-customer-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		//		'filterModel'  => $searchModel,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'user_id',
				'value'     => function (OrderCustomer $data) {
					return $data->users->username;
				},
			],
			'total_amount',
			'note',
			'discount',
			'created_date',
			// 'update_at',
			[
				'attribute' => 'status',
				'value'     => function (OrderCustomer $data) {
					return "<span class='{$data->getColorStatus()}'>" . $data::STATUS[$data->status] . "</span>";
				},
				'format'    => 'raw',
			],
			// 'update_by',
			// 'type',
			// 'parent_id',
			[
				'class'          => 'yii\grid\ActionColumn',
				'template'       => '{view} {delete}',
				'visibleButtons' => [
					'view'   => RoleChecker::isAuth(\app\controllers\OrderController::className(), 'view'),
					'delete' => RoleChecker::isAuth(\app\controllers\OrderController::className(), 'delete'),
				],
				'header'         => 'Xem chi tiết',
			],
		],
	]); ?>
</div>
