<?php
/* Database connection start */
$servername = "us-cdbr-iron-east-01.cleardb.net:3306";
$username = "b0fc7571f78ffb";
$password = "b562c8a3";
$dbname = "heroku_cb680c63ed9989a";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>