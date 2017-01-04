<?php
use app\components\Model;
use app\controllers\CustomerController;
use app\controllers\CustomerItemController;
use app\models\Customer;
use kartik\editable\Editable;
use kartik\file\FileInput;
use kartik\grid\GridView;
use navatech\role\helpers\RoleChecker;
use yii\bootstrap\ActiveForm;
//use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title                   = 'Danh sách khách hàng';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="customer-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?= $this->render('/_alert', [
		'module' => Yii::$app->getModule('user'),
	]) ?>
	<?php if(Yii::$app->user->identity->role_id == Model::ROLE_ADMIN) { ?>
		<?php $form = ActiveForm::begin([
			'layout'  => 'horizontal',
			'options' => [
				'enctype' => 'multipart/form-data',
			],
		]); ?>
		<?= $form->field($file, 'excel', [
		])->widget(FileInput::className(), [
			'pluginOptions' => [
				'allowedFileExtensions' => [
					'xlsx',
				],
				'showUpload'            => false,
			],
		]) ?>
		<!--	<button style="float: right;clear: right">--><?php //echo  ?><!--</button>-->
		<?= Html::submitButton('Import Excel', [
			'class'    => 'btn green uppercase col-sm-offset-3',
			'tabindex' => '3',
			//		'style'    => 'float: right;clear: right',
		]) ?>
		<?php ActiveForm::end(); ?>
	<?php } ?>
	<div class="clearfix"></div>
	<div class="panel panel-danger" style="margin-top: 20px">
		<div class="panel-heading">Tìm kiếm</div>
		<div class="panel-body">
			<?php echo $this->render('_search', ['model' => $searchModel]); ?>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="panel panel-info" style="margin-top: 20px">
		<div class="panel-heading">Tổng quan</div>
		<div class="panel-body">
			<p style="font-size: 20px">Số lượng khách hàng: <?= $quantity ?></p>
			<p style="font-size: 20px">Số lượng hàng đã mua: <?= $quantity_item ?></p>
		</div>
	</div>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		//		'export'       => false,
		'pjax'         => true,
		'columns'      => [
			[
				'class' => 'kartik\grid\SerialColumn',
				//             'header' => 'STT',
			],
			'created_date',
			[
				'class'           => 'kartik\grid\EditableColumn',
				'attribute'       => 'name',
				'editableOptions' => [
					'inputType' => \kartik\editable\Editable::INPUT_TEXT,
					//					'asPopover' => false
					//										'options'=>[
					//											'pluginOptions'=>['min'=>0, 'max'=>5000]
					//										]
				],
			],
			'address',
			[
				'attribute' => 'birthday',
				'value'     => function (Customer $data) {
					return $data->birthday != null ? Yii::$app->formatter->asDate($data->birthday, 'd-M-Y') : '';
				},
			],
			'email:email',
			[
				'class'           => 'kartik\grid\EditableColumn',
				'attribute'       => 'phone',
				'editableOptions' => [
					'inputType' => \kartik\editable\Editable::INPUT_TEXT,
				],
			],
			'id_number',
			[
				'class'           => 'kartik\grid\EditableColumn',
				'attribute'       => 'city_id',
				'editableOptions' => [
					'inputType' => Editable::INPUT_DROPDOWN_LIST,
					'data'      => ArrayHelper::map(\app\models\City::find()->andWhere([
						'status' => 1,
					])->all(), 'name', 'name'),
				],
			],
			[
				'attribute' => 'user_id',
				'value'     => function (Customer $data) {
					return $data->users->username;
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
			[
				'attribute' => 'count',
				'value'     => function (Customer $data) {
					return $data->getProductCount();
				},
			],
			'call_by',
			'call_at',
			[
				'class'          => 'yii\grid\ActionColumn',
				'header'         => 'Hành động',
				'visibleButtons' => [
					'view'   => RoleChecker::isAuth(CustomerItemController::className(), 'detail'),
					'update' => RoleChecker::isAuth(CustomerController::className(), 'update'),
					'delete' => RoleChecker::isAuth(CustomerController::className(), 'delete'),
				],
				'buttons'        => [
					'view' => function ($url, $model, $key) {
						return Html::a('<i class="fa fa-shopping-cart" aria-hidden="true"></i>', Url::to([
							'customer-item/detail',
							'id' => $model->id,
						]));
					},
				],
			],
		],
	]); ?>
</div>
<script>
	//	var outer=document.getElementsByClassName('page-content ').offsetWidth;
	//	var inner=document.getElementById('grid-view').offsetWidth;
	//	console.log($(window).width());
	window.scrollTo(200, 10);
</script>
