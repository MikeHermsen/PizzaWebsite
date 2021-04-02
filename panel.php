<?php
include_once 'includes/cred.php';

// Retriving key to compare
session_start();
$key = md5($adminUsername . $adminPassword);

// Comparing the real key with the givven key
if ( $key != $_SESSION['pub-key'] ) {
    echo "<script type='text/javascript'>location.href = 'index.php';</script>";

    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once 'includes/cred.php';

    // Connecting with the mysql database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checking the connection with the mysql db
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT id, p_name, p_price, p_stock, img_url, description FROM pizza_hut_products";
    $result = $conn->query($sql); // Excucuting database command

    // Fetching all products
    while($row = $result->fetch_assoc()) {
        $id     = $row['id'];
        $stock  = $row['p_stock'];
        $amount = $_POST[$id];

        // Checking if the user selected something
        if ( $amount != $stock ) {

          $sql_stock = "UPDATE pizza_hut_products SET p_stock = '$amount' WHERE id = $id";
          $conn->query($sql_stock); // Excucuting database command
            // Checking if this is possible

        }


    }

}
?>

<!DOCTYPE html>
<html lang="nl">

  <!-- Including page head -->
  <?php include_once 'includes/head.html' ?>

  <!-- Warning msg -->
  <h5 class="warning">Hier zijn geen echte pizza's te halen. Dit is een project website!</h5>

  <body>

    <!-- Including page header -->
    <?php include_once 'includes/header.php' ?>

    <!-- Change this to something that will change all variabvles and change the get_products aswell -->
    <form action="<?php basename($_SERVER['PHP_SELF']) ?>" method="post">
     <div class="banner" style="height: unset;">
      <div class="order">
        
          <?php include_once 'includes/admin_get_products.php' ?>
          <input class="btn-order" type="submit" value="Submit">

      </div>
     </div>
    
    </form>
  
  </body>

</html>