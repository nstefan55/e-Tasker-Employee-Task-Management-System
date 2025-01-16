<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

	include "DB_connection.php";
	include "app/Model/Task.php";
	include "app/Model/User.php";

	if ($_SESSION['role'] == "admin") {
		$todaydue_task = count_tasks_due_today($conn);
		$overdue_task = count_tasks_overdue($conn);
		$nodeadline_task = count_tasks_NoDeadline($conn);
		$num_task = count_tasks($conn);
		$num_users = count_users($conn);
		$pending = count_pending_tasks($conn);
		$in_progress = count_in_progress_tasks($conn);
		$completed = count_completed_tasks($conn);
	} else {
		$num_my_task = count_my_tasks($conn, $_SESSION['id']);
		$overdue_task = count_my_tasks_overdue($conn, $_SESSION['id']);
		$nodeadline_task = count_my_tasks_NoDeadline($conn, $_SESSION['id']);
		$pending = count_my_pending_tasks($conn, $_SESSION['id']);
		$in_progress = count_my_in_progress_tasks($conn, $_SESSION['id']);
		$completed = count_my_completed_tasks($conn, $_SESSION['id']);
	}
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Dashboard</title>
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
			<section class="section-1 bg-dark">
				<div class="container">
					<div class="row justify-content-center mt-5">
						<?php if ($_SESSION['role'] == "admin") { ?>
							<div class="col-md-4 mb-4">
								<div class="card text-center">
									<div class="card-body">
										<i class="fa fa-users"></i>
										<h5 class="card-title"><?= $num_users ?> <?= $num_users == 1 ? 'Employee' : 'Employees' ?></h5>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-4 ">
								<div class="card text-center">
									<div class="card-body">
										<i class="fa fa-tasks"></i>
										<h5 class="card-title"><?= $num_task ?> Tasks</h5>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-4">
								<div class="card text-center">
									<div class="card-body">
										<i class="fa fa-window-close-o"></i>
										<h5 class="card-title"><?= $overdue_task ?> Overdue</h5>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-4">
								<div class="card text-center">
									<div class="card-body">
										<i class="fa fa-clock-o"></i>
										<h5 class="card-title"><?= $nodeadline_task ?> No Deadline</h5>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-4">
								<div class="card text-center">
									<div class="card-body">
										<i class="fa fa-exclamation-triangle"></i>
										<h5 class="card-title"><?= $todaydue_task ?> Due Today</h5>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-4">
								<div class="card text-center">
									<div class="card-body">
										<i class="fa fa-bell"></i>
										<h5 class="card-title"><?= $overdue_task ?> Notifications</h5>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-4">
								<div class="card text-center">
									<div class="card-body">
										<i class="fa fa-square-o"></i>
										<h5 class="card-title"><?= $pending ?> Pending</h5>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-4">
								<div class="card text-center">
									<div class="card-body">
										<i class="fa fa-spinner"></i>
										<h5 class="card-title"><?= $in_progress ?> In progress</h5>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-4">
								<div class="card text-center">
									<div class="card-body">
										<i class="fa fa-check-square-o"></i>
										<h5 class="card-title"><?= $completed ?> Completed</h5>
									</div>
								</div>
							</div>
						<?php } else { ?>
							<div class="col-md-4 mb-4">
								<div class="card text-center">
									<div class="card-body">
										<i class="fa fa-tasks"></i>
										<h5 class="card-title"><?= $num_my_task ?> <?= $num_my_task == 1 ? 'Task' : 'Tasks' ?></h5>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-4">
								<div class="card text-center">
									<div class="card-body">
										<i class="fa fa-window-close-o"></i>
										<h5 class="card-title"><?= $overdue_task ?> Overdue</h5>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-4">
								<div class="card text-center">
									<div class="card-body">
										<i class="fa fa-clock-o"></i>
										<h5 class="card-title"><?= $nodeadline_task ?> No Deadline</h5>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-4">
								<div class="card text-center">
									<div class="card-body">
										<i class="fa fa-square-o"></i>
										<h5 class="card-title"><?= $pending ?> Pending</h5>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-4">
								<div class="card text-center">
									<div class="card-body">
										<i class="fa fa-spinner"></i>
										<h5 class="card-title"><?= $in_progress ?> In progress</h5>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-4">
								<div class="card text-center">
									<div class="card-body">
										<i class="fa fa-check-square-o"></i>
										<h5 class="card-title"><?= $completed ?> Completed</h5>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</section>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

		<script type="text/javascript">
			let active = document.querySelector("#navList li:nth-child(1)");
			active.classList.add("active");
		</script>

	</body>

	</html>
<?php } else {
	$em = "First Login";
	header("Location: login.php?info=$em");
	exit();
}
?>