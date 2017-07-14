<?php

session_start();

require_once('../../connection.php');

$userid = $_SESSION['userid'];
$itemid = $_POST['id'];

$sql = "select quantity from user_items where user_id='$userid' and items_id='$itemid'";
$query = mysqli_query($connect,$sql);

if(mysqli_num_rows($query)>0) {
	while ($result = mysqli_fetch_assoc($query)) {
		$quantity = $result['quantity'];
		echo $quantity;
	}
} else if(mysqli_num_rows($query)==0) {
	echo "0";
}

?>