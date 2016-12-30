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
<!--	<script>-->
<!--		var OneSignal = window.OneSignal || [];-->
<!--		OneSignal.push(["init", {-->
<!--			appId: "cb897a36-fc44-4820-98cc-b1b94c682040",-->
<!--			autoRegister: false, /* Set to true to automatically prompt visitors */-->
<!--			subdomainName: 'loc123.onesignal.com',-->
<!--			notifyButton: {-->
<!--				enable: true, /* Set to false to hide */-->
<!--				text: {-->
<!--					'tip.state.unsubscribed': 'Đăng ký nhận thông báo video',-->
<!--					'tip.state.subscribed': 'Bạn đã đăng ký nhận thông báo',-->
<!--					'tip.state.blocked': 'Bạn đã chặn hiển thị thông báo',-->
<!--					'message.prenotify': 'Click để đăng ký nhận thông báo về video mới nhất',-->
<!--					'message.action.subscribed': 'Cảm ơn bạn đã đăng ký!',-->
<!--					'message.action.resubscribed': 'Bạn đã đăng ký nhận thông báo',-->
<!--					'message.action.unsubscribed': 'Bạn đã hủy đăng ký nhận thông báo',-->
<!--					'dialog.main.title': 'Quản lý thông báo',-->
<!--					'dialog.main.button.subscribe': 'ĐĂNG KÝ',-->
<!--					'dialog.main.button.unsubscribe': 'HỦY ĐĂNG KÝ',-->
<!--					'dialog.blocked.title': 'Bỏ chặn thông báo',-->
<!--					'dialog.blocked.message': 'Thực hiện các hướng dẫn sau để cho phép thông báo:'-->
<!--				}-->
<!--			},-->
<!--		welcomeNotification: {-->
<!--			title: 'ovuinhi.com',-->
<!--			message: 'Cảm ơn bạn đã đăng ký!'-->
<!--		},-->
<!--			promptOptions: {-->
<!--				siteName: 'ovuinhi.com',-->
<!--				actionMessage: 'Nhận thông báo mới nhất về Video giải trí hài hước với Kênh video Ovuinhi.com.',-->
<!--				exampleNotificationTitle: 'Ovuinhi.com',-->
<!--				exampleNotificationMessage: 'Nhận thông báo video mới nhất',-->
<!--				exampleNotificationCaption: 'Bạn có thể dừng nhận thông báo bất kỳ lúc nào',-->
<!--				acceptButtonText: 'CHO PHÉP',-->
<!--				cancelButtonText: 'BỎ QUA'-->
<!--			}-->
<!--		}]);-->
<!--	</script>-->

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
