<?php

require('../../connection.php');

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
				<h1><u><strong>Chocobo Hut</u></strong><br><br>Shop for the adventurers!</h1>
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
				<ul class='nav navbar-nav'>
					<li><a href='#'>Buy Items</a></li>
					<li><a href='#'>About</a></li>
				</ul>
				<ul class='nav navbar-nav navbar-right'>
					<li class='gil'><a>Gil:</a></li>
					<li class='dropdown'>
						<a class='dropdown-toggle' data-toggle='dropdown' href='#'>
							<span class='glyphicon glyphicon-user'></span>".ucfirst($_SESSION['user'])."<span class='caret'></span>
						</a>
						<ul class='dropdown-menu'>
							<li><a href='#'>My Items</a></li>
						</ul>
					</li>
					<li><a href='../logout.php' class='logout'><span class='glyphicon glyphicon-log-out'></span>Log Out</a></li>
				</ul>
			</div>
		</div>
	</nav>
</header>


";

?>