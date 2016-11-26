<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderCustomer */

$this->title = 'Create Order Customer';
$this->params['breadcrumbs'][] = ['label' => 'Order Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-customer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
