<?php

//If any of the fields is left empty in the form ; this form throw error 
include 'db_connection.php';
error_reporting(E_ALL); ini_set('display_errors', 1);

if(isset($_POST['Submit'])){

    $machineId = $_POST["machine_id"];
    $machineName = $_POST["machine_name"];
    $costCenter = $_POST["cost_center"];
    $typeOfBreakdown = $_POST["breakdown_type"];
    
	$file = $_FILES['image'];
	$name = $file['image'];
	$path = "/images/" . basename($name);
if (move_uploaded_file($file['tmp_name'], $path)) {
    // Move succeed
} else {
   echo"Move failed";
   //Move failed 
  }
 
    $description = $_POST["description"];
	$dateTime = $_POST["submission_time"];


    $sql = "INSERT INTO requests (machineId, machineName, costCenter, typeOfBreakdown, image, description,dateTime) VALUES ('$machineId', '$machineName', '$costCenter', '$typeOfBreakdown', '" . mysqli_real_escape_string($path) . "', '$description','$dateTime')";

    if(mysqli_query($conn, $sql)){
        echo '<div style="text-align: center; color: white; background-color: steelblue; padding: 10px; font-size: 24px; font-weight: bold;"><i class="fas fa-check-circle"></i> Request Submitted Successfully!</div>';
    } else{
        echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
    }
}

?>