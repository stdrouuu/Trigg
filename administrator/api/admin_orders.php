<?php
session_start();
header('Content-Type: application/json');

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] != true) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

include('../../config/db_conn.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';
if (empty($action) && isset($_POST['action'])) {
    $action = $_POST['action'];
}


// Ambil semua data pesanan
if ($action == 'getAllOrders') {
    $sql = "SELECT o.*, 
               (SELECT GROUP_CONCAT(CONCAT(oi.product_name, ' (x', oi.qty, ')') SEPARATOR ', ') FROM order_items oi WHERE oi.order_id = o.id) as items_summary
            FROM orders o
            ORDER BY o.created_at DESC";
    $result = $conn->query($sql);
    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    echo json_encode($orders);
}

// Ambil item dari pesanan tertentu
if ($action == 'getOrderItems') {
    $order_id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM order_items WHERE order_id = $order_id");
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    echo json_encode($items);
}

// Update status pesanan
if ($action == 'updateOrderStatus') {
    $order_id = intval($_POST['order_id']);
    $status   = $conn->real_escape_string($_POST['status']);

    $allowed = ['pending', 'processing', 'shipped', 'delivered'];
    if (!in_array($status, $allowed)) {
        echo json_encode(["success" => false, "message" => "Invalid status"]);
        $conn->close();
        exit;
    }

    $conn->query("UPDATE orders SET status = '$status' WHERE id = $order_id");
    echo json_encode(["success" => true, "message" => "Order status updated"]);
}

// Ambil semua data komplain
if ($action == 'getAllComplaints') {
    $sql = "SELECT * FROM complaints ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $complaints = [];
    while ($row = $result->fetch_assoc()) {
        $complaints[] = $row;
    }
    echo json_encode($complaints);
}

// Update status komplain
if ($action == 'updateComplaintStatus') {
    $complaint_id = intval($_POST['complaint_id']);
    $status       = $conn->real_escape_string($_POST['status']);

    $allowed = ['open', 'in_review', 'resolved'];
    if (!in_array($status, $allowed)) {
        echo json_encode(["success" => false, "message" => "Invalid status"]);
        $conn->close();
        exit;
    }

    $conn->query("UPDATE complaints SET status = '$status' WHERE id = $complaint_id");
    echo json_encode(["success" => true, "message" => "Complaint status updated"]);
}

$conn->close();
?>
