<?php

session_start();

require_once('../../connection.php');

function get_css() {
	echo "changepassword.css";
}
function get_title() {
	echo "My Account";
}

function display_content() {
	echo "
<content>
	<div class='container-fluid form'>
		<div class='row'>
			<div class='container'>
				<form method='POST'>
					<div class='form-group group-header'>
						<label>User:".$_SESSION['user']."</label>
					</div>
					<div class='form-group'>
						<label>Old Password:</label>
						<input type='password' class='form-control' id='oldpw'>
					</div>
					<div class='form-group'>
						<label>New Password:</label>
						<input type='password' class='form-control' id='newpw'>
					</div>
					<div class='form-group'>
						<label>Confirm Password:</label>
						<input type='password' class='form-control' id='confirmpw'>
					</div>
					<button type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#confirm'>Change Password</button>
				</form>
				<div class='modal fade' id='confirm' role='dialog'>
					<div class='modal-dialog modal-sm'>
						<div class='modal-content'>
							<div class='modal-header'>
								<h5 class='modal-title'>Change Password</h5>
							</div>
							<div class='modal-body'>
								<h6>Confirm changing password?</h6>
								<p id='message'></p>
							</div>
							<div class='modal-footer'>
								<button type='button' class='btn btn-success' onclick='changepw();'>Yes</button>
								<button type='button' class='btn btn-danger' data-dismiss='modal'>Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</content>";
}

if(!isset($_SESSION['user'])) {
	header('location:../../first.php');
}

require_once('../main_template.php');
?>

<script type="text/javascript">
	function changepw(id) {
		var oldpw = $('#oldpw').val();
		var newpw = $('#newpw').val();
		var confirmpw = $('#confirmpw').val();

		$.post("changepw.php",
		{
			oldpw: oldpw,
			newpw: newpw,
			confirmpw: confirmpw
		},
			function(data, status){
				$('#message').html(data);
				setTimeout("location.href = 'changepassword.php';", 1000);
			});
	};
</script>