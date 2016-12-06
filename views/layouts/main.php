<?php
/* @var $this \yii\web\View */
/* @var $content string */
use app\components\widgets\LeftSidebar;
use app\components\widgets\TopBar;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
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
<?= TopBar::widget() ?>
<div class="clearfix">
</div>
<div class="page-container">
	<?= LeftSidebar::widget() ?>

	<div class="page-content-wrapper">
		<div class="page-content clearfix">
			<?= $content ?>
		</div>
	</div>
</div>

<footer class="footer">
	<div class="container">
		<p class="pull-left">&copy; My Company <?= date('Y') ?></p>

		<p class="pull-right"><?= Yii::powered() ?></p>
	</div>
</footer>
<script>
	jQuery(document).ready(function() {
		Metronic.init(); // init metronic core componets
		Layout.init(); // init layout
		QuickSidebar.init(); // init quick sidebar
		Demo.init(); // init demo features
		Index.init();
		Index.initDashboardDaterange();
		Index.initJQVMAP(); // init index page's custom scripts
		Index.initCalendar(); // init index page's custom scripts
		Index.initCharts(); // init index page's custom scripts
		Index.initChat();
		Index.initMiniCharts();
		Tasks.initDashboardWidget();
	});
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
