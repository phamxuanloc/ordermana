<?php
use app\models\UserStock;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserStockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title                   = 'Kho người dùng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-stock-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?php Pjax::begin(); ?>    <?= GridView::widget([
		'dataProvider' => $dataProvider,
		//		'filterModel'  => $searchModel,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'user_id',
				'value'     => function (UserStock $data) {
					return $data->users->username;
				},
			],
			[
				'attribute' => 'product_id',
				'value'     => function (UserStock $data) {
					return $data->product->name;
				},
			],
			'in_stock',
			'created_date',
//			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
	<?php Pjax::end(); ?></div>
