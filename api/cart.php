<?php
// API untuk operasional keranjang belanja
session_start();
header('Content-Type: application/json');
include('../config/db_conn.php');

// Gunakan session_id untuk lacak keranjang
$session_id = session_id();

$action = isset($_GET['action']) ? $_GET['action'] : '';
if (empty($action) && isset($_POST['action'])) {
    $action = $_POST['action'];
}

// Ambil semua item di keranjang dari tabel cart & products
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

// Tambah item ke keranjang
if ($action == 'addToCart') {
    $product_id = intval($_POST['product_id']);

    // Cek apakah produk sudah ada di keranjang
    $check = $conn->query("SELECT * FROM cart WHERE product_id = $product_id AND session_id = '$session_id'");
    
    if ($check->num_rows > 0) {
        // Jika sudah ada, tambah jumlahnya
        $conn->query("UPDATE cart SET qty = qty + 1 WHERE product_id = $product_id AND session_id = '$session_id'");
    } else {
        // Tambah item baru ke database
        $conn->query("INSERT INTO cart (product_id, qty, session_id) VALUES ($product_id, 1, '$session_id')");
    }

    $count = $conn->query("SELECT SUM(qty) as total FROM cart WHERE session_id = '$session_id'")->fetch_assoc();
    echo json_encode(["success" => true, "cartCount" => intval($count['total'])]);
}

// Update jumlah barang
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

// Hapus barang dari keranjang
if ($action == 'removeFromCart') {
    $cart_id = intval($_POST['cart_id']);
    $conn->query("DELETE FROM cart WHERE id = $cart_id AND session_id = '$session_id'");

    echo json_encode(["success" => true]);
}

// Ambil total item di keranjang
if ($action == 'getCount') {
    $count = $conn->query("SELECT SUM(qty) as total FROM cart WHERE session_id = '$session_id'")->fetch_assoc();
    echo json_encode(["cartCount" => intval($count['total'])]);
}

// Proses checkout dari keranjang
if ($action == 'checkout') {
    // Ambil semua item di keranjang for this session
    $sql = "SELECT cart.qty, products.id as product_id, products.name, products.price, products.image
            FROM cart
            JOIN products ON cart.product_id = products.id
            WHERE cart.session_id = '$session_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        echo json_encode(["success" => false, "message" => "Cart is empty"]);
        $conn->close();
        exit;
    }

    $items = [];
    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
        $total += $row['price'] * $row['qty'];
    }

    $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $order_notes = isset($_POST['order_notes']) ? trim($_POST['order_notes']) : '';

    // Simpan data ke tabel orders
    $stmt = $conn->prepare("INSERT INTO orders (session_id, first_name, address, phone, email, order_notes, total_price, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->bind_param("ssssssi", $session_id, $first_name, $address, $phone, $email, $order_notes, $total);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    // Masukkan tiap item ke order_items
    $stmt2 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, qty, price_at_order) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($items as $item) {
        $stmt2->bind_param("iissii", $order_id, $item['product_id'], $item['name'], $item['image'], $item['qty'], $item['price']);
        $stmt2->execute();
    }
    $stmt2->close();

    // Bersihkan keranjang setelah checkout
    $conn->query("DELETE FROM cart WHERE session_id = '$session_id'");

    echo json_encode(["success" => true, "order_id" => $order_id, "message" => "Order placed successfully"]);
}

$conn->close();
?>
