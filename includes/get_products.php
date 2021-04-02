
<?php
// Server connection settings
include_once 'cred.php';


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, p_name, p_price, p_stock, img_url, description FROM pizza_hut_products";
$result = $conn->query($sql);


while($row = $result->fetch_assoc()) {
  if ( $row['p_stock'] != 0 ) {

    echo "<div class=\"card\"> ";
    echo "  <img src=\"media/img/products/" . $row["img_url"] . "\" alt=\"Product item\"/>";
    echo "  <h2>" . $row["p_name"] . "</h2>";
    echo "  <h5>Price €" . $row["p_price"] . "</h5>";
    echo "  <p title=\"" . $row["description"] . "\">" . substr($row["description"], 0, 20) . "...</p>";
    echo "  <input type=\"number\" name=\"" . $row["id"] . "\" list=\"quantities\" placeholder=\"0\" min=\"0\" max=\"" . $row['p_stock'] . "\">";
    echo "</div>";
  }
}


$conn->close();
?>







