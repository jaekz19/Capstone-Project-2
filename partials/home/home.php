<?php

session_start();

$_SESSION['message'] = "";
$_SESSION['itemsown'] = "";
require('../../connection.php');

function get_css() {
	echo "home.css";
}

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
						<br>
						<h5 id='gil'></h5>
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
								<input type='button' class='btn btn-success' name='$id' value='Buy' data-toggle='modal' data-target='#modal$id' onclick='quantitycheck(this.name);'>
								<input type='button' class='btn btn-info' name='$id' value='Max' data-toggle='modal' data-target='#max$id' onclick='quantitycheck(this.name);'>
								<div id='modal$id' role='dialog' class='modal fade'>
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
												<input type='number' name='counter' id='counter$id' min='0' max='99' class='counter'>/99
												<input type='button' id='$id' value='Buy' class='btn btn-success' onclick='buybtn(this.id); quantitycheck(this.id);'>
												<br>
												<br>
												<p class='itemsown$id'></p>
											</div>
											<div class='modal-footer'>
												<p class='col-xs-6 message$id'></p>
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
												<p class='itemsown$id'></p>
												<input type='button' class='btn btn-success' value='Buy All' id='$id' onclick='maxbtn(this.id); quantitycheck(this.id);'>
											</div>
											<div class='modal-footer'>
												<p class='col-xs-6 message$id'></p>
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

	function quantitycheck(id) {
		$.post("quantitycheck.php",
	    {
	        id: id
	    },
	    function(data, status){
	        $('.itemsown'+id).html('You own: '+ data +'/99');
	    });
	};

	function buybtn(id) {
		var counter = $('#counter'+id).val();
		$.post("buy.php",
		{
			id: id,
			counter: counter
		},
		function(data, status){
			$('.message'+id).html(data);
		});
	};

	function maxbtn(id) {
		$.post("max.php",
		{
			id: id
		},
		function(data, status){
			$('.message'+id).html(data);
		});
	};

	function update() {
		$.post("checkgil.php",
			function(data, status){
				$('#gil').html('Your Gil: '+data);
			});
	};

	self.setInterval(update, 1000);
	
</script>