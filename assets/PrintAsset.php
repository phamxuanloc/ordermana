<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 1/24/2017
 * Time: 9:31 AM
 */
namespace app\assets;

use yii\web\AssetBundle;

class PrintAsset extends AssetBundle {

	public $basePath = '@webroot';

	public $baseUrl  = '@web';

	public $css      = [//		'css/site.css',
	];

	public $js       = [];

	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapPluginAsset',
	];
}