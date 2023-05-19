<?php
// Include database connection
include_once('dbconnect.php');

session_start();
if(!isset($_SESSION['user_email']))
{
    header('Location: login.php');
    exit;
}

$query="SELECT * FROM Product ";
// Fetch products from database
$stmt = $conn->prepare($query);

$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
  .card-image {
  width: 100%;
  height: 200px; 
  object-fit: cover;
}

  
</style>
</head>
<body>
<?php
  include 'navbar.php';
?>

  <div class="container" style="margin-top:30px;">
    
        
        
        <div class="row">
        <?php foreach ($products as $product): ?>
            
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                <div class="card-body">
                    <div class="text-center">
                        <div class="mt-3">
                            <img src="<?php echo $product['image']; ?>" alt="Product Image" class="card-image">
                            <p class="mb-0"><?php echo $product['name']; ?></p>
                            <p class="mb-0 font-weight-bold"><?php echo $product['price']; ?> OMR</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="mt-3">
                        <form method="post" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <div class="form-group">
                                <label for="quantity_<?php echo $product['product_id']; ?>">Quantity:</label>
                                <input type="number" class="form-control" id="quantity_<?php echo $product['product_id']; ?>" name="quantity" value="1">
                            </div>
                            <button type="submit" class="btn" style="background: #740404; color: white;"><span style=" color: white;">Add to Cart</span> <i class="fa fa-plus"></i></button>
                        </form>
                    </div>
                </div>
            </div>

                </div>
            
            <?php endforeach; ?>


        </div>
      </div>
    </div>
  </div>
  
  <?php include 'footer.php' ?>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

       
        
    </body>
</html>