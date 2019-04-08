<?php
include("session.php");
ob_start();
include("db-config.php");

$queID=$_GET['que_id'];
 
$sql4="DELETE FROM question WHERE que_id=".$queID."";
$result4=mysqli_query($conn, $sql4);

$sql5="DELETE FROM options WHERE que_id=".$queID.""; 
$result5=mysqli_query($conn, $sql5);

if($result5=="true" && $result4=="true")
{
	echo "<script type=\"text/javascript\">
        confirm(\"Are You Sure!.\");
        window.location = \"show-question.php\"
        </script>"; 
}
else 
{
	echo "<script type=\"text/javascript\">
        alert(\"Select Question for Deletion!.\");
        window.location = \"add-question.php\"
        </script>"; 
}
?>
