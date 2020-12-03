<?php 
session_start();
if(!array_key_exists("authenticated", $_SESSION) || $_SESSION['authenticated'] == false)
    die('Invalid Access');
else{
    $_SESSION['authenticated'] = false;
    $_SESSION['error_code'] = 0;
    $_SESSION['id'] = "";
    header("Location: /login.php");
}

?>