<?php

$host = "etdq12exrvdjisg6.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "vpoh4cg43jla3kby";
$password = "s9datg14khuj2lds";
$database = "iwcixxdeeyabkwal";

$connect = mysqli_connect($host,$username,$password,$database);

//to execute query to mysql using php use mysqli_query($connect,<variable>)


// addslashes($_POST) for strings with special characters
// echo "hello, database connected";
?>