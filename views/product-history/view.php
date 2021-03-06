<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductHistory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-history-view">

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
            'category_id',
            'name',
            'code',
            'old_value',
            'new_value',
            'created_date',
            'receipted_date',
            'product_id',
            'supplier',
            'bill_image',
            'bill_number',
            'order_number',
            'receiver',
            'deliver',
            'color',
            'weight',
            'unit',
            'price_tax',
            'status',
        ],
    ]) ?>

</div>
