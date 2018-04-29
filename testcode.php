<?php

  // Why doesn't this work for cart.php?

  //checks to see if  $_POST["quantity"] exists
  if (isset ($_POST["quantity"])) {
      $_SESSION ["quantity"] = [];
      $_SESSION["quantity"][] = $_POST["quantity"];
      $msg = "is working 1.";
  } else {
    $msg = "it isn't working 1.";
  }

  if (isset ($_POST["name"])) {
      $_SESSION ["name"] = [];
      $_SESSION["name"][] = $_POST["name"];
      $msg = "is working 2.";
  } else {
    $msg = "it isn't working 2.";
  }

  if (isset ($_POST["price"])) {
      $_SESSION ["price"] = [];
      $_SESSION["price"][] = $_POST["price"];
      $msg = "is working 3.";
  } else {
    $msg = "it isn't working 3.";
  }
}

//If the input "add to cart" is set (clicked), sets the $_SESSION to the $_POST ["cart"]
if (isset($_POST["cart"])) {


if (isset ($_POST["quantity"])) {
    if (isset ($_SESSION["quantity"])) {
      $_SESSION["quantity"][] = $_POST["quantity"];
    } else {
      $_SESSION["quantity"] = [];
      $_SESSION["quantity"][] = $_POST["quantity"];
    }
}

if (isset ($_POST["name"])) {
    if (isset ($_SESSION["name"])) {
      $_SESSION["name"][] = $_POST["name"];
    } else {
      $_SESSION["name"] = [];
      $_SESSION["name"][] = $_POST["name"];
    }
}

if (isset ($_POST["price"])) {
    if (isset ($_SESSION["price"])) {
      $_SESSION["price"][] = $_POST["price"];
    } else {
      $_SESSION["price"] = [];
      $_SESSION["price"][] = $_POST["price"];
    }
}

}
//deletes the session
if (isset($_POST["deleteSession"])) {
  unset($_SESSION ["quantity"]);
  unset($_SESSION ["name"]);
  unset($_SESSION ["price"]);
}
 ?>


 <div class="row">
   <div class="col-md-2"> <input type="checkbox" name="markedForDeletion" value=""> <?php echo ($_SESSION["quantity"][$i]); ?></div>
   <div class="col-md-8">  <?php echo ($_SESSION ["name"][$i]); ?></div>
   <div class="col-md-1">$<?php echo ($_SESSION ["price"][$i]); ?></div>
   <?php
     $miniTotal = ($_SESSION ["price"][$i])*($_SESSION ["quantity"][$i]);
     $cartTotal += $miniTotal;
    ?>
   <div class="col-md-1">$<?php echo ($miniTotal); ?></div>
 </div>

{ position: absolute;
z-index: 10;
top: -10px;
background: #ffffffb3;
right: 0;
max-width: 500px;
}

<?php
$sql3="SELECT * FROM customer WHERE order_id=? LIMIT 1";
 if($prep = $conn->prepare($sql3)){
   $prep->bind_param("i", $id);
   $prep->execute();
 }

  ?>
