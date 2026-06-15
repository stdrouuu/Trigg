<?php
// API CRUD Produk 
session_start();
header('Content-Type: application/json');
include('../../config/db_conn.php');

// Cek session admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] != true) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

$action = isset($_GET['action']) ? $_GET['action'] : '';
if (empty($action) && isset($_POST['action'])) {
    $action = $_POST['action'];
}

// Ambil semua produk
if ($action == 'getAll') {
    $sql = "SELECT * FROM products ORDER BY id DESC";
    $result = $conn->query($sql);

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);
}

// Tambah produk baru
if ($action == 'addProduct') {
    $name = $conn->real_escape_string($_POST['name']);
    $price = intval($_POST['price']);
    $label = $conn->real_escape_string($_POST['label']);
    $description = $conn->real_escape_string($_POST['description']);

    // Proses upload gambar produk
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = '../../assets/img/';
        $fileName = time() . '_'. basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = 'assets/img/' . $fileName;
        }
    }

    $sql = "INSERT INTO products (name, price, image, label, description) 
            VALUES ('$name', $price, '$imagePath', '$label', '$description')";

    if ($conn->query($sql)) {
        echo json_encode(["success" => true, "message" => "Product added successfully", "id" => $conn->insert_id]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to add product"]);
    }
}

// Update data produk
if ($action == 'updateProduct') {
    $id = intval($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $price = intval($_POST['price']);
    $label = $conn->real_escape_string($_POST['label']);
    $description = $conn->real_escape_string($_POST['description']);

    // Cek jika ada file gambar baru
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = '../../assets/img/';
        // ini kalau buat gaada angka depannya pas masukin foto di admiin
        // 17281931_nama-image.jpg
        // $fileName = basename($_FILES['image']['name']); 

        $fileName = time() . '_'. basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = 'assets/img/' . $fileName;
            $sql = "UPDATE products SET name='$name', price=$price, image='$imagePath', label='$label', description='$description' WHERE id=$id";
        }
    } else {
        $sql = "UPDATE products SET name='$name', price=$price, label='$label', description='$description' WHERE id=$id";
    }

    if ($conn->query($sql)) {
        echo json_encode(["success" => true, "message" => "Product updated successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update product"]);
    }
}

// Hapus produk dari database
if ($action == 'deleteProduct') {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM products WHERE id = $id";
    if ($conn->query($sql)) {
        echo json_encode(["success" => true, "message" => "Product deleted successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete product"]);
    }
}

$conn->close();
?>
