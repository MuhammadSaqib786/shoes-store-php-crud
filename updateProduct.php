<?php
// Include database connection
include_once('dbconnect.php');

// Get data from form
$product_id = $_POST['product_id'];
$name = $_POST['name'];
$category = $_POST['category'];
$description = $_POST['description'];
$price = $_POST['price'];
$image = $_POST['image'];

// Prepare SQL statement
$sql = "UPDATE Product SET name = :name, category_id = :category, description = :description, price = :price, image = :image WHERE product_id = :product_id";

// Prepare and execute the statement
$stmt = $conn->prepare($sql);


if ($stmt->execute(array(
    ':category' => $category,
    ':name' => $name,
    ':description' => $description,
    ':price' => $price,
    ':image' => $image,
    ':product_id' => $product_id
  ))) {
    echo "<script>alert('Product updated successfully.');</script>";
    header('Location: adminhome.php');
} else {
    echo "Error: " . $sql . "<br>" . $stmt->errorInfo()[2];
}

// Close database connection
$conn = null;
?>
