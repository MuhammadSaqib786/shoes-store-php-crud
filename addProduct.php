<?php
// Include database connection
include_once('dbconnect.php');

// Get data from form
$name = $_POST["name"];
$category = $_POST["category"];
$description = $_POST["description"];
$price = $_POST["price"];
$image = $_POST["image"];

// Prepare SQL statement
$sql = "INSERT INTO Product (category_id, name, description, price, image) VALUES (:category_id, :name, :description, :price, :image)";

// Prepare and execute the statement
$stmt = $conn->prepare($sql);


if ($stmt->execute(array(
    ':category_id' => $category,
    ':name' => $name,
    ':description' => $description,
    ':price' => $price,
    ':image' => $image
  ))) {
    echo "<script>alert('Product added successfully.');</script>";
    header('Location: adminhome.php');
} else {
    echo "Error: " . $sql . "<br>" . $stmt->errorInfo()[2];
}

// Close database connection
$conn = null;
?>
