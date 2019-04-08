<?php
session_start();
if($_SESSION['role'] != '9')
{
  header("location:logout.php");
}
include("db-config.php");
if (isset($_POST['email'])) {
$email = $_POST['email']; 
$select = mysqli_query($conn,"SELECT user_id,hash_key FROM user where email='$email'" ) ;
$row=mysqli_fetch_assoc($select); 
$USERID=$row['user_id'];
$HASH=$row['hash_key'];

$to = $email;
$from = "admin@gmail.com";
$subject = "for Reset password";
$message =  '<a href="http://question-bank.dev-fsit.com/setpassword.php?hash='.$HASH.'">Click here</a> to set your password.';
$headers = "From:" . $from;
if(mail($to,$subject,$message,$headers))  {
    header("location:index.php");
} 
else 
{
  	echo "Failed to send.";
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>confirm-password</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
</head>
<body id="body2">
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="row">
<div class="col-sm-4"></div>
<div class="col-sm-4">
<form action="confirm-password.php" method="POST">
<div class="form-group">
	<label id="h4">Email</label>
	<input type="email" name="email" id="email" class="form-control" required="">
</div>
<div class="form-group text-center">
	<button type="submit" name="submit" class="btn btn-info">Submit</button>
	<button type="button" class="btn btn-success"><a href="index.php">Cancel</a></button>
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