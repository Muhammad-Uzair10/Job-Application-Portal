<?php
$host = "localhost";
$dbname = "s_12345678";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dbname);
if(mysqli_connect_errno()){
    die("Connection error: " . mysqli_connect_error());
}
echo "Connection with database successful.";
echo "<br> ";
?>