<?php
/**
 * Created by Navatech.
 * @project ordermana
 * @author  LocPX
 * @email   loc.xuanphama1t1[at]gmail.com
 * @date    11/28/2016
 * @time    11:42 PM
 */
namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class LoginAsset extends AssetBundle {

	public $basePath  = '@webroot';

	public $baseUrl   = '@web';

	public $css       = [
		//		'css/site.css',
		'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
		'global/plugins/font-awesome/css/font-awesome.min.css',
		'global/plugins/simple-line-icons/simple-line-icons.min.css',
		'global/plugins/bootstrap/css/bootstrap.min.css',
		'global/plugins/uniform/css/uniform.default.css',
		'admin/pages/css/login.css',
		'global/css/components.css',
		'global/css/plugins.css',
		'admin/layout/css/layout.css',
		'admin/layout/css/themes/darkblue.css',
		'admin/layout/css/custom.css',
		'css/style.css',
	];

	public $js        = [
//		'global/plugins/respond.min.js',
//		'global/plugins/excanvas.min.js',
//		'global/plugins/jquery.min.js',
//		'global/plugins/jquery-migrate.min.js',
//		'global/plugins/jquery-ui/jquery-ui.min.js',
//		'global/plugins/bootstrap/js/bootstrap.min.js',
//		'global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
//		'global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
//		'global/plugins/jquery.blockui.min.js',
//		'global/plugins/jquery.cokie.min.js',
//		'global/plugins/uniform/jquery.uniform.min.js',
//		'global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
//		'global/plugins/jquery.pulsate.min.js',
//		'global/plugins/jquery.sparkline.min.js',
//		'global/scripts/metronic.js',
//		'admin/layout/scripts/layout.js',
//		'admin/layout/scripts/quick-sidebar.js',
//		'admin/pages/scripts/index.js',
//		'admin/pages/scripts/tasks.js',
//		'admin/layout/scripts/demo.js',
//		'admin/pages/scripts/login.js',
	];

//	public $jsOptions = ['position' => View::POS_HEAD];

	public $depends   = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapPluginAsset',
	];
}