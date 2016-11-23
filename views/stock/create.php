<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserStock */

$this->title = 'Create User Stock';
$this->params['breadcrumbs'][] = ['label' => 'User Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-stock-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
