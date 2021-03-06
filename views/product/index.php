<?php
use app\models\Product;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title                   = 'Kho sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<div class="panel panel-info">
		<div class="panel-heading">Tìm kiếm</div>
		<div class="panel-body">
			<?php echo $this->render('_search', ['model' => $searchModel]); ?>
		</div>
	</div>
	<p>
		<?= Html::a('Nhập sản phẩm mới vào kho', ['receipt'], ['class' => 'btn btn-success']) ?>
	</p>
	<p>
		<?= Html::a('Thêm sản phẩm đã có vào kho', ['product-history/create'], ['class' => 'btn btn-info']) ?>
	</p>
	<div class="panel panel-default">
		<div class="panel-heading">Thống kê</div>
		<div class="panel-body">
			<p>Tổng số hàng còn trong kho: <?= $product_num ?> Sản phẩm</p>
		</div>
	</div>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		//		'filterModel'  => $searchModel,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'created_date',
//				'value'     => function (Product $data) {
//					return Yii::$app->formatter->asDate($data->created_date);
//				},
			],
//			[
//				'attribute' => 'receipted_date',
//				'value'     => function (Product $data) {
//					return Yii::$app->formatter->asDate($data->receipted_date, 'H:m:s d-M-Y');
//				},
//				'format'    => 'raw',
//			],
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
//			'base_price',
			// 'description',
			// 'distribute_sale',
			// 'agent_sale',
			// 'retail_sale',
			// 'supplier',
			// 'order_number',
			// 'bill_number',
			// 'bill_image',
			// 'receiver',
			// 'deliver',
			// 'color',
			// 'weight',
			// 'unit',
//			[
//				'attribute' => 'status',
//				'value'     => function (Product $data) {
//					return $data::STATUS[$data->status];
//				},
//			],
			// 'price_tax',
			// 'supplier_discount',
			// 'updated_date',
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
