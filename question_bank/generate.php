<?php
include("main.php");
?>
	<div class="col-sm-9">
		<form action="" method="POST" id="generate">
		<h3 class="text-center text" id="h4">Generate Question Paper</h3>
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-3">
			<h4 class="" id="h4">Types of Question</h4>
				<div class="form-group ">
				<input type="checkbox" name="type[]" value="objective" id="Objective"> Objective Type
				<input type="number" name="limit_objques[]" class="form-control" id="limit_totalobj">
				</div>
				<div class="form-group ">
				<input type="checkbox" name="type[]" value="subjective" id="Subjective"> Subjective Type
				<input type="number" name="limit_subques[]" class="form-control" id="limit_totalsbj">
				<span id="typeErr"></span>
				</div>
			</div>
			<div class="col-sm-8"></div>
		</div><!--row end-->
		<br>
		
		<div id="type_container">
		<div class="row form-group" id="edit-0">
        <div class="col-md-3">
        	 <label id="h4">Technology</label>
			<select class="form-control" name="technology[]" id="technology">
		   	<option disabled="disabled" selected="selected" value="">Select Technology</option>
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
        <div class="col-md-2">
       	<label id="h4">Difficulty Level</label>
        <select class="form-control" name="level[]" id="level">
		<option disabled="disabled" selected="selected" value="">Select Level</option>
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
		<div class="col-md-2">
        <label id="h4">Number of Question</label>
		<input type="number" name="limit_qus[]" class="form-control" id="limit_que">
		<span id="limit_queErr"></span>
        </div>
         <div class="col-md-1">
        <label id="h4">Objective Question</label>
		<input type="number" name="limit_objque[]" class="form-control" id="limit_objque">
		<span id="limit_objqueErr"></span>
        </div>
        <div class="col-md-1">
        <label id="h4">Subjective Question</label>
		<input type="number" name="limit_subque[]" class="form-control" id="limit_subque">
		<span id="limit_subqueErr"></span>
        </div>
 		<div class="col-md-1 control-label">
			<a class="add-type" href="" title="Click to add more">
			<i class="glyphicon glyphicon-plus" style="margin-top: 30px;margin-right:30px;"></i></a>
		</div>
		<div class="col-sm-2">
		<div class="form-group">
			<input type="hidden" name="submit" value="1">
			<button type="submit" class="btn btn-warning btn-sm" id="QueAns">Generate</button>
		</div>
		</div>
        </div> 
		</div> 
		<div id="download"></div>
		<div id="type-container" class="hide">
		<div class="row form-group type-row" id="">
        <div class="col-md-3">
        	 <label id="h4">technology</label>
		  	<select  class="form-control" name="technology[]" id="technology">
			<option disabled="disabled" selected="selected" value="">Select Technology</option>
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
        	
        </div>
        <div class="col-md-2">
        	 <label id="h4">Difficulty Level</label>
        	<select  class="form-control" name="level[]" id="level">
		   	<option disabled="disabled" selected="selected" value="">Select Level</option>
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
       	<div class="col-md-2">
        <label id="h4">Number of Question</label>
		<input type="number" name="limit_qus[]" class="form-control" id="limit_que">
		<span id="limit_queErr"></span>
        </div>
         <div class="col-md-1">
        <label id="h4">Objective Question</label>
		<input type="number" name="limit_objque[]" class="form-control" id="limit_objque">
		<span id="limit_objqueErr"></span>
        </div>
        <div class="col-md-1">
        <label id="h4">Subjective Question</label>
		<input type="number" name="limit_subque[]" class="form-control" id="limit_subque">
		<span id="limit_subqueErr"></span>
        </div>
		<div class="col-md-1"><a class="remove-type" href="" targetDiv="" data-id="0" onclick="removeRow()"><i class="glyphicon glyphicon-trash" style="margin-top: 30px;margin-right:30px;"></i></a></div>
		</div>
		</div>
	</form>
	</div>
<?php
include("footer.php");
?>
 <script src="generatepaper.js"></script> 
 
<script>
	function removeRow() {
	    var didConfirm = confirm("Are you sure You want to delete");
	    if (didConfirm == true) {
	        var id = $(this).attr('data-id');
			var targetDiv = $(this).attr('targetDiv');
	       
	            $('#' + targetDiv).remove();
	       
	        return true;
	    } else {
	        return false;
	    }
 	}
$(document).ready(function() {
//var doc = $(document);
$('.add-type').click(function(e) {
     e.preventDefault(); 
    var content = $('#type-container .type-row'),
        element = null;
    for(var i = 0; i<1; i++){
        element = content.clone();
		var type_div = 'teams_'+$.now();
		element.attr('id', type_div);
		element.find('.remove-type').attr('targetDiv', type_div);
        element.appendTo('#type_container');
		
      }
	});
	
});
</script>