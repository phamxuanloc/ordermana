<?php
/* @var $this yii\web\View */
use app\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $model app\models\Order */
/* @var $items app\models\OrderItem */
/* @var $item app\models\OrderItem */
$this->title                   = 'Chi tiết đơn hàng #LN-00' . $model->id;
$this->params['breadcrumbs'][] = [
	'label' => 'Orders',
	'url'   => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('/_alert', [
	'module' => Yii::$app->getModule('user'),
]) ?>
<div class="order-view">

	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="portlet yellow-crusta box">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cogs"></i>Chi tiết đơn hàng
					</div>
					<div class="actions">
						<a href="javascript:;" class="btn btn-default btn-sm">
							<i class="fa fa-pencil"></i> Edit </a>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row static-info">
						<div class="col-md-5 name">
							Mã đơn #:
						</div>
						<div class="col-md-7 value">
                             <span class="label label-info label-sm">
	                             LN-00<?= $model->id ?></span>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Ngày tạo:
						</div>
						<div class="col-md-7 value">
							<?= $model->created_date ?>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Trạng thái:
						</div>
						<div class="col-md-7 value">
							<span class="label label-success">
								<?= $model::STATUS[$model->status] ?> </span>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Loại đơn hàng:
						</div>
						<div class="col-md-7 value">
							<span class="label label-success">
								<?= $model->getType() ?> </span>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Tổng tiền:
						</div>
						<div class="col-md-7 value">
							<?= number_format($model->total_amount) ?> VNĐ
						</div>
					</div>
					<!--					<div class="row static-info">-->
					<!--						<div class="col-md-5 name">-->
					<!--							Payment Information:-->
					<!--						</div>-->
					<!--						<div class="col-md-7 value">-->
					<!--						</div>-->
					<!--					</div>-->
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-12">
			<div class="portlet blue-hoki box">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cogs"></i>Thông tin người mua
					</div>
					<div class="actions">
						<a href="javascript:;" class="btn btn-default btn-sm">
							<i class="fa fa-pencil"></i> Edit </a>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row static-info">
						<div class="col-md-5 name">
							Tên tài khoản:
						</div>
						<div class="col-md-7 value">
							<?= $model->users->username ?>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Email:
						</div>
						<div class="col-md-7 value">
							<?= $model->users->email ?>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Thành phố:
						</div>
						<div class="col-md-7 value">
							<?= $model->users->cities->name ?>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Số điện thoại:
						</div>
						<div class="col-md-7 value">
							<?= $model->users->phone ?>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Loại tài khoản:
						</div>
						<div class="col-md-7 value">
							<?= $model::ROLE[$model->users->role_id] ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $form = ActiveForm::begin() ?>
	<div class="item-header">
		<div class="col-sm-2 code grid-display"><p style="text-transform: uppercase">Mã sản phẩm</p></div>
		<div class="col-sm-2 category-select grid-display">
			<p style="text-transform: uppercase">Tên danh mục</p>
		</div>
		<div class="product-select grid-display col-sm-3"><p style="text-transform: uppercase">Tên sản phẩm</p>
		</div>
		<div class="quantity grid-display col-sm-1"><p style="text-transform: uppercase">Số lượng</p></div>
		<div class="price-show grid-display col-sm-2"><p style="text-transform: uppercase">Tổng tiền</p></div>
		<div class="status-show grid-display col-sm-2"><p style="text-transform: uppercase">Trạng thái</p>
		</div>
	</div>
	<div class="items">
		<?php $i = 0; ?>
		<?php foreach($items as $item) { ?>
			<div class="item-detail">
				<div class="col-sm-2 code grid-display"><?= Html::input('text', 'code', $item->isNewRecord ? '' : $item->product->code, [
						'class'    => 'form-control form-height form-boder',
						"disabled" => true,
					]) ?></div>
				<div class="col-sm-2 category-select grid-display"><?= Html::dropDownList('', $item->isNewRecord ? '' : $item->product->category_id, Category::getCategoryOrder(), [
						'class'    => 'form-control form-height form-boder ',
						'prompt'   => 'Chọn danh mục',
						'style'    => 'float:left',
						"disabled" => true,
					]) ?>
				</div>
				<div class="col-sm-3 product-select grid-display">
					<div class="overflow"><?= Html::activeDropDownList($item, 'product_id', [
							$item->getProductByCategory(),
						], [
							'name'     => 'OrderItem[' . $i . '][product_id]',
							'class'    => 'form-control form-height form-boder',
							'prompt'   => 'Chọn sản phẩm',
							'style'    => 'float:left',
							"disabled" => true,
						]) ?></div>
				</div>
				<div class="col-sm-1 quantity grid-display"><?= Html::activeTextInput($item, 'quantity', [
						'class'    => 'form-control form-height form-boder',
						'type'     => 'number',
						'min'      => 0,
						'name'     => 'OrderItem[' . $i . '][quantity]',
						"disabled" => true,
					]) ?></div>
				<div class="col-sm-2 price-show grid-display"><?= Html::activeTextInput($item, 'total_price', [
						'class'    => 'form-control form-height form-boder',
						'disabled' => true,
					]) ?></div>
				<div class="col-sm-2 grid-display"><?= Html::activeTextInput($item, 'status', [
						'class'    => 'form-control form-height form-boder',
						'disabled' => true,
						'value'    => $item->getItemStatus(),
					]) ?></div>
			</div>
			<?php
			$i ++;
		} ?>
	</div>
	<!--	<div class="row action-pager ">-->
	<!--		<div class="col-sm-6 action-item add-item">-->
	<!--			<a class="fleft add-form" href="">Thêm sản phẩm</a>-->
	<!--		</div>-->
	<!--	</div>-->
	<!---->
	<!--	<div class=" row final-total">-->
	<!--		<div class="col-sm-6 total">-->
	<!--			<p>Tổng</p>-->
	<!--		</div>-->
	<!--		<div class="detail-total col-sm-6 ">-->
	<!--			<div class="col-sm-6 label-item">-->
	<!--				<p>Tổng giá trị đơn hàng:</p>-->
	<!--			<p>Giảm giá: </p>-->
	<!--			<p>Tổng số:</p>-->
	<!--			</div>-->
	<!--			<div class="col-sm-6 value-item">-->
	<!--				<p>0</p>-->
	<!--			</div>-->
	<!---->
	<!--		</div>-->
	<!--	</div>-->

	<?= $form->field($model, 'status')->dropDownList($model::STATUS, [
		'disabled' => $model->status == $model::RECEIPTED ? true : false,
	])->label('Trạng thái đơn hàng') ?>
	<div class="row action-pager" style="margin-top: 20px">
		<div class="col-sm-6 action-item order-accept">
			<?= Html::submitButton('Cập nhật trạng thái', ['class' => 'fleft btn btn-info']) ?>
		</div>
		<!--	<div class="col-sm-6 action-item order-cancel">-->
		<!--		<a class="fright" href="">Hủy đơn</a>-->
		<!---->
		<!--	</div>-->
	</div>
	<?php \yii\widgets\ActiveForm::end() ?>
	<script>
		$(".add-form").click(function() {
			var number  = $(".items").find(".item-detail").length;
			var context = $("<div class='item-detail' >" + $(".item-detail").html() + "</div>");
			context.find("input,select").val("");
			context.appendTo(".items").find('input:first').val(parseInt(number) + 1);
			$('.items .item-detail:last div:nth-child(4) select:first').attr('name', 'OrderItem[' + parseInt(number + 1) + '][product_id]');
			$('.items .item-detail:last div:nth-child(5) input:first').attr('name', 'OrderItem[' + parseInt(number + 1) + '][quantity]');
			return false;
		});
		$(document).on("change", ".category-select .form-control", function() {
			var context           = $(this).closest(".item-detail");
			var dependentDropdown = context.find("select[id='orderitem-product_id']");
			dependentDropdown.hide();
			dependentDropdown.parent().append('<i class="fa fa-spin fa-spinner"></i>');
			$.ajax({
				url    : "<?=\yii\helpers\Url::to([
					'/order/order-item',
					'role' => $model->users->role_id,
				])?>",
				type   : "post",
				data   : {
					category: $(this).val()
				},
				success: function(data) {
					setTimeout(function() {
						dependentDropdown.parent().find('.fa').remove();
						dependentDropdown.show();
						dependentDropdown.html(data);
					}, 500);
				}
			});
		});
		function numberFormat(x) {
			return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}
		function originFormat(x) {
			return x.toString().replace(/,/g, "");
		}
		var sum = 0;
		$(document).on("change", ".product-select .form-control", function() {
			var context  = $(this).closest(".item-detail");
			var codeGen  = context.find("input[name='code']");
			var quantity = context.find("input[id='orderitem-quantity']");
			var price    = context.find("input[name='OrderItem[total_price]']");
			$.ajax({
				url     : "<?=Url::to([
					'/order/order-item',
					'role' => $model->users->role_id,
				])?>",
				type    : "post",
				data    : {
					product: $(this).val()
				},
				dataType: "json",
				success : function(data) {
					context.find(".product-select .form-control option:selected").attr("data-price", data.product_price);
					codeGen.val(data.product_code);
					quantity.val(1);
					sub_total_price_event(context.find('.quantity input'));
				}
			})
		});
		$(document).on("change", ".quantity .form-control", function() {
			sub_total_price_event($(this));
		});
		$(document).on("keyup", ".quantity .form-control", function() {
			sub_total_price_event($(this));
		});
		function grand_total_price_event() {
			var sub_total = 0;
			$("input[name='OrderItem[total_price]']").each(function() {
				sub_total += Number(originFormat($(this).val()));
			});
			//		var discount_value = parseFloat($(".value-item p:nth-child(2)").text());
			//		var grand_total    = sub_total - (sub_total * discount_value / 100);
			$(".value-item p:nth-child(1)").html(numberFormat(sub_total) + " vnđ");
			//		$(".value-item p:nth-child(3)").html(numberFormat(Math.round(grand_total) + " vnđ"));
		}
		function sub_total_price_event(selector) {
			var context            = selector.closest(".item-detail");
			var origin_price_value = context.find(".product-select select option:selected").data("price");
			if(origin_price_value != '' && origin_price_value != undefined) {
				var quantity  = selector.val();
				var sub_total = context.find("input[name='OrderItem[total_price]']");

				var sub_total_value = (origin_price_value) * quantity;
				sub_total.val(numberFormat(sub_total_value));
				grand_total_price_event();
			}
		}
	</script>
</div>
