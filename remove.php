<?php
require_once 'dbconnect.php';

if (isset($_GET['cart_id'])) {
    // Check if cart_id is set and is a valid integer
    if (isset($_GET['cart_id']) && filter_var($_GET['cart_id'], FILTER_VALIDATE_INT)) {
        $cart_id = $_GET['cart_id'];

        // Prepare and execute a DELETE statement to remove the cart record from the database
        $delete_query = "DELETE FROM Cart WHERE cart_id = :cart_id";
        $stmt = $conn->prepare($delete_query);
        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->execute();

        // Redirect the user back to the original page
        header('Location: cart.php');
        exit();
    }
}
