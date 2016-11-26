<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_id',
            'name',
            'code',
            'image',
            // 'in_stock',
            // 'base_price',
            // 'description',
            // 'distribute_sale',
            // 'agent_sale',
            // 'retail_sale',
            // 'created_date',
            // 'supplier',
            // 'order_number',
            // 'bill_number',
            // 'bill_image',
            // 'receiver',
            // 'deliver',
            // 'color',
            // 'weight',
            // 'unit',
            // 'status',
            // 'price_tax',
            // 'supplier_discount',
            // 'updated_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
