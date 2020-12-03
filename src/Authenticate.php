<?php
include __DIR__.'/Hospital.php';
include __DIR__.'/Database.php';
include __DIR__.'/Receiver.php';
session_start();

function registerHospital(Hospital $newHospital){
    $connection = Database::getConnection();
    $statement = $connection->prepare("INSERT INTO hospitals (userid, password, name, address) VALUES (?,?,?,?)");
    $statement->bind_param("ssss", $newHospital->getUserid(), password_hash($newHospital->getPassword(), PASSWORD_DEFAULT), $newHospital->getName(), $newHospital->getAddress());
    if(!$statement->execute())
        die("Error occured while registering hospital");
    $statement->close();
}

function registerReceiver(Receiver $newReceiver){
    $connection = Database::getConnection();
    $statement = $connection->prepare("INSERT INTO receivers (username, password, blood_group, firstname, lastname, email) VALUES (?,?,?,?,?,?)");
    $statement->bind_param("ssssss", $newReceiver->getUsername(), password_hash($newReceiver->getPassword(), PASSWORD_DEFAULT), $newReceiver->getBloodGroup(), $newReceiver->getFirstName()
        , $newReceiver->getLastName(), $newReceiver->getEmail());
    if(!$statement->execute())
        die("Error occured while registering receiver.");
    $statement->close();
}

function loginHospital($userid, $password){
    $connection = Database::getConnection();
    $statement = "Select password from hospitals where userid='".$userid."';";
    $result = $connection->query($statement);
    return $result->num_rows == 1 && password_verify($password, $result->fetch_assoc()["password"],);
}

function loginReceiver($username, $password){
    $connection = Database::getConnection();
    $statement = "Select * from receivers where username='".$username."';";
    $result = $connection->query($statement);
    return $result->num_rows == 1 && password_verify($password, $result->fetch_assoc()["password"]);
}
function verifyHospitalUserid($userid){
    $connection = Database::getConnection();
    $statement = "Select * from hospitals where userid='".$userid."';";
    $result = $connection->query($statement);
    return $result->num_rows == 0;
}

function verifyReceiverUsername($username){
    $connection = Database::getConnection();
    $statement = "Select * from receivers where username='".$username."';";
    $result = $connection->query($statement);
    return $result->num_rows == 0;
}

function notNull($str){
    return $str != null and $str != '';
}

$location = "../index.php";

if($_POST['authentication_type'] != 0){
    switch($_POST['authentication_type']){

        case 1: 
            if(loginReceiver($_POST['receiver-login-username'], $_POST['receiver-login-password'])){
                $_SESSION['authenticated'] = true;
                $_SESSION['type'] = 1;
                $_SESSION['message'] = "";
                $_SESSION['id'] = $_POST['receiver-login-username'];
            }else{
                $_SESSION['message'] = "Invalid username or password";
                $location = "../login.php";
            }

        break;
        
        case 2:
            if(loginHospital($_POST['hospital-login-userid'], $_POST['hospital-login-password'])){
                $_SESSION['authenticated'] = true;
                $_SESSION['message'] = "";
                $_SESSION['type'] = 2;
                $_SESSION['id'] = $_POST['hospital-login-userid'];
            }else{
                $_SESSION['message'] = "Invalid userid or password";
                $location = "../login.php";
            }
        
        break;

        case 3:
            if(verifyReceiverUsername($_POST['receiver-register-username'])){

                $receiver = new Receiver($_POST['receiver-register-firstname'], $_POST['receiver-register-lastname'], $_POST['receiver-register-username'], $_POST['receiver-register-password'], $_POST['receiver-register-blood-group'], $_POST['receiver-register-email']);

                if($receiver->allValuesNotNull()){
                    registerReceiver($receiver);
                    $_SESSION['authenticated'] = true;
                    $_SESSION['type'] = 1;
                    $_SESSION['message'] = "";
                    $_SESSION['id'] = $_POST['receiver-register-username'];
                }else{
                    $_SESSION['message'] = "Found some empty values. Please try again";
                    $location = "../login.php";

                }

            }else{

                $_SESSION['message'] = "Username already exists.";
                $location = "../login.php";
            }
        
        break;

        case 4:
            if(verifyHospitalUserid($_POST['hospital-register-userid'])){

                $hospital = new Hospital($_POST['hospital-register-userid'], $_POST['hospital-register-password'], $_POST['hospital-register-name'], $_POST['hospital-register-address']);

                if($hospital->allValuesNotNull()){
                    registerHospital($hospital);
                    $_SESSION['authenticated'] = true;
                    $_SESSION['type'] = 2;
                    $_SESSION['message'] = "";
                    $_SESSION['id'] = $_POST['hospital-register-userid'];
                }else{
                    $_SESSION['message'] = "Found some empty values. Please try again";
                    $location = "../login.php";
                }

            }else{

                $_SESSION['message'] = "Userid already exists.";
                $location = "../login.php";

            }
        
        break;

        default: die('Invalid Access');
        break;

    }
}else{
    die('Invalid Access');
}

Database::closeConnection();
if($location == '../index.php' && $_SESSION['sample_id'] != null)
    $location = './RequestSample.php';
header('Location: '.$location);
?>