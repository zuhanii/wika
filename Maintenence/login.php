<?php
include("db_connection.php");

if(isset($_POST["Login"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["pwd"]);
    
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
  
    $num = mysqli_num_rows($sql);
  
    if($num > 0) {
        $row = mysqli_fetch_array($sql);
        if($row['type'] == 'A') {
            header("location:requests_record.php");
        } else {
            header("location:tracking.php");
        }
        exit();
    } else {
        echo '<hr><font color="red"><b><h3>Sorry Invalid Username and Password<br>Please Enter Correct Credentials</br></h3></b></font><hr>';
    }
}
?>
