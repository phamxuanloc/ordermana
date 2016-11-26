<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CustomerItem */

$this->title = 'Create Customer Item';
$this->params['breadcrumbs'][] = ['label' => 'Customer Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
