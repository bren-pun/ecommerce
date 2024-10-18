<?php
session_start();

// Check if the user is logged in and has the correct role
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'user') {
    header('Location: ../login.php'); // Redirect to login if not authenticated
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>User Dashboard</h1>
        <nav>
            <ul>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2> <!-- Escaped output for security -->
        <a href="view_products.php">View Products</a> | <!-- Added a separator for clarity -->
        <a href="view_orders.php">View My Orders</a>
    </main>

    <footer>
        <p>&copy; 2024 E-commerce System. All rights reserved.</p>
    </footer>
</body>
</html>
