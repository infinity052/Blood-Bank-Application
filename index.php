<?php
    session_start();
    if(array_key_exists("authenticated", $_SESSION) && $_SESSION['authenticated'] == true){
        if($_SESSION['type'] == 1)
            header("Location: ./AvailableSamples.php");
        else
            include __DIR__.'/assets/hospital.php';
    }else{
        $_SESSION['authenticated'] = false;
        include __DIR__.'/assets/homepage.php';
    }
    
    
       
?>