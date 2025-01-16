<?php
session_start();
include "../DB_connection.php";

function validate_register_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['full_name'])) {
    $user_name = validate_register_input($_POST['user_name']);
    $password = validate_register_input($_POST['password']);
    $full_name = validate_register_input($_POST['full_name']);

    if (empty($user_name) || empty($password) || empty($full_name)) {
        $em = "All fields are required";
        header("Location: ../register.php?error=$em");
        exit();
    } else if (username_exists($conn, $user_name)) {
        $em = "Username already exists, try another one";
        header("Location: ../register.php?error=$em");
        exit();
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $data = array($full_name, $user_name, $password, "employee");

        include "Model/User.php";
        insert_user($conn, $data);

        $em = "User registered successfully";
        header("Location: ../login.php?success=$em");
        exit();
    }
} else {
}


function username_exists($conn, $user_name)
{
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_name]);
    return $stmt->rowCount() == 1;
}
