<?php

session_start();

$_SESSION['message'] = "";

require('../../connection.php');

function get_title() {
	echo "Admin Page";
}

function display_banner() {
	echo "
<header>
	<div class='container-fluid banner'>
		<div class='row'>
			<div class='col-xs-2'>
				<figure>
					<img src='../../images/logo.png' alt=''>
				</figure>
			</div>
			<div class='col-xs-8'>
				<h1>Hello Admin!<br>Here you can see registered accounts<br>and there current inventory.</h1>
			</div>
		</div>
	</div>
	<nav class='navbar navbar-inverse'>
		<div class='container-fluid'>
			<div class='navbar-header'>
				<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#mynav'>
					<span class='icon-bar'></span>
					<span class='icon-bar'></span>
					<span class='icon-bar'></span>
				</button>
				<a class='navbar-brand'>Chocobo Hut</a>
			</div>
			<div class='collapse navbar-collapse' id='mynav'>
				<ul class='nav navbar-nav navbar-right'>
					<li><a><span class='glyphicon glyphicon-user'></span>".ucfirst($_SESSION['user'])."</a></li>
					<li><a href='../logout.php'><span class='glyphicon glyphicon-log-out'></span>Log Out</a></li>
				</ul>
			</div>
		</div>
	</nav>
</header>
";
}

function display_content() {
	echo "
<content>
	<div class='container-fluid users'>
		<div class='row'>";

	$sql = "select distinct user.id, items.name, items.image, user.username, user_items.quantity from user_items join items on (items.id = user_items.items_id) join user on (user.id = user_items.user_id) group by username";
	$query = mysqli_query($GLOBALS['connect'],$sql);

	foreach ($query as $key) {
		echo "
			<div class='col-xs-12'>
				<div class='user-content row'>
					<h1>User:".ucfirst($key['username'])."
						<span><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#modal".$key['id']."'>Delete</button></span>
					</h1>
					<div id='modal".$key['id']."' class='modal fade' role='dialog'>
						<div class='modal-content'>
							<div class='modal-header'>
								<h1 class='modal-title'>Are you sure you want to delete this account?</h1>
							</div>
							<div class='modal-footer'>
								<form method='POST' action='admin.php?id=".$key['id']."' class='col-xs-6'>
									<input type='submit' name='delete' class='btn btn-danger' value='Delete?'>
								</form> 
								<button type='button' class='btn btn-warning col-xs-6' data-dismiss='modal'>Cancel</button>
							</div>
						</div>
					</div>
					<div class='item-content'>";

		$check = "select distinct items.name, items.image, user.username, user_items.quantity from user_items join items on (items.id = user_items.items_id) join user on (user.id = user_items.user_id) where username='".$key['username']."'";
		$checkresult = mysqli_query($GLOBALS['connect'],$check);

		foreach ($checkresult as $value) {
			echo "		<div class='col-xs-6'>
							<h6>".$value['name']."</h6>
							<figure>
								<img src='".$value['image']."' alt=''>
								<figcaption>x".$value['quantity']."</figcaption>
							</figure>
						</div>";
		}
		echo "
					</div>
				</div>
			</div>";
	}
	echo "
		</div>
	</div>
</content>";
}

if(!isset($_SESSION['user'])) {
	header('location:../../first.php');
}

if(isset($_POST['delete'])) {
	$id = $_GET['id'];
	$sql1 = "delete from user where id='$id'";
	$sql2 = "delete from user_items where user_id='$id'";
	$execute1 = mysqli_query($connect,$sql1);
	$execute2 = mysqli_query($connect,$sql2);
	header('location:admin.php');
}

require_once('admin_template.php');
?>