<?php
include 'db_connection.php'; // Include database connection

$feedback = "";

if(isset($_GET['id'])) {
                // Get the 'id' from the URL
                $id = $_GET['id'];
}


// Check if 'id' is set in the URL

	

    // Check if the 'click' button is clicked
    if(isset($_POST['click'])) {
        // Get the current timestamp
		 date_default_timezone_set('Asia/Kolkata'); // Example: setting timezone to Asia/Kolkata

        $date_clicked = date('Y-m-d H:i:s');
		
		

        // Insert the 'date_clicked' into the database
       $sql = "UPDATE eventss SET startTime = '$date_clicked' WHERE id = $id";
	 // echo"UPDATE eventss SET startTime = '$date_clicked' WHERE id = $id";
		
		
		if(mysqli_query($conn, $sql)){
        echo '<div style="text-align: center; color: white; background-color: steelblue; padding: 10px; font-size: 24px; font-weight: bold;"><i class="fas fa-check-circle"></i> Maintenence Started!</div>';
    } else{
        echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
    }
	

        
}
?>

