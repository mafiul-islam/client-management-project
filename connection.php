<?php
 
 $server = "localhost";
 $username = "root";
 $password = "";
 $db = "db_profilebook";

 //create a connection 
    
    $conn = mysqli_connect($server,$username,$password,$db);

 //check the connection 

 if( !$conn ) {
 	die("connection failed: " . mysqli_connect_error() );
 }

 

?>