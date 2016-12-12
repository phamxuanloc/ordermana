<?php
use app\models\Customer;
use yii\grid\GridView;
use yii\helpers\Html;

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
			[
				'class'  => 'yii\grid\SerialColumn',
				'header' => 'STT',
			],
			'created_date',
			'name',
			'address',
			[
				'attribute' => 'birthday',
				'value'     => function (Customer $data) {
					return $data->birthday != null ? Yii::$app->formatter->asDate($data->birthday, 'Y-M-d') : '';
				},
			],
			'email:email',
			'phone',
			'id_number',
			[
				'attribute' => 'city_id',
				'value'     => function (Customer $data) {
					return $data->city->name;
				},
			],
			[
				'attribute' => 'user_id',
				'value'     => function (Customer $data) {
					return $data->user->username;
				},
			],
			// 'point',
			[
				'attribute' => 'parent_id',
				'value'     => function (Customer $data) {
					return $data->parent->username;
				},
			],
			'source',
			'product',
			// 'is_move',
			'link_fb',
			// 'sale',
			'note:ntext',
			[
				'attribute' => 'is_call',
				'value'     => function (Customer $data) {
					return $data::IS_CALL[$data->is_call];
				},
			],
			'call_by',
			'call_at',
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
