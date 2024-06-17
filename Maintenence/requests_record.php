<?php 
include 'db_connection.php';
$query = "SELECT * FROM requests ";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <div class="navbar">
	
       
        <a href="#">Log Book</a>
        <a href="machineMaster.php">Machine Master</a>
		</div>
    <title>Breakdown Logbook</title>
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

<h2>Breakdown Logbook</h2>

<table>
    <thead>
        <tr>
            <th>S No.</th>
            <th>Machine ID</th>
            <th>Machine Name</th>
            <th>Cost Center</th>
            <th>Breakdown Type</th>
            <th>Description</th>
            <th>Image</th>
            <th>Log Time</th>
			  
        <!--<th>Maintenence Start</th>
			<th>Maintenence Stop</th>
            <th>Response Time</th>
			<th>Downtime</th>
            <th>Breakdown Hr per month</th>
<th>Spare</th>
            <th>Status</th>
			<th>Correction </th>
            <th>Root Cause</th>
            <th>Status</th>-->
			<th>Details</th>
          
        </tr>
    </thead>
    <tbody>
        <?php
        while($row = mysqli_fetch_assoc($result)) {
          
            echo "<tr>";
            echo "<td>" . $row['Sno'] . "</td>";
            echo "<td>" . $row['machineID'] . "</td>";
            echo "<td>" . $row['machineName'] . "</td>";
            echo "<td>" . $row['costCenter'] . "</td>";
            echo "<td>" . $row['typeOfBreakdown'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";

            // Assuming the 'image' column contains the filename of the image
           echo '<td>'; // Start of table cell
    echo '<img src="' . $row['image'] . '" alt="Service Request Image" height="100" width="100">';
    echo '</td>'; // End of table cell
            echo "<td>" . $row['dateTime'] . "</td>";
		// Link to view machine details with ID as query parameter
           
		/*	echo "<td>-". "</td>";
            echo "<td>-". "</td>";
            echo "<td>-" ."</td>";
            echo "<td>-". "</td>";
			echo "<td>-". "</td>";
            echo "<td>-". "</td>";
            echo "<td>-" ."</td>";
            echo "<td>-". "</td>";
			 echo "<td>-". "</td>";
			 echo "<td>-". "</td>";*/
			// echo "<td><a href='status.php?id=" . $row['Sno'] . "'>View Status</a></td>";
			  echo "<td><a href='details.php?id=" . $row['Sno'] . "'>View Details</a></td>";


            echo "</tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>



























