<?php
    session_start();
    
    if(!array_key_exists("authenticated", $_SESSION) || $_SESSION['authenticated'] == false){
        $_SESSION['message'] = "Please login as a receiver first to request a sample.";
        $_SESSION['sample_id'] = $_POST['sample-id'];
        header("Location: ../login.php");

    }else if((!array_key_exists("sample_id", $_SESSION) || $_SESSION['sample_id'] == null) && $_POST['sample-id'] == null){

        die("Invalid Access");

    }else if($_SESSION['type'] == 2){
        $_SESSION['message'] = "Requesting blood samples is a feature only reserved for Receivers. Please log in as a Receiver.";
        header("Location: ../AvailableSamples.php");
    }
    else{
        include __DIR__.'/Samples.php';
        $sample_id = (!array_key_exists("sample_id", $_SESSION) || $_SESSION['sample_id'] == null) ? $_POST['sample-id'] : $_SESSION['sample_id'];
        $ret = requestSample($sample_id, $_SESSION['id']);
        if($ret == 0)
            die("Error occured. Please try again");
        else if($ret == 1)
            $_SESSION["message"] = "You have successfully placed a request for a sample. The hospital will get in touch with you shortly.";
        else
            $_SESSION["message"] = "You are not eligible for this blood sample because it does not match the blood type that you provided.";
        $_SESSION['sample_id'] = null;
        
        header("Location: ../index.php");
    }
?>