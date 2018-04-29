<?php

  // Starts the user session
  session_start();

  // Header text for this page
  $headerText = "<h1 class=\"display-1\">My Order</h1>";

?>

<!DOCTYPE html>
<html>
  <!-- Gets the header -->
  <?php include("header.php"); ?>

  <!-- Body starts here -->
    <div class="container">
      <div class="row">

        <!-- Starts form -->
        <form class="order" action="completed-order.php" method="post">

        <!-- Displays session/cart info -->
        <div class="row cart-heading">
          <div class="col-md-2">Quantity</div>
          <div class="col-md-5">Name</div>
          <div class="col-md-1">Price</div>
          <div class="col-md-1">Subtotal</div>
          <div class="col-md-1"></div>
        </div>

        <!-- Retrieved data in a loop -->
        <?php

          //Iterates over each session array variable to get the quantities, names, and prices of the products
          foreach ($_SESSION["order"] as $index =>$item){ ?>

                <div class="row">
                  <div class="col-md-2">
                    <input type="hidden" name="quantity" value="<?php echo ($item["quantity"]); ?>">
                    <?php echo ($item["quantity"]); ?>
                  </div>
                  <div class="col-md-5">
                    <input type="hidden" name="name" value="<?php echo ($item["name"]); ?>">
                    <?php echo ($item ["name"]); ?>
                  </div>
                  <div class="col-md-1">$<?php echo ($item ["price"]); ?> </div>
                  <?php
                    $miniTotal = ($item ["price"])*($item["quantity"]);
                    $cartTotal += $miniTotal;
                   ?>
                  <div class="col-md-1">$<?php echo ($miniTotal); ?></div>
                  <div class="col-md-1"><a href="cart.php?index=<?php echo ($index); ?>">Remove</a> </div>


                </div>

          <?php }  ?>

          <!-- Displays Grand Total -->
          <hr>
          <div class="col-md-3 total">
            <h4> Grand Total: $<?php echo $cartTotal ?> </h4>
          </div>
          <hr>

          <!-- Visible inputs to populate db -->
          <input type="text" name="customer_first_name" value="" placeholder="First Name">
          <input type="text" name="customer_last_name" value="" placeholder="Last Name">
          <input type="text" name="customer_phone" value="" placeholder="Phone Number">
          <input type="text" name="customer_email" value="" placeholder="Email">
          <input type="submit" name="checkout" value="Checkout Now" class="button">
          
          <!-- <a href="index.php"><button type="button" name="button" class="button"> Keep Shoppin'</button></a> -->
        </form>

      </div>
    </div>






  <!-- Gets the footer -->
  <?php include("footer.php") ?>
  </body>
</html>
