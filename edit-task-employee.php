<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "employee") {
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

		<link rel="stylesheet" href="css/style.css">

	</head>

	<body>
		<input type="checkbox" id="checkbox">
		<?php include "inc/header.php" ?>
		<div class="body">
			<?php include "inc/nav.php" ?>
			<section class="container bg-white ms-5 mt-3 section-1">
				<div class="card">
					<div class="card-body">
						<h2 class="card-title fw-bold d-flex">Edit Task <a href="my_task.php" class="btn btn-warning fw-bold mb-3 ms-3">Tasks</a></h2>
						<form method="POST" action="app/update-task-employee.php">
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
							<div class="mb-3">
								<p><b>Title: </b><?= $task['title'] ?></p>
							</div>
							<div class="mb-3">
								<p><b>Description: </b><?= $task['description'] ?></p>
							</div>
							<div class="mb-3">
								<label for="status" class="form-label">Status</label>
								<select name="status" class="form-select" id="status">
									<option <?php if ($task['status'] == "pending") echo "selected"; ?>>pending</option>
									<option <?php if ($task['status'] == "in_progress") echo "selected"; ?>>in_progress</option>
									<option <?php if ($task['status'] == "completed") echo "selected"; ?>>completed</option>
								</select>
							</div>
							<input type="text" name="id" value="<?= $task['id'] ?>" hidden>
							<button class="btn btn-warning fw-bold">Update</button>
						</form>
					</div>
				</div>
			</section>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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