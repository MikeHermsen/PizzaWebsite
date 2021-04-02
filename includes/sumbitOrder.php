<?php

// Grabbing the products that the user sended. This has been packed into some key.
// This prefents people from changing the session key and changing prices
session_start();
$product_pack =  $_SESSION['session-id'];

// Checking for the POST reqeust
// This will make it so the server won't crash if there is nothing filled in.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once 'cred.php';

    // Connecting with the mysql database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checking the connection with the mysql db
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Fetching the database objects
    $sql = "SELECT id, p_name, p_price, p_stock, img_url, description FROM pizza_hut_products";
    $result = $conn->query($sql); // Excucuting database command

    // Creating an table for showing the products inside
    $total_price = 0;
    $key = "";

    $send = "<h1>Pizza Order</h1><br>";

    // Fetching all products
    while($row = $result->fetch_assoc()) {
        $id     = $row['id'];
        $stock  = $row['p_stock'];
        $price  = $row['p_price'];
        $name  = $row['p_name'];


        $session_pack = explode(' ', $product_pack);
        foreach ($session_pack as &$session_item) {
            
            $info_pack = explode('|', $session_item);
            if ( $info_pack[1] == $id ) {
                $total_price += $info_pack[0] * $price;
                $send .=  "Product:   $name<br>" .
                          "price:     $price<br>" .
                          "amount:    $info_pack[0]<br><br>";   
                
                $new_stock = $stock - $info_pack[0];
                
                // Replacing all stock values to new stock valeus.
                $sql_stock = "UPDATE pizza_hut_products SET p_stock = '$new_stock' WHERE id = $id";
                $conn->query($sql_stock); // Excucuting database command

                
            }

        }


    }
    // Creating the total price
    $send .= "<p>Total Price €" . $total_price . "</p><br><br>";
     
    // Showing all other information in the mail
    $send .=    "woonplaats:        " . $_POST['woonplaats'] . "<br>" .
                "straatnaam:        " . $_POST['straatnaam'] . "<br>" .
                "postcode:          " . $_POST['postcode'] . "<br>" .
                "huisnummer:        " . $_POST['huisnummer'] . "<br>" .
                "voornaam:          " . $_POST['voornaam'] . "<br>" .
                "achternaam:        " . $_POST['achternaam'] . "<br>" .
                "telefoonnummer:    " . $_POST['telefoonnummer'] . "<br><br>";

    // Sending some simple messages with it
    $send .= "De bestelling zal zo snel mogelijk klaar gemaakt worden.<br>" .
             "Mocht er iets verkeerds staan in de gegevens stuur dan een email en wij zullen het aanpassen.";

} else {
    echo "<script type='text/javascript'>location.href = '404.php';</script>";
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/phpmailer/phpmailer/src/Exception.php';
require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';
echo "h";

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    /// Login in to the email
    $mail->Username = $userEmail;
    $mail->Password = $gmailPassword; 

    // Sender and recipient settings
    $mail->setFrom($userEmail, $userEmailName);
    $mail->addAddress($_POST['email'], $_POST['voornaam'] . " " . $_POST['achternaam']);
    $mail->addReplyTo($userEmail, $userEmailName . ' Reply'); // to set the reply to

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "Bestelling";
    $mail->Body = $send;
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';

    mail($to,$subject,$message,$headers);
    //$mail->send();

    $mail->Subject = "New Bestelling";
    $mail->addAddress($userEmail, $_POST['voornaam'] . " " . $_POST['achternaam']);
    $mail->send();


    echo "Je bestelling is verwerkt, Er is hierbij een mail gestuurd naar u. Mocht 1 van de gegevens niet kloppen kunt u een mailtje terug sturen naar ons.";
} catch (Exception $e) {
    echo "Probeer het later opnieuw. Er is iets foutgegaan";
}

?>


<script> 
setTimeout(function () {
    window.location.href = "../index.php";
}, 2000); 
</script>