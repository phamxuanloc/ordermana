<?php
use app\models\Customer;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title                   = 'Danh sách khách hàng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			'address',
			'email:email',
			'phone',
			[
				'attribute' => 'city_id',
				'value'     => function (Customer $data) {
					return $data->city->name;
				},
			],
			// 'user_id',
			// 'point',
			[
				'attribute' => 'parent_id',
				'value'     => function (Customer $data) {
					return $data->parent->username;
				},
			],
			// 'is_move',
			// 'link_fb',
			// 'sale',
			// 'note:ntext',
			// 'is_call',
			// 'call_by',
			// 'call_at',
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
