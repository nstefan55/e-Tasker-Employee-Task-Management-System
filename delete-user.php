<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
  include "DB_connection.php";
  include "app/Model/User.php";

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

    // Check if the user has any tasks assigned
    $tasks = get_tasks_by_user_id($conn, $id);
    if (count($tasks) > 0) {
      $em = "Cannot delete user with assigned tasks";
      header("Location: user.php?error=$em");
      exit();
    }

    $data = array($id, "employee");
    delete_user($conn, $data);
    $sm = "Deleted Successfully";
    header("Location: user.php?success=$sm");
    exit();
  } catch (PDOException $e) {
    // Log the error message for debugging
    error_log("Database error: " . $e->getMessage());

    // Display a user-friendly error message
    $em = "An error occurred while processing your request. Please try again later.";
    header("Location: user.php?error=$em");
    exit();
  }
} else {
  $em = "First login";
  header("Location: login.php?error=$em");
  exit();
}



function get_tasks_by_user_id($conn, $id)
{
  $sql = "SELECT * FROM tasks WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $tasks;
}
