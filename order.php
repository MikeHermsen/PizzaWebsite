<!DOCTYPE html>
<html lang="nl">

  <!-- Including page head -->
  <?php include_once 'includes/head.html' ?>

  <!-- Warning msg -->
  <h5 class="warning">Hier zijn geen echte pizza's te halen. Dit is een project website!</h5>

  <body>

    <!-- Including page header -->
    <?php include_once 'includes/header.php' ?>

    <form action="onOrderSelection.php" method="post">
     <div class="banner" style="height: unset;">
      <div class="order">
        
          <?php include_once 'includes/get_products.php' ?>
          <input class="btn-order" type="submit" value="Submit">

      </div>
     </div>
    </form>
  
  </body>

</html>