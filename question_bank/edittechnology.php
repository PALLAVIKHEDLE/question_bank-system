<?php
include("session.php");
ob_start();
include("main.php");
include("db-config.php");	
if (isset($_POST['technology'])) {
$techID = $_POST['id'];
$technology=$_POST['technology'];

$updatetech="UPDATE technology SET  tech_name='$technology' where tech_id='".$techID."'";
$res1 = mysqli_query($conn, $updatetech) ;
if($res1 == true) {
	header("Location:viewtechnology.php?tech_id=".$techID);
} else {
	echo "Error: " . $updatetech . "<br>" . $conn->error;
}
}
?>	
<br><br>
<div class="col-sm-2"></div>
<div class="col-sm-5" style="padding:15px;background: lightgrey;">
<form action="edittechnology.php" method="POST" id="editform">
<?php
	$techID=$_GET['tech_id'];
	$sql="SELECT * FROM technology WHERE tech_id='$techID'";
	$res=mysqli_query($conn, $sql);
	$row=mysqli_fetch_assoc($res);
?>
<input type="hidden" name="id" class="form-control" value="<?php echo $techID; ?>">
<div class="form-group">
<label>Technology Name</label>
<input type="text" name="technology" id="technology" class="form-control" value="<?php echo $row['tech_name']; ?>">
<span id="techErr"></span>
</div>
<div class="form-group text-center">
<button type="submit" class="btn btn-primary" id="techupdate" >Update</button>
</div>
</form>
</div><!-- 6 close-->
<script>
$(document).ready(function(){
$("#techupdate").click(function(e){
   	e.preventDefault();
    var tech = $("#technology").val();
    if(tech == "") {
      $("#technology").css('border-color', 'red');
      $("#techErr").text("Please Enter Technology").css('color','red');
    }else {
      $("#editform").submit();
    }
    });
});
</script> 
<?php
	include("footer.php");
?>	