<?php
use app\models\Order;
use navatech\role\helpers\RoleChecker;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title                   = 'Đơn hàng xuất kho';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<div class="panel panel-info">
		<div class="panel-heading">Tìm kiếm</div>
		<div class="panel-body">
			<?php echo $this->render('_search', ['model' => $searchModel]); ?>
		</div>
	</div>

	<p>
		<?= Html::a('Xuất kho', ['order-item'], ['class' => 'btn btn-success']) ?>
	</p>
	<div class="panel panel-success">
		<div class="panel-heading">Thống kê</div>
		<div class="panel-body">
			<div class="col-sm-6">
				<p>Tổng số đơn hàng: <?= $order_num ?> Đơn</p>
				<p>Tổng số tiền hàng: <?= $order_sum ?> VNĐ</p>
				<p>Tổng số đơn đại diện: <?= $order_pre ?> Đơn</p>
			</div>
			<div class="col-sm-6">
				<p>Tổng số đơn đại lí bán buôn: <?= $order_big ?> Đơn</p>
				<p>Tổng số đơn đại lí bán lẻ: <?= $order_age ?> Đơn</p>
				<p>Tổng số đơn điểm phân phối: <?= $order_dis ?> Đơn</p>
			</div>
		</div>

	</div>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		//		'filterModel'  => $searchModel,
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
