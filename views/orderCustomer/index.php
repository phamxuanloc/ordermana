<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrderCustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'total_amount',
            'note',
            'created_date',
            // 'update_at',
            // 'status',
            // 'update_by',
            // 'type',
            // 'customer_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
