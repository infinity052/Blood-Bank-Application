<?php
    include __DIR__.'/Database.php';

    function getAvailableSamples(){
        $connection = Database::getConnection();
        $sql = "select blood_samples.id, blood_samples.type, hospitals.name from blood_samples,hospitals where blood_samples.hospital_id = hospitals.id;";
        return $connection->query($sql); 
    }
    
    function requestSample($sample_id, $receiver_username){
        $connection = Database::getConnection();
        $sql = "Select id, blood_group from receivers where username = '".$receiver_username."';";
        $data = $connection->query($sql);
        if($data->num_rows < 1){
            echo "error occured while reading receiver's username";
            return 0;
        }
        $data = $data->fetch_assoc();
        $receiver_id = $data["id"];
        $receiver_type = $data["blood_group"];

        $sql = "Select hospital_id, type from blood_samples where id = '".$sample_id."';";
        $data = $connection->query($sql);
        if($data->num_rows < 1){
            echo "error occured while reading sample's type in blood_samples table";
            return 0;
        }
        $data = $data->fetch_assoc();
        $hospital_id = $data["hospital_id"];
        $type_requested = $data["type"];
        
        if($receiver_type != $type_requested)
            return -1;

        $statement = $connection->prepare("insert into sample_requests (receiver_id, sample_id, hospital_id) values (?, ?, ?)");
        $statement->bind_param("ddd", $receiver_id, $sample_id, $hospital_id);
        $res = $statement->execute();
        if(!$res){
            $statement->close();
            return false;
        }
        $statement->close();
        return true;
    }

    function addBloodInfo($type, $hospital_userid){
        $connection = Database::getConnection();
        $sql = "select id from hospitals where userid = '".$hospital_userid."';";
        $hospital_id = $connection->query($sql)->fetch_assoc()['id'];
        $sql = "insert into blood_samples (type, hospital_id) values ('".$type."' , '".$hospital_id."');";
        if(!$connection->query($sql))
            die("Error occured while inserting blood info. Please try again");
    }

    function getCurrentRequests($hospital_userid){
        $connection = Database::getConnection();
        $sql = "select id from hospitals where userid = '".$hospital_userid."';";
        $hospital_id = $connection->query($sql);
        if(!$hospital_id)
            die("Error occured while getting pending requests. Error in Query 1");
        $hospital_id = $hospital_id->fetch_assoc()['id'];
        $sql = "select sample_requests.sample_id, sample_requests.receiver_id, 
        blood_samples.type, receivers.firstname, receivers.lastname from 
        sample_requests, blood_samples, receivers where sample_requests.hospital_id = 
        ".$hospital_id." and receivers.id=sample_requests.receiver_id and 
        blood_samples.id = sample_requests.sample_id;";
        return $connection->query($sql);
    }

?>