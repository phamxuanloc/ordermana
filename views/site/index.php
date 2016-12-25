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
			<a href="index.html">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Trang chủ</a>
		</li>
	</ul>
	<div class="page-toolbar">
		<div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
			<i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp;
			<i class="fa fa-angle-down"></i>
		</div>
	</div>
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
					1349
				</div>
				<div class="desc">
					Sản phẩm mới tháng <?= date('m') ?>
				</div>
			</div>
			<a class="more" href="javascript:;">
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
					12,000,000
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
					549
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
					+89%
				</div>
				<div class="desc">
					Biến động doanh số
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
		'title' => 'Tiền nhập hàng đại diện',
		'width' => '100%',
		'height'=>500,
		'titleTextStyle'=>['color'=>'red']
	),
));
?>
<div class="row">
	<div class="col-md-6 col-sm-6">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bar-chart font-green-sharp hide"></i>
					<span class="caption-subject font-green-sharp bold uppercase">Lượt truy cập</span>
					<span class="caption-helper">weekly stats...</span>
				</div>
				<div class="actions">
					<div class="btn-group btn-group-devided" data-toggle="buttons">
						<label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
							<input type="radio" name="options" class="toggle" id="option1">Mới</label>
						<label class="btn btn-transparent grey-salsa btn-circle btn-sm">
							<input type="radio" name="options" class="toggle" id="option2">Trở lại</label>
					</div>
				</div>
			</div>
			<div class="portlet-body">
				<div id="site_statistics_loading">
					<img src="../../assets/admin/layout/img/loading.gif" alt="loading"/>
				</div>
				<div id="site_statistics_content" class="display-none">
					<div id="site_statistics" class="chart">
					</div>
				</div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
	<div class="col-md-6 col-sm-6">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-share font-red-sunglo hide"></i>
					<span class="caption-subject font-red-sunglo bold uppercase">Doanh thu</span>
					<span class="caption-helper">Tháng</span>
				</div>
				<div class="actions">
					<div class="btn-group">
						<a href="" class="btn grey-salsa btn-circle btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							Filter Range<span class="fa fa-angle-down">
									</span>
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="javascript:;">
									Q1 2014 <span class="label label-sm label-default">
											past </span>
								</a>
							</li>
							<li>
								<a href="javascript:;">
									Q2 2014 <span class="label label-sm label-default">
											past </span>
								</a>
							</li>
							<li class="active">
								<a href="javascript:;">
									Q3 2014 <span class="label label-sm label-success">
											current </span>
								</a>
							</li>
							<li>
								<a href="javascript:;">
									Q4 2014 <span class="label label-sm label-warning">
											upcoming </span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="portlet-body">
				<div id="site_activities_loading">
					<img src="../../assets/admin/layout/img/loading.gif" alt="loading"/>
				</div>
				<div id="site_activities_content" class="display-none">
					<div id="site_activities" style="height: 228px;">
					</div>
				</div>
				<div style="margin: 20px 0 10px 30px">
					<div class="row">
						<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
										<span class="label label-sm label-success">
										Lợi nhuận: </span>
							<h3>$13,234</h3>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
										<span class="label label-sm label-info">
										Thuế: </span>
							<h3>$134,900</h3>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
										<span class="label label-sm label-danger">
										Phí ship: </span>
							<h3>$1,134</h3>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
										<span class="label label-sm label-warning">
										Đơn hàng: </span>
							<h3>235090</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>
<div class="clearfix">
</div>


