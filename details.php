<?php
include 'db_connection.php'; // Include database connection

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    echo 'No ID provided.';
    exit();
}

// Fetch data from the database for the provided ID
$sql = "SELECT id, logTime, startTime, endTime FROM eventss WHERE id = $id";
$result = $conn->query($sql);

// Fetch the row from the result
$row = mysqli_fetch_assoc($result);

if ($row) {
    $logTime = new DateTime($row['logTime']);
    $startTime = $row['startTime'] ? new DateTime($row['startTime']) : null;
    $endTime = $row['endTime'] ? new DateTime($row['endTime']) : null;

    // Calculate differences
    $logToStart = $startTime ? $logTime->diff($startTime) : null;
    $logToEnd = $endTime ? $logTime->diff($endTime) : null;
    $startToEnd = ($startTime && $endTime) ? $startTime->diff($endTime) : null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Status</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa; /* light gray */
            color: #333; /* dark gray */
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff; /* white */
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff; /* blue */
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
        .btn-container {
            margin-top: 20px;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            background-color: #007bff; /* blue */
            text-decoration: none;
            margin-right: 10px;
        }
        .btn:hover {
            background-color: #0056b3; /* darker blue */
        }
        .difference-section {
            margin-top: 30px;
            padding: 20px;
            background-color: #e9ecef; /* light gray */
            border-radius: 8px;
        }
        .difference-section h2 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="#">Home</a>
        <a href="requests_record.php">Log Book</a>
        <a href="#"></a>
    </div>
    <div class="container">
        <h1>Maintenance Status</h1>
        <table id="statusTable">
            <tr>
                <th>Log Time</th>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
            <?php
            if ($row) {
                echo "<tr>";
                echo "<td>" . $row['logTime'] . "</td>";
                echo "<td>" . $row['startTime'] . "</td>";
                echo "<td>" . $row['endTime'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
		<br><br>

        <!-- Place the buttons outside the table -->
        <div class="button-container">
            <button class="btn" onclick="goToNextPage(<?php echo $id; ?>, 'startTime.php')" >Start</button>
            <button class="btn" onclick="goToNextPage(<?php echo $id; ?>, 'completeTime.php')" >Complete</button>
        </div>

        <!-- Section to display time differences -->
        <div class="difference-section">
            <h2>Records:</h2>
            <p>Reaction Time: <?php echo $logToStart ? $logToStart->format('%d days %h hours %i minutes %s seconds') : 'N/A'; ?></p>
            <p>Total Downtime: <?php echo $logToEnd ? $logToEnd->format('%d days %h hours %i minutes %s seconds') : 'N/A'; ?></p>
            <p>Maintenence Time: <?php echo $startToEnd ? $startToEnd->format('%d days %h hours %i minutes %s seconds') : 'N/A'; ?></p>
        </div>
    </div>

    <script>
        function goToNextPage(id, page) {
            window.location.href = page + '?id=' + id;
        }
    </script>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
