<?php die('Access Denied');?>
<!doctype html>
<html lang="cmn-Hans">
<head>
<meta charset="utf-8">
<title>{$title}</title>
{include('admin/_header.php')}

</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper">
	<!-- Header -->
	<div class="header">

        <!-- Logo -->
		<div class="header-left">
			<a href="/admin-index" class="logo">
				<img src="/assets/img/logo.png" alt="Logo">
			</a>
			<a href="/admin-index" class="logo logo-small">
				<img src="/assets/img/logo-small.png" alt="Logo" width="30" height="30">
			</a>
		</div>
		<!-- /Logo -->

        <!-- Sidebar Toggle -->
		<a href="javascript:void(0);" id="toggle_btn">
			<i class="fa fa-bars"></i>
		</a>
		<!-- /Sidebar Toggle -->

        <!-- Search -->
	    <div class="top-nav-search">
			<form>
				<input type="text" class="form-control" placeholder="Search here">
				<button class="btn" type="submit"><i class="fa fa-search"></i></button>
			</form>
		</div>
		<!-- /Search -->

        <!-- Mobile Menu Toggle -->
		<a class="mobile_btn" id="mobile_btn">
			<i class="fa fa-bars"></i>
		</a>
		<!-- /Mobile Menu Toggle -->

        <!-- Header Menu -->
        <ul class="nav user-menu">
			<!-- User Menu -->
			<li class="nav-item dropdown has-arrow main-drop">
				<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
					<span class="user-img">
						<img src="/assets/img/profiles/default.jpg" alt="">
						<span class="status online"></span>
					</span>
					<span>Admin</span>
				</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="/settings"><i data-feather="settings" class="mr-1"></i> Settings</a>
					<a class="dropdown-item" href="/logout"><i data-feather="log-out" class="mr-1"></i> Logout</a>
				</div>
			</li>
			<!-- /User Menu -->
		</ul>
		<!-- /Header Menu -->

    </div>
	<!-- /Header -->


</div>
<!-- /Main Wrapper -->

{include('admin/_footer.php')}

</body>
</html>