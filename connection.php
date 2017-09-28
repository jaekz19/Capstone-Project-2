<?php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$host = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$database = substr($url["path"], 1);

$connect = mysqli_connect($host,$username,$password,$database);

//to execute query to mysql using php use mysqli_query($connect,<variable>)


// addslashes($_POST) for strings with special characters
// echo "hello, database connected";
?>