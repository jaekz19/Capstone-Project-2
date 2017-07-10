<?php

session_start();

$_SESSION['message'] = "";
$_SESSION['itemsown'] = "";

require('../../connection.php');

function get_title() {
	echo "Greetings!";
}

function display_content() {
	echo "
	<content>
		<div class='container-fluid items'>
			<div class='row'>
				<div class='container-fluid message'>
					<div class='container'>
						<h1>Greetings Adventurers!</h1>
						<h3>Don't forget to buy what you need before your journey.</h3>
					</div>
				</div>";

	$showitemsquery = htmlspecialchars("select * from items");
	$showitemsresult = mysqli_query($GLOBALS['connect'],$showitemsquery);

	if(mysqli_num_rows($showitemsresult)>0) {
		while($rows = mysqli_fetch_assoc($showitemsresult)) {
			$id = $rows['id'];
			$name = $rows['name'];
			$price = $rows['price'];
			$des = $rows['description'];
			$img = $rows['image'];

			echo "
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					<div class='container-fluid'>
						<button class='accordion'>$name<span class='glyphicon glyphicon-plus'></span></button>
						<div class='accordion-content'>
							<figure class='col-xs-3'>
								<img src='$img'>
							</figure>
							<div class='col-xs-6'>
								<p>$des</p>				
								<p>$price Gil</p>
							</div>
							<div class='col-xs-3'>
								<input type='button' class='single' id='buy' value='Buy' data-toggle='modal' data-target='#modal$id' onclick='itemown('buy');'>
								<input type='submit' class='single' id='max' value='Max' data-toggle='modal' data-target='#max$id'>
								<div id='modal$id' role='dialog' class='modal fade'>
									<div class='modal-dialog modal-sm'>
										<div class='modal-content'>
											<div class='modal-header'>
												<h4 class='modal-header'>
													$name
													<span><img src='$img'></span>
												</h4>
												<p>".$_SESSION['message']."</p>
											</div>
											<div class='modal-body'>
												<p>$des</p>
												<p>$price Gil</p>
												<form method='POST' action='home.php?id=$id' id='buyform$id'>
													<input type='number' name='counter' min='0' max='99' class='counter'>/99
													<input type='submit' name='buy' value='Buy' class='btn btn-success'>
												</form>
												<br>
												<p>You own: ".$_SESSION['itemsown']."/99</p>
											</div>
											<div class='modal-footer'>
												<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
											</div>
										</div>
									</div>
								</div>
								<div id='max$id' role='dialog' class='modal fade'>
									<div class='modal-dialog modal-sm'>
										<div class='modal-content'>
											<div class='modal-header'>
												<h4 class='modal-header'>
													$name
													<span><img src='$img'></span>
												</h4>
											</div>
											<div class='modal-body'>
												<p>$des</p>
												<p>$price Gil</p>
												<p>Do you wanna max out the item?</p>
												<form method='POST' action='home.php?id=$id'>
													<input type='submit' class='btn btn-success' value='Buy All' name='max'>
												</form>
											</div>
											<div class='modal-footer'>
												<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>";
		}
	}

	echo "
				<div class='container-fluid'>

				</div>
			</div>
		</div>
	</content>";
}

if(!isset($_SESSION['user'])) {
	header('location:../../first.php');
}

if(isset($_POST['buy'])) {
	$userid = $_SESSION['userid'];
	$id = $_GET['id'];
	$input = $_POST['counter'];

	$itemcheck = "select * from user_items where user_id='$userid' and items_id='$id'";
	$initialresult = mysqli_query($connect,$itemcheck);
	$finalresult = mysqli_fetch_assoc($initialresult);

	$quantitycheck = "select quantity from user_items where user_id='$userid' and items_id='$id'";
	$quantitycheckquery = mysqli_query($connect,$quantitycheck);
	$quantitycheckresult = mysqli_fetch_assoc($quantitycheckquery);

	if($finalresult >= 1) {
		foreach ($quantitycheckresult as $key) {
			if($key += $input <= 99){
				$update = "update user_items set quantity=$key + $input where user_id='$userid' and items_id='$id'";
				mysqli_query($connect,$update);
			} else if ($key += $input >= 100) {
				$_SESSION['message'] = "Exceed carry limit!";
			}
		}
	} else if($finalresult == 0) {
		$insert = "insert into user_items(user_id,items_id,quantity)
					values('$userid','$id','$input')";
		mysqli_query($connect,$insert);
	}
}

// if(isset($_POST['max'])) {
// 	$userid = $_SESSION['userid'];
// 	$id = $_GET['id'];
// 	$sql = ""
// }

require_once('../main_template.php');
?>

<script type="text/javascript">
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
		acc[i].onclick = function(){
			var panel = this.nextElementSibling;
			if (panel.style.maxHeight) {
				panel.style.maxHeight = null;
			} else {
				panel.style.maxHeight = panel.scrollHeight + "px";
			}
		}
	}

	$('.accordion').click(function(){
		$(this).find('.glyphicon').toggleClass('glyphicon-plus');
		$(this).find('.glyphicon').toggleClass('glyphicon-minus');
	});

	$(document).ready(function() {
		$("#buy").click(function() {
			var quantity = $('#modal'+id).val();

			$.post("showitemsown.php?id="+id,
			{
				quantity: quantity
			},
			function(data, status) {
				alert(data);
			});
		});
	});

	// function itemown(id) {
	// 	var quantity = $('#modal'+id).val();
	// 	$.post("showitemsown.php?id="+id,
	// 	{
	// 		quantity: quantity
	// 	},
	// 	function(data) {
	// 		alert(data);
	// 	});
	// }
	
</script>