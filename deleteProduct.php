<?php
require_once 'dbconnect.php';

if (!isset($_GET['product_id'])) {
  header("Location: adminhome.php");
  exit();
}

$product_id = $_GET['product_id'];

// Delete the product from the database
$delete_query = "DELETE FROM Product WHERE product_id = :product_id";
$delete_statement = $conn->prepare($delete_query);
$delete_statement->execute(array(':product_id' => $product_id));

// Redirect to the admin home page
header("Location: adminhome.php");
exit();
?>
