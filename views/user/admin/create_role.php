<?php
/**
 * Created by Navatech.
 * @project ordermana
 * @author  LocPX
 * @email   loc.xuanphama1t1[at]gmail.com
 * @date    11/30/2016
 * @time    4:39 PM
 */
use app\components\Model;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php if(Yii::$app->user->identity->role_id == Model::ROLE_ADMIN) { ?>
	<?= Html::a('Tạo tài khoản admin công ty', Url::to([
		'/user/admin/create',
		'role' => Model::ROLE_ADMIN,
	]), ['class' => 'btn btn-danger']) ?>
	<?= Html::a('Tạo tài khoản đại diện', Url::to([
		'/user/admin/create',
		'role' => Model::ROLE_PRE,
	]), ['class' => 'btn btn-warning']) ?>
<?php } ?>
<?php if(Yii::$app->user->identity->role_id == Model::ROLE_ADMIN || Yii::$app->user->identity->role_id < Model::ROLE_BIGA ) { ?>

	<?= Html::a('Tạo tài khoản đại lý bán buôn', Url::to([
		'/user/admin/create',
		'role' => Model::ROLE_BIGA,
	]), ['class' => 'btn btn-info']) ?>
<?php } ?>
<?php if(Yii::$app->user->identity->role_id == Model::ROLE_ADMIN || Yii::$app->user->identity->role_id < Model::ROLE_A ) { ?>
	<?= Html::a('Tạo tài khoản đại lý bán lẻ', Url::to([
		'/user/admin/create',
		'role' => Model::ROLE_A,
	]), ['class' => 'btn btn-primary']) ?>
<?php } ?>
<?php if(Yii::$app->user->identity->role_id == Model::ROLE_ADMIN || Yii::$app->user->identity->role_id < Model::ROLE_D) { ?>
	<?= Html::a('Tạo tài khoản điểm phân phối', Url::to([
		'/user/admin/create',
		'role' => Model::ROLE_D,
	]), ['class' => 'btn btn-default']) ?>
<?php } ?>