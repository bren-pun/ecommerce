<?php
session_start();
include '../includes/db.php';

$orderId = $_GET['id'];
$sql = "DELETE FROM orders WHERE id=$orderId";

if ($conn->query($sql) === TRUE) {
    echo "Order deleted successfully.";
} else {
    echo "Error: " . $conn->error;
}
?>
<a href="view_orders.php">Back to Orders</a>
