<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-history-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product History', ['create'], ['class' => 'btn btn-success']) ?>
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
            'old_value',
            // 'new_value',
            // 'created_date',
            // 'receipted_date',
            // 'product_id',
            // 'supplier',
            // 'bill_image',
            // 'bill_number',
            // 'order_number',
            // 'receiver',
            // 'deliver',
            // 'color',
            // 'weight',
            // 'unit',
            // 'price_tax',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
