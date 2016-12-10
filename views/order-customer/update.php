<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrderCustomer */

$this->title = 'Update Order Customer: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-customer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
