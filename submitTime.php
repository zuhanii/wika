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
        $date_clicked = date('Y-m-d H:i:s');
		

        // Insert the 'date_clicked' into the database
       $sql = "UPDATE eventss SET endTime = '$date_clicked' WHERE id = $id";
	 // echo"UPDATE eventss SET startTime = '$date_clicked' WHERE id = $id";
    
		if(mysqli_query($conn, $sql)){
        echo '<div style="text-align: center; color: white; background-color: steelblue; padding: 10px; font-size: 24px; font-weight: bold;"><i class="fas fa-check-circle"></i> Maintenence Ended!</div>';
    } else{
        echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
    }
        
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Maintenance Record Submission</title>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <style>
	
      .centered-button {
        display: block;
        width: 100%;
        max-width: 300px;
        margin: 20px auto;
        padding: 15px 20px;
        text-align: center;
        background-color: #007BFF; /* Change to desired color */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        font-size: 16px;
      }
      .centered-button:hover {
        background-color: #0056b3; /* Change to desired hover color */
      }
      .input-field {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
      }
      .input-field i {
        margin-right: 10px;
      }
      .input-field input,
      .input-field textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
      }
      .input-field textarea {
        resize: none;
      }
      .form-container {
        max-width: 500px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background: #fff;
      }
      .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
      }
	 
       </style>
  </head>
  <body>
  <!--
    <div class="form-container">
      <form action="completeForm.php" method="post" enctype="multipart/form-data">
        <h2>Submit Maintenance Record</h2>
        <div class="input-field">
          <i class="fas fa-edit"></i>
          <textarea placeholder="Remarks" name="remarks" id="remarks" rows="4" required></textarea>
        </div>
        <div class="input-field">
          <i class="fas fa-cogs"></i>
          <input type="text" placeholder="Machine ID" name="machine_id" id="machine_id" required />
        </div>
        <input type="submit" value="Submit" class="centered-button" />-->
	 
</form>
</div>
</body>
</html>
