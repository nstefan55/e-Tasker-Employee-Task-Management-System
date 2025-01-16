<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
	include "DB_connection.php";
	include "app/Model/Task.php";
	include "app/Model/User.php";

	if (!isset($_GET['id'])) {
		header("Location: tasks.php");
		exit();
	}
	$id = $_GET['id'];
	$task = get_task_by_id($conn, $id);

	if ($task == 0) {
		header("Location: tasks.php");
		exit();
	}
	$users = get_all_users($conn);
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Edit Task</title>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/dashboard_animations.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<input type="checkbox" id="checkbox">
		<?php include "inc/header.php" ?>
		<div class="body">
			<?php include "inc/nav.php" ?>
			<section class="ml-5 container section-1 bg-white">
				<h4 class="fw-bold">Edit Task <a href="tasks.php" class="btn btn-warning fw-bold ms-3">Tasks</a></h4>
				<form
					method="POST"
					action="app/update-task.php">
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
						<label>Title</label>
						<input type="text" name="title" class="form-control" placeholder="Full Name" value="<?= $task['title'] ?>"><br>
					</div>
					<div class="input-holder">
						<label>Description</label>
						<textarea name="description" rows="5" class="form-control"><?= $task['description'] ?></textarea><br>
					</div>
					<div class="input-holder">
						<label>Snooze</label>
						<input type="date" name="due_date" class="form-control" placeholder="Snooze" value="<?= $task['due_date'] ?>"><br>
					</div>

					<div class="input-holder">
						<label>Assigned to</label>
						<select name="assigned_to" class="form-control">
							<option value="0">Select employee</option>
							<?php if ($users != 0) {
								foreach ($users as $user) {
									if ($task['assigned_to'] == $user['id']) { ?>
										<option selected value="<?= $user['id'] ?>"><?= $user['full_name'] ?></option>
									<?php } else { ?>
										<option value="<?= $user['id'] ?>"><?= $user['full_name'] ?></option>
							<?php }
								}
							} ?>
						</select><br>
					</div>
					<input type="text" name="id" value="<?= $task['id'] ?>" hidden>

					<button class="btn btn-warning fw-bold">Update</button>
				</form>

			</section>
		</div>

		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
		<script type="text/javascript">
			let active = document.querySelector("#navList li:nth-child(4)");
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