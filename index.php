<?php
  // Starts the user session
  session_start();

  //Gets credentials and connects to db
  include "data-con.php";

  // Selects all rows from the "products" table
  $sql = "SELECT * FROM products ORDER BY RAND()";
  $results =$conn->query($sql);
  if ($results) {
    $msg = "It works!";
  } else {
    $msg = "It doesn't work :( " . $conn->error;
  }

  // Selects all rows from the "categories" table
  $sql2 = "SELECT * FROM product_categories";
  $results2 =$conn->query($sql2);
  if ($results2) {
    $msg = "It works!";
  } else {
    $msg = "It doesn't work :( " . $conn->error;
  }

  // This page's header text
  $headerText = "<h1 class=\"display-1\">Planayana</h1><h4 class=\"tag-line\">Bringing textures into your classroom</h1>";

  // Close db connection
  $conn->close();

?>

<!DOCTYPE html>
<html>
  <!-- Gets the header -->
  <?php include("header.php"); ?>

  <div class="container">
    <div class="row">
      <div class="col-12">

        <!-- category display -->
        <h3 class="display-4 categories">Categories</h3>
        <div class="card-deck">

          <!-- loops over the product categories -->
          <?php while ($row2 = $results2->fetch_assoc()) {?>
            <div class="card no-flex" style="width: 18rem;">
              <img class="card-img-top" src="<?php echo $row2["category_image"] ?>" alt="Card image cap" >
              <div class="card-body centre">
                <a href="categories.php?id=<?php echo $row2["id"];?>" class="button "><?php echo $row2["name"] ?></a>
              </div>
            </div>
           <?php } ?>
        </div>

        <!-- masonary style layout for products -->
        <h3 class="display-4 all-products">All Products</h3>
        <div class="card-columns">

          <!-- Runs a while loop to iterate over all the products -->
          <?php while ($row = $results->fetch_assoc()) {?>
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="<?php echo $row["image_url"] ?>" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row["name"] ?></h5>
                <h6 class="card-title">$<?php echo $row["price"] ?></h6>
                <a href="product.php?id=<?php echo $row["id"]?>" class="button">More Info</a>
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
