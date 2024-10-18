<?php
session_start(); // Start the session
include '../includes/db.php';
include '../includes/header.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set. Redirecting to login.";
    header('Location: ../login.php'); // Redirect to login page
    exit();
} else {
    // Debug line: You can remove this in production
    echo "User ID is: " . htmlspecialchars($_SESSION['user_id']);
}

$userId = $_SESSION['user_id']; // Store user ID in a variable

?>

<div class="container">
    <h2>My Orders</h2>
    <?php
    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT orders.*, products.name FROM orders JOIN products ON orders.product_id = products.id WHERE user_id = ?");
    
    // Check for SQL preparation errors
    if (!$stmt) {
        echo "Error preparing statement: " . htmlspecialchars($conn->error);
        exit();
    }

    // Bind the user ID parameter
    $stmt->bind_param("i", $userId);
    
    // Execute the statement
    if (!$stmt->execute()) {
        echo "Error executing statement: " . htmlspecialchars($stmt->error);
        exit();
    }

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "Order ID: " . htmlspecialchars($row['id']) . 
                 ", Product: " . htmlspecialchars($row['name']) . 
                 ", Quantity: " . htmlspecialchars($row['quantity']) . 
                 ", Order Date: " . htmlspecialchars($row['order_date']);
            echo "</div>";
        }
    } else {
        echo "No orders found."; // Message if no orders exist
    }

    // Close the statement
    $stmt->close();
    ?>
</div>

<?php
// Close the database connection
$conn->close();
?>
