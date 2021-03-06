<?php
use execut\widget\TreeView;
use yii\web\JsExpression;

?>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<?php
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
 var data_username = $('.modal-body').find('#username p');
 var data_quantity = $('.modal-body').find('#quantity select');
 var data_amount = $('.modal-body').find('#amount p');
 var data_last_amount = $('.modal-body').find('#last-amount p');
 var data_last_last_amount = $('.modal-body').find('#last-last-amount p');
 var data_orderc=$('.modal-body').find('#orderc p');
 var data_last_orderc=$('.modal-body').find('#last-orderc p');
 var data_last_last_orderc=$('.modal-body').find('#last-last-orderc p');
 var data_order=$('.modal-body').find('#order p');
 var data_last_order=$('.modal-body').find('#last-order p');
 var data_last_last_order=$('.modal-body').find('#last-last-order p');
 
 var data_cstock=$('.modal-body').find('#current_stock p');
 var data_issue=$('.modal-body').find('#issue p');
 var data_cissue=$('.modal-body').find('#customer_issue p');
 var data_csystem=$('.modal-body').find('#customer_system p');
 var data_crevenue=$('.modal-body').find('#change_revenue p');
 var data_fb=$('.modal-body').find('#fb_link p');
 var data_fblink=$('.modal-body').find('#fb_link a');       
       $.ajax({
			url    : item.url,
			type   : "post",
             async: false,
			data   : {
				a: 1
			},
				dataType: "json",
			success: function(data) {
			data_amount.html(data.amount);
			data_last_amount.html(data.previous_amount);
			data_last_last_amount.html(data.p_previous_amount);
				data_orderc.html(data.customer_issue);
				data_last_orderc.html(data.previous_customer_issue);
				data_last_last_orderc.html(data.p_previous_customer_issue);	
				data_order.html(data.issue);
				data_last_order.html(data.previous_issue);
				data_last_last_order.html(data.p_previous_issue);
			data_username.html(data.username);
			data_quantity.html(data.quantity);
			
			data_cstock.html(data.current_stock);
			data_issue.html(data.issue);
			data_cissue.html(data.customer_issue);
			// data_csystem.html(data.customer_system);
			// data_crevenue.html(data.change_revenue);
			data_fb.html(data.fb_link);
			data_fblink.attr("href",data.fb_link);
			
			// Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
 
    function drawChart() {
    // var jsonData = $.ajax({
    //       url: item.url,
    //       			type   : "post",
	//
    //       data   : {
    //          a: 1,
		//      b: 1
		// 	},
    //       dataType: "json",
    //       async: false
    //       }).responseText;
     // var data = new google.visualization.DataTable();
     var amount_chart=[];
     var order_chart=[];
     var orderc_chart=[];
     if(data.previous_amount==0&&data.amount==0&&data.p_previous_amount==0){
     amount_chart=[
        {"c":[{"v":"Không có dữ liệu","f":null},{"v":1,"f":null}]},
      ]
     }else {
      amount_chart=[
        {"c":[{"v":"T "+data.current,"f":null},{"v":data.amount,"f":null}]},
        {"c":[{"v":"T "+data.previous_month,"f":null},{"v":data.previous_amount,"f":null}]},
        {"c":[{"v":"T "+data.p_previous_month,"f":null},{"v":data.p_previous_amount,"f":null}]},
      ]
     }
     if(data.issue==0&&data.previous_issue==0&&data.p_previous_issue==0){
     order_chart=[
        {"c":[{"v":"Không có dữ liệu","f":null},{"v":1,"f":null}]},
      ]
     }else {
      order_chart=[
        {"c":[{"v":"T "+data.current,"f":null},{"v":data.issue,"f":null}]},
        {"c":[{"v":"T "+data.previous_month,"f":null},{"v":data.previous_issue,"f":null}]},
        {"c":[{"v":"T "+data.p_previous_month,"f":null},{"v":data.p_previous_issue,"f":null}]},
      ]
     }
     if(data.customer_issue==0&&data.previous_customer_issue==0&&data.p_previous_customer_issue==0){
     orderc_chart=[
        {"c":[{"v":"Không có dữ liệu","f":null},{"v":1,"f":null}]},
      ]
     }else {
      orderc_chart=[
        {"c":[{"v":"T "+data.current,"f":null},{"v":data.customer_issue,"f":null}]},
        {"c":[{"v":"T "+data.previous_month,"f":null},{"v":data.previous_customer_issue,"f":null}]},
        {"c":[{"v":"T "+data.p_previous_month,"f":null},{"v":data.p_previous_customer_issue,"f":null}]},
      ]
     }
		var data_chart = new google.visualization.DataTable({
  "cols": [
        {"id":"","label":"Topping","pattern":"","type":"string"},
        {"id":"","label":"Slices","pattern":"","type":"number"}
      ],
  "rows": amount_chart
});
							// Set chart options
							var options = {
								'title' : 'Doanh thu tháng',
								'width' : 295,
								'height': 300
							};
							
							
							var data_order = new google.visualization.DataTable({
  "cols": [
        {"id":"","label":"Topping","pattern":"","type":"string"},
        {"id":"","label":"Slices","pattern":"","type":"number"}
      ],
  "rows": order_chart
});
							// Set chart options
							var options_order = {
								'title' : 'Doanh thu bán buôn',
								'width' : 295,
								'height': 300
							};
							
							var data_orderc = new google.visualization.DataTable({
  "cols": [
        {"id":"","label":"Topping","pattern":"","type":"string"},
        {"id":"","label":"Slices","pattern":"","type":"number"}
      ],
  "rows": orderc_chart
});
							// Set chart options
							var options_orderc = {
								'title' : 'Doanh thu bán lẻ',
								'width' : 295,
								'height': 300
							};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data_chart, options);
      var chart_order = new google.visualization.PieChart(document.getElementById('chart_order'));
      chart_order.draw(data_order, options_order);
      var chart_orderc = new google.visualization.PieChart(document.getElementById('chart_orderc'));
      chart_orderc.draw(data_orderc, options_orderc);
    }
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
		<button type="button" class="btn btn-success">Đại lý(<?= $big_num ?>)</button>
		<button type="button" class="btn btn-primary">Đại lý bán lẻ| NPP(<?= $age_num ?>)</button>
		<button type="button" class="btn btn-default">Điểm phân phối(<?= $dis_num ?>)</button>
	</p>

	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog modal-lg">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" style="color: #00aa00; font-weight: bold">Thông tin cơ bản</h4>
				</div>
				<div class="modal-body">
					<div class="col-sm-12">
						<div class="col-sm-3 text-center well well-sm"><strong>Tháng</strong></div>
						<div class="col-sm-3 text-center"><?= $p_previous_month ?></div>
						<div class="col-sm-3 text-center"><?= $previous_month ?></div>
						<div class="col-sm-3 text-center"><?= date('m') ?></div>
					</div>
					<div class="col-sm-12">

						<div class="col-sm-3 text-center well well-sm"><strong>Tổng doanh thu</strong></div>
						<div class="col-sm-3 text-center" id="last-last-amount"><p>0</p></div>
						<div class="col-sm-3 text-center" id="last-amount"><p></p></div>
						<div class="col-sm-3 text-center" id="amount"><p>0</p></div>
					</div>
					<div class="col-sm-12">

						<div class="col-sm-3 text-center well well-sm"><strong>Doanh thu bán buôn</strong></div>
						<div class="col-sm-3 text-center last-last-orderc"><p>0</p></div>
						<div class="col-sm-3 text-center last-orderc"><p>0</p></div>
						<div class="col-sm-3 text-center orderc"><p>0</p></div>
					</div>
					<div class="col-sm-12" style="border-bottom: solid black 1px">

						<div class="col-sm-3 text-center well well-sm"><strong>Doanh thu bán lẻ</strong></div>
						<div class="col-sm-3 text-center last-last-order"><p>0</p></div>
						<div class="col-sm-3 text-center last-order"><p>0</p></div>
						<div class="col-sm-3 text-center order"><p>0</p></div>
					</div>
					<div class="col-sm-12" style="border-bottom: solid black 1px">
						<div id="chart_div" class="col-sm-4"></div>
						<div id="chart_order" class="col-sm-4"></div>
						<div id="chart_orderc" class="col-sm-4"></div>
					</div>
					<div class="col-sm-6" id="username" style="    min-height: 30px;color: #7a43b6; font-weight: bold">Têm đămg nhập:
						<p style="display: inline-block; color: #3fbf79"></p></div>
					<div class="col-sm-6" id="fb_link" style="    min-height: 30px;display: inline-block; color: #7a43b6; font-weight: bold">Link fb:
						<a href="#"><p style="display: inline-block; color: #3fbf79"></p></a></div>
					<div class="col-sm-6" id="current_stock" style="color: #7a43b6; font-weight: bold">Tổng số hàng đã nhập tháng này:
						<p style="display: inline-block ;color: #3fbf79"></p>
					</div>
					<!--					<div class="col-sm-6" id="amount" style="color: #7a43b6; font-weight: bold">Tổng số tiền đã nhập hàng tháng này:-->
					<!--						<p style="display: inline-block ;color: #3fbf79"></p> VNĐ-->
					<!--					</div>-->
					<!--					<div class="col-sm-6" id="issue" style="color: #7a43b6; font-weight: bold">Tổng tiền xuất hàng tháng này:-->
					<!--						<p style="display: inline-block;color: #3fbf79"></p> VNĐ-->
					<!--					</div>-->
					<!--					<div class="col-sm-6" id="customer_issue" style="color: #7a43b6; font-weight: bold">Tổng tiền bán lẻ tháng này:-->
					<!--						<p style="display: inline-block;color: #3fbf79""></p></div>-->
					<!--					<div class="col-sm-6" id="customer_system" style="color: #7a43b6; font-weight: bold">Bán lẻ trong hệ thống tháng này:-->
					<!--						<p style="display: inline-block;color: #3fbf79""></p> VNĐ-->
					<!--					</div>-->
					<!--					<div class="col-sm-6" id="change_revenue" style="color: #7a43b6; font-weight: bold">Thay đổi so với cùng kỳ tháng trước:-->
					<!--						<p style="display: inline-block;color: #3fbf79""></p> %-->
					<!--					</div>-->
					<div class="col-sm-6" id="quantity" style="color: #7a43b6; font-weight: bold">
						<form><label>
								<select></select>
							</label></form>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
<?= $this->render('/_alert', [
	'module' => Yii::$app->getModule('user'),
]) ?>
<?php
echo $groupsContent;
?>