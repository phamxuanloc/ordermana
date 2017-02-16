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
use app\controllers\AdminController;
use navatech\role\helpers\RoleChecker;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php if(RoleChecker::isAuth(AdminController::className(), 'create-admin', Yii::$app->user->identity->role_id)) { ?>
	<?= Html::a('Tạo tài khoản admin công ty', Url::to([
		'/user/admin/create-admin',
	]), ['class' => 'btn btn-danger']) ?>
<?php } ?>

<?php if(RoleChecker::isAuth(AdminController::className(), 'create-pre', Yii::$app->user->identity->role_id)) { ?>

	<?= Html::a('Tạo tài khoản đại diện', Url::to([
		'/user/admin/create-pre',
	]), ['class' => 'btn btn-warning']) ?>
<?php } ?>
<?php if(RoleChecker::isAuth(AdminController::className(), 'create-big', Yii::$app->user->identity->role_id)) { ?>

	<?= Html::a('Tạo tài khoản đại lý', Url::to([
		'/user/admin/create-big',
	]), ['class' => 'btn btn-success']) ?>
<?php } ?>
<?php if(RoleChecker::isAuth(AdminController::className(), 'create-age', Yii::$app->user->identity->role_id)) { ?>
	<?= Html::a('Tạo tài khoản đại lý bán lẻ| NPP', Url::to([
		'/user/admin/create-age',
	]), ['class' => 'btn btn-primary']) ?>
<?php } ?>
<?php if(RoleChecker::isAuth(AdminController::className(), 'create-dis', Yii::$app->user->identity->role_id)) { ?>
	<?= Html::a('Tạo tài khoản điểm phân phối', Url::to([
		'/user/admin/create-dis',
	]), ['class' => 'btn btn-default']) ?>
<?php } ?>
<?php if(RoleChecker::isAuth(AdminController::className(), 'create-care', Yii::$app->user->identity->role_id)) { ?>
	<?= Html::a('Tạo tài khoản chăm sóc KH', Url::to([
		'/user/admin/create-care',
	]), ['class' => 'btn green']) ?>
<?php } ?>

<?php if(RoleChecker::isAuth(AdminController::className(), 'create-care', Yii::$app->user->identity->role_id)) { ?>
	<?= Html::a('Tạo tài khoản center', Url::to([
		'/user/admin/create-care',
	]), ['class' => 'btn btn-center']) ?>
<?php } ?>
