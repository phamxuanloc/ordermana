<?php
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AlertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title                   = 'Thông báo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alert-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Tạo thông báo', ['create'], ['class' => 'btn btn-success']) ?>
	</p>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		//        'filterModel' => $searchModel,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'content',
				'format'    => 'raw',
			],
			[
				'attribute' => 'role_id',
				'value'     => function (\app\models\Alert $data) {
					$role = \yii\helpers\ArrayHelper::merge(['ALL'], $data::ROLE);
					return $role[$data->role_id];
				},
			],
			'created_date',
			[
				'class'    => 'yii\grid\ActionColumn',
				'header'   => 'Thao tác',
				'template' => '{update} {delete}',
			],
		],
	]); ?>
</div>
