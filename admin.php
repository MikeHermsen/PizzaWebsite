<?php
// The login screen
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    // This displays when the user try to login
    header('WWW-Authenticate: Basic realm="Admin panel"');
    header('HTTP/1.0 401 Unauthorized');
    echo '404 NOT FOUND';
    exit;
    
} else {

    include_once 'includes/cred.php';

    if ( $adminUsername == $_SERVER['PHP_AUTH_USER'] & $adminPassword ==  $_SERVER['PHP_AUTH_PW'] ) {
        $rederict_site = "panel.php"; // Redericting to the panel if the credentials are correct
        
        session_start(); // This will create a key to use
        $key = md5($_SERVER['PHP_AUTH_USER'] . $_SERVER['PHP_AUTH_PW']);
        $_SESSION['pub-key'] = $key; // Saving the key in an session

    } else {
        // If the password or username was incorrect it will rederict to the homepage
        $rederict_site = "index.php";
    }

}
?>

<!-- Redericting users to the following website -->
<script type="text/javascript">location.href = <?php echo '"' . $rederict_site . '"'; ?>;</script>


