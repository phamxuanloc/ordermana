<?php
use execut\widget\TreeView;
use yii\web\JsExpression;

/** @var app\components\Model $model */
$data = $model->getUserTree();
//$data = [
//	[
//		'text'  => 'admin',
//		'nodes' => [
//			[
//				'text'  => 'user_pre2',
//				'nodes' => [
//					[
//						'text' => 'user_pre',
//					],
//					[
//						'text' => 'agent1',
//					],
//				],
//			],
//			[
//				'text' => 'admin23',
//			],
//			[
//				'text' => 'admin2222',
//			],
//			[
//				'text' => '123456',
//			],
//			[
//				'text' => 'admin2222ds',
//			],
//		],
//	],
//	[
//		'text' => 'admin22',
//	],
//	[
//		'text' => '123213213',
//	],
//	[
//		'text' => '123123',
//	],
//];
//$onSelect      = new JsExpression(<<<JS
//     function (undefined, item) {
//    console.log(item);
//}
//JS
//);
$groupsContent = TreeView::widget([
	'data'          => $data,
	'size'          => TreeView::TEMPLATE_ADVANCED,
	'header'        => 'Cây hệ thống',
	'searchOptions' => [
		'inputOptions' => [
			'placeholder' => 'Tìm kiếm tài khoản .....',
		],
	],
	'defaultIcon'=>'glyphicon glyphicon-user',
	'clientOptions' => [
		//		'on'nodes'elected'    => $onSelect,
		'selectedBackColor' => 'rgb(40, 153, 57)',
		'borderColor'       => '#fff',
		'enableLinks'       => true,
//		'emptyIcon'         => 'glyphicon glyphicon-remove-sign',
		'levels'            => 2,
		'color'=>'green'
	],
]);
echo $groupsContent;
?>