<?php
include("session.php");
include("main.php");
include("db-config.php");
?>
<br>
	<div class="col-sm-2"></div>
		<div class="col-sm-5" style="padding:15px;">
			<h4 class="text-center" style="color:orange;"> Question List </h4>
					<?php
						$queID=$_GET['que_id'];
						$sql="SELECT * FROM question where que_id='".$queID."'";
						$res1=mysqli_query($conn, $sql);
						$row=mysqli_fetch_assoc($res1);

						$techid="SELECT * FROM technology where tech_id='".$row['tech_id']."'";
						$query = mysqli_query($conn,$techid);
						$tech=mysqli_fetch_assoc($query);
 		       		  
						$levelid="SELECT * FROM difficulty_level where level_id='".$row['level_id']."'";
						$query2 = mysqli_query($conn,$levelid);
						$level=mysqli_fetch_assoc($query2);
                  	
						$optionname="SELECT * FROM options where que_id='".$row['que_id']."'";
						$query3 = mysqli_query($conn,$optionname);
						$optionName = array();
	                  while($rowoptionName = $query3->fetch_assoc()){
	                  	$optionName[] = $rowoptionName['obj_option'];
	                  	//echo  $rowoptionName['obj_option'];
                    }
					?>
					<table class="table table-bordered">
					   <tr class="warning">
							<th>id</th>
							<td><?php echo $row['que_id'];?></td>
						</tr>

						<tr class="info">
							<th>question</th>
							<td><?php echo $row['question'];?></td>
						</tr>
						<tr class="info">
							<th>answer</th>
							<td><?php echo $row['answer'];?></td>
						</tr>
						<tr class="info">
							<th>Difficulty_level</th>
							<td><?php echo $level['level_name'];?></td>
						</tr>
						<tr class="info">
							<th>Technology</th>
							<td><?php echo $tech['tech_name'];?></td>
						</tr>
						<tr class="info">
							<th>option</th>
							<td><?php echo $optionName[0];?></td>
						</tr>
						
						<tr class="info">
							<th>option</th>
							<td><?php echo $optionName[1];?></td>
						</tr>
						<tr class="info">
							<th>option</th>
							<td><?php echo $optionName[2];?></td>
						</tr>
						<tr class="info">
							<th>option</th>
							<td><?php echo $optionName[3];?></td>
						</tr>
					</table>
					<div class="text-center">
					<button type="button" class="btn btn-info"><a href="show-question.php">Cancel</a></button>
					</div>
		</div><!--4 END-->
		
