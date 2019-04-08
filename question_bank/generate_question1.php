
<?php
include("main.php");
?>
	<div class="col-sm-9">
		<form action="" method="POST" id="generate">
		<h3 style="color:red;text-align: center;"><?php echo $msg; ?></h3>
		<h3 class="text-center text" id="h4">Generate Question Paper</h3>
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-3">
			<h4 class="" id="h4">Types of Question</h4>
				<div class="form-group ">
				<input type="radio" name="type" value="objective" id="Objective"> Objective Type
				<span id="typeErr"></span>
				</div>
				<div class="form-group ">
				<input type="radio" name="type" value="subjective" id="Subjective"> Subjective Type
				<span id="typeErr"></span>
				</div>
			</div>
			<div class="col-sm-8"></div>
		</div><!--row end-->
		<br>
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-3">
				<div class="form-group">
					<label id="h4">Total Number of Question</label> 
					<input type="text" name="no_of_qus" class="form-control" class="total" id="ques" value="">
					<span id="queErr"></span>
				</div>
			</div>
			<div class="col-sm-8"></div>
		</div><!-- row 2 end-->
<div id="container">
   <div class="row addNew">
    <div  class="col-sm-4">
        <select class="form-control" name="technology[]" id="technology">
		   	<option  value="">Select Technology</option>
				<?php
					include("db-config.php");
					$sql="SELECT * FROM technology";
					$res=mysqli_query($conn,$sql);
					while($row=mysqli_fetch_assoc($res)){
				?>	
				<option value="<?php echo ($row['tech_id'])?>" >
				<?php echo($row['tech_name']) ?>
				</option>
				<?php
				}
						
				?>
        	</select>
        	   <span id="techErr"></span>
   </div>
		<div class="col-sm-3">
			<select class="form-control" name="level[]" id="level" >
		<option  value="">Select Level</option>
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
           <span id="levelErr"></span>
		</div>
		<div class="col-sm-2">
		<input type="text" name="limit_qus[]" id="limit_que" class="limit" value="">
		   <span id="limit_queErr"></span>
		</div>
      		<input type="button" class="newField" value="Add field">

        <br>
        <br>
       
    </div>
</div>

 <div class="col-sm-2">
		<div class="form-group">
			<input type="hidden" name="submit" value="1">
			<button type="submit" class="btn btn-warning btn-sm" id="QueAns">Generate</a></button>
		</div>
		</div>
		<div id="download"></div>
	</form>
</div>
<?php
include("footer.php");
?>
 <script src="validate-gen-qus.js"></script> 
<script>
   $('#container').on('click','.newField', function () {
          var newthing=$('div.addNew:first').clone().find('.newField').removeClass('newField').addClass('remove').val('Remove Field!').end();
          
         $('#container').append(newthing);
    });
    
     $('#container').on('click','.remove', function () {
        
        $(this).parent().remove();
    });
    
</script>
