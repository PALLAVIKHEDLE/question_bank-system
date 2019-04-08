<?php
include("session.php");
include("db-config.php");
if (isset($_POST['password'])) {
	$password =  md5($_POST['password']);
	$select=mysqli_query($conn,"SELECT user_id FROM user ORDER BY user_id DESC LIMIT 0 , 1" );
	$row=mysqli_fetch_assoc($select);
	$USERID=$row['user_id'];
	$update = "UPDATE user SET status ='1', password='$password' WHERE user_id='$USERID'";
	$result1 = mysqli_query($conn, $update);
	if($result1 ==true ){
	   	header("location:index.php");
	}
	else{
	   	echo "Error: " . $update . "<br>" . $conn->error;
	}	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>main page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<nav class="navbar navbar-default" id="navbar">
	<div class="container-fluid">
	<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>                        
    </button>
	<a class="navbar-brand" id="navhead" href="#">Question Bank</a>
	</div>
	<div class="collapse navbar-collapse" id="myNavbar">
	<ul class="nav navbar-nav navbar-right">
	<button type="submit" class="btn btn-warning btn-sm" id="button"><a href="index.php">Logout</a></button>
	</ul>
	</div>
	</div>
</nav>
<div class="container">
	<div class="row"><br>
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
	<form action="setpassword.php" method="POST">
		<div class="form-group">
		<label id="h4">Password</label>
		<input type="password" name="password" id="password" class="form-control">
		</div>
		<div class="form-group text-center">
		<button type="submit" class="btn btn-info">Submit</button>
		</div>
	</form>
	</div><!--4 end-->
	<div class="col-sm-4"></div>
	</div><!--row end-->
</div><!--container end-->
</body>
</html>
