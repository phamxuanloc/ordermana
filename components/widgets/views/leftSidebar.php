<?php
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
			<li>
				<a href="javascript:;">
					<i class="icon-basket"></i>
					<span class="title">Quản lý kho</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="<?= Url::to(['/product/receipt']) ?>">
							<i class="icon-home"></i>
							Nhập kho</a>
					</li>
					<li>
						<a href="<?= Url::to(['/product/index']) ?>">
							<i class="icon-home"></i>
							Thống kê xuất kho</a>
					</li>
					<li>
						<a href="<?= Url::to(['/order/order-item']) ?>">
							<i class="icon-basket"></i>
							Xuất kho</a>
					</li>
<!--					<li>-->
<!--						<a href="ecommerce_products.html">-->
<!--							<i class="icon-handbag"></i>-->
<!--							Thống kê chi tiết kho</a>-->
<!--					</li>-->
				</ul>
			</li>
			<li>
				<a href="javascript:;">
					<i class="icon-rocket"></i>
					<span class="title">Quản lý đơn hàng</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="<?= Url::to(['/order']) ?>">
							Danh sách đơn hàng</a>
					</li>
					<li>
						<a href="layout_horizontal_sidebar_menu.html">
							Danh sách đơn hàng bán lẻ</a>
					</li>
					<li>
						<a href="<?= Url::to(['/order/order-item']) ?>">
							Tạo đơn hàng</a>
					</li>
					<li>
						<a href="layout_horizontal_menu1.html">
							Tạo đơn hàng bán lẻ</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="javascript:;">
					<i class="icon-diamond"></i>
					<span class="title">Quản lý tài khoản</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="<?= Url::to(['/role']) ?>">
							Phân quyền</a>
					</li>
					<li>
						<a href="<?= Url::to(['/user/admin/index']) ?>">
							Danh sách tài khoản</a>
					</li>
					<li>
						<a href="<?= Url::to(['/user/admin/create']) ?>">

							Thêm mới tài khoản</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="javascript:;">
					<i class="icon-puzzle"></i>
					<span class="title">Quản lý khách hàng lẻ</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="components_pickers.html">
							Danh sách khách hàng lẻ</a>
					</li>
					<li>
						<a href="components_context_menu.html">
							Thêm khách hàng lẻ</a>
					</li>
				</ul>
			</li>
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
		</ul>

		<!-- END SIDEBAR MENU -->
	</div>
</div>
<!-- END SIDEBAR -->


