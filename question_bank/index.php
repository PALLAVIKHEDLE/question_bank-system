<?php
ob_start();
include("db-config.php");
session_start();
$message="";
if(isset($_POST['email']))
{
	$email = $_POST['email'];
	$password = md5($_POST['password']);	

	$sql = "SELECT user_id, email, password FROM user WHERE email = '".$email."' AND password = '".$password."'";
	$res = mysqli_query($conn, $sql);
	$row1=$res->fetch_assoc();
	$USERID=$row1['user_id'];

	$query = "SELECT * FROM user_role WHERE user_id = '".$USERID."'";
	$result = mysqli_query($conn, $query);
	$row2=$result->fetch_assoc();
	$USERID=$row2['role_id'];
		
	$_SESSION['id']=$row1['user_id'];
	$_SESSION['role']=$row2['role_id'];
	$_SESSION['email']=$row1['email'];
	$count=mysqli_num_rows($res);
	$cnt=mysqli_num_rows($result);
	if($count==1 && $cnt==1)
	{	
		if($row2['role_id']=='9')
		{
			header("location:home.php"); 
		}
		else if ($row2['role_id']=='8')
		{
			$_SESSION['role']=$row1['role_id'];
			header("location:home.php"); 
		}
	}
	else{
		$message="Please Enter Valid Email and Password";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body id="body">
<div class="container">
	<div class="row">
	<div class="col-sm-12">
	<div class="row">
	<div class="col-sm-4"></div>
	<div class="col-sm-4 well" id="div1">
	<form action="index.php" method="POST" id="myform">
		<h2>Login</h2>
		<div class="text-center">
			<span style="color: red;"><?php echo $message; ?></span>
		</div>
		<hr class="hr">
		<div class="form-group">
			<label>Email</label>
			<input type="text" name="email" class="form-control" id="email">
			<span id="emailErr"></span>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" name="password" class="form-control" id="password" maxlength="8">
			<span id="passwordErr"></span>
		</div>
		<div class="form-group">
			<button type="submit" id="submit"  name="submit" class="btn btn-info" style="margin-top: 4px;">Login</button>
		</div>
		<hr class="hr">
		<div class="text-center">
			<a href="confirm-password.php">Forgot your password?</a>
		</div>
	</form>
	</div>
	<div class="col-sm-4"></div>
	</div>
	</div>
	</div>
</div>
</body>
</html>
