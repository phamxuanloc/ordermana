<?php
/**
 * Created by PhpStorm.
 * User: Yamon-PC
 * Date: 05-Dec-16
 * Time: 6:07 PM
 */
use app\models\Category;
use yii\helpers\Html;
/* @var $model app\models\Order */
/* @var $items app\models\OrderItem */
/* @var $item app\models\OrderItem */
?>
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
