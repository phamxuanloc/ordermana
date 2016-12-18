<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductHistory */

$this->title = 'Create Product History';
$this->params['breadcrumbs'][] = ['label' => 'Product Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
