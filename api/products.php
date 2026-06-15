<?php
// API produk
header('Content-Type: application/json');
include('../config/db_conn.php');

$action = isset($_GET['action']) ? $_GET['action'] : 'getAll';

// Ambil semua produk
if ($action == 'getAll') {
    $sql = "SELECT * FROM products ORDER BY id ASC";
    $result = $conn->query($sql);

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);
}

// Ambil detail produk berdasarkan ID
if ($action == 'getOne') {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "Product not found"]);
    }
}

// Cari produk berdasarkan nama
if ($action == 'search') {
    $keyword = $conn->real_escape_string($_GET['keyword']);
    $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%' ORDER BY id ASC";
    $result = $conn->query($sql);

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);
}

$conn->close();
?>
