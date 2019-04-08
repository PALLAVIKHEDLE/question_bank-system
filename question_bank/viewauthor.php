<?php
include("session.php");
include("main.php");
include("db-config.php");
?>
<br><br>
<div class="col-sm-2"></div>
<div class="col-sm-5" style="padding:15px;">
<h4 class="text-center" style="color:orange;"> Author </h4>
<?php
	$userID=$_GET['user_id'];
	$sql="SELECT user_id,name,email,mobile_no FROM user where user_id=".$userID."";
	$res1=mysqli_query($conn, $sql);
	$row=mysqli_fetch_assoc($res1);
	
	$techid="SELECT * FROM user_technology where user_id=".$userID."";
	$query = mysqli_query($conn,$techid);
    $techId = array();
   	while($rowTech = $query->fetch_assoc()){
        $techId[] = $rowTech['tech_id'];
    }
    $techIds = implode(',', $techId);
 	if($techIds != ""){
	$techname="SELECT * FROM technology where tech_id IN (".$techIds.")";
	$query1 = mysqli_query($conn,$techname);	 
	$techName = array();
	while($rowTechName = $query1->fetch_assoc()){
	$techName[] = $rowTechName['tech_name'];
	}
	$techNames = implode(',', $techName);
    }else{
        echo "<td></td>";
    }
	$roleid="SELECT * FROM user_role where user_id=".$userID."";
	$query2 = mysqli_query($conn,$roleid);
    $row3= $query2->fetch_assoc();
 		
    $rolename="SELECT * FROM role where role_id='".$row3['role_id']."'";
 	$query3 = mysqli_query($conn,$rolename);
    $row4 = $query3->fetch_assoc();
?>
<table class="table table-bordered">
	<tr class="warning">
	<th>id</th>
	<td><?php echo $row['user_id'];?></td>
	</tr>
	<tr class="info">
	<th>name</th>
	<td><?php echo $row['name'];?></td>
	</tr>
	<tr class="danger">
	<th>email</th>
	<td><?php echo $row['email'];?></td>
	</tr>
	<tr class="info">
	<th>mobile</th>
	<td><?php echo $row['mobile_no'];?></td>
	</tr>
	<tr class="danger">
	<th>Technology</th>
	<td><?php echo $techNames;?></td>
	</tr>
	<tr class="info">
	<th>Role</th>
	<td><?php echo $row4['role_name'];?></td>
	</tr>
</table>
<div class="text-center">
<button type="button" class="btn btn-warning"><a href="author-management.php">Cancel</a></button>
</div>
</div><!--4 END-->	
