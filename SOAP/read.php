<?php
//soap client

require_once "./lib/nusoap.php";


if(isset($_POST['submit'])){
    require 'database.php';

    $std_no = $_POST['std_no'];

    /* 
    We can use the url below or create a wsdl file with the contents from the URL
    below then use the file to create the client object  
    */
    $client = new nusoap_client("http://localhost/SOAP/retrieve.php?wsdl", true);

    $error = $client->getError();
    if ($error) {
        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
    }

    $results = $client->call("get_students", array("std_no" => $std_no)); 

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Students</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
</head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand nav-link text-white"><h3>Get Student Details</h3></a>
                </li>
            </ul>
        </nav><br>
            <form action="read.php" method="post">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        
                        <input type="text" required class="form-control" name="std_no" id="std_no" placeholder="Enter Student Admission Number">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                    <br>
                        <button name="submit" class="btn btn-primary btn-block">Retrieve</button>
                    </div>
                </div>
                            
            </form>
        </div>
        <a class="btn btn-primary" href="index.php" role="button">Home</a>
        <a class="btn btn-primary" href="create.php" role="button">Add Student </a>
        <?php
        if(isset($_POST['submit'])){
        ?>
        <div class="container" style="padding-top: 50px;">
            
            <table class="table table-stripped">
                <thead class="thead-dark">
                    <tr>
                    
                    <th scope="col">Student Number</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Address</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                        if ($client->fault) {
                            echo '<div class="p-3 mb-2 bg-danger text-white">';
                            echo '<h2>Fault</h2>';
                            print_r($results);
                            echo "</div>";
                        } else {
                            $error = $client->getError();
                            if ($error) {
                                echo '<div class="p-3 mb-2 bg-danger text-white">';
                                echo '<h2>Error! </h2>';
                                echo '<pre>' . $error . '</pre>';
                                echo "</div>";
                            } else {
                                foreach($results as $result){
                                    echo '
                                    <tr>
                                        <td>'.$result["std_no"].'</td>
                                        <td>'.$result["name"].'</td>
                                        <td>'.$result["phone"].'</td>
                                        <td>'.$result["address"].'</td>
                                        
                                    </tr>
                                    ';
                                }
                            }
                        } 
                    
            
                    ?>
                </tbody>
            </table>
        </div>
        <?php
            } 
        ?>
    </body>
</html>
<?php

?>
