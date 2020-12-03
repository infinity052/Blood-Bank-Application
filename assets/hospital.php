<?php
session_start();
if(!array_key_exists('authenticated' , $_SESSION) || $_SESSION['authenticated'] == false || $_SESSION['type'] != 2)
    die('Invalid Access');
    
else{
    include __DIR__.'/../src/Samples.php';
    $data = getCurrentRequests($_SESSION["id"]);
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include __DIR__.'/GlobalInclusions.html'; ?>
    <title>Document</title>
</head>
<?php 
    include __DIR__.'/navbar.php';
?>
<body style="background: black;">
    <form action="../src/AddBloodSample.php" method="POST" id="add-blood-info" onsubmit="return confirmSubmit();">
    <div class="container text-center">
        <h4 class="display-4 mt-5" style="color: white;">Add Blood Info</h4>
        <div class="input-group mb-3 mt-5">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Blood Type</span>
            </div>
            <select class="custom-select" id="blood-group" name="blood_group">
								<option selected value="">Select</option>
								<option value="O+">O+</option>
								<option value="O-">O-</option>
								<option value="AB+">AB+</option>
								<option value="AB-">AB-</option>
								<option value="A+">A+</option>
								<option value="A-">A-</option>
								<option value="B+">B+</option>
								<option value="B-">B-</option>
				</select>
        </div>
        <button class="btn btn-danger">Add</button>
        <button onclick = "togglePendingRequests()" type="button" class="btn btn-info ml-1">Check Sample Requests</button>
    </form>
    
    </div>

    <div class="container" id="pending-requests" style="display: none;">
        <h3 class="text-center mt-5 display-3" style="color: white">
            Pending Requests
        </h3>
        
                <?php
                    $i = 1;
                    if($data->num_rows > 0){
                        echo '<table style="border: solid 1px white; color: white;" class="w-100 mt-5">
                        <thead>
                            <tr id="thead">
                            <td style="border: solid 1px white; color: white;" class="p-3">S. No.</td>
                            <td style="border: solid 1px white; color: white;" class="p-3">Blood Type</td>
                            <td style="border: solid 1px white; color: white;" class="p-3">Receiver First Name</td>
                            <td style="border: solid 1px white; color: white;" class="p-3">Receiver Last Name</td>
                            </tr>
                        </thead>
                        <tbody>';
                        while($current_row = $data->fetch_assoc()){
                        echo "<tr id = \"". $current_row['id']  ."\" class = \" w-100\" style=\"cursor: pointer;\">";
                            echo "<td class=\"p-4 w-25\">".$i."</td>";
                            echo "<td class=\"p-4 w-25\">".$current_row["type"]."</td>";
                            echo "<td class=\"p-4 w-25\">".$current_row["firstname"]."</td>";
                            echo "<td class=\"p-4 w-25\">".$current_row["lastname"]."</td>";
                        echo "</tr>";
                        $i++;  
                        }
                        echo '</tbody>
                    </table>'; 
                    echo '<div class="mt-3 text-right">
                    <button class="btn btn-outline-danger" onclick = "toggleBloodInfo()">
                            Add Blood Info
                    </button>
                </div>';                   
                    }else{

                        echo '<h5 class="text-center mt-5 h5" style="color: white">
                        No sample requests pending.
                        </h5>';

                    }
                    
                ?>
            
        
    </div>

    <script>
        function toggleBloodInfo(){
            $("#pending-requests").hide();
            $("#add-blood-info").show();
        }

        function togglePendingRequests(){
            $("#add-blood-info").hide();
            $("#pending-requests").show();   
        }
        function confirmSubmit(){
            if ($("#blood-group").val() ==""){
                alert("Please select a blood type");
                return false;
            }
            return true;
        }
        
    </script>

    <?php
         if(array_key_exists('message', $_SESSION) && $_SESSION['message'] != "")
             echo "<script>alert(\"".$_SESSION["message"]."\")</script>";
         $_SESSION['sample_id'] = null;
         $_SESSION['message'] = "";

    ?>
</body>
</html>