<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 1/24/2017
 * Time: 9:16 AM
 * @var \app\models\CenterItem $items
 */
use app\assets\AppAsset;
use yii\helpers\Html;

\app\assets\PrintAsset::register($this);
?>
<?php $this->beginPage() ?>
	<!DOCTYPE html>
	<html lang="<?= Yii::$app->language ?>" class="no-js">
	<head>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
	</head>
	<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
	<?php $this->beginBody() ?>
	<h2 style="text-align: center">Đơn hàng #LN-Center-00<?= $model->id ?></h2>
	<div style="font-weight: bold;width: 33.33333333%; display: inline-block;float: left">Tên sản phẩm</div>
	<div style="font-weight: bold;width: 33.33333333%;display: inline-block;float: left">Số lượng</div>
	<div style="font-weight: bold;width: 33.33333333%;display: inline-block;float: left">Thành tiền</div>
	<?php
	foreach($items as $item) {
		?>
		<div style="font-weight: bold;width: 33.33333333%;display: inline-block;float: left"><?= $item->product->name ?></div>
		<div style="font-weight: bold;width: 33.33333333%;display: inline-block;float: left"><?= $item->quantity ?></div>
		<div style="font-weight: bold;width: 33.33333333%;display: inline-block;float: left"><?= $item->total_price ?></div>
	<?php } ?>
	<div style="float: right; margin-top: 25px">Tổng tiền:<?= $model->total_amount ?></div>
	<?php $this->endBody() ?>
	</body>
	</html>
<?php $this->endPage() ?>