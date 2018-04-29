<?php

  // Starts the user session
  session_start();

?>
<head>
  <meta charset="utf-8">
  <!-- puts the name variable in the title -->
  <titleLab Exercise 4: Message Storage System</title>
  <link rel="stylesheet" href="css/custom.css" type="text/css">
  <!-- bootstrap css-->
  <link type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        rel="stylesheet"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700" rel="stylesheet">
</head>

<!-- Begin body content -->
<body>

  <!-- Begin navbar -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-yellow ">
    <a class="navbar-brand" href="index.php">Planayana</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link " href="index.php">All products</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="categories.php">Categories</span></a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="cart.php">My Cart</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin-inventory.php">Admin Inventory</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin-orders.php">Admin Orders</a>
        </li>

      </ul>

      <form class="form-inline my-2 my-lg-0" action="order.php" method="post">
        <div class="cart-icon-total">

          <!-- if the session["order"] has been set, the amount of items in the cart is displayed here -->
          <?php
            if (isset($_SESSION["order"])) {
              echo count($_SESSION["order"]);
            }
          ?>
        </div>
        <input type="submit" value="Checkout" class="button">
      </form>
    </div>
    </nav>

    <!-- Begin header banner -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 header-banner">
          <div class="row">

            <!-- Creates slightly transparent overlay  -->
            <div class="col-12 banner-overlay">

              <!-- dynamically populates the header text based on which page user is on -->
              <div id="header-text">
                <?php echo $headerText ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </header>
