<?php

//If any of the fields is left empty in the form ; this form throw error 
include 'db_connection.php';
error_reporting(E_ALL); ini_set('display_errors', 1);

if(isset($_POST['Submit'])){

    $machineId = $_POST["machine_id"];
    $machineName = $_POST["machine_name"];
    $costCenter = $_POST["cost_center"];
    $typeOfBreakdown = $_POST["breakdown_type"];
	
    $description = $_POST["description"];
	$dateTime = $_POST["submission_time"];
	
	
	 $file = $_FILES['image'];
    $imageName = basename($file['name']);                  
    $target_dir = "image/"; // Ensure this is relative to the script
    $target_file = $target_dir . $imageName;              
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (move_uploaded_file($file["tmp_name"], $target_file)) {
        // Prepare SQL statement to insert data
        $sql = "INSERT INTO requests (machineId, machineName, costCenter, typeOfBreakdown, image, description, dateTime) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $machineId, $machineName, $costCenter, $typeOfBreakdown, $target_file, $description, $dateTime);

        if ($stmt->execute()) {
            echo '<div style="text-align: center; color: white; background-color: steelblue; padding: 10px; font-size: 24px; font-weight: bold;"><i class="fas fa-check-circle"></i> Request Submitted Successfully!</div>';
        } else {
            echo "ERROR: Could not execute query: " . mysqli_error($conn);
        }

        $stmt->close();
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>