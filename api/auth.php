<?php
// cek username dan password (hardcoded). 
// Kalau cocok, data disimpan ke dalam $_SESSION

// API login user
session_start();
header('Content-Type: application/json');
include('../config/db_conn.php');

$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action == 'login') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Cek login user sederhana (hardcoded)
    if ($username == 'brandon' && $password == '1234') {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_name'] = 'Brandon';
        echo json_encode(["success" => true, "message" => "Login successful"]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid username or password"]);
    }
}

if ($action == 'logout') {
    session_destroy();
    echo json_encode(["success" => true]);
}

// memastikan status session user 
if ($action == 'checkSession') {
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
        echo json_encode(["loggedIn" => true, "userName" => $_SESSION['user_name']]);
    } else {
        echo json_encode(["loggedIn" => false]);
    }
}

$conn->close();
?>
