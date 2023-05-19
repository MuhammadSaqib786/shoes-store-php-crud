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

  <div class="container">
    <h1 class="text-center my-5"> Admin Page</h1>
    
    <div class="row">
  <div class="col-sm-10">
    <div class="card mb-3">
      <div class="card-body">
        
        <div class="table-responsive mt-4">
        <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Product Name</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Include database connection
          include_once('dbconnect.php');
          
          // Fetch products with category names from the database
          $stmt = $conn->prepare("SELECT p.product_id, p.name, c.name as category_name, p.price FROM Product p JOIN Category c ON p.category_id = c.category_id");
          $stmt->execute();
          $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

          // Loop through the products and display them in a table
          foreach ($products as $product) {
            echo '<tr>';
            echo '<td>' . $product['product_id'] . '</td>';
            echo '<td>' . $product['name'] . '</td>';
            echo '<td>' . $product['category_name'] . '</td>';
            echo '<td>' . $product['price'] . '</td>';
            echo '<td>
                    <a href="edit.php?id=' . $product['product_id'] . '"><i class="fas fa-edit mr-3"></i></a>
                    <a href="deleteProduct.php?product_id=' . $product['product_id'] . '"><i class="fas fa-trash"></i></a>
                  </td>';
            echo '</tr>';
          }
          ?>
        </tbody>
      </table>

        </div>
      </div>
    </div>
  </div>
</div>
<div class="card mb-3">
    <h5 class="card-title">Shoe's Management</h5>
  <p class="card-text">Adding new Shoes</p>
  <div class="card-body">
  <form action="addProduct.php" method="post">
  <div class="form-group">
    <label for="name">Product Name</label>
    <input type="text" class="form-control" id="name" name="name" required>
  </div>
  <div class="form-group">
    <label for="category">Category</label>
    <select class="form-control" id="category" name="category" required>
      <?php
      // Include database connection
      include_once('dbconnect.php');

      // Fetch categories from the database
      $stmt = $conn->prepare("SELECT * FROM Category");
      $stmt->execute();
      $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Loop through the categories and generate options for the dropdown menu
      foreach ($categories as $category) {
        echo '<option value="' . $category['category_id'] . '">' . $category['name'] . '</option>';
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" required></textarea>
  </div>
  <div class="form-group">
    <label for="price">Price (OMR)</label>
    <input type="number" class="form-control" id="price" name="price" step="0.01" required>
  </div>
  
  <div class="form-group">
    <label for="image">Image Address</label>
    <input type="text" class="form-control" id="image" name="image" required>
  </div>
  <button type="submit" class="btn btn-primary">Add Shoe</button>
</form>


</div>


</div>
  </div>

  <div class="container my-5">
    
  <div class="row">
  <div class="col-md-12">
    <h2>Below are orders</h2>
    <div class="table-responsive">
    <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Product Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Total</th>
      <th scope="col">Order Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Include database connection
    include_once('dbconnect.php');

    // Fetch data from Orders table with user and product details
    $sql = "SELECT Orders.order_id, myUser.username, Product.name, Orders.quantity, Product.price, Orders.total_price, Orders.order_date 
            FROM Orders 
            INNER JOIN myUser ON Orders.user_id = myUser.user_id 
            INNER JOIN Product ON Orders.product_id = Product.product_id";
    $result = $conn->query($sql);

    if ($result->rowCount() > 0) {
      // Output data of each row
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<th scope='row'>" . $row["order_id"] . "</th>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["price"] . " OMR</td>";
        echo "<td>" . $row["total_price"] . " OMR</td>";
        echo "<td>" . $row["order_date"] . "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='7'>No orders found.</td></tr>";
    }

    // Close database connection
    $conn = null;
    ?>
  </tbody>
</table>

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
