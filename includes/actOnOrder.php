
<?php
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
    echo        "<table style=\"width:100%\">".
                "  <tr>" .
                "    <th>Product</th>" .
                "    <th>price</th>" .
                "    <th>amount</th>" .
                "  </tr>";

    // Fetching all products
    while($row = $result->fetch_assoc()) {
        $id     = $row['id'];
        $stock  = $row['p_stock'];
        $price  = $row['p_price'];
        $name  = $row['p_name'];
        $amount = $_POST[$id];

        // Checking if the user selected something
        if ( $amount != 0 ) {

            // Checking if this is possible
            if ( $amount < $stock + 1) {
                
                $total_price += $price * $amount;
                
                echo    "  <tr>" .
                        "    <td>$name</td>" .
                        "    <td>€$price</td>" .
                        "    <td>x$amount</td>" .
                        "  </tr>";
                $key .= $amount . "|" . $id . " " ; 
            }
        }


    }
    echo "</table>"; 
    echo  "<p>Total Price €" . $total_price . "</p>";
    session_start();
    $_SESSION['session-id'] = $key;

} else {
    echo "404 NOT FOUND";
}
?>