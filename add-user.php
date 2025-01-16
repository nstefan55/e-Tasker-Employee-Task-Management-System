<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {

?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Add User</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
	</head>

	<body>
		<input type="checkbox" id="checkbox">
		<?php include "inc/header.php" ?>
		<div class="body">
			<?php include "inc/nav.php" ?>
			<section class="section-1 bg-white">
				<div class="py-5 d-flex justify-content-center flex-column">
					<div class="ml-4 mb-4 container">
						<h4>Add Users <a href="user.php" class="btn btn-warning ms-3 fw-bold">All Users</a></h4>
					</div>
					<form class="container ml-4"
						method="POST"
						action="app/add-user.php">
						<?php if (isset($_GET['error'])) { ?>
							<div class=" alert alert-danger" role="alert">
								<?php echo stripcslashes($_GET['error']); ?>
							</div>
						<?php } ?>

						<?php if (isset($_GET['success'])) { ?>
							<div class="alert alert-success" role="alert">
								<?php echo stripcslashes($_GET['success']); ?>
							</div>
						<?php } ?>
						<div class="form-group">
							<label for="full_name">Full Name</label>
							<input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full Name">
						</div>
						<div class="form-group">
							<label for="user_name">Username</label>
							<input type="text" name="user_name" class="form-control" id="user_name" placeholder="Username">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" class="form-control" id="password" placeholder="Password">
						</div>

						<button type="submit" class="btn btn-primary">Add</button>
					</form>
				</div>

			</section>
		</div>

		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
		<script type="text/javascript">
			let active = document.querySelector("#navList li:nth-child(2)");
			active.classList.add("active");
		</script>
	</body>

	</html>
<?php } else {
	$em = "First login";
	header("Location: login.php?error=$em");
	exit();
}
?>