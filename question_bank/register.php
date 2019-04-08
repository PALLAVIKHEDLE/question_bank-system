<?php
include("session.php");
include("db-config.php");
if (isset($_POST['email'])) 
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$myemail = md5($_POST['email']);

	$insert = "INSERT INTO user(name, email, mobile_no,hash_key)values('$name','$email',".$mobile.",'$myemail')";
	$result=mysqli_query($conn,$insert);

	$select=mysqli_query($conn,"SELECT user_id FROM user ORDER BY user_id DESC LIMIT 0 , 1" );
	$row=mysqli_fetch_assoc($select);
	$tech_name = $_POST['technology'];
	foreach($tech_name as $technology){
	$sql = "INSERT INTO user_technology(user_id,tech_id)values('".$row['user_id']."',".$technology.")";
	$tech=mysqli_query($conn,$sql); 
	}
	$roleName = $_POST['role'];
	$add = "INSERT INTO user_role(user_id,role_id)values('".$row['user_id']."',".$roleName.")";
	$roles=mysqli_query($conn,$add); 
	if($result==true && $tech==true && $roles==true)
	{
		echo "Welcome!You are register Successfully";
		$to = $email;
    	$from = "keerthi.ij@fortunesoftit.com";
    	$subject = "for setting password";
    	$message =  '<a href="http://question-bank.dev-fsit.com/setpassword.php?hash='.$myemail.'">Click here</a> to set your password.';
    	$headers = "From:" . $from;
 	if(mail($to,$subject,$message,$headers)){
        echo "Email send.";
    } else {
        echo "Failed to send.";
    	 }
	}else{
		echo "Error: " . $insert . "<br>" . $conn->error;
	}
}
?>
