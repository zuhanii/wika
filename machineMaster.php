<?php 
include 'db_connection.php';
$query = "SELECT * FROM machine_master ";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <div class="navbar">
	
       
        <a href="requests_record.php">Log Book</a>
        <a href="#">Machine Master</a>
		</div>
    <title>Machine Master</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa; /* light gray */
        color: #333; /* dark gray */
        margin: 0;
        padding: 0;
    }
    h2 {
        color: #007bff; /* blue */
        font-weight: bold;
    }
	
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff; /* white */
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }
	
	
	
	
    th, td {
        border: 1px solid #dee2e6; /* light gray */
        padding: 12px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2; /* light gray */
        font-weight: bold;
    }
	.navbar {
            background-color: #007bff; /* blue */
            padding: 10px 20px;
            margin-bottom: 20px;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
</style>

</head>
<body>

<h2>Machine Master List</h2>

<table>
    <thead>
        <tr>
            <th>S No.</th>
			<th>F Id</th>
            <th>Machine ID</th>
            <th>Machine Name</th>
			<th>Model</th>
			<th>Make</th>
            <th>Description</th>
            <th>Vendor</th>
            <th>Vendor Description</th>
            <th>Connected Load </th>
            <th>Voltage</th>
			<th>Department</th>
			<th>Sub-Department</th>
			<th>Work Center</th>
			  <th>Cost Center</th>
			  <th>Working Status </th>
			  <th>Working Remark</th>
			   <th>Class</th>
			    <th>Listed in PM</th>
				 <th>Operating or Drawing</th>
				 <th>Date Of Installation</th>
			  
			 
        
           
        </tr>
    </thead>
    <tbody>
        <?php
        while($row = mysqli_fetch_assoc($result)) {
          

            echo "<tr>";
            echo "<td>" . $row['sno'] . "</td>";
            echo "<td>" . $row['fa_id'] . "</td>";
            echo "<td>" . $row['machine_id'] . "</td>";
            echo "<td>" . $row['machine_name'] . "</td>";
			 echo "<td>" . $row['model'] . "</td>";
			  echo "<td>" . $row['make'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
			 echo "<td>" . $row['vendor'] . "</td>";
            echo "<td>" . $row['connectedLoad_kw'] . "</td>";
			echo "<td>" . $row['voltage'] . "</td>";
			echo "<td>" . $row['dept'] . "</td>";
			echo "<td>" . $row['subdept'] . "</td>";
			echo "<td>" . $row['workCenter'] . "</td>";
			echo "<td>" . $row['costCenter'] . "</td>";
				echo "<td>" . $row['workingStatus'] . "</td>";
				echo "<td>" . $row['workingRemark'] . "</td>";
				echo "<td>" . $row['class'] . "</td>";
				echo "<td>" . $row['listenInPm'] . "</td>";
				echo "<td>" . $row['operatingOrDrawing'] . "</td>";
				echo "<td>" . $row['dateOfInstallation'] . "</td>";
			
			 

      
		
           
			


            echo "</tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>



























