<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 1/24/2017
 * Time: 9:12 AM
 */
?>
	<iframe src="<?= \yii\helpers\Url::to([
		'sale',
		'id' => $model->id,
	]) ?>" id="printf" name="printf" height="400" width="100%">
	</iframe>
<?= \yii\bootstrap\Html::a('Kết thúc', \yii\helpers\Url::to(['create']), ['class' => 'btn btn-success']) ?>