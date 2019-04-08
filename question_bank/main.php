<?php
include("session.php");
include("header.php");
?>
<div class="container-fluid">
<div class="row">
<div class="col-sm-3">
<?php
if($_SESSION['role']=='9'){
?>
	<div class="list-group" id="ul">
	<a href="home.php" class="list-group-item glyphicon glyphicon-home">Home</a>
	<a href="author-management.php" class="list-group-item glyphicon glyphicon-user">Author Management</a>
	<a href="technology.php" class="list-group-item glyphicon glyphicon-plus">Technology</a>
	<a href="add-question.php" class="list-group-item glyphicon glyphicon-import">Add Question</a>
	<a href="show-question.php" class="list-group-item glyphicon glyphicon-list-alt">Show Question</a>
	<a href="generate.php" class="list-group-item glyphicon glyphicon-pencil">Generate Question Paper</a>
	</div>
	<?php 
	}
	else{
	?>
	<div class="list-group" id="ul">
	<a href="home.php" class="list-group-item glyphicon glyphicon-home">Home</a>
	<a href="add-question.php" class="list-group-item glyphicon glyphicon-import">Add Question</a>
	<a href="show-question.php" class="list-group-item glyphicon glyphicon-list-alt">Show Question</a>
	<a href="generate.php" class="list-group-item glyphicon glyphicon-pencil">Generate Question Paper</a>
	</div>
	<?php
	}
?>
</div><!-- col-3 end-->
<hr id="horiz_line" style="width: 100%;size: 82px;border: 1px solid orange;display: none;border-right: 0;
    border-left: 0;" > 
