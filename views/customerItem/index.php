<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CustomerItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customer Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Customer Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_customer_id',
            'product_id',
            'quantity',
            'total_price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
