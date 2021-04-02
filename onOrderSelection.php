<!DOCTYPE html>
<html lang="nl">

  <!-- Including page head -->
  <?php include_once 'includes/head.html' ?>

  <!-- Warning msg -->
  <h5 class="warning">Hier zijn geen echte pizza's te halen. Dit is een project website!</h5>

  <body>
  
    <!-- Including page header -->
    <?php include_once 'includes/header.php' ?>
    
    <div class="banner" style="height:unset; min-height:100vh;">
      <div class="forum-container">
        
        <div class="recipe">
          <?php include_once 'includes/actOnOrder.php' ?>
        </div>

          <form action="includes/sumbitOrder.php" method="POST">

              <div>
                  <i class="fa fa-user-circle fa-lg"></i> 
                  <input type="text", id="voornaam" name="voornaam" placeholder="voornaam"
                    title="voornaam moet tussen de 3 & 30 lang zijn!"
                    minlength="3"
                    maxlength="30"
                  required>
              </div>
    
              <div>
                  <i class="fa fa-user-circle fa-lg"></i> 
                  <input type="text", id="achternaam" name="achternaam" placeholder="achternaam"
                    title="achternaam moet tussen de 3 & 30 lang zijn!"
                    minlength="3"
                    maxlength="30"
                  required>
              </div>
    
              <div>
                  <i class="fa fa-envelope fa-lg"></i> 
                  <input type="email", id="email" name="email" placeholder="email"
                  required>
              </div>

              <div>
                  <i class="fa fa-building fa-lg"></i> 
                  <input type="text" id="postcode" name="postcode" pattern="[1-9][0-9]{3}\s?[a-zA-Z]{2}" placeholder="postcode"
                  required>
              </div>

              <div>
                  <i class="fa fa-road fa-lg"></i> 
                  <input type="text" id="straatnaam" name="straatnaam" placeholder="straatnaam"
                    maxlength="30"
                  required>
              </div>

              <div>
                  <i class="fa fa-home fa-lg"></i> 
                  <input type="text" id="huisnummer" name="huisnummer" placeholder="huisnummer"
                    maxlength="30"
                  required>
              </div>

              <div>
                  <i class="fa fa-home fa-lg"></i> 
                  <input type="text" id="woonplaats" name="woonplaats" placeholder="woonplaats"
                    maxlength="30"
                  required>
              </div>

              <div>
                  <i class="fa fa-phone fa-lg"></i> 
                  <input type="text" id="telefoonnummer" name="telefoonnummer" placeholder="telefoonnummer"
                    maxlength="30"
                  required>
              </div>

              <input class="btn-order" type="submit" value="Submit">
            </form>

      </div>
    </div>
  
  </body>

</html>
