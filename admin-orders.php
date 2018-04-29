<?php

  // starts the user session
  session_start();

  // header text for this page
  $headerText = "<h1 class=\"display-1\">Admin View of All Orders</h1>";

  //Gets credentials and connects to db
  include "data-con.php";

  //Gets the all rows from orders and ordered_products
  // $sql = "SELECT * FROM orders JOIN ordered_products ON orders.id = ordered_products.order_id JOIN products ON ordered_products.product_id = products.id";
  $sql = "SELECT * FROM orders JOIN ordered_products ON orders.id = ordered_products.order_id JOIN products ON ordered_products.product_id = products.id";
  $results1 = $conn->query($sql);
  if ($results1) {
    $msg = " It works!";
  } else {
    $msg = " It doesn't work :( " . $conn->error;
  }

  //The while loop is run here so that the "fetch_assoc" is only run once, and then simply called on later in the code.
  while ($row = $results1->fetch_assoc()) {
    //The next two lines of code create the customer info by establishing a unique associative array
    //if the $row["order_id"] doesn't yet exist
    if(!isset($orderList[$row["order_id"]])){
      $orderList[$row["order_id"]] = ["customer_name" => $row["customer_name"], "email" => $row["email"], "order_id"=>$row["order_id"] , "phone" => $row["phone"], "date" => $row["date"]];
    }
    //Creates an empty associative array for the ordered items, with the $row's key set as "order_id"
    $orderedItems[$row["order_id"]][] = [
      "product_name" => $row["name"],
      "quantity" => $row["quantity"],
      "price" => $row["price"],
      "subtotal" => ($row["price"]*$row["quantity"]),
    ];
  }
?>

<!DOCTYPE html>
<html>

  <!-- Gets the header -->
  <?php include("header.php"); ?>

  <!-- Body starts here -->
  <div class="container">
    <div class="row">

      <!-- Displays order info from joined tables -->
      <?php foreach ($orderList as $key => $orderedItemsArray) { ?>

        <div class="admin-orders col-12">
          <h2>Order for <span class="customer-name"><?php echo $orderedItemsArray["customer_name"] ?> </span> on <?php echo $orderedItemsArray["date"] ?></h2>
          <p>Order #: <?php echo $orderedItemsArray["order_id"] ?></p>
          <p>Phone: <?php echo $orderedItemsArray["phone"] ?></p>
          <p>Email: <?php echo $orderedItemsArray["email"] ?></p>

          <table class="table table-striped">
            <thead>
              <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
              </tr>
            </thead>

            <!-- Establishes an array for the order totals below -->
            <?php $orderTotal = [] ?>

            <!-- Loops over each product ordered within that order  -->
            <?php foreach ($orderedItems[$key] as $key=> $value) { ?>
              <tr>
                <td><?php echo($value['product_name']); ?></td>
                <td><?php echo($value['quantity']); ?></td>
                <td>$<?php echo($value['price']); ?></td>
                <td>$<?php echo ($value['subtotal']); ?></td>

                <!-- Populates the "orderTotal" array with each "subtotal" -->
                <?php $orderTotal[] = ($value['subtotal']); ?>

              </tr>
            <?php } ?>
          </table>

          <!-- Displays each order total -->
          <h3 class="order-total">Cart total: <span class="price">$<?php echo array_sum($orderTotal) ?></span></h3>
        </div>
      <?php } ?>

    </div>
  </div>


  <!-- Gets the footer -->
  <?php include("footer.php") ?>
  </body>
</html>
