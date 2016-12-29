<?php
/**
 * Created by PhpStorm.
 * User: Yamon-PC
 * Date: 28-Dec-16
 * Time: 12:01 PM
 */
use scotthuangzl\googlechart\GoogleChart;
use yii\bootstrap\ActiveForm;

?>
<div class="report-form">
	<?php
	$form = ActiveForm::begin([
		'layout' => 'inline',
		'action' => ['report'],
		'method' => 'get',
	]);
	?>
	<div class="col-sm-4">
		<?php
		echo $form->field($model, 'start_date')->widget(\kartik\date\DatePicker::className(), [
			'options'       => [
				'placeholder' => 'Ngày bắt đầu',
			],
			'pluginOptions' => [
				'format' => 'yyyy-m-dd',
			],
		]);
		?>
	</div>
	<div class="col-sm-4">
		<?php
		echo $form->field($model, 'end_date')->widget(\kartik\date\DatePicker::className(), [
			'options'       => ['placeholder' => 'Ngày kết thúc'],
			'pluginOptions' => [
				'format' => 'yyyy-m-dd',
			],
		]);
		?>
	</div>
	<div class="col-sm-12" style="margin-top: 15px">
		<?php echo \yii\helpers\Html::submitButton('Báo cáo', ['class' => 'btn btn-warning']) ?>
	</div>
	<?php ActiveForm::end() ?>
</div>
<div class="clearfix"></div>
<div class="panel panel-danger" style="margin-top: 20px">
	<div class="panel-heading">Báo cáo tổng hợp</div>
	<div class="panel-body">
		<div class="col-sm-4">Tổng số đơn hàng: <?= $order ?></div>
		<div class="col-sm-4">Tổng số tài khoản hệ thống: <?= $total_children ?></div>
		<div class="col-sm-4">Tổng số đại diện: <?= $pre_count ?></div>
		<div class="col-sm-4">Tổng số đại lý bán buôn: <?= $big_count ?></div>
		<div class="col-sm-4">Tổng số đại lý bán lẻ: <?= $age_count ?></div>
		<div class="col-sm-4">Tổng số điểm phân phối: <?= $dis_count ?></div>
	</div>
</div>
<div class="panel panel-info" style="margin-top: 20px">
	<div class="panel-heading">Sơ đồ</div>
	<div class="panel-body">
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
				'colors'         => ['green'],
				'title'          => 'Doanh thu tuần này',
				'titleTextStyle' => [
					'color'    => 'blue',
					'fontSize' => 25,
				],
			),
		));
		?>
	</div>
</div>
