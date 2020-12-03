<?php
    session_start();

    if(!array_key_exists('authenticated' , $_SESSION) || $_SESSION['authenticated'] == false || $_SESSION['type'] != 2)
        die('Invalid Access');
    include __DIR__."/Samples.php";
    addBloodInfo($_POST['blood_group'], $_SESSION['id']);
    $_SESSION['message'] = "Blood sample successfully added";
    header("Location: ../index.php");

?>