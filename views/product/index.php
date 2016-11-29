<?php
use app\models\Product;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title                   = 'Kho sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Nhập sản phẩm vào kho', ['receipt'], ['class' => 'btn btn-success']) ?>
	</p>
	<div class="panel panel-default">
		<div class="panel-heading">Thống kê</div>
		<div class="panel-body">
			<p>Tổng số hàng trong kho:<?= $product_num ?></p>
			<p>Tổng số tiền nhập giá gốc:<?= $product_sum ?></p>
		</div>
	</div>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel'  => $searchModel,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'category_id',
				'value'     => function (Product $data) {
					return $data->category->name;
				},
			],
			'name',
			'code',
			//			'image',
			'in_stock',
			'base_price',
			// 'description',
			// 'distribute_sale',
			// 'agent_sale',
			// 'retail_sale',
			// 'created_date',
			// 'supplier',
			// 'order_number',
			// 'bill_number',
			// 'bill_image',
			// 'receiver',
			// 'deliver',
			// 'color',
			// 'weight',
			// 'unit',
			// 'status',
			// 'price_tax',
			// 'supplier_discount',
			// 'updated_date',
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
