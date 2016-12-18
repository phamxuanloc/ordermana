<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerItem */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Customer Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_customer_id',
            'product_id',
            'quantity',
            'total_price',
        ],
    ]) ?>

</div>
