<?php
use app\models\Order;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title                   = 'Đơn hàng xuất kho';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Xuất kho', ['order-item'], ['class' => 'btn btn-success']) ?>
	</p>
	<div class="panel panel-default">
		<div class="panel-heading">Thống kê</div>
		<div class="panel-body">
			<p>Tổng số đơn hàng:<?= $order_num ?></p>
			<p>Tổng số tiền hàng:<?= $order_sum ?></p>
		</div>
	</div>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel'  => $searchModel,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'user_id',
				'value'     => function (Order $data) {
					return $data->users->username;
				},
			],
			'total_amount',
			'note',
			'created_date',
			// 'update_at',
			[
				'attribute' => 'status',
				'value'     => function (Order $data) {
					return $data::STATUS[$data->status];
				},
			],
			// 'update_by',
			// 'type',
			// 'parent_id',
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
