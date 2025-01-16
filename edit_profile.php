<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "employee") {
	include "DB_connection.php";
	include "app/Model/User.php";
	$user = get_user_by_id($conn, $_SESSION['id']);

?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Edit Profile</title>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<?php include "inc/header.php" ?>
		<div class="body">
			<?php include "inc/nav.php" ?>
			<div class="card container">
				<div class="card-header w-100 text-center py-4">
					<h4>Edit Profile <a href="profile.php" class="btn btn-warning fw-bold">Return to Profile</a></h4>
				</div>
				<div class="card-body">
					<form class="form-1" method="POST" action="app/update-profile.php">
						<?php if (isset($_GET['error'])) { ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<?php echo stripcslashes($_GET['error']); ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php } ?>

						<?php if (isset($_GET['success'])) { ?>
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<?php echo stripcslashes($_GET['success']); ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php } ?>
						<div class="form-group">
							<label>Full Name</label>
							<input type="text" name="full_name" class="form-control" placeholder="Full Name" value="<?= $user['full_name'] ?>">
						</div>

						<div class="form-group">
							<label>Old Password</label>
							<input type="password" value="**********" name="password" class="form-control" placeholder="Old Password">
						</div>
						<div class="form-group">
							<label>New Password</label>
							<input type="password" name="new_password" class="form-control" placeholder="New Password">
						</div>
						<div class="form-group">
							<label>Confirm Password</label>
							<input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
						</div>

						<button class="btn btn-warning">Change</button>
					</form>
				</div>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
		<script type="text/javascript">
			let active = document.querySelector("#navList li:nth-child(3)");
			active.classList.add("active");

			document.querySelectorAll('.btn-close').forEach(button => {
				button.addEventListener('click', function() {
					const url = new URL(window.location.href);
					url.searchParams.delete('error');
					url.searchParams.delete('success');
					window.history.replaceState({}, document.title, url.toString());
				});
			});
		</script>
	</body>

	</html>
<?php } else {
	$em = "First login";
	header("Location: login.php?error=$em");
	exit();
}
?>