<?php
use app\models\Category;
use app\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/** @var \app\models\CenterItem $orderItem */
/** @var \app\models\Order $order */
/** @var \app\models\UserStock $product */
/** @var \app\models\Product $product */
/** @var \app\models\UserStock $stock */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="order-title text-center ">
	<h3>ĐƠN HÀNG</h3>
	<p>(Sử dụng chức năng bên dưới để lên đơn đặt hàng)</p>
</div>

<?php $form = ActiveForm::begin() ?>
<div class="item-header">
	<div class="col-sm-1 id grid-display"><p style="text-transform: uppercase">STT</p></div>
	<div class="col-sm-2 code grid-display"><p style="text-transform: uppercase">Mã sản phẩm</p></div>
	<div class="col-sm-2 category-select grid-display">
		<p style="text-transform: uppercase">Tên danh mục</p>
	</div>
	<div class="product-select grid-display col-sm-2"><p style="text-transform: uppercase">Tên sản phẩm</p>
	</div>
	<div class="quantity grid-display col-sm-1"><p style="text-transform: uppercase">Số lượng</p></div>
	<div class="discount grid-display col-sm-2"><p style="text-transform: uppercase">Giảm giá(VNĐ)</p>
	</div>
	<div class="price-show grid-display col-sm-2"><p style="text-transform: uppercase">Tổng tiền</p>
	</div>
	<div class="center-items">
		<?php for(
			$i = 0; $i < 1; $i ++
		) { ?>
			<div class="item-detail" style="display: none">
				<div class="col-sm-1 id grid-display"><?= Html::input('text', '', $i, [
						'class'    => 'ordinal form-control form-height form-boder',
						"disabled" => true,
					]) ?></div>
				<div class="col-sm-2 code grid-display"><?= Html::input('text', 'code', $orderItem->isNewRecord ? '' : $orderItem->product->code, [
						'class'    => 'form-control form-height form-boder',
						"disabled" => true,
					]) ?></div>
				<div class="col-sm-2 category-select grid-display"><?= Html::dropDownList('', $orderItem->isNewRecord ? '' : $orderItem->product->category_id, Category::getCategoryOrder(), [
						'class'  => 'form-control form-height form-boder ',
						'prompt' => 'Chọn danh mục',
						'style'  => 'float:left',
					]) ?>
				</div>
				<div class="col-sm-2 product-select grid-display">
					<div class="overflow"><?= Html::activeDropDownList($orderItem, 'product_id', $stock->getStockProduct(), [
							'name'   => 'CenterItem[' . $i . '][product_id]',
							'class'  => 'form-control form-height form-boder',
							'prompt' => 'Chọn sản phẩm',
							'style'  => 'float:left',
						]) ?></div>
				</div>
				<div class="col-sm-1 quantity grid-display"><?= Html::activeTextInput($orderItem, 'quantity', [
						'class' => 'form-control form-height form-boder',
						'type'  => 'number',
						'min'   => 0,
						'name'  => 'CenterItem[' . $i . '][quantity]',
					]) ?></div>
				<div class="col-sm-2 discount grid-display"><?= Html::activeTextInput($orderItem, 'discount', [
						'class' => 'form-control form-height form-boder',
						'name'  => 'CenterItem[' . $i . '][discount]',
						'value' => 0,
					]) ?></div>
				<div class="col-sm-2 price-show grid-display"><?= Html::activeTextInput($orderItem, 'total_price', [
						'class'    => 'form-control form-height form-boder',
						'disabled' => true,
					]) ?></div>
			</div>
		<?php } ?>
	</div>
	<!--		<div class="row action-pager ">-->
	<!--			<div class="col-sm-6 action-item add-item">-->
	<!--				<a class="fleft add-form" href="">Thêm sản phẩm</a>-->
	<!--			</div>-->
	<!--		</div>-->
	<div class="order-info">
		<div class=" row final-total">
			<div class="col-sm-6 total">
				<p>Tổng</p>
			</div>
			<div class="detail-total col-sm-6 ">
				<div class="col-sm-6 label-item">
					<p>Tổng giá trị đơn hàng:</p>
					<!--			<p>Giảm giá: </p>-->
					<!--			<p>Tổng số:</p>-->
				</div>
				<div class="col-sm-6 value-item">
					<p>0</p>
				</div>

			</div>
		</div>
		<div class="row action-pager">
			<div class="col-sm-6 action-item order-accept">
				<?= Html::submitButton('Tạo đơn hàng', ['class' => 'fleft btn btn-primary']) ?>
			</div>
			<!--	<div class="col-sm-6 action-item order-cancel">-->
			<!--		<a class="fright" href="">Hủy đơn</a>-->
			<!---->
			<!--	</div>-->
		</div>
	</div>
	<?php \yii\widgets\ActiveForm::end() ?>
	<div class="product-items clearfix">
		<ul>
			<?php if($admin_show) { ?>
				<?php foreach($products as $product) { ?>
					<li class="col-sm-2">
						<a href="#" class="add-form">
							<div class="product-image">
								<img src="<?= $product->getPictureUrl('image') ?>" alt="<?= $product->name ?>">
								<span class="product-price"><?= $product->retail_sale ?>VNĐ</span>
								<span class="product-id" style="display: none"><?= $product->id ?></span>
								<span class="category-id" style="display: none"><?= $product->category_id ?></span>
							</div>
							<span class="product-title"><?= $product->name ?></span>
						</a>
					</li>
				<?php } ?>
			<?php } else { ?>
				<?php foreach($products as $product) { ?>
					<li class="col-sm-2">
						<a href="#" class="add-form">
							<div class="product-image">
								<img src="<?= $product->product->getPictureUrl('image') ?>" alt="<?= $product->product->name ?>">
								<span class="product-price"><?= $product->product->retail_sale ?>VNĐ</span>
								<span class="product-id" style="display: none"><?= $product->product_id ?></span>
								<span class="category-id" style="display: none"><?= $product->product->category_id ?></span>
							</div>
							<span class="product-title"><?= $product->product->name ?></span>
						</a>
					</li>
				<?php } ?>
			<?php } ?>

		</ul>
	</div>
	<script>

		$(document).on("change", ".category-select .form-control", function() {
			var context           = $(this).closest(".item-detail");
			var dependentDropdown = context.find("select[id='centeritem-product_id']");
			dependentDropdown.hide();
			dependentDropdown.parent().append('<i class="fa fa-spin fa-spinner"></i>');
			$.ajax({
				url    : "<?=\yii\helpers\Url::to([
					'/center/create',
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
			var quantity = context.find("input[id='centeritem-quantity']");
			var price    = context.find("input[name='CenterItem[total_price]']");
			$.ajax({
				url     : "<?=Url::to([
					'/center/create',
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
		$(document).on("change", ".discount .form-control", function() {
			var quantity = $(this).closest(".item-detail").find(".quantity .form-control");
			sub_total_price_event($(quantity));
		});
		$(document).on("keyup", ".discount .form-control", function() {
			var quantity = $(this).closest(".item-detail").find(".quantity .form-control");
			sub_total_price_event($(quantity));
		});
		function grand_total_price_event() {
			var sub_total = 0;
			$("input[name='CenterItem[total_price]']").each(function() {
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
				var quantity        = selector.val();
				var discount        = context.find(".discount .form-control").val();
				var sub_total       = context.find("input[name='CenterItem[total_price]']");
				var sub_total_value = (origin_price_value - discount) * quantity;
				sub_total.val(numberFormat(sub_total_value));
				grand_total_price_event();
			}
		}
		$(".add-form").click(function() {

			var number   = $(".center-items").find(".item-detail").length - 1;
			var context  = $("<div class='item-detail' >" + $(".item-detail").html() + "</div>");
			var category = $(this).find(".category-id").html();
			var product  = $(this).find(".product-id").html();
			var price    = $(this).find(".product-price").html();
			var quantity = $(this).find(".quantity").html();
			var isset    = false;

			$(".product-select select").each(function() {
				var product_value = $(this).val();
				if(product_value == product) {
					isset                = true;
					var quantity_context = $(this).closest(".item-detail").find(".quantity input");
					var total_price      = $(this).closest(".item-detail").find(".price-show input");
					quantity_context.val(parseInt(quantity_context.val()) + 1);
					var quantity_detail = $(this).closest(".item-detail").find(".quantity .form-control");
					sub_total_price_event(quantity_detail);
					//					total_price.val()
					grand_total_price_event();
				}

			});
			if(isset == false) {
				context.find(".category-select select").val(category);
				context.find(".product-select select").val(product);
				context.find(".price-show input").val(parseInt(price));
				context.find(".quantity input").val(1);
				context.find(".product-select select option:selected").attr("data-price", parseInt(price));
				context.appendTo(".center-items").find('input:first').val(parseInt(number) + 1);
				$('.center-items .item-detail:last div:nth-child(4) select:first').attr('name', 'CenterItem[' + parseInt(number + 1) + '][product_id]');
				$('.center-items .item-detail:last div:nth-child(5) input:first').attr('name', 'CenterItem[' + parseInt(number + 1) + '][quantity]');
			}
			//			context.find("input,select").val(1);

			grand_total_price_event();
			return false;
		});
	</script>
