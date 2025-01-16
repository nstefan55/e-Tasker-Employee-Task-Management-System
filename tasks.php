<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
	include "DB_connection.php";
	include "app/Model/Task.php";
	include "app/Model/User.php";

	$text = "All Tasks";
	if (isset($_GET['due_date']) &&  $_GET['due_date'] == "Due Today") {
		$text = "Due Today";
		$tasks = get_all_tasks_due_today($conn);
		$num_task = count_tasks_due_today($conn);
	} else if (isset($_GET['due_date']) &&  $_GET['due_date'] == "Overdue") {
		$text = "Overdue";
		$tasks = get_all_tasks_overdue($conn);
		$num_task = count_tasks_overdue($conn);
	} else if (isset($_GET['due_date']) &&  $_GET['due_date'] == "No Deadline") {
		$text = "No Deadline";
		$tasks = get_all_tasks_NoDeadline($conn);
		$num_task = count_tasks_NoDeadline($conn);
	} else {
		$tasks = get_all_tasks($conn);
		$num_task = count_tasks($conn);
	}
	$users = get_all_users($conn);


?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>All Tasks</title>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/font.css">

	</head>

	<body>
		<input type="checkbox" id="checkbox">
		<?php include "inc/header.php" ?>
		<div class="body">
			<?php include "inc/nav.php" ?>
			<section class="section-1 bg-white">
				<h4 class="mb-3">
					<a href="create_task.php" class="btn btn-warning fw-bold">Create Task</a>
					<a href="tasks.php?due_date=Due Today" class="btn btn-outline-secondary">Due Today</a>
					<a href="tasks.php?due_date=Overdue" class="btn btn-outline-secondary">Overdue</a>
					<a href="tasks.php?due_date=No Deadline" class="btn btn-outline-secondary">No Deadline</a>
					<a href="tasks.php" class="btn btn-outline-secondary">All Tasks</a>
				</h4>
				<h4 class="h1 fw-bold mt-5 mb-4"><?= $text ?> (<?= $num_task ?>)</h4>
				<?php if (isset($_GET['success'])) { ?>
					<div class="alert alert-success" role="alert">
						<?php echo stripcslashes($_GET['success']); ?>
					</div>
				<?php } ?>
				<?php if ($tasks != 0) { ?>
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th>#</th>
								<th>Title</th>
								<th style="width: 30%;">Description</th>
								<th>Assigned To</th>
								<th>Due Date</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 0;
							foreach ($tasks as $task) { ?>
								<tr>
									<td><?= ++$i ?></td>
									<td><?= $task['title'] ?></td>
									<td><?= strlen($task['description']) > 50 ? substr($task['description'], 0, 50) . '...' : $task['description'] ?></td>
									<td>
										<?php
										foreach ($users as $user) {
											if ($user['id'] == $task['assigned_to']) {
												echo $user['full_name'];
											}
										} ?>
									</td>
									<td><?php if ($task['due_date'] == "") echo "No Deadline";
										else echo $task['due_date'];
										?></td>
									<td><?= $task['status'] ?></td>
									<td>
										<a href="edit-task.php?id=<?= $task['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
										<a href="delete-task.php?id=<?= $task['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
									</td>
								</tr>
							<?php	} ?>
						</tbody>
					</table>
				<?php } else { ?>
					<div class="card d-inline-flex justify-content-center container mt-5 w-auto">

						<div class="card-body">
							<h5 class="card-title">There are currently 0 Tasks on category "<?= $text ?>" </h5>
							<p class="card-text"></p>
							<a href="create_task.php" class="btn btn-warning fw-bold">Add New Task</a>
						</div>
					</div>
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