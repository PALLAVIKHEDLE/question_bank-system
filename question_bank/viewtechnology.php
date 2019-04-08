<?php
include("session.php");
include("main.php");
include("db-config.php");
?>
<br><br>
<div class="col-sm-2"></div>
<div class="col-sm-5" style="padding:15px;">
<h4 class="text-center"> Technology </h4>
<?php
	$techID=$_GET['tech_id'];
	$sql7="SELECT * FROM technology WHERE tech_id='".$techID."'";
	$res7=mysqli_query($conn, $sql7);
	$row_tech=mysqli_fetch_assoc($res7);
?>
<table class="table table-bordered">
<tr class="warning">
<th>id</th>
<td><?php echo $row_tech['tech_id'];?></td>
</tr>
<tr class="info">
<th>Technology</th>
<td><?php echo $row_tech['tech_name'];?></td>
</tr>
</table>
<div class="text-center">
<button type="button" class="btn btn-warning"><a href="technology.php">Cancel</a></button>
</div>
</div><!--4 END-->
<?php
include("footer.php");
?>	
