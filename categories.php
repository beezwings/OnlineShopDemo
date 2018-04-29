<?php

  // Starts the user session
  session_start();

  //Gets credentials and connects to db
  include "data-con.php";

  // Selects all rows from the "products" table of the dynamically populated id
  $sql = "SELECT products.name as product_name, product_categories.name as category_name, image_url, description, stock, price, products.id FROM products JOIN product_categories ON products.category_id = product_categories.id WHERE category_id=?";

  if ($prep = $conn->prepare($sql)){
    $prep->bind_param("i", $_GET["id"]);
    $prep->execute();
    $results = $prep->get_result();
    $msg = "it works!";
  } else {
    $msg = "ERROR!!";
  }

  // The while loop is run here so that the "fetch_assoc" is only run once, and then simply called on later in the code.
  while ($row = $results->fetch_assoc()) {
    $rowArrays[] = $row;
  }

  // Closes db connection
  $conn->close();

?>

<!DOCTYPE html>
<html>

  <!-- Gets the header -->
  <?php include("header.php"); ?>

  <!-- Main content begins -->
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3 class="display-4"><?php echo $rowArrays[0]["category_name"] ?></h3>

        <!-- masonary style layout for products -->
        <div class="card-columns">

            <!-- Runs a foreach loop to iterate over all the products -->
            <?php foreach ($rowArrays as $rowArray) {?>
                  <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="<?php echo $rowArray["image_url"] ?>" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $rowArray["product_name"] ?></h5>
                      <h6 class="card-title">$<?php echo $rowArray["price"] ?></h6>
                      <p class="card-text"><?php echo $rowArray["description"];?></p>
                      <a href="product.php?id=<?php echo $rowArray["id"];?>" class="button">More Info</a>
                    </div>
                  </div>
              <?php } ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Gets the footer -->
    <?php include("footer.php") ?>
  </body>
</html>
