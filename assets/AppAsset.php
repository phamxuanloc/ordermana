<?php
/**
 * @link      http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license   http://www.yiiframework.com/license/
 */
namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since  2.0
 */
class AppAsset extends AssetBundle {

	public $basePath  = '@webroot';

	public $baseUrl   = '@web';

	public $css       = [
		//		'css/site.css',
		'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
		'global/plugins/font-awesome/css/font-awesome.min.css',
		'global/plugins/simple-line-icons/simple-line-icons.min.css',
		'global/plugins/bootstrap/css/bootstrap.min.css',
		'global/plugins/uniform/css/uniform.default.css',
		'global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
		'global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css',
		'global/plugins/fullcalendar/fullcalendar.min.css',
		'global/plugins/jqvmap/jqvmap/jqvmap.css',
		'admin/pages/css/tasks.css',
		'global/css/components.css',
		'global/css/plugins.css',
		'admin/layout/css/layout.css',
		'admin/layout/css/themes/darkblue.css',
		'admin/layout/css/custom.css',
		'css/style.css',
	];

	public $js        = [
		'global/plugins/respond.min.js',
		'global/plugins/excanvas.min.js',
		//		'global/plugins/jquery.min.js',
		'global/plugins/jquery-migrate.min.js',
		'global/plugins/jquery-ui/jquery-ui.min.js',
		//		'global/plugins/bootstrap/js/bootstrap.min.js',
		'global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
		'global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
		'global/plugins/jquery.blockui.min.js',
		'global/plugins/jquery.cokie.min.js',
		'global/plugins/uniform/jquery.uniform.min.js',
		'global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
		'global/plugins/jqvmap/jqvmap/jquery.vmap.js',
		'global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js',
		'global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js',
		'global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js',
		'global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js',
		'global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js',
		'global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js',
		'global/plugins/flot/jquery.flot.min.js',
		'global/plugins/flot/jquery.flot.resize.min.js',
		'global/plugins/flot/jquery.flot.categories.min.js',
		'global/plugins/jquery.pulsate.min.js',
		'global/plugins/bootstrap-daterangepicker/moment.min.js',
		'global/plugins/bootstrap-daterangepicker/daterangepicker.js',
		'global/plugins/fullcalendar/fullcalendar.min.js',
		'global/plugins/jquery-easypiechart/jquery.easypiechart.min.js',
		'global/plugins/jquery.sparkline.min.js',
		'global/scripts/metronic.js',
		'admin/layout/scripts/layout.js',
		'admin/layout/scripts/quick-sidebar.js',
		'admin/layout/scripts/demo.js',
		'admin/pages/scripts/index.js',
		'admin/pages/scripts/tasks.js',
	];

	public $jsOptions = ['position' => View::POS_HEAD];

	public $depends   = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapPluginAsset',
	];
}
