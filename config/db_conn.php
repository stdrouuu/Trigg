<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "20222_wp2_412024022";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Auto-migrate dummy session data to current session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_sid = session_id();
if ($current_sid) {
    $check_orders = $conn->query("SELECT COUNT(*) as cnt FROM orders WHERE session_id = '$current_sid'");
    if ($check_orders) {
        $has_orders = intval($check_orders->fetch_assoc()['cnt']);
        if ($has_orders === 0) {
            $dummy_sid = 'gu0e8jhqqc6jmd27qlpc1l14jr';
            // Migrate main dummy data
            $conn->query("UPDATE cart SET session_id = '$current_sid' WHERE session_id = '$dummy_sid'");
            $conn->query("UPDATE complaints SET session_id = '$current_sid' WHERE session_id = '$dummy_sid'");
            $conn->query("UPDATE favorites SET session_id = '$current_sid' WHERE session_id = '$dummy_sid'");
            $conn->query("UPDATE orders SET session_id = '$current_sid' WHERE session_id = '$dummy_sid'");
            
            // Migrate other secondary dummy session data
            $other_dummies = ['kh7r0djbgjv7vo153qnldq0bcg', 'lsifocvjgpk18go5kkga890vtv', 'ran9f8hss6kvle3isi4pd1405r'];
            foreach ($other_dummies as $o_dummy) {
                $conn->query("UPDATE cart SET session_id = '$current_sid' WHERE session_id = '$o_dummy'");
                $conn->query("UPDATE favorites SET session_id = '$current_sid' WHERE session_id = '$o_dummy'");
            }
        }
    }
}
?>