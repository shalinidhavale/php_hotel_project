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

/* Links by default white */
.navbar a,
.navbar .dropdown-menu a {
    color: white !important;
}

/* Dropdown background */
.navbar .dropdown-menu {
    background-color: #2c5364;
    border-radius: 10px; /* Rounded look */
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.4);
    transition: all 0.3s ease-in-out;
}

/* Dropdown links hover */
.navbar .dropdown-menu a:hover {
    background-color: #1a2a35;
    color: #FFD700 !important; /* Golden hover text */
}

/* White arrow (caret) */
.navbar .dropdown-toggle::after {
    border-top: 0.5em solid #fff !important;
    border-right: 0.5em solid transparent;
    border-left: 0.5em solid transparent;
    margin-left: 6px;
    vertical-align: middle;
    transition: all 0.3s ease-in-out;
}
.navbar .dropdown-toggle:hover::after {
    border-top-color: #FFD700 !important; /* Golden glow */
    filter: drop-shadow(0 0 6px rgba(255, 215, 0, 0.9));
    transform: scale(1.1);
}

/* Feather icons white */
.navbar [data-feather] {
    stroke: #fff !important;
    width: 20px;
    height: 20px;
    transition: all 0.3s ease-in-out;
}

/* Feather icons hover = Golden glow */
.navbar .dropdown-item:hover [data-feather],
.navbar .nav-icon:hover [data-feather] {
    stroke: #FFD700 !important;
    filter: drop-shadow(0 0 6px rgba(255, 215, 0, 0.8));
    transform: scale(1.15);
}


		
		@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@600&display=swap');

.sidebar-brand {
  text-decoration: none !important;  /* underline हट गया */
  display: block;
  text-align: center;
}

.sidebar-brand:hover {
  text-decoration: none !important;  /* hover पर भी हट गया */
}

.logo-text-gold {
  font-size: 36px;
  font-weight: bold;
  font-family: 'Cinzel', serif;
  letter-spacing: 4px;
  text-transform: uppercase;
  background: linear-gradient(45deg, #FFD700, #FFA500, #FFC107);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  text-align: center;
  margin: 20px 0;

  /* ✨ Premium glow effect */
  text-shadow: 0 0 8px rgba(255, 215, 0, 0.6),
               0 0 16px rgba(255, 180, 0, 0.8),
               0 0 32px rgba(255, 140, 0, 0.9);
  
  /* smooth glow animation */
  animation: goldenGlow 3s infinite alternate ease-in-out;
}

@keyframes goldenGlow {
  0% { text-shadow: 0 0 8px rgba(255, 215, 0, 0.6), 0 0 16px rgba(255, 180, 0, 0.8); }
  100% { text-shadow: 0 0 20px rgba(255, 215, 0, 1), 0 0 40px rgba(255, 180, 0, 1); }
}


</style>

</head>

<body>
	<div class="wrapper">
		<!-- Sidebar -->
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="<?= base_url() ?>">
                   <h3 class="logo-text-gold">Taj Hotel</h3>
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
