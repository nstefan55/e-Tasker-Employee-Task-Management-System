<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
	include "DB_connection.php";
	include "app/Model/User.php";

	if (!isset($_GET['id'])) {
		header("Location: user.php");
		exit();
	}
	$id = $_GET['id'];
	$user = get_user_by_id($conn, $id);

	if ($user == 0) {
		header("Location: user.php");
		exit();
	}

?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Edit User</title>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">

	</head>

	<body>
		<input type="checkbox" id="checkbox">
		<?php include "inc/header.php" ?>
		<div class="body">
			<?php include "inc/nav.php" ?>
			<section class="section-1 bg-white">
				<h4 class="fw-bold">Edit Users <a href="user.php" class="btn btn-warning fw-bold ms-3">Users</a></h4>
				<form class="form-1"
					method="POST"
					action="app/update-user.php">
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
					<div class="input-holder">
						<lable>Full Name</lable>
						<input type="text" name="full_name" class="input-1" placeholder="Full Name" value="<?= $user['full_name'] ?>"><br>
					</div>
					<div class="input-holder">
						<lable>Username</lable>
						<input type="text" name="user_name" value="<?= $user['username'] ?>" class="input-1" placeholder="Username"><br>
					</div>
					<div class="input-holder">
						<lable>Password</lable>
						<input type="text" value="**********" name="password" class="input-1" placeholder="Password"><br>
					</div>
					<input type="text" name="id" value="<?= $user['id'] ?>" hidden>

					<button class="edit-btn btn-warning fw-bold">Update</button>
				</form>

			</section>
		</div>

		<script type="text/javascript">
			let active = document.querySelector("#navList li:nth-child(2)");
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