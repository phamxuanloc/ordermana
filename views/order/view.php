<?php
/* @var $this yii\web\View */
/* @var $model app\models\Order */
$this->title                   = 'Chi tiết đơn hàng #LN-00' . $model->id;
$this->params['breadcrumbs'][] = [
	'label' => 'Orders',
	'url'   => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="portlet yellow-crusta box">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cogs"></i>Chi tiết đơn hàng
					</div>
					<div class="actions">
						<a href="javascript:;" class="btn btn-default btn-sm">
							<i class="fa fa-pencil"></i> Edit </a>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row static-info">
						<div class="col-md-5 name">
							Mã đơn #:
						</div>
						<div class="col-md-7 value">
                             <span class="label label-info label-sm">
	                             LN-00<?= $model->id ?></span>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Ngày tạo:
						</div>
						<div class="col-md-7 value">
							<?= $model->created_date ?>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Trạng thái:
						</div>
						<div class="col-md-7 value">
							<span class="label label-success">
								<?= $model::STATUS[$model->status] ?> </span>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Loại đơn hàng:
						</div>
						<div class="col-md-7 value">
							<span class="label label-success">
								<?= $model->getType() ?> </span>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Tổng tiền:
						</div>
						<div class="col-md-7 value">
							<?= $model->total_amount ?> VNĐ
						</div>
					</div>
					<!--					<div class="row static-info">-->
					<!--						<div class="col-md-5 name">-->
					<!--							Payment Information:-->
					<!--						</div>-->
					<!--						<div class="col-md-7 value">-->
					<!--						</div>-->
					<!--					</div>-->
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-12">
			<div class="portlet blue-hoki box">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cogs"></i>Thông tin người mua
					</div>
					<div class="actions">
						<a href="javascript:;" class="btn btn-default btn-sm">
							<i class="fa fa-pencil"></i> Edit </a>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row static-info">
						<div class="col-md-5 name">
							Tên tài khoản:
						</div>
						<div class="col-md-7 value">
							<?= $model->users->username ?>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Email:
						</div>
						<div class="col-md-7 value">
							<?= $model->users->email ?>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Thành phố:
						</div>
						<div class="col-md-7 value">
							<?= $model->users->cities->name ?>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Số điện thoại:
						</div>
						<div class="col-md-7 value">
							<?= $model->users->phone ?>
						</div>
					</div>
					<div class="row static-info">
						<div class="col-md-5 name">
							Loại tài khoản:
						</div>
						<div class="col-md-7 value">
							<?= $model::ROLE[$model->users->role_id] ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
