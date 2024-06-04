

<?php
//If any of the fields is left empty in the form; this will throw error
include 'db_connection.php';
error_reporting(E_ALL); ini_set('display_errors', 1);

if(isset($_POST['Submit'])){

    $logTime = $_POST["acceptTime"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];
    

    $sql = "INSERT INTO eventss (logTime, startTime, endTime)VALUES ('$logTime', '$startTime', '$endTime')";

    if(mysqli_query($conn, $sql)){
        echo '<div style="text-align: center; color: white; background-color: steelblue; padding: 10px; font-size: 24px; font-weight: bold;"><i class="fas fa-check-circle"></i> Service Completed!</div>';
    } else{
        echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
    }

}

?>
