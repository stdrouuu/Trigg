<?php
// API for cart operations
session_start();
header('Content-Type: application/json');
include('../config/db_conn.php');

// Use session id to track user cart
$session_id = session_id();

$action = isset($_GET['action']) ? $_GET['action'] : '';
if (empty($action) && isset($_POST['action'])) {
    $action = $_POST['action'];
}

// Get all cart items
if ($action == 'getCart') {
    $sql = "SELECT cart.id as cart_id, cart.qty, products.* 
            FROM cart 
            JOIN products ON cart.product_id = products.id 
            WHERE cart.session_id = '$session_id'
            ORDER BY cart.id ASC";
    $result = $conn->query($sql);

    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }

    echo json_encode($items);
}

// Add item to cart
if ($action == 'addToCart') {
    $product_id = intval($_POST['product_id']);

    // Check if item already in cart
    $check = $conn->query("SELECT * FROM cart WHERE product_id = $product_id AND session_id = '$session_id'");
    
    if ($check->num_rows > 0) {
        // If already exists, increase qty
        $conn->query("UPDATE cart SET qty = qty + 1 WHERE product_id = $product_id AND session_id = '$session_id'");
    } else {
        // Insert new item
        $conn->query("INSERT INTO cart (product_id, qty, session_id) VALUES ($product_id, 1, '$session_id')");
    }

    // Return updated cart count
    $count = $conn->query("SELECT SUM(qty) as total FROM cart WHERE session_id = '$session_id'")->fetch_assoc();
    echo json_encode(["success" => true, "cartCount" => intval($count['total'])]);
}

// Update quantity
if ($action == 'updateQty') {
    $cart_id = intval($_POST['cart_id']);
    $qty = intval($_POST['qty']);

    if ($qty <= 0) {
        $conn->query("DELETE FROM cart WHERE id = $cart_id AND session_id = '$session_id'");
    } else {
        $conn->query("UPDATE cart SET qty = $qty WHERE id = $cart_id AND session_id = '$session_id'");
    }

    echo json_encode(["success" => true]);
}

// Remove item from cart
if ($action == 'removeFromCart') {
    $cart_id = intval($_POST['cart_id']);
    $conn->query("DELETE FROM cart WHERE id = $cart_id AND session_id = '$session_id'");

    echo json_encode(["success" => true]);
}

// Get cart count
if ($action == 'getCount') {
    $count = $conn->query("SELECT SUM(qty) as total FROM cart WHERE session_id = '$session_id'")->fetch_assoc();
    echo json_encode(["cartCount" => intval($count['total'])]);
}

$conn->close();
?>
