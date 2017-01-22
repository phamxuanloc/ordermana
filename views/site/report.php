<?php
/**
 * Created by PhpStorm.
 * User: Yamon-PC
 * Date: 28-Dec-16
 * Time: 12:01 PM
 */
use app\components\Model;
use app\models\User;
use scotthuangzl\googlechart\GoogleChart;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

//use yii\widgets\ActiveForm;
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
	<div class="col-sm-4">
		<?php
		echo $form->field($model, 'username')->widget(\kartik\select2\Select2::className(), [
			'options' => ['placeholder' => 'Đại diện'],
			'data'    => ArrayHelper::map(User::find()->where(['role_id' => Model::ROLE_PRE])->all(), 'id', 'username'),
		]);
		?>
	</div>
	<div class="col-sm-12" style="margin-top: 15px">
		<?php echo \yii\helpers\Html::submitButton('Báo cáo', ['class' => 'btn btn-warning']) ?>
		<?= Html::a('Reset', ['site/report'], ['class' => 'btn btn-default']) ?>
	</div>

	<?php ActiveForm::end() ?>
</div>
<div class="clearfix"></div>
<div class="panel panel-danger" style="margin-top: 20px">
	<div class="panel-heading">Báo cáo tổng hợp</div>
	<div class="panel-body">
		<div class="col-sm-4">Tổng số đơn hàng: <span style="font-weight: bold"><?= $order ?> đơn</span></div>
		<div class="col-sm-4">Tổng số doanh thu:
			<span style="font-weight: bold"><?= number_format($revenue) ?> VNĐ</span></div>
		<div class="col-sm-4">Tổng số khách hàng hệ thống: <span style="font-weight: bold"><?= $customer ?></span></div>
		<div class="col-sm-4">Tổng số tài khoản hệ thống: <span style="font-weight: bold"><?= $total_children ?></span>
		</div>
		<div class="col-sm-4">Tổng số đại diện: <span style="font-weight: bold"><?= $pre_count ?></span></div>
		<div class="col-sm-4">Tổng số đại lý bán buôn: <span style="font-weight: bold"><?= $big_count ?></span></div>
		<div class="col-sm-4">Tổng số đại lý bán lẻ: <span style="font-weight: bold"><?= $age_count ?></span></div>
		<div class="col-sm-4">Tổng số điểm phân phối: <span style="font-weight: bold"><?= $dis_count ?></span></div>
	</div>
</div>
<div class="panel panel-info" style="margin-top: 20px">
	<div class="panel-heading">Sơ đồ</div>
	<div class="panel-body">
		<?php
		if(Yii::$app->user->identity->role_id == Model::ROLE_ADMIN) {
			echo GoogleChart::widget(array(
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
		} elseif(Yii::$app->user->identity->role_id == Model::ROLE_PRE || Yii::$app->user->identity->role_id == Model::ROLE_BIGA) {
			echo GoogleChart::widget(array(
				'visualization' => 'PieChart',
				'data'          => $age_array,
				'options'       => array(
					'title'          => 'Tiền nhập hàng đại lý',
					'width'          => '100%',
					'height'         => 500,
					'titleTextStyle' => [
						'color'    => 'red',
						'fontSize' => 25,
					],
				),
			));
		}
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
		echo GoogleChart::widget(array(
			'visualization' => 'PieChart',
			'data'          => $stock,
			'options'       => array(
				'title'          => 'Hàng trong kho',
				'width'          => '100%',
				'height'         => 500,
				'titleTextStyle' => [
					'color'    => 'violet',
					'fontSize' => 25,
				],
			),
		));
		echo GoogleChart::widget(array(
			'visualization' => 'PieChart',
			'data'          => $top_customer,
			'options'       => array(
				'title'          => 'Top khách hàng',
				'width'          => '100%',
				'height'         => 500,
				'titleTextStyle' => [
					'color'    => 'orange',
					'fontSize' => 25,
				],
			),
		));
		?>

	</div>
</div>
