<?php 

// Session Start For Every Page
	session_start();


// Connect Databse
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db  = "chatapplication";
$conn = new mysqli($db_host, $db_username, $db_password, $db);




// Check Database Connection
if($conn->connect_error){
	die("Connection Failed: ". $conn->connect_error);
}