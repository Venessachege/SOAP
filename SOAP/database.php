<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "student_details";
// Create connection
$conn = new mysqli ($host, $username, $password, $dbname);
if (mysqli_connect_error()){
die('Connect Error ('. mysqli_connect_errno() .') '
. mysqli_connect_error());
}

//$conn->close();



?>