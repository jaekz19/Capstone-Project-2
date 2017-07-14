<?php

session_start();

$_SESSION['message'] = "";

require('connection.php');

function get_title() {
	echo "Chocobo Hut";
}

function display_banner() {
	return "
<header>
	<div class='container-fluid banner'>
		<div class='row'>
			<div class='col-xs-2'>
				<figure>
					<img src='images/logo.png' alt=''>
				</figure>
			</div>
			<div class='col-xs-8'>
				<h1>Greetings!<br>and welcome to<br>Chocobo Hut!</h1>
			</div>
		</div>
	</div>
</header>";
}

function display_content() {
	return "
<content>
	<div class='container-fluid loginpart'>
		<div class='row'>
			<div class='col-xs-8 col-xs-offset-2'>
				<form method='POST' action='' id='form'>
					<h1>Welcome!</h1>
					<h3>". $_SESSION['message'] . "</h3>
					<h3>Enter the World of Fantasy!</h3>
					<h5>Username:</h5>
					<input type='username' name='username' class='inputsize'>
					<h5>Password:</h5>
					<input type='password' name='password' class='inputsize'>
					<br>
					<input type='submit' name='login' value='Log-In' class='log'>
					<br>
					<input type='submit' name='signup' value='Sign-Up' class='reg' id='signup'>
				</form>
			</div>
		</div>
	</div>
</content>";
}

if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$username = strtolower($username);
	$password = sha1($_POST['password']);
	$sql = "select * from user where username='$username' and password='$password'";
	$result = mysqli_query($connect,$sql);

	if(mysqli_num_rows($result)>0) {
		while($rows = mysqli_fetch_assoc($result)) {
			$id = $rows['id'];
			$user = $rows['username'];
			$pass = $rows['password'];
			$role = $rows['role'];
			$gil = $rows['gil'];

			if($username == $user && $role == 'admin' && $password == $pass) {
				$_SESSION['userid'] = $id;
				$_SESSION['user'] = $username;
				header('location:partials/admin/admin.php');
			} else if ($username == $user && $password == $pass) {
				$_SESSION['userid'] = $id;
				$_SESSION['user'] = $username;
				$_SESSION['gil'] = $gil;
				header('location:partials/home/home.php');
			} else {
				$_SESSION['message'] = "Log in Failed.";
			}
		}
	}
}

if(isset($_POST['register'])) {
	$username = $_POST['reguser'];
	$username = strtolower($username);
	$password = $_POST['regpass'];
	$confirm = $_POST['confirmpass'];
	$query = "select * from user where username='$username'";
	$check = mysqli_query($connect,$query);
	$result = mysqli_fetch_assoc($check);

	if($result >= 1 ) {
		$_SESSION['message'] = "Username already taken.";
	} else if ($password != $confirm) {
		$_SESSION['message'] = "Password do not match.";
	} else if ($username == '') {
		$_SESSION['message'] = "Please enter Username.";
	} else if ($password == '') {
		$_SESSION['message'] = "Please enter Password.";
	} else if ($password == $confirm && $result == 0) {
		$password = sha1($password);
		$sql = "insert into user (username,password,gil,role)
				values('$username','$password',9999,'user')";
		mysqli_query($connect,$sql);
		$_SESSION['message'] = "Register Successful!";
	}
}

require_once('index/login_template.php');
?>

<script type="text/javascript">
	$("#signup").click(function(){
		$("#form").replaceWith("<form method='POST' action=''><h1>Welcome!</h1><h3>Sign-Up to enter The Fantasy!</h3><h5>Username:</h5><input type='username' name='reguser' class='inputsize'><h5>Password:</h5><input type='password' name='regpass' class='inputsize'><h5>Confirm Password:</h5><input type='password' name='confirmpass' class='inputsize'><br><input type='submit' name='register' value='Register' class='reg'><br><input type='submit' value='Cancel' name='cancel' class='reg'></form>");
	})
</script>