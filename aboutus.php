<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us</title>

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


  <section class="about-us py-5" style="margin-bottom:100px">
  <div class="container">
    <h2>About Us</h2>
    <p>Welcome to our shoe store, where style meets comfort!</p>
    <p>At our store, we are passionate about providing high-quality shoes that not only look great but also keep your feet happy and healthy. We believe that the right pair of shoes can make a world of difference in your overall style and well-being.</p>
    <p>With a wide range of options for men, women, and kids, we strive to offer something for everyone. Whether you're looking for casual sneakers, elegant heels, sports shoes, or sturdy boots, we've got you covered.</p>
    <p>Our team of experienced professionals carefully curates our collection to ensure that every pair of shoes we offer meets our strict quality standards. We work with renowned brands and designers to bring you the latest trends and timeless classics.</p>
    <p>We understand that shopping for shoes online can be challenging, so we provide detailed product descriptions, accurate sizing information, and customer reviews to help you make an informed decision. Additionally, our friendly and knowledgeable customer support team is always ready to assist you with any questions or concerns you may have.</p>
    <p>Customer satisfaction is our top priority, and we strive to provide an exceptional shopping experience from start to finish. We offer secure payment options, fast shipping, and hassle-free returns.</p>
    <p>Thank you for choosing our shoe store. We look forward to helping you step out in style!</p>
  </div>
  </section>
  
  <?php include 'footer.php' ?>
  
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
