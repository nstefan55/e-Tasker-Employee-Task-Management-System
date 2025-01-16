<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Task Management System</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="login-body bg-dark d-flex align-items-center min-vh-100">

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<form method="POST" action="app/login.php" class="shadow p-5 rounded bg-light">

					<h1 class="h1 fw-bold">LOGIN</h1>
					<?php if (isset($_GET['info'])) { ?>
						<div class="alert alert-info text-center" role="alert">
							<h4 class="alert-heading">Welcome User to
								<div class="">
									<span class="text-warning">e-</span><strong>TASKER</strong>
								</div>
							</h4>
							<hr>
							<p class="text-start">If you already registered to the platform please enter your valid username and password bellow,</p>
							<p class="text-start">otherwise, please reffer to the sign up page!</p>
						</div>
					<?php } ?>

					<?php if (isset($_GET['error'])) { ?>
						<div class="alert alert-danger" role="alert">
							<?php echo stripcslashes($_GET['error']); ?>
						</div>
					<?php } ?>

					<?php if (isset($_GET['success'])) { ?>
						<div class="alert alert-success" role="alert">
							<?php echo stripcslashes($_GET['success']); ?>
						</div>
					<?php } ?>

					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Username</label>
						<input type="text" class="form-control w-100" name="user_name">
					</div>
					<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Password</label>
						<input type="password" class="form-control w-100" name="password" id="exampleInputPassword1">
					</div>
					<button type="submit" class="btn btn-lg btn-warning fw-bold">LOGIN</button>
					<a href="register.php">
						<button type="button" class="btn btn-lg btn-warning fw-bold">New around? Sign Up!</button>
					</a>
				</form>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>