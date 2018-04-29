<?php

  // Starts the user session
  session_start();

  //Gets credentials and connects to db
  include "data-con.php";

  $fullname = ($_POST["customer_first_name"]) . " " . ($_POST["customer_last_name"]);

  // Binds the customer data for the new order into the database. Timestamp automatically added on server side
  $sql = "INSERT INTO orders (customer_name , phone, email ) VALUES (? , ? , ? )";
  if ($prep = $conn->prepare($sql)){
    $prep->bind_param("sss",  $fullname  , $_POST["customer_phone"] , $_POST["customer_email"] );
    $prep->execute();
    $msg = "Successful order part one!";
    print_r($orderID); //Prints the order ID for Jessie to see
    $orderID = $conn->insert_id; //Gets the order ID of last submitted order above
  } else {
    $msg = "ERROR!!";
  }

  // This second sql statement iterates over each row of ordered products and enters them into the "ordered_products" table
  $sql2 = "INSERT INTO ordered_products (product_id, quantity, order_id) VALUES (?, ?, ?)";
  if ($prep = $conn->prepare($sql2)) {

    // Bind the parameters, gets the order ID from $orderID (set in previous sql statement)
    $prep->bind_param ("iii", $productID, $productQuantity, $orderID);
    foreach ($_SESSION["order"] as $key => $value) { //need to loop over the $_SESSION["order"] because more than one item
      $productID = $value["id"];
      $productQuantity = $value ["quantity"];
      $prep->execute();   //Adds the new row until no more array values
    }
    $msg .= " Congratulations on your successful order.";
    unset($_SESSION ["order"]); //Clears the cart from the session
  } else {
      $msg .= " Your order failed. I'm so sorry." ;
  }

  // This third sql join statement gets the newly formed rows from orders and ordered_products
  $sql3 = "SELECT * FROM orders JOIN ordered_products ON orders.id = ordered_products.order_id JOIN products ON ordered_products.product_id = products.id WHERE orders.id=$orderID";

  $results =$conn->query($sql3);
  if ($results) {
    $msg .= " It works!";
  } else {
    $msg .= " It doesn't work :( " . $conn->error;
  }

  //Creates a variable, "orderItemsArray[]" to represent each row from the order table.
  //The while loop is run here so that the "fetch_assoc" is only run once, and then simply called on later in the code.
  while ($orders = $results->fetch_assoc()) {
    $orderedItemsArray[] = $orders;
  }

?>
<!DOCTYPE html>
<html>
  <!-- Gets the header -->
  <?php include("header.php"); ?>

  <!-- Body starts here -->
  <div class="container">
    <div class="row">
      <div class="col-12">

        <!-- Displays order info (joined tables) -->
        <h2>Order conformation for <?php echo $orderedItemsArray[0]["customer_name"] ?> on <?php echo $orderedItemsArray[0]["date"] ?></h2>
        <p>Order #: <?php echo $orderedItemsArray[0]["order_id"] ?></p>
        <p>Phone: <?php echo $orderedItemsArray[0]["phone"] ?></p>
        <p>Email: <?php echo $orderedItemsArray[0]["email"] ?></p>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <?php foreach ($orderedItemsArray as $key => $value) { ?>
            <tr>
              <td><?php echo $value["name"] ?></td>
              <td><?php echo $value["quantity"] ?></td>
              <td>$<?php echo $value["price"] ?></td>

              <!-- Creates a subtotal from the price multiplied by quantity -->
              <?php
                $miniTotal = ($value ["price"])*($value["quantity"]);
                $cartTotal += $miniTotal;  //adds all the subtotals up
               ?>
               <td>$<?php echo $miniTotal ?></td>
            </tr>
        <?php  } ?>
        </table>

        <!-- Displays subtotals -->
        <h3>Total: $<?php echo $cartTotal ?></h3>
        <a href="index.php">
          <button type="button" name="button" class="button"> Do More Shopping</button>
        </a>
      </div>
    </div>
  </div>


  <!-- Gets the footer -->
  <?php include("footer.php") ?>
  </body>
</html>
