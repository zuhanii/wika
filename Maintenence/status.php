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

$heading = '';

if ($row) {
    $logTime = new DateTime($row['logTime']);
    $startTime = $row['startTime'] !== '0000-00-00 00:00:00' ? new DateTime($row['startTime']) : null;
    $endTime = $row['endTime'] !== '0000-00-00 00:00:00' ? new DateTime($row['endTime']) : null;

    // Determine the heading based on startTime and endTime
    if ($row['startTime'] === '0000-00-00 00:00:00') {
        $heading = 'Maintenance not started yet';
    } elseif ($row['endTime'] === '0000-00-00 00:00:00') {
        $heading = 'Maintenance work started';
    } else {
        $heading = 'Maintenance work ended';
    }

    // Custom function to calculate working hours difference
    function calculateWorkingHoursDifference($start, $end) {
        $startWorkday = clone $start;
        $endWorkday = clone $end;
        
        $startWorkday->setTime(9, 0);
        $endWorkday->setTime(17, 30);

        // Case when the period is within a single day
        if ($start->format('Y-m-d') === $end->format('Y-m-d')) {
            if ($start > $endWorkday || $end < $startWorkday) {
                return 0; // If start or end is outside work hours
            }
            $start = max($start, $startWorkday);
            $end = min($end, $endWorkday);
            return $end->getTimestamp() - $start->getTimestamp();
        }

        // Case when the period spans multiple days 
        $workingSeconds = 0;

        // Add the first day's working hours
        if ($start < $endWorkday) {
            $workingSeconds += min($endWorkday->getTimestamp(), $start->getTimestamp()) - max($startWorkday->getTimestamp(), $start->getTimestamp());
        }

        // Add the working hours for the days in between
        $start->modify('+1 day')->setTime(9, 0);
        while ($start < $end->setTime(0, 0)) {
            $workingSeconds += ($endWorkday->getTimestamp() - $startWorkday->getTimestamp());
            $start->modify('+1 day');
        }

        // Add the last day's working hours
        if ($end > $startWorkday) {
            $workingSeconds += min($end->getTimestamp(), $endWorkday->getTimestamp()) - $startWorkday->getTimestamp();
        }

        return $workingSeconds;
    }

    // Calculate differences in seconds
    $logToStart = $startTime ? calculateWorkingHoursDifference($logTime, $startTime) : null;
    $logToEnd = $endTime ? calculateWorkingHoursDifference($logTime, $endTime) : null;
    $startToEnd = ($startTime && $endTime) ? calculateWorkingHoursDifference($startTime, $endTime) : null;
}

function formatSeconds($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days %h hours %i minutes %s seconds');
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
        .btn[disabled] {
            background-color: #cccccc; /* gray */
            cursor: not-allowed;
        }
        .btn:hover:not([disabled]) {
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
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .navbar {
            background-color: #007bff; /* blue */
            padding: 10px 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="#">Home</a>
        <a href="requests_record.php">Log Book</a>
        <a href="#"></a>
        <div>
            <img src="logo.png" alt="Logo">
        </div>
    </div>
    <div class="container">
        <h1>Maintenance Status</h1>
        <h2><?php echo $heading; ?></h2>
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
                echo "<td>" . ($row['startTime'] === '0000-00-00 00:00:00' ? 'Maintenance not started yet' : $row['startTime']) . "</td>";
                echo "<td>" . ($row['endTime'] === '0000-00-00 00:00:00' ? 'Maintenance work hasn\'t ended yet' : $row['endTime']) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        
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
