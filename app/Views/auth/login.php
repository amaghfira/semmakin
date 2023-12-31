<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SEMMAKIN</title>
	<link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>/dist/images/logos/favicon.png" />
	<link rel="stylesheet" href="<?= base_url(); ?>/dist/css/styles.min.css" />
</head>

<body>
	<?php
	$session = session();
	$login = $session->getFlashdata('login');
	$username = $session->getFlashdata('username');
	$password = $session->getFlashdata('password');
	?>
	<?php if ($username) { ?>
		<p style="color:red"><?php echo $username ?></p>
	<?php } ?>

	<?php if ($password) { ?>
		<p style="color:red"><?php echo $password ?></p>
	<?php } ?>

	<?php if ($login) { ?>
		<p style="color:green"><?php echo $login ?></p>
	<?php } ?>

	<!--  Body Wrapper -->
	<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
		<div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
			<div class="d-flex align-items-center justify-content-center w-100">
				<div class="row justify-content-center w-100">
					<div class="col-md-8 col-lg-6 col-xxl-3">
						<div class="card mb-0">
							<div class="card-body">
								<a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
									<!-- <img src="<?= base_url(); ?>/dist/images/logos/dark-logo.svg" width="180" alt=""> -->
									<h3>SEMMAKIN</h3>
								</a>
								<p class="text-center">Sistem Informasi Manajemen Kemiskinan</p>
								<form method="post" action="<?php echo base_url(); ?>/auth/valid_login" class="signin-form">
									<div class="mb-3">
										<label for="name" class="form-label">Username</label>
										<input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
									</div>
									<div class="mb-4">
										<label for="password" class="form-label">Password</label>
										<input type="password" class="form-control" id="password" name="password">
									</div>
									<div class="d-flex align-items-center justify-content-between mb-4">
										<div class="form-check">
											<input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
											<label class="form-check-label text-dark" for="flexCheckChecked">
												Remeber this Device
											</label>
										</div>
										<a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
									</div>
									<button type="submit" name="login" class="form-control btn btn-primary submit px-3">Sign In</button>
									<div class="d-flex align-items-center justify-content-center">
										<!-- <p class="fs-4 mb-0 fw-bold">New to Modernize?</p> -->
										<a class="text-primary fw-bold ms-2" href="./authentication-register.html">Create an account</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?= base_url(); ?>/dist/libs/jquery/dist/jquery.min.js"></script>
	<script src="<?= base_url(); ?>/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>