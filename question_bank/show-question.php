<?php
include("main.php");
include("db-config.php");
?>
<div class="col-sm-1"></div>
<div class="col-sm-6">

<h3 class="text-center" id="h4">Show Question List</h3>
	<div class="table-responsive">
	<table class="table table-bordered">
	<thead>
		<tr class="info">
		<th>ID</th>
		<th>Question</th>
		<th>Answer</th>
		<th>Technology</th>
		<th>Difficulty Level</th>
		<th>Option1</th>
		<th>Option2</th>
		<th>Option3</th>
		<th>Option4</th>
		<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$sql="SELECT * FROM question";
		$res1=mysqli_query($conn, $sql);
		
        while($rowque= $res1->fetch_assoc()) {
            echo "<tr class='wanrning'>";
			echo "<td>" .$rowque["que_id"]. "</td>";
			echo "<td>" .$rowque["question"]. "</td>";
			echo "<td>" .$rowque["answer"]. "</td>";
					
		$techid="SELECT * FROM technology where tech_id='".$rowque['tech_id']."'";
		$query = mysqli_query($conn,$techid);
		$tech=mysqli_fetch_assoc($query);
		echo "<td>" .$tech["tech_name"]. "</td>";
						
        $levelid="SELECT * FROM difficulty_level where level_id='".$rowque['level_id']."'";
		$query2 = mysqli_query($conn,$levelid);
		$level=mysqli_fetch_assoc($query2);
        echo "<td>" .$level["level_name"]. "</td>";
                  		
        if($rowque['question_type']=='objective'){
		$optionid="SELECT * FROM options where que_id='".$rowque['que_id']."'";
       	$query3 = mysqli_query($conn,$optionid);
       	$optionName = array();
	    while($rowoptionName = $query3->fetch_assoc()){
	        $optionName[] = $rowoptionName['obj_option'];
	   	}
	    	echo"<td>".$optionName[0]."</td>";
	    	echo"<td>".$optionName[1]."</td>";
	    	echo"<td>".$optionName[2]."</td>";
	    	echo"<td>".$optionName[3]."</td>";
	    }
	    else{
	        echo "<td></td>";
	        echo "<td></td>";
	        echo "<td></td>";
	        echo "<td></td>";
	    }
			echo"<td><a href='editquestion.php?que_id=".$rowque['que_id']."'>
			<span class='glyphicon glyphicon-edit'></span></a> &nbsp;&nbsp&nbsp;&nbsp";
            echo"<a href='deletequestion.php?que_id=".$rowque['que_id']."'>
			<span class='glyphicon glyphicon-trash'</span></a></td>";
			echo "</tr>";
		}
	?>
	</tbody>
	</table>
	</div>
<div class="text-center">

</div>
</div><!--6 end-->
<div class="col-sm-1">
	<button class="btn btn-warning"><a href="add-question.php" style="color: black;">Add Question</button>
</div>
<?php
	include("footer.php");
?>
