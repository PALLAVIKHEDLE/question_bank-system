<?php
include("main.php");
include("db-config.php");

?>
<div class="col-sm-1"></div>
<div class="col-sm-6">
<button type="button" class="btn btn-warning btn-sm"  id="button" data-toggle="modal" data-target="#myModal">Register</button>
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-body" style="background: lightgrey;">
<form action="" method="POST" id="insertform">
	<h2>Register</h2>
	<hr id="hr1"> 			
	<div class="form-group">
	<label>Name</label>
	<input type="text" id="name" name="name" class="form-control"maxlength="15">
 	<span id="nameErr"></span> 
	</div>
	<div class="form-group">
	<label>Email</label>
	<input type="text" id="email" name="email" class="form-control">
	<span id="emailErr"></span>
	</div>
	<div class="form-group">
	<label>mobile</label>
	<input type="text" id="mobile" name="mobile" class="form-control" maxlength="10">
	<span id="mobileErr"></span>
	</div>
	<div class="form-group">
	<label>Technology</label>
	<?php
		$sql="SELECT * FROM technology";
		$res=mysqli_query($conn,$sql);
		while($row=mysqli_fetch_assoc($res)){
	?>	
	<input type="checkbox" name="technology[]" value="<?php echo $row['tech_id']; ?>" class="tech"> <label><?php echo $row['tech_name']; ?></label>
	<?php
	}
	?><br>
	<span id="techErr"></span>
	</div>
	<div class="form-group">
	<label>Role</label>
	<select name="role" class="form-control" id="role">
	<option value="">Select Role</option>
	<?php
	$sql="SELECT * FROM role";
	$res=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_assoc($res)){
	?>	
	<option value="<?php echo ($row['role_id'])?>" >
	<?php echo($row['role_name']) ?>
	</option>
	<?php
	}
	?>
	</select>
	<span id="roleErr"></span> 
	</div>
	<div class="modal-footer">
	<button type="submit" name="submit" class="btn btn-success" id="register">Register</button>
	<button type="reset" class="btn btn-warning" data-dismiss="modal">Clear</button>
	</div>
</div>
</div>
</div>
</div>

</form>
<h3 class="text-center" id="h4">Author Management</h3>
	<div class="table-responsive">
    <table class="table table-bordered">
	<thead>
		<tr class="info">
		<th>ID</th>
		<th>Name</th>
		<th>Email</th>
		<th>Mobile</th>
		<th>Technology</th>
		<th>Role</th>
		<th>Action</th>
		</tr>
   	</thead>
    <tbody>
    <?php  
    	 
  		$data="SELECT user_id,name,email,mobile_no FROM user  ";
		$user=mysqli_query($conn, $data);   
		
        while($rows = $user->fetch_assoc()) 
        {
          	echo"<tr class='warning'>";
            echo"<td>".$rows['user_id']."</td>";
            echo"<td>".$rows['name']."</td>";
            echo"<td>".$rows['email']."</td>";
            echo"<td>".$rows['mobile_no']."</td>";
            $userid=$rows['user_id'];
          	$techid="SELECT * FROM user_technology where user_id='$userid'";
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
	            echo"<td>".$techNames."</td>";
            }else{
                echo "<td></td>";
            }
			$roleid="SELECT * FROM user_role where user_id='$userid'";
			$query2 = mysqli_query($conn,$roleid);
            $row2= $query2->fetch_assoc();
 				
            $rolename="SELECT * FROM role where role_id='".$row2['role_id']."'";
       		$query3 = mysqli_query($conn,$rolename);
            $row3 = $query3->fetch_assoc();
            echo"<td>".$row3['role_name']."</td>";	
			echo"<td><a href='editauthor.php?user_id=".$rows['user_id']."'><span class='glyphicon glyphicon-edit'></span></a>&nbsp;&nbsp;&nbsp;&nbsp;";
			echo"<a href='deleteauthor.php?user_id=".$rows['user_id']."'><span class='glyphicon glyphicon-trash'></span></a></td>";
           	echo"</tr>";
        }
      
    ?>
</tbody>
</table>
</div>
<div class="text-center">

</div>
</div><!--7end-->
<?php
	include("footer.php");
?>
<script src="validate.js"></script>