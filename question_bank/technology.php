<?php
// include("session.php");
include("main.php");
include("db-config.php");
if(isset($_POST['technology']))
{  
  $technology=$_POST['technology'];
  $insert = "INSERT INTO technology(tech_name)VALUES('$technology')";
  $result=mysqli_query($conn,$insert);  
  if($result==true ){
    echo "New Technology is added";
  }else{
    echo "Error: " . $insert . "<br>" . $conn->error;
  }
}
?>
<div class="col-sm-2"></div>
<div class="col-sm-5">
<h3 class="text-center" id="h4">Technology-Management</h3>
<table class="table table-bordered">                     
<thead>
  <tr class="info">
  <th>Id</th>  
  <th>Technology</th>
  <th>Action</th>
  </tr>
</thead>
<tbody>
<?php
$tech="SELECT * FROM technology ";
$sql=mysqli_query($conn, $tech);
  while($row = $sql->fetch_assoc()) {
    echo "<tr class='warning'>";
    echo"<td>".$row['tech_id']."</td>";
    echo"<td>".$row['tech_name']."</td>";
    echo"<td><a href='edittechnology.php?tech_id=".$row['tech_id']."'><span class='glyphicon glyphicon-edit'></span></a> &nbsp;&nbsp&nbsp;&nbsp";
    echo"<a href='deletetechnology.php?tech_id=".$row['tech_id']."'><span class='glyphicon glyphicon-trash'</span></a></td>";
    echo"</tr>";
    }
  
?>

</tbody>
</table>
</div><!--7 end-->
<!-- modal -->
<button type="button" class="btn btn-warning btn-sm"  id="button1" data-toggle="modal" data-target="#myTech">Add Technology</button>
<div class="modal fade" id="myTech" tabindex="-1" role="dialog" aria-labelledby="Technology" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-header">
  <h4 class="modal-title" id="h4">Add Technology</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
<form action="" method="POST" id="form2">
<div class="form-group">
  <input type="text" placeholder="Enter Technology Name" name="technology" id="technology" class="form-control">
  <span id="technameErr"></span>
</div>
<div class="modal-footer">
  <button type="submit"  class="btn btn-warning" id="add_tech">Save</button>
  <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>

<script>
$(document).ready(function(){
  $("#add_tech").click(function(e){
    e.preventDefault();
    var technology = $("#technology").val();
    if(technology == "") {
      $("#technology").css('border', '2px solid red');
      $("#technameErr").text("Please Enter Technology").css('color','red');
    }else {
      $("#form2").submit();
    }
    });
});
</script> 

<?php
  include("footer.php");
?>
