<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title                   = 'Lịch sử nhập kho';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-history-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php  echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		//		'filterModel'  => $searchModel,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],
			//			'id',
			//			'category_id',
			'created_date',
			'receipted_date',
			'name',
			'code',
			'old_value',
			'new_value',
			// 'product_id',
			// 'supplier',
			// 'bill_image',
			'bill_number',
			'order_number',
			'receiver',
			'deliver',
			'color',
			'weight',
			'unit',
			'price_tax',
			[
				'attribute' => 'status',
				'value'     => function (\app\models\ProductHistory $data) {
					return $data::STATUS[$data->status];
				},
			],
			[
				'class'    => 'yii\grid\ActionColumn',
				'header'   => 'Hành động',
				'template' => '{update} {delete}',
			],
		],
	]); ?>
</div>
