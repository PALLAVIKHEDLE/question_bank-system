<?php
include("main.php");
include("db-config.php");

?>
<div class="col-sm-1"></div>
<div class="col-sm-7">

<h3 class="text-center" style="color:orange">Previous Question Paper</h3>
<table class="table table-bordered">
<thead>
<tr class="info">
<th>Date And Time</th>
<th>Question with Answer</th>
<th>Question</th>
<th>Delete</th>
</tr>
</thead>
<tbody>
<?php

$sql = "SELECT * FROM previous_question_paper";
 $result = mysqli_query($conn, $sql);

	while($rowprevious = $result->fetch_assoc())
    {
	   $time = $rowprevious['generate_time'];
        $previous_paper=$rowprevious['previous_paper'];
        $p_question=$rowprevious['previous_question'];
        echo '<tr class="success">';
        echo '<td>"'.$time.'"</td>';
        echo '<td><a href="'.$previous_paper.'">Question and Answer</a></td>';
        echo '<td><a href="'.$p_question.'">Question Paper</a></td>';
        echo"<td><a href='deletepaper.php?pre_que_id=".$rowprevious['pre_que_id']."'>
			<span class='glyphicon glyphicon-trash'</span></a></td>";
	   echo '</tr>';
    }
?>
</tbody>
</table>	
<div class="text-center">

</div>
</div>
<div class="col-sm-1"></div>
<?php
include("footer.php");
?>
