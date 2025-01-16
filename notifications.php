<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
	include "DB_connection.php";
	include "app/Model/Notification.php";

	$notifications = get_all_my_notifications($conn, $_SESSION['id']);
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Notifications</title>
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
			<section class="section-1 bg-white  mt-4">
				<h4 class="mb-4">All Notifications</h4>
				<?php if (isset($_GET['success'])) { ?>
					<div class="alert alert-success" role="alert">
						<?php echo stripcslashes($_GET['success']); ?>
					</div>
				<?php } ?>
				<?php if ($notifications != 0) { ?>
					<table class="table table-hover table-striped table-bordered rounded">
						<thead class="table-light">
							<tr>
								<th>#</th>
								<th>Message</th>
								<th>Type</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 0;
							foreach ($notifications as $notification) { ?>
								<tr>
									<td><?= ++$i ?></td>
									<td><?= $notification['message'] ?></td>
									<td><?= $notification['type'] ?></td>
									<td><?= $notification['date'] ?></td>
								</tr>
							<?php	} ?>
						</tbody>
					</table>
				<?php } else { ?>
					<h3>You have 0 notifications</h3>
				<?php  } ?>
			</section>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

		<script type="text/javascript">
			let active = document.querySelector("#navList li:nth-child(4)");
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