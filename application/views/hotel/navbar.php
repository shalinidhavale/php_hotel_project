<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="<?= base_url() ?>assets/img/icons/icon-48x48.png" />
	<script src="https://kit.fontawesome.com/515a066f23.js" crossorigin="anonymous"></script>

	<title>Taj Hotel | Admin</title>

	<!-- Styles -->
	<link href="<?= base_url() ?>assets/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	<!-- Feather Icons -->
	<script src="https://unpkg.com/feather-icons"></script>

	<style>
		.navbar {
			background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
			color: white;
		}
		.navbar a,
		.navbar .dropdown-menu a {
			color: white !important;
		}
		.navbar .dropdown-menu {
			background-color: #2c5364;
		}
		.navbar .dropdown-menu a:hover {
			background-color: #1a2a35;
		}
	</style>
</head>

<body>
	<div class="wrapper">
		<!-- Sidebar -->
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="<?= base_url() ?>">
					<span class="align-middle" style="letter-spacing: 2px;">Taj Hotel</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-item active">
						<a class="sidebar-link" href="<?= base_url() ?>">
							<i class="align-middle" data-feather="home"></i>
							<span class="align-middle">Dashboard</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="<?= base_url() ?>hotel/manage_table">
							<i class="align-middle" data-feather="grid"></i>
							<span class="align-middle">Manage Tables</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="<?= base_url() ?>hotel/manage_category">
							<i class="align-middle" data-feather="tag"></i>
							<span class="align-middle">Manage Category</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="<?= base_url() ?>hotel/add_product">
							<i class="align-middle" data-feather="plus-circle"></i>
							<span class="align-middle">Add Product</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="<?= base_url() ?>hotel/product_list">
							<i class="align-middle" data-feather="list"></i>
							<span class="align-middle">Product List</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>

		<!-- Top Navbar -->
<div class="main">
	<nav class="navbar navbar-expand navbar-light navbar-bg py-3 px-4">
		<!-- Sidebar toggle button -->
		<a class="sidebar-toggle js-sidebar-toggle me-3">
			<i class="hamburger align-self-center text-white"></i>
		</a>

		<div class="navbar-collapse collapse">
			<ul class="navbar-nav navbar-align ms-auto align-items-center">
				<li class="nav-item dropdown">
					<!-- Small screen icon -->
					<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
						<i class="align-middle text-white" data-feather="settings"></i>
					</a>

					<!-- Profile image + name -->
					<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
						<img src="<?= base_url() ?>assets/img/avatars/profile.png" class="avatar img-fluid rounded me-2" alt="User" />
						<span class="text-white fw-semibold">Admin</span>
					</a>

					<!-- Dropdown menu -->
					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?= base_url() ?>change_password"><i class="align-middle me-1" data-feather="settings"></i> Change Password</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?= base_url() ?>logout"><i class="align-middle me-1" data-feather="log-out"></i> Log out</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>
