<?php
require_once 'dbconnect.php';

// Check if the user is logged in
session_start();
if (!isset($_SESSION['user_email'])) {
  header("Location: login.php");
  exit();
}

// Get the user ID
$user_email = $_SESSION['user_email'];
$user_id=$_SESSION['user_id'];

// Fetch cart data from the database
$cart_query = "SELECT p.product_id, p.name, p.price, c.quantity FROM Product p JOIN Cart c ON p.product_id = c.product_id WHERE c.user_id = :user_id";
$cart_stmt = $conn->prepare($cart_query);
$cart_stmt->execute(array(':user_id' => $user_id));
$cart_data = $cart_stmt->fetchAll(pdo::FETCH_ASSOC);

// Calculate the subtotal
$subtotal = 0;
foreach ($cart_data as $row) {
  $price = $row['price'];
  $quantity = $row['quantity'];
  $subtotal += $price * $quantity;
}

// Calculate tax and shipping
$tax = $subtotal * 0.05;
$shipping = 5.0;

// Calculate the total
$total = $subtotal + $tax + $shipping;




// Insert the order details into the database
// Insert the order into the database
$order_query = "INSERT INTO orders (user_id, product_id, quantity, total_price, order_date) VALUES (:uid,:pid, :qt, :tl,NOW())";
$order_stmt = $conn->prepare($order_query);

foreach ($cart_data as $row) {
  $product_id = $row['product_id'];
  $quantity = $row['quantity'];
  $order_stmt->execute(array(
    ':uid' => $user_id,
    ':pid' => $product_id,
    ':qt' => $quantity,
    ':tl' => $total
  ));
}

// Remove the cart items from the database
$remove_cart_query = "DELETE FROM Cart WHERE user_id= :user_id";
$remove_cart_stmt = $conn->prepare($remove_cart_query);
$remove_cart_stmt->execute(array(':user_id' => $user_id));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Signup</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom CSS -->
  <style>
  
  .content {
    width: 50%;
    margin: auto;
  }

  h1 {
    text-align: center;
    margin-top: 1rem;
    margin-bottom: 3rem;
  }

  
</style>
</head>
<body>
<?php
include 'navbar.php';
$subtotal =0;
// Display the order details to the user
echo '<div class="container" style="margin-bottom:150px;">
        <h1>Order Details</h1>
        <div class="card mb-3">
          <div class="card-body">
            
            <p class="card-text">Total: ' . $total . ' OMR</p>
            <p class="card-text">Details:</p>
            <ul class="list-group">';
foreach ($cart_data as $row) {
  $name = $row['name'];
  $price = $row['price'];
  $quantity = $row['quantity'];
  $prototal= $price * $quantity;
  $subtotal += $prototal;


  echo '<li class="list-group-item d-flex justify-content-between align-items-center">' . $name . '<span class="badge badge-primary badge-pill">' . $quantity . '</span><span class="badge badge-primary badge-pill">' . $prototal . ' OMR</span></li>';
}
echo ' </ul>';

// Calculate tax and shipping
$tax = ($total- $shipping) * 0.05;
$shipping = 5.00;

$subtotal =$total - $shipping - $tax;
$total_cost = $total;

// Display cart summary
echo '<div class="card">
<div class="card-body">
<h5 class="card-title">Order Summary</h5>
<hr>
<div class="d-flex justify-content-between align-items-center mb-3">
<div class="d-flex flex-column">
<span>Subtotal</span>
</div>
<span class="text-primary">' . $subtotal . ' OMR</span>
</div>
<div class="d-flex justify-content-between align-items-center mb-3">
<div class="d-flex flex-column">
<span>Tax (5%)</span>
</div>
<span class="text-primary">' . $tax . ' OMR</span>
</div>
<div class="d-flex justify-content-between align-items-center mb-3">
<div class="d-flex flex-column">
<span>Shipping</span>
</div>
<span class="text-primary">' . $shipping . ' OMR</span>
</div>
<hr>
<div class="d-flex justify-content-between align-items-center mb-3">
<div class="d-flex flex-column">
<strong>Total Cost</strong>
</div>
<span class="text-primary"><strong>' . $total_cost . ' OMR</strong></span>
</div>
</div>
</div>
</div>

  </div>
</div>';

// Remove cart items for this user
$remove_query = "DELETE FROM Cart WHERE user_id = :user_id";
$remove_statement = $conn->prepare($remove_query);
$remove_statement->execute(['user_id' => $user_id]);

?>
<?php include 'footer.php' ?>
    <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
