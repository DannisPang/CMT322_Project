<?php
    include_once "dbh.inc.php";
?>

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
<!--Navigation Bar-->
<nav class="navbar navbar-expand-md navbar-dark sticky-top">
<div class="container-fluid">
	<a class="navbar-brand" href="#"><h2>Food Market</h2></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item active">
				<a class="nav-link" href="#">Main</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="ResOrderPage.php">Orders</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Log Out</a>
			</li>
		</ul>
	</div>
</div>
</nav>

<!-- Jumbotron -->
<div class="container-fluid">
	<div class="row jumbotron">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
			<h2 class="RestaurantName">Subaidah</h2>
			<p class="RestaurantDescription">
			A restaurant located in USM that serves delicious malaysia mamak food.
			</p>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-2 padding">

		<?php
			if(isset($_POST['editDesc'])){
				echo "Edit Desc is selected";
			}
			if(isset($_POST['addProd'])){
				echo "Add prod is selected";
			}
		?>

		<form method="post">
			<input class="btn btn-outline-secondary margin" type="submit" name="editDesc" value="Edit Description"/>
			<input class="btn btn-outline-secondary margin" type="submit" name="addProd" value="Add Product"/>
		</form>

		<!--
			<a href="#" class="btn btn-outline-secondary margin">
			Edit Description
            </a>
            <a href="#" class="btn btn-outline-secondary margin">Add new product</a>
		-->
		
		
		</div>
	</div>
</div>


<div class="container-fluid padding">
<div class="row padding">
<?php

    
    if ($conn-> connect_error){
        die("Connection failed:". $conn-> connect_error);
    }
        $resid = 'R001';
        $sql = "SELECT * from product";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
            while ($row = mysqli_fetch_assoc($result)){
                echo "<div class='col-md-4'><div class='card'><img class='card-img-top' src='img/roticanai.png'><div class='card-body'>";
                echo "<h4 class='card-title'>" . $row['ProductName'] . "</h4><p class='card-text'>RM".$row['ProductPrice'] . "</p>";
                echo "<a href='#' class='btn btn-outline-secondary margin'>Update</a><a href='#' class='btn btn-outline-secondary margin'>Delete</a></div></div></div>";
            }
        }
        else{
            echo "<p>" . $sql . "</p>";
        }

        $conn-> close();
    
?>

</div>
</div>


<!-- Cards - Menus -->
<!--
<div class="container-fluid padding">
<div class="row padding">
	<div class="col-md-4">
		<div class="card">
			<img class="card-img-top" src="img/roticanai.png">
			<div class="card-body">
				<h4 class="card-title">Roti Canai</h4>
				<p class="card-text">RM 1.00</p>
				<a href="#" class="btn btn-outline-secondary">Update</a>
				<a href="#" class="btn btn-outline-secondary">Delete</a>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<img class="card-img-top" src="img/nasikandar.png">
			<div class="card-body">
				<h4 class="card-title">Nasi Kandar</h4>
				<p class="card-text">RM 6.00</p>
				<a href="#" class="btn btn-outline-secondary">Update</a>
				<a href="#" class="btn btn-outline-secondary">Delete</a>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<img class="card-img-top" src="img/tandoori.png">
			<div class="card-body">
				<h4 class="card-title">Tandoori Chicken</h4>
				<p class="card-text">RM 7.00</p>
				<a href="#" class="btn btn-outline-secondary">Update</a>
				<a href="#" class="btn btn-outline-secondary">Delete</a>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<img class="card-img-top" src="img/roticanai.png">
			<div class="card-body">
				<h4 class="card-title">Roti Canai</h4>
				<p class="card-text">RM 1.00</p>
				<a href="#" class="btn btn-outline-secondary">Update</a>
				<a href="#" class="btn btn-outline-secondary">Delete</a>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<img class="card-img-top" src="img/nasikandar.png">
			<div class="card-body">
				<h4 class="card-title">Nasi Kandar</h4>
				<p class="card-text">RM 6.00</p>
				<a href="#" class="btn btn-outline-secondary">Update</a>
				<a href="#" class="btn btn-outline-secondary">Delete</a>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<img class="card-img-top" src="img/tandoori.png">
			<div class="card-body">
				<h4 class="card-title">Tandoori Chicken</h4>
				<p class="card-text">RM 7.00</p>
				<a href="#" class="btn btn-outline-secondary">Update</a>
				<a href="#" class="btn btn-outline-secondary">Delete</a>
			</div>
		</div>
	</div>
</div>
</div>
-->

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