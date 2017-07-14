<?php

session_start();

require_once('../../connection.php');

function get_css() {
	echo "myitems.css";
}

function get_title() {
	echo "My Items";
}

function display_content() {
	echo "
<content>
	<div class='container-fluid itemsown'>
		<div class='row'>
			<div class='container-fluid message'>
				<div class='container'>
					<h6>Hello Adventurer!<br>here you can view the items you purchased</h6>
					<h5 id='gil'></h5>
				</div>
			</div>";

$sql = "select items.id,items.name,items.description,items.image,user_items.quantity from items join user_items on (items.id = user_items.items_id) join user on (user.id = user_items.user_id) where user_id='".$_SESSION['userid']."'";
$query = mysqli_query($GLOBALS['connect'],$sql);

if(mysqli_num_rows($query)>0) {
	while($final = mysqli_fetch_assoc($query)) {
		$id = $final['id'];
		$itemname = $final['name'];
		$itemdes = $final['description'];
		$itemimg = $final['image'];
		$quantity = $final['quantity'];

echo 		"<div class='col-xs-6 items'>
				<div class='container'>
					<button type='button' class='btn btn-success btn-sm col-xs-8 col-xs-offset-2' data-toggle='modal' data-target='#sellmodal$id'>Sell</button>
					<br>
					<br>
					<h6>$itemname x$quantity</h6>
					<figure>
						<img src='$itemimg' alt=''>
					</figure>
					<div class='container description'>
						<h6>$itemdes</h6>
					</div>
				</div>
			</div>
			<div class='modal fade' id='sellmodal$id' role='dialog'>
				<div class='modal-dialog modal-sm'>
					<div class='modal-content'>
						<div class='modal-header'>
							<h5 class='modal-title'>SELL</h5>
						</div>
						<div class='modal-body'>
							<h6>You have x$quantity</h6>
							<h6>Do you wanna sell this item?</h6>
							<input type='number' id='counter$id' min=0 max=99>/99
							<button type='button' class='btn btn-sm btn-success' id='$id' onclick='sell(this.id);'>Sell</button>
							<button type='button' class='btn btn-sm btn-info' id='$id' onclick='max(this.id);'>Max</button>
							<h6>Note: Selling more than what you own will sell all of the item</h6>
						</div>
						<div class='modal-footer'>
							<button type='button' class='btn btn-danger' data-dismiss='modal'>Cancel</button>
						</div>
					</div>
				</div>
			</div>";
	}
}

echo"	</div>
	</div>
</content>";
}

if(!isset($_SESSION['user'])) {
	header('location:../../first.php');
}

require_once('../main_template.php');


?>

<script type="text/javascript">

	function sell(id) {
		var counter = $('#counter'+id).val();
		$.post("sell.php",
		{
			id: id,
			counter: counter
		},
		function(data, status){
			window.location.replace("myitems.php");
		});
	};

	function max(id) {
		$.post("maxsell.php",
		{
			id: id
		},
		function(data, status){
			$('#counter'+id).val(data);
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