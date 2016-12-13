<?php
use execut\widget\TreeView;
use yii\bootstrap\Modal;
use yii\web\JsExpression;
use yii\widgets\Pjax;

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
$onSelect      = new JsExpression(<<<JS
function (undefined,item) {
 var data_phone = $('.modal-body').find('#phone p');
 var data_email = $('.modal-body').find('#email p');
 var data_city = $('.modal-body').find('#city p');
 var data_id = $('.modal-body').find('#id-num p');
 var data_username = $('.modal-body').find('#username p');
 var data_created = $('.modal-body').find('#created p');
       $.ajax({
			url    : item.url,
			type   : "post",
			data   : {
				a: 1
			},
				dataType: "json",
			success: function(data) {
			data_phone.html(data.phone);
			data_email.html(data.email);
			data_city.html(data.city);
			data_id.html(data.id);
			data_created.html(data.created);
			data_username.html(data.username);
			}
			
		});
	
}
JS
);
$groupsContent = TreeView::widget([
	'data'          => $data,
	'size'          => TreeView::TEMPLATE_ADVANCED,
	'header'        => 'Cây hệ thống',
	'searchOptions' => [
		'inputOptions' => [
			'placeholder' => 'Tìm kiếm tài khoản .....',
		],
	],
	'defaultIcon'   => 'glyphicon glyphicon-user',
	'clientOptions' => [
		'onNodeSelected'    => $onSelect,
		'selectedBackColor' => 'rgb(40, 153, 57)',
		'borderColor'       => '#fff',
		'enableLinks'       => true,
		//		'emptyIcon'         => 'glyphicon glyphicon-remove-sign',
		'levels'            => 2,
		'color'             => 'green',
	],
]); ?>
	<p>Chú thích</p>
	<p>
		<button type="button" class="btn btn-danger">Admin(<?= $adm_num ?>)</button>
		<button type="button" class="btn btn-warning">Đại diện(<?= $pre_num ?>)</button>
		<button type="button" class="btn btn-info">Đại lí bán buôn(<?= $big_num ?>)</button>
		<button type="button" class="btn btn-primary">Đại lý(<?= $age_num ?>)</button>
		<button type="button" class="btn btn-default">Nhà phân phối(<?= $dis_num ?>)</button>
	</p>

	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Thông tin cơ bản</h4>
				</div>
				<div class="modal-body">
					<div class="col-sm-6" id="username">Têm đămg nhập: <p style="display: inline-block"></p></div>
					<div class="col-sm-6" id="created">Ngày tạo: <p style="display: inline-block"></p></div>
					<div class="col-sm-6" id="phone">Số điện thoại:  <p style="display: inline-block"></p></div>
					<div class="col-sm-6" id="id-num">Số chứng minh thư: <p style="display: inline-block"></p></div>
					<div class="col-sm-6" id="city">Thành phố: <p style="display: inline-block"></p></div>
					<div class="col-sm-6" id="email">Email; <p style="display: inline-block"></p></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

<?php
echo $groupsContent;
?>