<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 1/22/2017
 * Time: 4:32 PM
 */
use scotthuangzl\googlechart\GoogleChart;

?>
<?php
echo GoogleChart::widget(array(
	'visualization' => 'PieChart',
	'data'          => $source,
	'options'       => array(
		'title'          => 'Nguồn khách hàng',
		'width'          => '100%',
		'height'         => 500,
		'titleTextStyle' => [
			'color'    => 'orange',
			'fontSize' => 25,
		],
	),
));
echo GoogleChart::widget(array(
	'visualization' => 'PieChart',
	'data'          => $pre,
	'options'       => array(
		'title'          => 'Đại diện nhập KH trong tháng ',
		'width'          => '100%',
		'height'         => 500,
		'titleTextStyle' => [
			'color'    => 'orange',
			'fontSize' => 25,
		],
	),
));
?>
