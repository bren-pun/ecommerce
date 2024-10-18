<?php
session_start();
include '../includes/db.php';

$productId = $_GET['id'];
$sql = "SELECT * FROM products WHERE id=$productId";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $sql = "UPDATE products SET name='$name', description='$description', price=$price, stock=$stock WHERE id=$productId";
    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST">
    <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
    <textarea name="description" required><?php echo $product['description']; ?></textarea>
    <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
    <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required>
    <button type="submit">Update Product</button>
</form>
