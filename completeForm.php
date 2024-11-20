<?php

//If any of the fields is left empty in the form ; this form throw error 
include 'db_connection.php';
error_reporting(E_ALL); ini_set('display_errors', 1);

if(isset($_POST['Submit'])){

    $machineId = $_POST["machine_id"];
    $remark = $_POST["remarks"];
    
        $sql = "INSERT INTO completionremarks (machineId, remarks) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $machineId, $remarks);
   
        if ($stmt->execute()) {
            echo '<div style="text-align: center; color: white; background-color: steelblue; padding: 10px; font-size: 24px; font-weight: bold;"><i class="fas fa-check-circle"></i> Remarks Submitted Successfully!</div>';
        } else {
            echo "ERROR: Could not execute query: " . mysqli_error($conn);
        }
                       
        $stmt->close();
    } else {
        echo "Error uploading file.";
    }
// echo"error uploading file."; 
// bank verification letter of the 
$conn->close();
?>