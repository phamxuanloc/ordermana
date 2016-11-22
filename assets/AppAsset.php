<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
	    'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
	    'global/plugins/font-awesome/css/font-awesome.min.css',
	    'global/plugins/simple-line-icons/simple-line-icons.min.css',
	    'global/plugins/bootstrap/css/bootstrap.min.css',
	    'global/plugins/uniform/css/uniform.default.css',
	    'global/plugins/jqvmap/jqvmap/jqvmap.css',
	    'global/plugins/morris/morris.css',
	    'admin/pages/css/tasks.css',
	    'global/css/components-rounded.css',
	    'global/css/plugins.css',
	    'admin/layout3/css/layout.css',
	    'admin/layout3/css/themes/default.css',
	    'admin/layout3/css/custom.css',
    ];
    public $js = [

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
