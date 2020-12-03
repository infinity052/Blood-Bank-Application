<?php
    session_start();
    include __DIR__.'/src/Samples.php';
    $data = getAvailableSamples();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background: black;">
    <?php
        include __DIR__.'/assets/GlobalInclusions.html';
        include __DIR__.'./assets/navbar.php'; 
    ?>
    <div class="container">
        <h3 class="text-center mt-5 display-3" style="color: white">
            Available Samples
        </h3>
        
                <?php
                    $i = 1;
                    if($data->num_rows > 0){
                        echo '<table style="border: solid 1px white; color: white;" class="w-100 mt-5">
                        <thead>
                            <tr id="thead">
                            <td style="border: solid 1px white; color: white;" class="p-3">S. No.</td>
                            <td style="border: solid 1px white; color: white;" class="p-3">Blood Type</td>
                            <td style="border: solid 1px white; color: white;" class="p-3">Hospital Name</td>
                            </tr>
                        </thead>
                        <tbody>';
                        while($current_row = $data->fetch_assoc()){
                        echo "<tr id = \"". $current_row['id']  ."\" class = \" w-100\" style=\"cursor: pointer;\">";
                            echo "<td class=\"p-4 w-25\">".$i."</td>";
                            echo "<td class=\"p-4 w-25\">".$current_row["type"]."</td>";
                            echo "<td class=\"p-4 w-25\">".$current_row["name"]."</td>";
                        echo "</tr>";
                        $i++;  
                        }
                        echo '</tbody>
                    </table>';
                        echo '<div class="mt-3 text-right">
                        <button class="btn btn-outline-danger" onclick = "requestSample()">
                                Request Sample
                        </button>
                    </div>';
                    
                    }else{

                        echo '<h5 class="text-center mt-5 h5" style="color: white">
                        No blood samples available
                        </h5>';

                    }
                    
                ?>
            
        
    </div>
    <form action="/src/RequestSample.php" method="POST"><input type="text" hidden id="sample-id" name="sample-id"></form>
    <script>
        selected = "";
        $('tr').mouseenter((event)=>{
            if(event.target.parentElement.id != 'thead' && selected != event.target.parentElement.id)
                $(event.target.parentElement).css('background',' rgb(16, 16, 16)');
        });
        $('tr').mouseleave((event)=>{
            if(event.target.parentElement.id != 'thead' && selected != event.target.parentElement.id)
                $(event.target.parentElement).css('background','black');
        });
        $('tr').click((event)=>{
            if(event.target.parentElement.id == 'thead')
                return;

            if(selected == event.target.parentElement.id){
                $(event.target.parentElement).css('background','black');
                selected = "";
            }

            else{
                if(selected != "")
                    $("#"+selected).css('background', 'black');
                $(event.target.parentElement).css('background','#dc3545');
                selected = event.target.parentElement.id;
            }
        });
        function requestSample(){
            if(selected == ""){
                alert("Please select a sample first");
                return;
            }
            $("#sample-id").val(selected);
            $('form').submit();
        }

        <?php
        if(array_key_exists('message', $_SESSION) && $_SESSION['message'] != "")
               echo "alert(\"".$_SESSION["message"]."\")";
        $_SESSION['sample_id'] = null;
        $_SESSION['message'] = "";
    ?>

    </script>
    
</body>
</html>