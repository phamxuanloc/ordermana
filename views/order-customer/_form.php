<?php
use app\models\Category;
use app\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/** @var \app\models\CustomerItem $orderItem */
/** @var \app\models\Order $order */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="order-title text-center ">
    <h3>ĐƠN HÀNG</h3>
    <p>(Sử dụng chức năng bên dưới để lên đơn đặt hàng)</p>
</div>

<?php $form = ActiveForm::begin() ?>
<?= $form->field($order, 'customer_id')->widget(Select2::className(), [
    'data' => $children
])->label('Xuất cho khách hàng') ?>
<div class="item-header">
    <div class="col-sm-1 id grid-display"><p style="text-transform: uppercase">STT</p></div>
    <div class="col-sm-2 code grid-display"><p style="text-transform: uppercase">Mã sản phẩm</p></div>
    <div class="col-sm-3 category-select grid-display">
        <p style="text-transform: uppercase">Tên danh mục</p>
    </div>
    <div class="product-select grid-display col-sm-3"><p style="text-transform: uppercase">Tên sản phẩm</p>
    </div>
    <div class="quantity grid-display col-sm-1"><p style="text-transform: uppercase">Số lượng</p></div>
    <div class="price-show grid-display col-sm-2"><p style="text-transform: uppercase">Tổng tiền</p>
    </div>
</div>
<div class="items">
    <?php for(
        $i = 1; $i < 6; $i ++
    ) { ?>
        <div class="item-detail">
            <div class="col-sm-1 id grid-display"><?= Html::input('text', '', $i, [
                    'class'    => 'ordinal form-control form-height form-boder',
                    "disabled" => true,
                ]) ?></div>
            <div class="col-sm-2 code grid-display"><?= Html::input('text', 'code', $orderItem->isNewRecord ? '' : $orderItem->product->code, [
                    'class'    => 'form-control form-height form-boder',
                    "disabled" => true,
                ]) ?></div>
            <div class="col-sm-3 category-select grid-display"><?= Html::dropDownList('', $orderItem->isNewRecord ? '' : $orderItem->product->category_id, Category::getCategoryOrder(), [
                    'class'  => 'form-control form-height form-boder ',
                    'prompt' => 'Chọn danh mục',
                    'style'  => 'float:left',
                ]) ?>
            </div>
            <div class="col-sm-3 product-select grid-display">
                <div class="overflow"><?= Html::activeDropDownList($orderItem, 'product_id', [
                    ], [
                        'name'   => 'CustomerItem[' . $i . '][product_id]',
                        'class'  => 'form-control form-height form-boder',
                        'prompt' => 'Chọn sản phẩm',
                        'style'  => 'float:left',
                    ]) ?></div>
            </div>
            <div class="col-sm-1 quantity grid-display"><?= Html::activeTextInput($orderItem, 'quantity', [
                    'class' => 'form-control form-height form-boder',
                    'type'  => 'number',
                    'min'   => 0,
                    'name'  => 'CustomerItem[' . $i . '][quantity]',
                ]) ?></div>
            <div class="col-sm-2 price-show grid-display"><?= Html::activeTextInput($orderItem, 'total_price', [
                    'class'    => 'form-control form-height form-boder',
                    'disabled' => true,
                ]) ?></div>
        </div>
    <?php } ?>
</div>
<div class="row action-pager ">
    <div class="col-sm-6 action-item add-item">
        <a class="fleft add-form" href="">Thêm sản phẩm</a>
    </div>
</div>

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
        <?= Html::submitButton('Tạo đơn hàng', ['class' => 'fleft']) ?>
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
        var dependentDropdown = context.find("select[id='customeritem-product_id']");
        dependentDropdown.hide();
        dependentDropdown.parent().append('<i class="fa fa-spin fa-spinner"></i>');
        $.ajax({
            url    : "<?=\yii\helpers\Url::to([
                '/order-customer/order-item',
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
        var quantity = context.find("input[id='customeritem-quantity']");
        var price    = context.find("input[name='CustomerItem[total_price]']");
        $.ajax({
            url     : "<?=Url::to([
                '/order-customer/order-item',
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
        $("input[name='CustomerItem[total_price]']").each(function() {
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
            var sub_total = context.find("input[name='CustomerItem[total_price]']");

            var sub_total_value = (origin_price_value) * quantity;
            sub_total.val(numberFormat(sub_total_value));
            grand_total_price_event();
        }
    }
</script>
