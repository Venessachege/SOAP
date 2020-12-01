<?php
require 'database.php';
if(isset($_POST['submit'])){

  $std_no= $_POST['std_no'];
  $name= $_POST['name'];
  $phone= $_POST['phone'];
  $address= $_POST['address'];

$sql = "INSERT INTO student_details(std_no, name, phone, address)
values ('$std_no','$name','$phone','$address')";

if ($conn->query($sql)){
echo "Student record inserted sucessfully";
//header('Location: create.php');
}else{
  echo'Error while inserting records';
}
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>SOAP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  </head>

  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand nav-link text-white"><h3>Add Student Details</h3></a>
                </li>
            </ul>
        </nav><br>
<h2>Add Student</h2>

<form method="post" action="create.php">

  <input type="text" name="std_no" id="std_no" class="form-control" placeholder="Student_Number" aria-label="Student_Number" aria-describedby="basic-addon1" required><br>
  <input type="text" name="name" id="std_no" class="form-control" placeholder="Student Name" aria-label="Student Name" aria-describedby="basic-addon1" required><br>
  <input type="text" name="phone" id="std_no" class="form-control" placeholder="Phone Number" aria-label="Phone Number" aria-describedby="basic-addon1" required><br>
  <input type="text" name="address" id="address" class="form-control" placeholder="Address" aria-label="Address" aria-describedby="basic-addon1" required><br>
  <input class="btn btn-primary" type="submit" value="Submit" name='submit'>
</form>
<br>
<a class="btn btn-primary" href="read.php" role="button">Read Student Info</a>
<a class="btn btn-primary" href="index.php" role="button">Back to Home</a>

  </body>
</html>