<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
	include "DB_connection.php";
	include "app/Model/Task.php";
	include "app/Model/User.php";

	$tasks = get_all_tasks_by_id($conn, $_SESSION['id']);

?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>My Tasks</title>
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
				<h4 class="mb-4 fw-bold text-uppercase">My Tasks</h4>
				<?php if (isset($_GET['success'])) { ?>
					<div class="alert alert-success" role="alert">
						<?php echo stripcslashes($_GET['success']); ?>
					</div>
				<?php } ?>
				<?php if ($tasks != 0) { ?>
					<table class="table table-hover rounded mt-4 shadow table-light">
						<thead class="table-dark">
							<tr>
								<th scope=" col">#</th>
								<th scope="col" style=" width: 30%;">Title</th>
								<th scope="col" style="width: 30%;">Description</th>
								<th scope="col">Status</th>
								<th scope="col">Due Date</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 0;
							foreach ($tasks as $task) { ?>
								<tr>
									<th scope="row"><?= ++$i ?></th>
									<td><?= $task['title'] ?></td>
									<td><?= $task['description'] ?></td>
									<td><?= $task['status'] ?></td>
									<td><?= $task['due_date'] ?></td>
									<td>
										<a href="edit-task-employee.php?id=<?= $task['id'] ?>" class="btn btn-primary">Edit</a>
									</td>
								</tr>
							<?php	} ?>
						</tbody>
					</table>
				<?php } else { ?>
					<div class="card d-inline-flex justify-content-center container mt-5 w-auto">

						<div class="card-body">
							<h5 class="card-title">There are currently 0 Tasks assigned!</h5>
							<p class="card-text"></p>

						</div>
					</div>
				<?php  } ?>

			</section>
		</div>

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