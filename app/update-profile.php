<?php
session_start();

function validate_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
	if ($_SESSION['role'] == 'employee' && isset($_POST['confirm_password'], $_POST['new_password'], $_POST['password'], $_POST['full_name'])) {
		include "../DB_connection.php";

		$password = validate_input($_POST['password']);
		$full_name = validate_input($_POST['full_name']);
		$new_password = validate_input($_POST['new_password']);
		$confirm_password = validate_input($_POST['confirm_password']);
		$id = $_SESSION['id'];

		if (empty($password) || empty($new_password) || empty($confirm_password)) {
			$em = "Password is required";
			header("Location: ../edit_profile.php?error=$em");
			exit();
		} elseif (empty($full_name)) {
			$em = "Full name is required";
			header("Location: ../edit_profile.php?error=$em");
			exit();
		} elseif ($confirm_password != $new_password) {
			$em = "Passwords don't match!";
			header("Location: ../edit_profile.php?error=$em");
			exit();
		} else {
			include "Model/User.php";

			$user = get_user_by_id($conn, $id);
			if ($user) {
				if (password_verify($password, $user['password'])) {
					$new_password = password_hash($new_password, PASSWORD_DEFAULT);

					$data = array($full_name, $new_password, $id);
					update_profile($conn, $data);

					$em = "User updated successfully";
					header("Location: ../edit_profile.php?success=$em");
					exit();
				} else {
					$em = "Incorrect password";
					header("Location: ../edit_profile.php?error=$em");
					exit();
				}
			} else {
				$em = "Unknown error occurred";
				header("Location: ../edit_profile.php?error=$em");
				exit();
			}
		}
	} else {
		$em = "Unknown error occurred";
		header("Location: ../edit_profile.php?error=$em");
		exit();
	}
} else {
	$em = "First login";
	header("Location: ../login.php?error=$em");
	exit();
}
