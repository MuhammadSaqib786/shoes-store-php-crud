<?php
session_start();

if(!isset($_SESSION['user_email']))
{
    header('Location: login.php');
    exit;
}

include_once('dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_SESSION['user_id'];
  $product_id = $_POST['product_id'];
  $quantity = $_POST['quantity'];
  $sql="INSERT INTO Cart (user_id, product_id, quantity) VALUES (:ui, :pi, :qt)";
  $stmt = $conn->prepare($sql);
  

  if ($stmt->execute(array(
    ':ui' => $user_id,
    ':pi' => $product_id,
    ':qt' => $quantity
  ))) {
    
  } else {
    echo 'Error: Unable to add product to cart.';
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cart</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom CSS -->
  <style>
    

    .content {
      background-color: #FFFFFF;
      color: #000000;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    h1 {
      font-size: 5rem;
      margin-bottom: 2rem;
    }

    button {
      background-color: #3CB9D1;
      color: #FFFFFF;
      border: none;
      padding: 0.5rem 2rem;
      font-size: 1.5rem;
      cursor: pointer;
    }

    button:hover {
      background-color: #FFFFFF;
      color: #3CB9D1;
    }
  </style>
</head>
<body>
    <?php
    include 'navbar.php';
    ?>

<?php
include 'dbconnect.php';
$user_id = $_SESSION['user_id'];

$cart_query = "SELECT p.name, p.price, c.quantity, c.cart_id FROM Product p JOIN Cart c ON p.product_id = c.product_id WHERE c.user_id = :user_id";
$cart_statement = $conn->prepare($cart_query);
$cart_statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$cart_statement->execute();

$total = 0; // Initialize total variable to 0

// Display cart data in the desired format
echo '<div class="container" style="margin-bottom:240px;">
        <h1>Cart</h1>
        <div class="row">
            <div class="col-md-8">';

while ($cart_row = $cart_statement->fetch(PDO::FETCH_ASSOC)) {
    $name = $cart_row['name'];
    $price = $cart_row['price'];
    $quantity = $cart_row['quantity'];
    $subtotal = $price * $quantity;
    $cart_id = $cart_row['cart_id'];

    echo '<div class="card mb-3">
            <div class="row no-gutters">
                
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">' . $name . '</h5>
                        <p class="card-text">Price: ' . $price . ' OMR</p>
                        <p class="card-text">Quantity: ' . $quantity . '</p>
                        <a href="remove.php?cart_id=' . $cart_id . '" class="btn btn-danger"><i class="fa fa-trash"></i> Remove</a>
                    </div>
                </div>
            </div>
        </div>';

    $total += $subtotal; // Add subtotal to total
}

echo '</div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cart Summary</h5>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column">
                        <span>Subtotal</span>
                    </div>
                    <span class="text-primary">' . $total . ' OMR </span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column">
                        <span>Tax (5%)</span>
                    </div>
                    <span class="text-primary">' . ($total * 0.05) . ' OMR </span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column">
                        <span>Shipping</span>
                    </div>
                    <span class="text-primary">5 OMR </span>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column">
                        <strong>Total</strong>
                    </div>
                    <span class="text-primary"><strong>' . ($total * 1.05 + 5) . ' OMR </strong></span>
                </div>
                <a href="payment-details.php" class="btn btn-block" style="background: #740404; color: white;">Checkout</a>
</div>
</div>
</div>

</div>
</div>'; ?>
  <?php include 'footer.php' ?>
  
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
