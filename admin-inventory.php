<?php

  // Starts the user session
  session_start();

  // Header text for this page
  $headerText = "<h1 class=\"display-1\">Product Inventory</h1>";

  //Gets credentials and connects to db (also creates $results variable)
  include "data-con.php";

  // Binds the new data into the database if "add new" is clicked
  if (isset($_POST["add-new"])) {
    $sql2 = "INSERT INTO products (id, name , description, stock , price , category_id , image_url) VALUES (? , ? , ? , ? , ? , ? , ?)";
    if ($prep = $conn->prepare($sql2)){
      $prep->bind_param("issiiis", $_POST["id"] , $_POST["name"] , $_POST["description"] , $_POST["stock"] , $_POST["price"], $_POST["category"] , $_POST["image_url"]);
      $prep->execute();
      $msg = "Inventory added!";
    } else {
      $msg = "ERROR! Inventory not added!";
    }
  }

  // Selects all rows from the "products" table of the dynamically populated id
  $sql = "SELECT products.id, products.name, product_categories.name as cat_name, description, stock, price, image_url FROM products JOIN product_categories ON products.category_id = product_categories.id";

  $results = $conn->query($sql);
  if ($results) {
    $msg .= " It displays!";
  } else {
    $msg .= " It doesn't display :( " . $conn->error;
  }

  // Closes the DB connection
  $conn->close();

?>

<!-- Begin html -->
<!DOCTYPE html>
<html>
  <!-- Gets the header -->
  <?php include("header.php"); ?>

    <!-- Main content begins -->
    <div class="container-fluid inventory">
      <div class="row">

        <!-- adds new data to the inventory -->
        <form class="" action="admin-inventory.php" method="post">
          <p>
            <input type="text" name="name" value="" placeholder="Name">
            <input type="text" name="description" value="" placeholder="Describe the product">
            <input type="number" name="price" value="" placeholder="Price">
            <select class="" name="category">

              <!-- If there's time, create a loop here to be dynamically populated by DB -->
              <option value="1">Fabrics</option>
              <option value="2">Paper</option>
              <option value="3">Tiles</option>

            </select>
            <input type="text" name="image_url" value="" placeholder="image url ">
            <input type="number" name="stock" value="" placeholder="quantity">
            <input type="submit" name="add-new" value="Add New Product(s)" class="button">
          </p>
        </form>

        <table class=" table table-striped">
          <!-- Header for inventory -->
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Category</th>
              <th>Description</th>
              <th>stock</th>
              <th>Price</th>
              <th>Image URL</th>
            </tr>
          </thead>

          <tbody>
            <!-- Iterates over each row in the db  -->
            <?php while($products=$results->fetch_assoc()) {?>

            <tr>
              <!-- Finds the values for each of the column names referenced in the $sql statement above -->
              <?php foreach ($products as $product): ?>
                <td><?php echo ($product) ?> </td>
              <?php endforeach; ?>
            </tr>

            <?php  } ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- End Content -->
    <?php include("footer.php") ?>
  </body>
</html>
