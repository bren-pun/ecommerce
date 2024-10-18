<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $sql = "DELETE FROM products WHERE id=$productId";

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "No product ID provided.";
}
?>
<a href="index.php">Back to Admin Dashboard</a>
