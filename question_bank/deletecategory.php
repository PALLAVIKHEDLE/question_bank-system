<?php
include("session.php");
include("db-config.php");
$techID=$_GET['tech_id'];
$sql="DELETE FROM technology WHERE tech_id='$techID'";
$result=mysqli_query($conn, $sql);
if($result=="true") 
{
	 echo "<script type=\"text/javascript\">
            confirm(\"Are You Sure!.\");
            window.location = \"technology.php\"
           </script>"; 
}
else 
{
	 echo "<script type=\"text/javascript\">
            alert(\"Select Technology for Deletion.\");
           	window.location = \"technology.php\"
           </script>"; 
}
?>