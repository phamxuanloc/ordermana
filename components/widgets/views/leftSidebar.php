<?php
use app\controllers\AdminController;
use app\controllers\OrderController;
use app\controllers\ProductController;
use navatech\role\controllers\DefaultController;
use navatech\role\helpers\RoleChecker;
use yii\helpers\Url;

?>
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
	<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
	<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
	<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU -->
		<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
		<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
		<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
		<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
			<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
			<li class="sidebar-toggler-wrapper">
				<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				<div class="sidebar-toggler">
				</div>
				<!-- END SIDEBAR TOGGLER BUTTON -->
			</li>
			<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
			<li class="sidebar-search-wrapper">
				<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
				<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
				<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
				<form class="sidebar-search " action="extra_search.html" method="POST">
					<a href="javascript:;" class="remove">
						<i class="icon-close"></i>
					</a>
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
							</span>
					</div>
				</form>
				<!-- END RESPONSIVE QUICK SEARCH FORM -->
			</li>
			<li class="start active open">
				<a href="<?= Url::home() ?>">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
				</a>
			</li>
			<?php if(RoleChecker::isAuth(\app\controllers\SiteController::className(), 'report')) { ?>
				<li>
					<a href="javascript:;">
						<i class="icon-docs"></i>
						<span class="title">Báo cáo</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="<?= Url::to(['/site/report']) ?>">
								<i class="icon-home"></i>
								Báo cáo theo thời gian</a>
						</li>
					</ul>
				</li>
			<?php } ?>
			<?php if(RoleChecker::isAuth(ProductController::className(), 'index')) { ?>

				<li>
					<a href="javascript:;">
						<i class="icon-basket"></i>
						<span class="title">Quản lý kho</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<?php if(RoleChecker::isAuth(ProductController::className(), 'receipt')) { ?>
							<li>
								<a href="<?= Url::to(['/product/receipt']) ?>">
									<i class="icon-home"></i>
									Nhập hàng mới vào kho</a>
							</li>
						<?php } ?>
						<li>
							<a href="<?= Url::to(['/product-history/create']) ?>">
								<i class="icon-home"></i>
								Thêm hàng vào kho</a>
						</li>
						<?php if(RoleChecker::isAuth(ProductController::className(), 'index')) { ?>

							<li>
								<a href="<?= Url::to(['/product/index']) ?>">
									<i class="icon-home"></i>
									Hàng trong kho</a>
							</li>
						<?php } ?>
						<li>
							<a href="<?= Url::to(['/product-history/index']) ?>">
								<i class="icon-home"></i>
								Lịch sử nhập kho</a>
						</li>
						<?php if(RoleChecker::isAuth(OrderController::className(), 'order-item')) { ?>
							<li>
								<a href="<?= Url::to(['/order/order-item']) ?>">
									<i class="icon-basket"></i>
									Xuất kho</a>
							</li>
						<?php } ?>
						<li>
							<a href="<?= Url::to(['/stock']) ?>">
								<i class="icon-basket"></i>
								Kho hàng người dùng</a>
						</li>
						<!--					<li>-->
						<!--						<a href="ecommerce_products.html">-->
						<!--							<i class="icon-handbag"></i>-->
						<!--							Thống kê chi tiết kho</a>-->
						<!--					</li>-->
					</ul>
				</li>
			<?php } ?>
			<?php if(RoleChecker::isAuth(OrderController::className(), 'index')) { ?>
				<li>
					<a href="javascript:;">
						<i class="icon-rocket"></i>
						<span class="title">Quản lý đơn hàng</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<?php if(RoleChecker::isAuth(OrderController::className(), 'index')) { ?>
							<li>
								<a href="<?= Url::to(['/order']) ?>">
									Danh sách đơn hàng xuất kho</a>
							</li>
						<?php } ?>
						<?php if(RoleChecker::isAuth(OrderController::className(), 'index')) { ?>
							<li>
								<a href="<?= Url::to(['/order/receipted']) ?>">
									Danh sách đơn hàng nhập kho</a>
							</li>
						<?php } ?>
						<li>
							<a href="<?= Url::to(['/order-customer']) ?>">
								Danh sách đơn hàng bán lẻ</a>
						</li>
						<?php if(RoleChecker::isAuth(OrderController::className(), 'order-item')) { ?>
							<li>
								<a href="<?= Url::to(['/order/order-item']) ?>">
									Xuất kho</a>
							</li>
						<?php } ?>

						<li>
							<a href="<?= Url::to(['/order-customer/order-item']) ?>">
								Tạo đơn hàng bán lẻ</a>
						</li>
					</ul>
				</li>
			<?php } ?>
			<?php if(RoleChecker::isAuth(AdminController::className(), 'index')) { ?>
				<li>
					<a href="javascript:;">
						<i class="icon-diamond"></i>
						<span class="title">Quản lý tài khoản</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<?php if(RoleChecker::isAuth(DefaultController::className(), 'create')) { ?>
							<li>
								<a href="<?= Url::to(['/role']) ?>">
									Phân quyền</a>
							</li>
						<?php } ?>
						<?php if(RoleChecker::isAuth(AdminController::className(), 'tree')) { ?>

							<li>
								<a href="<?= Url::to(['/user/admin/tree']) ?>">
									Tổng quan hệ thống</a>
							</li>
						<?php } ?>
						<?php if(RoleChecker::isAuth(AdminController::className(), 'change-parent')) { ?>

							<li>
								<a href="<?= Url::to(['/user/admin/change-parent']) ?>">
									Chuyển hệ thống</a>
							</li>
						<?php } ?>

						<?php if(RoleChecker::isAuth(AdminController::className(), 'index')) { ?>
							<li>
								<a href="<?= Url::to(['/user/admin/index']) ?>">
									Danh sách tài khoản</a>
							</li>
						<?php } ?>
						<?php if(RoleChecker::isAuth(AdminController::className(), 'care')) { ?>
							<li>
								<a href="<?= Url::to(['/user/admin/care']) ?>">
									Danh sách tài khoản cskh</a>
							</li>
						<?php } ?>

						<?php if(RoleChecker::isAuth(AdminController::className(), 'create')) { ?>

							<li>
								<a href="<?= Url::to(['/user/admin/create']) ?>">

									Thêm mới tài khoản</a>
							</li>
						<?php } ?>
					</ul>
				</li>
			<?php } ?>

			<?php if(RoleChecker::isAuth(\app\controllers\CustomerController::className(), 'index')) { ?>
				<li>
					<a href="javascript:;">
						<i class="icon-puzzle"></i>
						<span class="title">Quản lý khách hàng lẻ</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<?php if(RoleChecker::isAuth(\app\controllers\CustomerController::className(), 'index')) { ?>
							<li>
								<a href="<?= Url::to(['/customer']) ?>">
									Danh sách khách hàng lẻ</a>
							</li>
						<?php } ?>

						<?php if(RoleChecker::isAuth(\app\controllers\CustomerController::className(), 'create')) { ?>
							<li>
								<a href="<?= Url::to(['/customer/create']) ?>">
									Thêm khách hàng lẻ</a>
							</li>
						<?php } ?>

						<?php if(RoleChecker::isAuth(\app\controllers\CustomerController::className(), 'move')) { ?>
							<li>
								<a href="<?= Url::to(['/customer/move']) ?>">
									Chuyển khách hàng lẻ</a>
							</li>
						<?php } ?>
						<?php if(RoleChecker::isAuth(\app\controllers\CustomerController::className(), 'report')) { ?>
							<li>
								<a href="<?= Url::to(['/customer/report']) ?>">
									Báo cáo khách hàng</a>
							</li>
						<?php } ?>

					</ul>
				</li>
			<?php } ?>
			<?php if(RoleChecker::isAuth(\app\controllers\CategoryController::className(), 'create')) { ?>

				<li>
					<a href="javascript:;">
						<i class="icon-docs"></i>
						<span class="title">Quản lý Danh mục sản phẩm</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="<?= Url::to(['/category']) ?>">
								<i class="icon-paper-plane"></i>
								<span class="badge badge-warning"></span>Danh sách danh mục</a>
						</li>
						<li>
							<a href="<?= Url::to(['/category/create']) ?>">
								<i class="icon-user-following"></i>
								<span class="badge badge-success badge-roundless">new</span>Thêm mới danh mục</a>
						</li>
					</ul>
				</li>
			<?php } ?>
			<?php if(RoleChecker::isAuth(\app\controllers\PointController::className(), 'index')) { ?>

				<li>
					<a href="javascript:;">
						<i class="icon-puzzle"></i>
						<span class="title">Quản lý hệ thống điểm khách hàng</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="<?= Url::to(['/point']) ?>">
								Danh sách mốc điểm</a>
						</li>
						<li>
							<a href="<?= Url::to(['/point/create']) ?>">
								Thêm mốc điểm</a>
						</li>
						<li>
							<a href="<?= Url::to(['/setting']) ?>">
								Cấu hình đổi điểm</a>
						</li>
					</ul>
				</li>
			<?php } ?>
			<?php if(RoleChecker::isAuth(\app\controllers\ProviderController::className(), 'create')) { ?>

				<li>
					<a href="javascript:;">
						<i class="icon-present"></i>
						<span class="title">Nhà cung cấp</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="<?= Url::to(['/provider']) ?>">
								Danh sách nhà cung cấp</a>
						</li>
						<li>
							<a href="<?= Url::to(['/provider/create']) ?>">
								Thêm mới nhà cung cấp</a>
						</li>
					</ul>
				</li>
			<?php } ?>
			<?php if(RoleChecker::isAuth(\app\controllers\AlertController::className(), 'create')) { ?>

				<li>
					<a href="javascript:;">
						<i class="icon-present"></i>
						<span class="title">Quản lý thông báo</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="<?= Url::to(['/alert']) ?>">
								Danh sách thông báo</a>
						</li>
						<li>
							<a href="<?= Url::to(['/alert/create']) ?>">
								Thêm mới thông báo</a>
						</li>
					</ul>
				</li>
			<?php } ?>
			<li>
				<a href="javascript:;">
					<i class="icon-home"></i>
					<span class="title">Quản lý center</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="<?= Url::to(['/user/admin/center']) ?>">
							Danh sách center</a>
					</li>
					<li>
						<a href="<?= Url::to(['/center/order-list']) ?>">
							Danh sách đơn hàng center</a>
					</li>
					<li>
						<a href="<?= Url::to(['/center/create']) ?>">
							Tạo đơn hàng center</a>
					</li>
				</ul>
			</li>
		</ul>

		<!-- END SIDEBAR MENU -->
	</div>
</div>
<!-- END SIDEBAR -->


