<?php
session_start();

if(!isset($_SESSION['user_email']))
{
    header('Location: login.php');
    exit;
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
    <section class="container mt-5">
    <div class="row mt-5">
            <div class="col-sm-12">
            <form action="checkout.php" method="POST" class="mt-5">
            <h3 class="mb-3">Enter Billing Details</h3>
            
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="number" id="phoneNumber" name="phoneNumber" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="paymentMethod">Payment Method:</label>
                <select id="paymentMethod" name="paymentMethod" class="form-control" required>
                    <option value="cash">Cash</option>
                    <option value="card">Card</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cardNumber">Card Number:</label>
                <input type="number" id="cardNumber" name="cardNumber" class="form-control" required>
            </div>
            <div class="form-group">
            <button type= "submit" class="btn" style="background: #740404; color: white;" name="submit">Checkout</button>
            </div>

            
            
        </form>
        
            </div>
    
</section>

<?php include 'footer.php' ?>
  
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
