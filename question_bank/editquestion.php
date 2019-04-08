<?php
include("session.php");
ob_start();
	include("main.php");
	include("db-config.php");	
	if (isset($_POST['submit'])) {
		//print_r($_POST);
	$queID = $_POST['id'];
	$question = $_POST['que'];
	$tech = $_POST['tech'];
	$answer=$_POST['ans'];
	$level=$_POST['level'];
	$options=array();	
	 $options=$_POST['option1'];
	
	  $sql="UPDATE question SET tech_id='".$tech['tech_id']."', level_id='".$level['level_id']."', 
	  question='".$question."',answer='".$answer."' where que_id=".$queID."";
	  $result=mysqli_query($conn, $sql);
	  $update_option_id="SELECT option_id from options where que_id=".$queID."";
	   $res=mysqli_query($conn, $update_option_id);
	   while($rowoptionid = $res->fetch_assoc()){
	               $optionId[] = $rowoptionid['option_id'];
	               //echo $rowoptionid['option_id'];
	          }
	       foreach( $options as $index => $opt ) {
        //echo ''.$opt .'/'.$optionId[$index].'..';
            $update_option="UPDATE options SET obj_option='".$opt."' WHERE  option_id=".$optionId[$index].""; 
            $result2=mysqli_query($conn, $update_option);
	          
		}
  	 
	 if($result==true && $result2 == true){
	//echo "welcome";
	 header("Location:viewquestion.php?que_id=".$queID);
	
	} else {
//		echo "HI";
	header("Location:show-question.php");
	}

}

$queIDs=$_GET['que_id'];
?>	
		<div class="col-sm-2"></div>
		<div class="col-sm-5 jumbotron " style="padding:15px;background: lightgrey;">
			<form action="editquestion.php?que_id=<?php echo $queIDs;?>" method="POST">
				<?php
						$sql1="SELECT * FROM question where que_id='".$queIDs."'";
						$user1=mysqli_query($conn, $sql1);
						$id=mysqli_fetch_assoc($user1);
					
          			    $techid="SELECT * FROM technology where tech_id='".$id['tech_id']."'";
			      		$query = mysqli_query($conn,$techid);
						$tech=mysqli_fetch_assoc($query);
 		       		    $technology= $tech['tech_id'];
              	  	    $levelid="SELECT * FROM difficulty_level where level_id='".$id['level_id']."'";
			    	    $query2 = mysqli_query($conn,$levelid);
					    $level=mysqli_fetch_assoc($query2);
                  	    
       			 	    $optionname="SELECT * FROM options where que_id='".$queIDs."'";
       			        $query3 = mysqli_query($conn,$optionname);
			
                        $optionName = array();
	                    while($rowoptionName = $query3->fetch_assoc()){
	                    $optionName[] = $rowoptionName['obj_option'];
	              
	                 }
				?>
				    <input type="hidden" name="id" class="form-control" value="<?php echo $queIDs; ?>">
					<div class="form-group">
					<label>Technology</label>
					<input type="text" id="tech" name="tech" class="form-control"
					value="<?php echo $tech['tech_id']; ?>">
					<?php echo $tech['tech_name']; ?>
				    </div>
				 
			   	    <div class="form-group">
					<label>Question</label>
					<input type="text" id="que" name="que" class="form-control"
					value="<?php echo $id['question']; ?>"> 
				    </div>
					<div class="form-group">
					<label>Answer</label>
					<input type="text" id="ans" name="ans" class="form-control"
					value="<?php echo $id['answer']; ?>"> 
				    </div>
			
					<div class="form-group">
						<label>Difficulty_level</label>
						<select name="level" class="form-control" id="level">
						<option value="">Select level</option>
						<?php
						  $selected = "";
						  $sql4="SELECT * FROM difficulty_level";
						  $res4=mysqli_query($conn,$sql4);
						  while($difficulty=mysqli_fetch_assoc($res4))
						  {
							if($difficulty['level_id'] == $level['level_id']){
							$selected = "selected";
							}
							 ?>	
						
						<option value="<?php echo ($difficulty['level_id'])?>" <?php echo $selected ?>>
						<?php echo($difficulty['level_name']) ?>
						</option>
						<?php
					    $selected = "";
						  }
						?>
						</select>
							
					</div>
					<div class="form-group">
					<label>option1</label>
					<input type="text" id="option1" name="option1[]" class="form-control" 
					value= "<?php echo $optionName[0];?>" >

				   </div>
				   <div class="form-group">
				   <label>option2</label>
				   <input type="text" id="option1" name="option1[]" class="form-control" 
					value= "<?php echo $optionName[1];?>" >

				   </div>
				   <div class="form-group">
					<label>option3</label>
					<input type="text" id="option1" name="option1[]" class="form-control" 
					value= "<?php echo $optionName[2];?>" >

				   </div>
				   <div class="form-group">
				   <label>option4</label>
				   <input type="text" id="option1" name="option1[]" class="form-control" 
					value= "<?php echo $optionName[3];?>" >

				   </div>
				  
				<div class="form-group text-center">
					<button type="submit" name="submit" class="btn btn-primary">Update</button>
				</div>
				
			</form>
		
		</div><!-- 6 close-->
		
<?php
	include("footer.php");
	
?>	
  