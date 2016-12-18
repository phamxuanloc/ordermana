<?php
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CustomerItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title                   = 'Danh sách sản phẩm của khách hàng ' . \app\models\Customer::findOne($id)->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-item-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
//		'filterModel'  => $searchModel,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'product_id',
				'value'     => function (\app\models\CustomerItem $data) {
					return $data->product->name;
				},
			],
			'quantity',
			'total_price',
			[
				'class' => 'yii\grid\ActionColumn',
			],
		],
	]); ?>
</div>
