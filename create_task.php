<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
	include "DB_connection.php";
	include "app/Model/User.php";

	$users = get_all_users($conn);

?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Create Task</title>
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
			<section class="section-1 bg-white ms-4">
				<h4 class="ml-5 fw-bold mb-4">Create Task </h4>
				<form class="container ml-5"
					method="POST"
					action="app/add-task.php">
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
					<div class="input-holder form-group">
						<lable>Title</lable>
						<input type="text" name="title" class="input-1 form-control" placeholder="Title"><br>
					</div>
					<div class="input-holder form-group">
						<lable>Description</lable>
						<textarea type="text" name="description" class="input-1 form-control" placeholder="Description"></textarea><br>
					</div>
					<div class="input-holder form-group">
						<lable>Due Date</lable>
						<input type="date" name="due_date" class="input-1 form-control" placeholder="Due Date"><br>
					</div>
					<div class="input-holder form-group">
						<lable>Assigned to</lable>
						<select name="assigned_to" class="input-1 form-control">
							<option value="0">Select employee</option>
							<?php if ($users != 0) {
								foreach ($users as $user) {
							?>
									<option value="<?= $user['id'] ?>"><?= $user['full_name'] ?></option>
							<?php }
							} ?>
						</select><br>
					</div>
					<button class="edit-btn btn btn-warning fw-bold">Create Task</button>
				</form>

			</section>
		</div>

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