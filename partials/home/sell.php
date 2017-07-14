<?php

session_start();

require_once('../../connection.php');

$userid = $_SESSION['userid'];
$itemid = $_POST['id'];
$input = $_POST['counter'];

$sql = "select * from user_items where user_id=$userid and items_id=$itemid";
$query = mysqli_query($connect,$sql);
$result = mysqli_fetch_assoc($query);

if($result['quantity'] != $input) {
	$gilselect = "select gil from user where id=$userid";
	$gilquery = mysqli_query($connect,$gilselect);
	$gil = mysqli_fetch_assoc($gilquery);
	$gil = $gil['gil'];

	$priceselect = "select price from items where id=$itemid";
	$pricequery = mysqli_query($connect,$priceselect);
	$price = mysqli_fetch_assoc($pricequery);
	$price = $price['price'];

	$equation = $input * $price;
	$newgil = $gil + $equation;
	$math = $result['quantity'] - $input;

	$updateinv = "update user_items set quantity=$math where user_id=$userid and items_id=$itemid";
	$updateinvquery = mysqli_query($connect,$updateinv);

	$updategil = "update user set gil=$newgil where id=$userid";
	$updategilquery = mysqli_query($connect,$updategil);


} else if ($result['quantity'] == $input) {
	$gilselect = "select gil from user where id=$userid";
	$gilquery = mysqli_query($connect,$gilselect);
	$gil = mysqli_fetch_assoc($gilquery);
	$gil = $gil['gil'];

	$priceselect = "select price from items where id=$itemid";
	$pricequery = mysqli_query($connect,$priceselect);
	$price = mysqli_fetch_assoc($pricequery);
	$price = $price['price'];

	$equation = $input * $price;
	$newgil = $gil + $equation;

	$updategil = "update user set gil=$newgil where id=$userid";
	$updategilquery = mysqli_query($connect,$updategil);

	$delete = "delete from user_items where user_id=$userid and items_id=$itemid";
	$deletequery = mysqli_query($connect,$delete);
}

?>