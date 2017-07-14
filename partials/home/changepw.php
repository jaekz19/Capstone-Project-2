<?php

session_start();

require_once('../../connection.php');

$userid = $_SESSION['userid'];
$inputold = sha1($_POST['oldpw']);
$inputnew = $_POST['newpw'];
$inputconfirmpw = $_POST['confirmpw'];

$sql = "select * from user where id=$userid";
$query = mysqli_query($connect,$sql);
$result = mysqli_fetch_assoc($query);

$password = $result['password'];

if($inputold === $password && $inputnew === $inputconfirmpw) {
	$finalpw = sha1($inputconfirmpw);

	$change = "update user set password='$finalpw' where id=$userid";
	$changequery = mysqli_query($connect,$change);
	echo "Password change successful!";
} else {
	echo "Incorrect Password!";
}

?>