<?php

  // Starts the user session
  session_start();

  // Header text for this page
  $headerText = "<h1 class=\"display-1\">Products</h1>";

  //Gets credentials and connects to db
  include "data-con.php";

  // Selects the single row from the "products" table of the dynamically populated id
  $sql = "SELECT * FROM products WHERE id=?";

  if ($prep = $conn->prepare($sql)){
    $prep->bind_param("i", $_GET["id"]);
    $prep->execute();
    $results = $prep->get_result();
    $msg = "it works!";
  } else {
    $msg = "ERROR!!";
  }

  //closes the connection
  $conn->close();

?>


<!DOCTYPE html>
<html>
  <!-- Gets the header -->
  <?php include("header.php"); ?>

    <!-- Gets the row info -->
    <?php $product = $results->fetch_assoc();?>

    <div class="container">

      <!-- form for products to be added to cart-->
      <form class="product" action="cart.php" method="post">
      <div class="row">
        <div class="col-12 col-md-4"><!-- gets the product image -->
          <img src="<?php echo $product["image_url"] ?>" alt="">
        </div>

        <div class="col-12 col-md-8"><!-- Gets other product info -->
          <h3 class="display-4 product-name"><?php echo $product["name"] ?></h3>
          <li>Stock: <?php echo $product["stock"] ?></li>
          <li>Stock: <?php echo $product["description"] ?></li>
          <li>Price: $<?php echo $product["price"] ?></li>
          <li>Category: TBA</li>

          <!-- Quantity and add to cart buttons: -->
          <input type="number" name="quantity" min="1" value="1" class="quantity">

          <!-- Hidden input field allows name and price to be populated -->
          <input type="hidden" name="name" value="<?php echo $product["name"] ?>" >
          <input type="hidden" name="price" value="<?php echo $product["price"] ?>" >
          <input type="hidden" name="id" value="<?php echo $product["id"] ?>">

          <!-- submit button adds info to sessionn -->
          <input type="submit" name="cart" value="Add to Cart" class="button cart-button">
        </div>
      </div>
      </form>

      <a href="index.php">
        <button type="button" name="button" class="button"> Back to all products</button>
      </a>

    </div>

    <!-- Gets the footer -->
    <?php include("footer.php") ?>
  </body>
</html>
