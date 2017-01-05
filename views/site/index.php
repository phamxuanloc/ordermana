<?php
/* @var $this yii\web\View */
use scotthuangzl\googlechart\GoogleChart;

$this->title = 'Mỹ phẩm Linh Nhâm';
?>

<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				Widget settings form goes here
			</div>
			<div class="modal-footer">
				<button type="button" class="btn blue">Save changes</button>
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<!-- BEGIN STYLE CUSTOMIZER -->
<!-- END STYLE CUSTOMIZER -->
<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?=\yii\helpers\Url::home()?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Trang chủ</a>
		</li>
	</ul>
<!--	<div class="page-toolbar">-->
<!--		<div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">-->
<!--			<i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp;-->
<!--			<i class="fa fa-angle-down"></i>-->
<!--		</div>-->
<!--	</div>-->
</div>
<?= $this->render('/_alert', [
	'module' => Yii::$app->getModule('user'),
]) ?>
<h3 class="page-title">
	Trang chủ
	<small>Thống kê & số liệu</small>
</h3>
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS -->
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat blue-madison">
			<div class="visual">
				<i class="fa fa-comments"></i>
			</div>
			<div class="details">
				<div class="number">
					<?= $product_quantity ?>
				</div>
				<div class="desc">
					Sản phẩm mới tháng <?= date('m') ?>
				</div>
			</div>
			<a class="more" href="<?= \yii\helpers\Url::to(['/product']) ?>">
				Xem thêm <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat red-intense">
			<div class="visual">
				<i class="fa fa-bar-chart-o"></i>
			</div>
			<div class="details">
				<div class="number">
					<?= number_format($revenue) ?>
				</div>
				<div class="desc">
					Tổng thu tháng <?= date('m') ?>
				</div>
			</div>
			<a class="more" href="javascript:;">
				Xem thêm<i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat green-haze">
			<div class="visual">
				<i class="fa fa-shopping-cart"></i>
			</div>
			<div class="details">
				<div class="number">
					<?= $order ?>
				</div>
				<div class="desc">
					Đơn hàng tháng <?= date('m') ?>
				</div>
			</div>
			<a class="more" href="javascript:;">
				Xem thêm<i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat purple-plum">
			<div class="visual">
				<i class="fa fa-globe"></i>
			</div>
			<div class="details">
				<div class="number">
					<?= $change_revenue ?>%
				</div>
				<div class="desc">
					Biến động doanh số(so với cùng kỳ tháng trước)
				</div>
			</div>
			<a class="more" href="javascript:;">
				Xem thêm <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
</div>
<!-- END DASHBOARD STATS -->
<div class="clearfix">
</div>

<?php echo GoogleChart::widget(array(
	'visualization' => 'PieChart',
	'data'          => $data,
	'options'       => array(
		'title'          => 'Tiền nhập hàng đại diện',
		'width'          => '100%',
		'height'         => 500,
		'titleTextStyle' => [
			'color'    => 'red',
			'fontSize' => 25,
		],
	),
));
echo GoogleChart::widget(array(
	'visualization' => 'BarChart',
	'data'          => $top_product,
	'options'       => array(
		'title'          => 'Top sản phẩm bán chạy',
		'titleTextStyle' => [
			'color'    => 'green',
			'fontSize' => 25,
		],
	),
));
echo GoogleChart::widget(array(
	'visualization' => 'ColumnChart',
	'data'          => $profit_month,
	'options'       => array(
		'colors'=>['green'],
		'title'          => 'Doanh thu tuần này',
		'titleTextStyle' => [
			'color'    => 'blue',
			'fontSize' => 25,
		],
	),
));
?>
<div class="clearfix">
</div>


