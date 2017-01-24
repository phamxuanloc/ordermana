<?php
use app\models\User;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\widgets\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

//use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
$this->title                   = 'Chi tiết đơn hàng';
$this->params['breadcrumbs'][] = [
	'label' => 'Orders',
	'url'   => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="customer-order">
	<h1><?= Html::encode($this->title) ?></h1>
	<div class="portlet yellow-crusta box">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-cogs"></i>Chi tiết đơn hàng
			</div>
			<div class="actions">
				<a href="javascript:;" class="btn btn-default btn-sm">
					<i class="fa fa-pencil"></i> Edit </a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="row static-info">

				<div class="col-md-5 name">
					Mã đơn #:
				</div>
				<div class="col-md-7 value">
                             <span class="label label-info label-sm">
	                             LN-Center-00<?= $order->id ?></span>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-5 name">
					Ngày tạo:
				</div>
				<div class="col-md-7 value">
					<?= $order->created_date ?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-5 name">
					Trạng thái:
				</div>
				<div class="col-md-7 value">
							<span class="label label-success">
								<?= $order::STATUS[$order->status] ?> </span>
				</div>
			</div>

			<div class="row static-info">
				<div class="col-md-5 name">
					Tổng tiền:
				</div>
				<div class="col-md-7 value">
					<?= $order->total_amount ?> VNĐ
				</div>
			</div>
		</div>
	</div>
</div>
<div class="customer-form">

	<?php $form = ActiveForm::begin([
		'layout'  => 'horizontal',
		'options' => [
			'enctype' => 'multipart/form-data',
		],
	]); ?>

	<?= $form->field($model, 'name')->textInput([
		'maxlength' => true,
		'readOnly'  => $model->isNewRecord ? false : true,
	]) ?>
	<?= $form->field($model, 'image')->widget(FileInput::className(), [
		'options'       => ['accept' => 'image/*'],
		'pluginOptions' => [
			'allowedFileExtensions' => [
				'jpg',
				'gif',
				'png',
			],
			'showUpload'            => false,
			'initialPreview'        => $model->getIsNewRecord() ? [
				Html::img(Yii::$app->urlManager->baseUrl . '/uploads/no_image_thumb.gif', ['class' => 'file-preview-image']),
			] : [
				Html::img($model->getPictureUrl('avatar'), ['class' => 'file-preview-image']),
			],
		],
	]); ?>
	<?= $form->field($model, 'address')->textInput([
		'maxlength' => true,
		'readOnly'  => $model->isNewRecord ? false : true,
	]) ?>

	<?= $form->field($model, 'email')->textInput([
		'maxlength' => true,
		'readOnly'  => $model->isNewRecord ? false : true,
	]) ?>
	<?= $form->field($model, 'birthday')->widget(DatePicker::className(), [
		'pluginOptions' => [
			'autoclose' => true,
			'format'    => 'yyyy-mm-dd',
		],
		'options'       => [
			'readOnly' => $model->isNewRecord ? false : true,
		],
	]) ?>
	<?= $form->field($model, 'phone')->textInput([
		'value'    => $phone,
		'readOnly' => $model->isNewRecord ? false : true,
	]) ?>
	<?= $form->field($model, 'id_number')->textInput([
		'readOnly' => $model->isNewRecord ? false : true,
	]) ?>

	<?= $form->field($model, 'city_id')->widget(Select2::className(), [
		'data'    => ArrayHelper::map(\app\models\City::find()->andWhere([
			'status' => 1,
		])->all(), 'name', 'name'),
		'options' => [
			'readOnly' => $model->isNewRecord ? false : true,
		],
	])->label('Thành phố') ?>

	<?= $form->field($model, 'link_fb')->textInput([
		'maxlength' => true,
		'readOnly'  => $model->isNewRecord ? false : true,
	]) ?>
	<!--	--><?php //echo $form->field($model, 'source')->textInput() ?>
	<?php echo $form->field($model, 'product')->textInput([
		'readOnly' => $model->isNewRecord ? false : true,
	]) ?>
	<?= $form->field($model, 'note')->textarea([
		'rows'     => 6,
		'readOnly' => $model->isNewRecord ? false : true,
	]) ?>

	<div class="col-sm-offset-3">
		<?= Html::submitButton('Thanh toán', ['class' => 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
