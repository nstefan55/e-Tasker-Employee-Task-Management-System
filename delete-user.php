<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
  include "DB_connection.php";
  include "app/Model/User.php";
  include "app/Model/Task.php";

  if (!isset($_GET['id'])) {
    header("Location: user.php");
    exit();
  }
  $id = $_GET['id'];

  try {
    $user = get_user_by_id($conn, $id);

    if ($user == 0) {
      header("Location: user.php");
      exit();
    }

    $tasks = get_tasks_by_user_id($conn, $id);
    if (count($tasks) > 0) {
      $em = "Cannot delete user with assigned tasks";
      header("Location: user.php?error=$em");
      exit();
    }

    $data = array($id, "employee");
    delete_user($conn, $data);
    $sm = "User Deleted Successfully";
    header("Location: user.php?success=$sm");
    exit();
  } catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());

    $em = "An error occurred while processing your request. Please try again later.";
    header("Location: user.php?error=$em");
    exit();
  }
} else {
  $em = "First login";
  header("Location: login.php?error=$em");
  exit();
}
