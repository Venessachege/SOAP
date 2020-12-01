<?php
//soap server
require_once "lib/nusoap.php";

function get_students($std_no){
    require 'database.php';

    $students = array();

    $student_retrieve_sql = "SELECT * FROM `student_details` WHERE std_no = $std_no";
    $student_results = mysqli_query($conn,$student_retrieve_sql);

    
    //return $student_results;
    
    while($row = mysqli_fetch_assoc($student_results)) {
        array_push($students, array(
            "name" => $row["name"],
            "std_no" => $row["std_no"],
            "phone" => $row["phone"],
            "address" => $row["address"]
            
        ));
    }
    return $students;
}

//create the soap object

$server = new soap_server();
$server->register("get_students");

$server->configureWSDL("studentrecords", "urn:studentrecords");

$server->register("get_students",
    array("std_no" => "xsd:integer"),
    array("return" => "xsd:Array"),
    "urn:studentrecords",
    "urn:studentrecords#get_students",
    "rpc",
    "encoded",
    "Retrieve student records from database depending on student ID passed");
$server->service(file_get_contents("php://input"));
?>
