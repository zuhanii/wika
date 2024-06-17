<?php 
include 'db_connection.php';
$query = "SELECT * FROM requests";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status</title>
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
            text-align: center;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .navbar img {
            height: 40px;
            width: auto;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div>
        <a href="#">Track Status</a>
        <a href="insert.php">Submit Request</a>
    </div>
    <div>
   <img src="logo.png" alt="Logo">
   
    </div>
</div>

<h2>Machines Under Maintenance</h2>

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
            <th>Status</th>
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
            echo '<td><img src="' . $row['image'] . '" alt="Service Request Image" height="100" width="100"></td>';
            echo "<td>" . $row['dateTime'] . "</td>";
            echo "<td><a href='status.php?id=" . $row['Sno'] . "'>View Status</a></td>";
            echo "</tr>";
		
        }
        ?>
    </tbody>
</table>
</body>
</html>
