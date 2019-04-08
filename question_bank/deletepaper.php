<?php
include("session.php");
include("db-config.php");
$previous_id=$_GET['pre_que_id'];
$sql="DELETE FROM previous_question_paper WHERE pre_que_id='$previous_id'";
$result=mysqli_query($conn, $sql);
if($result=="true") 
{
	echo "<script type=\"text/javascript\">
            confirm(\"Are You Sure!.\");
            window.location = \"home.php\"
           </script>"; 
}
else 
{
	echo "<script type=\"text/javascript\">
            alert(\"Select Question Paper for Deletion.\");
           	window.location = \"home.php\"
           </script>"; 
}
?>

