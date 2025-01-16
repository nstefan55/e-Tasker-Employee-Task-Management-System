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
		<title>Profile</title>
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
			<div class="card container ms-5">
				<div class=" card-header">
					<h4 class="fw-bold">Profile<a href="edit_profile.php" class="btn btn-warning fw-bold btn-sm float-right">Edit Profile</a></h4>
				</div>
				<div class="card-body">
					<table class="table">
						<tr>
							<td><strong>Full Name</strong></td>
							<td><?= $user['full_name'] ?></td>
						</tr>
						<tr>
							<td><strong>User name</strong></td>
							<td><?= $user['username'] ?></td>
						</tr>
						<tr>
							<td><strong>Joined At</strong></td>
							<td><?= $user['created_at'] ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

		<script type="text/javascript">
			let active = document.querySelector("#navList li:nth-child(3)");
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