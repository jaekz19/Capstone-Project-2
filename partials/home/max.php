<?php

session_start();

require_once('../../connection.php');

$id = $_POST['id'];
$userid = $_SESSION['userid'];
$usergil = $_SESSION['gil'];

$itemcheck = "select * from user_items where user_id='$userid' and items_id='$id'";
$initialresult = mysqli_query($connect,$itemcheck);
$finalresult = mysqli_fetch_assoc($initialresult);

	if($finalresult >= 1) {
		$currentquantity = $finalresult['quantity'];
		$max = 99 - $currentquantity;

		$pricecheck = "select price from items where id='$id'";
		$pricequery = mysqli_query($connect,$pricecheck);
		$pricefinal = mysqli_fetch_assoc($pricequery);
		$price = $pricefinal['price'];

		$updated = $max * $price;
		$maxprice = $usergil - $updated;

		if ($currentquantity == 99) {
			echo "Item already full!";
		} else if($maxprice >= 0) {
			$updategil = "update user set gil=$maxprice where id=$userid";
			mysqli_query($connect,$updategil);

			$updateinv = "update user_items set quantity=$currentquantity + $max where user_id=$userid and items_id=$id";
			mysqli_query($connect,$updateinv);

			echo "Thank you for buying!";
			$_SESSION['gil'] = $maxprice;
		} else if ($maxprice <= 0) {
			echo "Insufficient Gil!";
		}
	} else if ($finalresult == 0) {
		$currentquantity = $finalresult['quantity'];

		$pricecheck = "select price from items where id='$id'";
		$pricequery = mysqli_query($connect,$pricecheck);
		$pricefinal = mysqli_fetch_assoc($pricequery);
		$price = $pricefinal['price'];

		$updated = 99 * $price;
		$maxprice = $usergil - $updated;

		if($maxprice >= 0) {
			$updategil = "update user set gil=$maxprice where id=$userid";
			mysqli_query($connect,$updategil);

			$updateinv = "update user_items set quantity=99 where user_id=$userid and items_id=$id";
			mysqli_query($connect,$updateinv);

			echo "Thank you for buying!";
			$_SESSION['gil'] = $maxprice;
		} else if ($finalresult <= 0) {
			echo "Insufficient Gil!";
		}
	}
?>