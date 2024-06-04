

<?php
$servername = "localhost:8080";
$username = "wmd-s";
$password = "$J7sTdzm54";
$dbname = "servicerequests";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
