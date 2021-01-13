<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Food Market - Restaurant</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link href="style.css" rel="stylesheet">
</head>
<body>

<!-- Navigation bar -->
<nav class="navbar navbar-expand-md navbar-dark sticky-top">
<div class="container-fluid">
	<a class="navbar-brand" href="#"><h2>Food Market</h2></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" href="ResMainPage.php">Main</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="#">Orders</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Log Out</a>
			</li>
		</ul>
	</div>
</div>
</nav>

<!-- Jumbotron - for total orders -->
<div class="container-fluid">
	<div class="row jumbotron">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
			<h2 class="RestaurantName">Subaidah</h2>
			<p class="RestaurantDescription">
			Total number of orders: 5
			</p>
		</div>
	</div>
</div>
<hr>
<!-- Orders Lists in Cards -->
<div class="container-fluid padding">
	<h2 class="orderlistheader">Orders Placed</h2>
	<div class="card shadow">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
			<h3 class="OrderHeader">Tandoori</h3>
			<p class="cardContent">
				<a><b>Client:</b> Ms. Vicky Yew</a><br>
				<a><b>Contact No.:</b> 011-1234567</a><br>
				<a><b>Amount:</b> 1</a> <br>
				<a><b>Time:</b> 23 Dec 2020 06:00pm</a>
			</p>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-2 text-center">
			<p class="OrderTotal">Total: RM 7.00</p>
			<a href="#"><button type="button" class="btn btn-outline-secondary btn-lg margin">Accept
			</button></a>
			<a href="#"><button type="button" class="btn btn-outline-secondary btn-lg margin">Decline
			</button></a>
		</div>
	</div>
	</div>
	<br>
	<div class="card shadow">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
			<h3 class="OrderHeader">Nasi Kandar</h3>
			<p class="cardContent">
				<a><b>Client:</b> Mr. Pang Yi Shen</a><br>
				<a><b>Contact No.:</b> 012-9876543</a> <br>
				<a><b>Amount:</b> 1</a><br>
				<a><b>Time:</b> 23 Dec 2020 06:00pm</a>
			</p>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-2 text-center">
			<p class="OrderTotal">Total: RM 6.00</p>
			<a href="#"><button type="button" class="btn btn-outline-secondary btn-lg margin">Accept
			</button></a>
			<a href="#"><button type="button" class="btn btn-outline-secondary btn-lg margin">Decline
			</button></a>
		</div>
	</div>
	</div>

</div>
<hr>
<div class="container-fluid padding">
	<h2 class="orderlistheader">Orders Accepted</h2>
	<div class="card shadow">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
			<h3 class="OrderHeader">Tandoori</h3>
			<p class="cardContent">
				<a><b>Client:</b> Ms. Vicky Yew</a><br>
				<a><b>Contact No.:</b> 011-1234567</a><br>
				<a><b>Amount:</b> 1</a> <br>
				<a><b>Time:</b> 23 Dec 2020 06:00pm</a>
			</p>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-2 text-center">
			<p class="OrderTotal">Total: RM 7.00</p>
			<a href="#"><button type="button" class="btn btn-outline-secondary btn-lg margin">Picked Up
			</button></a>
		</div>
	</div>
	</div>
</div>

<footer>
<div class="container-fluid padding">
<div class="row text-center">
	<div class="col-md-4">
		<p>Contact Us: 555-555-5555</p>
	</div>
	
	<div class="col-md-4">
		<p>Our hours: Daily 10am - 5pm</p>
	</div>
	
	<div class="col-md-4">
		<p>Please Dont contact us</p>
	</div>
</div>
</div>
</footer>





</body>

</html>