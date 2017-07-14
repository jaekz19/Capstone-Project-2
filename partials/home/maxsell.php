<?php

session_start();

require_once('../../connection.php');

$userid = $_SESSION['userid'];
$itemid = $_POST['id'];

$sql = "select quantity from user_items where user_id=$userid and items_id=$itemid";
$query = mysqli_query($connect,$sql);
$result = mysqli_fetch_assoc($query);

echo $result['quantity'];

?>