<?php
/** @var \app\models\OrderItem $orderItem */
/** @var \app\models\Order $order */ ?>
<?php
echo $this->render('_create', [
	'orderItem'  => $orderItem,
	'order'      => $order,
	'products'   => $products,
	'stock'      => $stock,
	'admin_show' => $admin_show,
]);
?>