<?php
session_start();
header('Content-Type: application/json');
include('../../config/db_conn.php');

$action = isset($_POST['action']) ? $_POST['action'] : '';

// Proses login admin
if ($action == 'login') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // cek data user dari database
    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $result = $conn->query($sql);

    // cek apakah user ada di DB (minimal > 0 kolom terbentuk)
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // cek password (password_verify untuk cek yang sudah di-hash)
        if (password_verify($password, $row['password']) || $password === $row['password']) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            echo json_encode(["success" => true, "message" => "Login successful"]);
        } else {
            echo json_encode(["success" => false, "message" => "Invalid username or password"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid username or password"]);
    }
}

// logout = session destroy
if ($action == 'logout') {
    session_destroy();
    echo json_encode(["success" => true]);
}

// cek session admin (apakah admin msh login?)
if ($action == 'checkSession') {
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] == true) {
        echo json_encode(["loggedIn" => true, "username" => $_SESSION['admin_username']]);
    } else {
        echo json_encode(["loggedIn" => false]);
    }
}

$conn->close();
?>
