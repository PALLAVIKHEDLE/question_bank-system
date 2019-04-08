<?php
ob_start();
include("main.php");
include("db-config.php");	
if (isset($_POST['submit'])) {
	$userID = $_POST['id'];
	$roleID = $_POST['role'];
	$techID = $_POST['technology'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
			
	
	$sql4="DELETE FROM user_technology WHERE user_id=".$userID."";
  	$result4=mysqli_query($conn, $sql4);
  	foreach($techID as $techNames){
		$sql = "INSERT INTO user_technology(user_id,tech_id)values('".$userID."',".$techNames.")";
		$tech=mysqli_query($conn,$sql); 
	}
	$sql2="UPDATE user_role SET role_id=".$roleID." where user_id=".$userID."";
	$result2=mysqli_query($conn, $sql2);
	$sql="UPDATE user SET name='$name', email='$email', mobile_no=".$mobile." where user_id=".$userID."";
	$result=mysqli_query($conn, $sql);
	if($result==true && $result2==true && $tech==true)
	{
		header("Location:viewauthor.php?user_id=".$userID);
	} else {
		header("Location:author-management.php");
	}

}
$userIDs=$_GET['user_id'];
?>	
	<div class="col-sm-2"></div>
		<div class="col-sm-5 jumbotron " style="padding:15px;background: lightgrey;">
			<form action="editauthor.php?user_id=<?php echo $userIDs;?>" method="POST" id="updateform">
				<?php
                  	$sql1="SELECT name,email,mobile_no FROM user where user_id='$userIDs'";
					$user1=mysqli_query($conn, $sql1);
					$id=mysqli_fetch_assoc($user1);
					
          			$techid="SELECT * FROM user_technology where user_id='$userIDs'";
			      	$query = mysqli_query($conn,$techid);
 		       		$techId = array();
              		while($rowTech = $query->fetch_assoc()){
                  		$techId[] = $rowTech['tech_id'];
                	}  
              	    $roleIds="SELECT * FROM user_role where user_id='$userIDs'";
			    	$query2 = mysqli_query($conn,$roleIds);
                  	$row2= $query2->fetch_assoc();
 					
                   	$rolename="SELECT * FROM role where role_id='".$row2['role_id']."'";
       			  	$query3 = mysqli_query($conn,$rolename);
                  	$row3 = $query3->fetch_assoc();
               
				?>
				<input type="hidden" name="id" class="form-control" value="<?php echo $userIDs; ?>">
				<div class="form-group">
					<label>Name</label>
					<input type="text" id="name" name="name" class="form-control" maxlength="15" 
					value="<?php echo $id['name']; ?>" required>
					<span id="nameErr"></span> 
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" id="email" name="email" class="form-control" 
					value="<?php echo $id['email']; ?>" required>
					<span id="emailErr"></span>
				</div>
			   	<div class="form-group">
					<label>mobile</label>
					<input type="text" id="mobile" name="mobile" class="form-control" maxlength="10"
					value="<?php echo $id['mobile_no']; ?>" required>
					 <span id="mobileErr"></span> 
				</div>
				<div class="form-group">
				<label>Technology</label>
				<?php
					$checked = "";
					$sql="SELECT * FROM technology";
					$res=mysqli_query($conn,$sql);
					while($row=mysqli_fetch_assoc($res)){
					if(in_array($row['tech_id'], $techId,TRUE)){
						$checked = "checked";
					}
					?>	
					<input type="checkbox" name="technology[]" value ="<?php echo $row['tech_id'] ?>" class="tech" <?php echo $checked; ?>>
					<label><?php echo $row['tech_name']; ?></label>
					<?php
						$checked = "";
					}
					?>		
					<br> <span id="techErr"></span>
				</div>
				<div class="form-group">
				<label>Role</label>
				<select name="role" class="form-control" id="role" required>
				<option value="">Select Role</option>
					<?php
						$selected = "";
						$sql="SELECT * FROM role";
						$res=mysqli_query($conn,$sql);
						while($role=mysqli_fetch_assoc($res))
						{
							if($role['role_id'] == $row2['role_id']){
							$selected = "selected";
						}
						?>	
						<option value="<?php echo ($role['role_id'])?>" <?php echo $selected ?>>
						<?php echo($role['role_name']) ?>
						</option>
						<?php
							 $selected = "";
						 }
					?>
				</select>
				<span id="roleErr"></span>
				</div>
				<div class="form-group text-center">
					<button type="submit" name="submit" class="btn btn-primary" id="update">Update</button>
				</div>
				
			</form>
		
		</div><!-- 6 close-->
<?php
	include("footer.php");	
?>	


