<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserStock */

$this->title = 'Update User Stock: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-stock-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
