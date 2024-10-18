<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php'); // Redirect to login if user_id is not set
    exit();
}

$user_id = $_SESSION['user_id']; // Retrieve user ID from the session

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']); // Ensure product_id is an integer

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO orders (user_id, product_id, quantity) VALUES (?, ?, ?)");
    $quantity = 1; // Assuming you want to add 1 product at a time

    // Bind parameters (i = integer)
    $stmt->bind_param("iii", $user_id, $product_id, $quantity);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Product added to cart successfully.";
    } else {
        echo "Error: " . $stmt->error; // More specific error message
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No product ID specified.";
}

// Close the database connection if needed
$conn->close();
?>
