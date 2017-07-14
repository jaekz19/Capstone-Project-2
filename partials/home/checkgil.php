<?php

session_start();

require_once('../../connection.php');

$userid = $_SESSION['userid'];
$sql = "select gil from user where id='$userid'";
$query = mysqli_query($connect,$sql);
$result = mysqli_fetch_assoc($query);
$_SESSION['gil'] = $result['gil'];
echo $result['gil'];

?>