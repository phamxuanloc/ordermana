<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="portlet yellow-crusta box">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Order Details
                    </div>
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-default btn-sm">
                            <i class="fa fa-pencil"></i> Edit </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row static-info">
                        <div class="col-md-5 name">
                            Order #:
                        </div>
                        <div class="col-md-7 value">
                            12313232 <span class="label label-info label-sm">
																Email confirmation was sent </span>
                        </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-5 name">
                            Order Date & Time:
                        </div>
                        <div class="col-md-7 value">
                            Dec 27, 2013 7:16:25 PM
                        </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-5 name">
                            Order Status:
                        </div>
                        <div class="col-md-7 value">
																<span class="label label-success">
																Closed </span>
                        </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-5 name">
                            Grand Total:
                        </div>
                        <div class="col-md-7 value">
                            $175.25
                        </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-5 name">
                            Payment Information:
                        </div>
                        <div class="col-md-7 value">
                            Credit Card
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="portlet blue-hoki box">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Customer Information
                    </div>
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-default btn-sm">
                            <i class="fa fa-pencil"></i> Edit </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row static-info">
                        <div class="col-md-5 name">
                            Customer Name:
                        </div>
                        <div class="col-md-7 value">
                            Jhon Doe
                        </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-5 name">
                            Email:
                        </div>
                        <div class="col-md-7 value">
                            jhon@doe.com
                        </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-5 name">
                            State:
                        </div>
                        <div class="col-md-7 value">
                            New York
                        </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-5 name">
                            Phone Number:
                        </div>
                        <div class="col-md-7 value">
                            12234389
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
