<?php
	include("db-config.php");

	session_start();

	$email_check = $_SESSION['email'];
	$role_check =$_SESSION['role'];

	$sql = mysqli_query($conn, "SELECT email FROM user WHERE email='$email_check'");
	$row = mysqli_fetch_assoc($sql);
	$sql1 = mysqli_query($conn, "SELECT role_id FROM user_role WHERE role_id='$role_check'");
	$row1 = mysqli_fetch_assoc($sql1);

	$login_session =$row['email'];
	$role_session =$row1['role_id'];

	if(!isset($_SESSION['role']))
	{	
	      header("location:index.php");
	}
?>