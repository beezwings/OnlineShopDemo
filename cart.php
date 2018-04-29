<?php

  // Starts the user session
  session_start();

  // Header text for this page
  $headerText = "<h1 class=\"display-1\">My Cart</h1>";

  // If the input "add to cart" is set (clicked), sets the $_SESSION to the $_POST ["cart"]
  if (isset($_POST["cart"])) {
    $orderedItem = [];
    if (isset($_POST["quantity"])) {
      $orderedItem["quantity"] = $_POST["quantity"];
    }
    if (isset($_POST["name"])){
      $orderedItem["name"] = $_POST["name"];
    }
    if (isset($_POST["price"])){
      $orderedItem["price"] = $_POST["price"];
    }
    if (isset($_POST["id"])){
      $orderedItem["id"] = $_POST["id"];
    }
    if (!isset($_SESSION["order"])) {
      $_SESSION["order"] = [];
    }
    $_SESSION["order"][]= $orderedItem;
  }


  // Unsets the session data aka, clears the cart
  if (isset($_POST["deleteSession"])) {
    unset($_SESSION ["order"]);
  }
  //Deletes individual items from the session
  unset($_SESSION ["order"][$_GET["index"]]);

?>

<!DOCTYPE html>
<html>
  <!-- Gets the header -->
  <?php include("header.php"); ?>

  <!-- Main content begins -->
      <div class="container">
        <form class="cart" action="cart.php" method="post">
          <h3>Cart</h3>
          <div class="row cart-heading">
            <div class="col-md-2">Quantity</div>
            <div class="col-md-5">Name</div>
            <div class="col-md-1">Price</div>
            <div class="col-md-1">Subtotal</div>
            <div class="col-md-1"></div>
          </div>

        <!-- Retrieves data in a loop -->
        <?php

          //Iterates over each session array variable to get the quantities, names, and prices of the products
          foreach ($_SESSION["order"] as $index =>$item){ ?>

                <div class="row">
                  <div class="col-md-2"> <?php echo ($item["quantity"]); ?></div>
                  <div class="col-md-5">  <?php echo ($item ["name"]); ?></div>
                  <div class="col-md-1">$<?php echo ($item ["price"]); ?> </div>
                  <?php
                    $miniTotal = ($item ["price"])*($item["quantity"]);
                    $cartTotal += $miniTotal;
                   ?>
                  <div class="col-md-1">$<?php echo ($miniTotal); ?></div>
                  <div class="col-md-1"><a href="cart.php?index=<?php echo ($index); ?>">Remove</a> </div>
                </div>

          <?php }  ?>
        <hr>

        <!-- Displays Grand Total -->
        <h4 class="order-total"> Grand Total: $<?php echo $cartTotal ?> </h4>
        <a href="index.php"><button type="button" name="button" class="button"> Keep Shoppin'</button></a>
        <a href="order.php" class="right"><button type="button" name="button" class="button"> Proceed to Checkout</button></a>
      </form>
    </div>

    <!-- Gets the footer -->
    <?php include("footer.php") ?>
  </body>
</html>
