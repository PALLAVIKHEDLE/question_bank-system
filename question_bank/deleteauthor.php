<?php
include("session.php");
include("db-config.php");

$userID=$_GET['user_id'];

$sql4="DELETE FROM user_technology WHERE user_id=".$userID."";
$result4=mysqli_query($conn, $sql4);

$sql5="DELETE FROM user_role WHERE user_id=".$userID." and role_id !='9'"; 
$result5=mysqli_query($conn, $sql5);

$sql3="DELETE FROM user WHERE user_id=".$userID.""; 
$result3=mysqli_query($conn, $sql3); 

if($result3=="true" && $result4=="true" && $result5=="true" )
{
	echo "<script type=\"text/javascript\">
        confirm(\"Are You Sure!.\");
        window.location = \"author-management.php\"
        </script>";
}
else 
{
	echo "<script type=\"text/javascript\">
        alert(\"Select Author for Deletion!.\");
        window.location = \"author-management.php\"
        </script>";

}
?>