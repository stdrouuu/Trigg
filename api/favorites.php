<?php
// API favorit user
session_start();
header('Content-Type: application/json');
include('../config/db_conn.php');

$session_id = session_id();

$action = isset($_GET['action']) ? $_GET['action'] : '';
if (empty($action) && isset($_POST['action'])) {
    $action = $_POST['action'];
}

// Ambil semua produk favorit
if ($action == 'getFavorites') {
    $sql = "SELECT favorites.id as fav_id, products.* 
            FROM favorites 
            JOIN products ON favorites.product_id = products.id 
            WHERE favorites.session_id = '$session_id'
            ORDER BY favorites.id DESC";
    $result = $conn->query($sql);

    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }

    echo json_encode($items);
}

// Toggle favorit
if ($action == 'toggleFavorite') {
    $product_id = intval($_POST['product_id']);

    // Cek apakah sudah difavoritkan
    $check = $conn->query("SELECT * FROM favorites WHERE product_id = $product_id AND session_id = '$session_id'");
    
    if ($check->num_rows > 0) {
        // Hapus dari favorit
        $conn->query("DELETE FROM favorites WHERE product_id = $product_id AND session_id = '$session_id'");
        echo json_encode(["success" => true, "status" => "removed"]);
    } else {
        // Tambah ke favorit
        $conn->query("INSERT INTO favorites (product_id, session_id) VALUES ($product_id, '$session_id')");
        echo json_encode(["success" => true, "status" => "added"]);
    }
}

// Cek status favorit produk
if ($action == 'checkFavorite') {
    $product_id = intval($_GET['product_id']);
    $check = $conn->query("SELECT * FROM favorites WHERE product_id = $product_id AND session_id = '$session_id'");
    
    echo json_encode(["isFavorited" => $check->num_rows > 0]);
}

// Hapus dari favorit
if ($action == 'removeFavorite') {
    $fav_id = intval($_POST['fav_id']);
    $conn->query("DELETE FROM favorites WHERE id = $fav_id AND session_id = '$session_id'");

    echo json_encode(["success" => true]);
}

$conn->close();
?>
