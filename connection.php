<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'chocobohut';

$connect = mysqli_connect($host,$username,$password,$database);

//to execute query to mysql using php use mysqli_query($connect,<variable>)


// addslashes($_POST) for strings with special characters
// echo "hello, database connected";
?>