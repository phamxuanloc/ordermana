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
$onSelect      = new JsExpression(<<<JS
function (undefined,item) {
 var data_phone = $('.modal-body').find('#phone p');
 var data_email = $('.modal-body').find('#email p');
 var data_city = $('.modal-body').find('#city p');
 var data_id = $('.modal-body').find('#id-num p');
 var data_username = $('.modal-body').find('#username p');
 var data_created = $('.modal-body').find('#created p');
 var data_quantity = $('.modal-body').find('#quantity p');
 var data_amount = $('.modal-body').find('#amount p');
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
			data_quantity.html(data.quantity);
			data_amount.html(data.amount);
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
					<h4 class="modal-title" style="color: #00aa00; font-weight: bold">Thông tin cơ bản</h4>
				</div>
				<div class="modal-body">
					<div class="col-sm-6" id="username" style="color: #7a43b6; font-weight: bold">Têm đămg nhập:
						<p style="display: inline-block; color: #3fbf79"></p></div>
					<div class="col-sm-6" id="created" style="color: #7a43b6; font-weight: bold">Ngày tạo:
						<p style="display: inline-block;color: #3fbf79""></p></div>
					<div class="col-sm-6" id="phone" style="color: #7a43b6; font-weight: bold">Số điện thoại:
						<p style="display: inline-block;color: #3fbf79""></p></div>
					<div class="col-sm-6" id="id-num" style="color: #7a43b6; font-weight: bold">Số chứng minh thư:
						<p style="display: inline-block;color: #3fbf79""></p></div>
					<div class="col-sm-6" id="city" style="color: #7a43b6; font-weight: bold">Thành phố:
						<p style="display: inline-block;color: #3fbf79""></p></div>
					<div class="col-sm-6" id="email" style="color: #7a43b6; font-weight: bold">Email:
						<p style="display: inline-block ;color: #3fbf79"></p></div>
					<div class="col-sm-6" id="quantity" style="color: #7a43b6; font-weight: bold">Số sản phẩm đã nhập:
						<p style="display: inline-block ;color: #3fbf79"></p></div>
					<div class="col-sm-6" id="amount" style="color: #7a43b6; font-weight: bold">Tổng số tiền đã nhập hàng:
						<p style="display: inline-block ;color: #3fbf79"></p> VNĐ
					</div>
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