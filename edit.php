<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Home</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
?>

  <div class="container" style="margin-top:70px">
    
    
    <div class="row">
  <div class="col-sm-10">
    
<div class="card mb-3">
    
  <p class="card-text">Updating</p>
  <div class="card-body">
  <?php
// Include database connection
include_once('dbconnect.php');

// Get product ID from the previous form
$product_id = $_GET['id'];

// Fetch product details from the database
$stmt = $conn->prepare("SELECT * FROM Product WHERE product_id = :product_id");
$stmt->bindParam(':product_id', $product_id);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch categories from the database
$categoriesStmt = $conn->prepare("SELECT * FROM Category");
$categoriesStmt->execute();
$categories = $categoriesStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<form action="updateProduct.php" method="post">
  <div class="form-group">
    <label for="name">Product Name</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
  </div>
  <div class="form-group">
    <label for="category">Category</label>
    <select class="form-control" id="category" name="category" required>
      <?php
      // Loop through the categories and generate options for the dropdown menu
      foreach ($categories as $category) {
        $selected = ($category['category_id'] == $product['category_id']) ? 'selected' : '';
        echo '<option value="' . $category['category_id'] . '" ' . $selected . '>' . $category['name'] . '</option>';
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" required><?php echo $product['description']; ?></textarea>
  </div>
  <div class="form-group">
    <label for="price">Price (OMR)</label>
    <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
  </div>
  
  <div class="form-group">
    <label for="image">Image Address</label>
    <input type="text" class="form-control" id="image" name="image" value="<?php echo $product['image']; ?>" required>
  </div>
  <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
  <button type="submit" class="btn btn-primary">Update Product</button>
</form>



</div>


</div>
  </div></div></div>


  <?php include 'footer.php' ?>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
