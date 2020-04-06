<?php
/* Database connection start */
$servername = "localhost:8889";
$username = "root";
$password = "root";
$dbname = "votersaccount";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>