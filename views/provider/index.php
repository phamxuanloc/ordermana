<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProviderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nhà cung cấp';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provider-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Thêm mới nhà cung cấp', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'address',
            'phone',
            'created_date',
            // 'email:email',
            // 'note:ntext',
             'company',
            // 'tax_code',
            // 'payment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
