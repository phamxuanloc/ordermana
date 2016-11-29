<?php
use app\models\Category;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title                   = 'Danh mục';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Thêm mới danh mục', ['create'], ['class' => 'btn btn-success']) ?>
	</p>
	<?php Pjax::begin(); ?>    <?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel'  => $searchModel,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			[
				'attribute' => 'parent_id',
				'value'     => function (Category $data) {
					return Category::findOne($data->parent_id) !== null ? Category::findOne($data->parent_id)->name : 'Không có';
				},
				'filter'    => $searchModel->getCategoryOrder(),
			],
			[
				'attribute' => 'status',
				'value'     => function (Category $data) {
					return $data::STATUS[(int) $data->status];
				},
				'filter'    => $searchModel::STATUS,
			],
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
	<?php Pjax::end(); ?></div>
