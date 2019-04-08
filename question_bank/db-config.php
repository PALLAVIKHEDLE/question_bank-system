<?php
	$conn = mysqli_connect("localhost", "root", "", "question_bank");
	if(!$conn) {
	echo "Connection failed".mysqli_connect_error();
	}
	else {
	//echo "Connection Established Successfully!";
	}
?>