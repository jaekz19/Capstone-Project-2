<?php

session_start();

require_once('../../connection.php');

$userid = $_SESSION['userid'];
$usergil = $_SESSION['gil'];
$id = $_POST['id'];
$input = $_POST['counter'];

$itemcheck = "select * from user_items where user_id='$userid' and items_id='$id'";
$initialresult = mysqli_query($connect,$itemcheck);
$finalresult = mysqli_fetch_assoc($initialresult);

	if($finalresult >= 1) {
		$pricecheck = "select price from items where id='$id'";
		$pricequery = mysqli_query($connect,$pricecheck);
		$pricefinal = mysqli_fetch_assoc($pricequery);

		$price = $pricefinal['price'] * $input;
		$quantity = $finalresult['quantity'];
		$updated = $usergil - $price;

		if(($quantity + $input) <= 99 && $updated >= 0){
			$updategil = "update user set gil='$updated' where id='$userid'";
			$updateinv = "update user_items set quantity=$quantity + $input where user_id='$userid' and items_id='$id'";
			mysqli_query($connect,$updategil);
			mysqli_query($connect,$updateinv);
			echo "Thank you for buying!";
			$_SESSION['gil'] = $updated;
		} else if (($quantity + $input) >= 100 && $updated >= 0) {
			echo "Exceed carry limit!";
		} else if ($updated <= 0) {
			echo "Insufficient Gil!";
		}

	} else if($finalresult == 0) {
		$pricecheck = "select items.price from items join user_items on (user_items.items_id = items.id) where items.id=$id";
		$pricequery = mysqli_query($connect,$pricecheck);
		$pricefinal = mysqli_fetch_assoc($pricequery);

		$price = $pricefinal['price'] * $input;
		$updated = $usergil - $price;

		if($updated >= 0) {
			$updategil = "update user set gil='$updated' where id='$userid'";
			mysqli_query($connect,$updategil);

			$insert = "insert into user_items(user_id,items_id,quantity)
						values('$userid','$id','$input')";
			mysqli_query($connect,$insert);
			$_SESSION['gil'] = $updated;
			echo "Thank you for buying!";
		} else if ($updated <= 0) {
			echo "Insufficient Gil!";
		}
	}

?>