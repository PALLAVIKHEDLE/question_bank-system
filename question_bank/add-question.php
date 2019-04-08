<?php
include("main.php");
?>
<form action="add-phpExcel.php" method="post" id="excel_form" enctype="multipart/form-data">
<button type="button" class="btn btn-success" style="float:right;margin-right: 43px;" >
<a href="/download/question-template.xlsx" download="">Download Template</a></button>
<h3 class="text-center" id="h4">Add-Questions</h3>
<div class="col-sm-9">
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-3">
    <br><br>
    <div class="form-group">
        <h4 id="h4">Add Questions</h4>
        <input type="file" name="file" id="file" class="form-control" accept="" required>
        <div style="color:red;"> <?php echo $message; ?></div>
    </div>
    </div>
    <div class="col-sm-3">
        <button type="submit" id="submit" name="submit" class="btn btn-primary" id="btn2">Import</button>
    </div>
    <div class="col-sm-3"></div>
</div>
<div class="row">
<div class="col-sm-1"></div>
<div class="col-sm-10">
<h4 style="color:red">Note</h4>
<p style="color:blue;">1. For Adding the Question You must downlod the template from the DOWNLOAD TEMPLATE 
<p style="color:blue;">2. Do not Add Question excepts the unavailable technology in the technology list.</p>
<p style="color:blue;">3. Question Type should be objective or subjective.</p>
<p style="color:blue;">4. Difficulty Level should be Easy, Medium and Difficult.</p>
<p style="color:blue;">5. After completion of adding question in the download file you must import same file only.</p>    
</div>
<div class="col-sm-1"></div>
</div>
</div>
</form>
<?php
    include("footer.php")
?>

