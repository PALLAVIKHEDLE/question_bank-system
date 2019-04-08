<?php
include("main.php");
require_once 'Classes/PHPExcel/IOFactory.php';
require_once 'Classes/PHPExcel.php';
      
$fname = $_FILES['file']['tmp_name'];
$filename = $_FILES['file']['name'];
$worksheet = '';
  
$excelReader = PHPExcel_IOFactory::createReaderForFile($fname); 
$excelObj = $excelReader->load($fname); 
$worksheet = $excelObj->getSheet(0);
include("db-config.php");

$lastRow = $worksheet->getHighestRow();
$error_log = array();
for ($row = 2; $row <= $lastRow; $row++) 
{
    $options = array();
    $tech = $worksheet->getCell('A'.$row)->getValue(); 
    $difficulty = $worksheet->getCell('B'.$row)->getValue();
    $question = $worksheet->getCell('C'.$row)->getValue();
    $answer = $worksheet->getCell('D'.$row)->getValue();
    $Qtype = $worksheet->getCell('E'.$row)->getValue();
    $options[] = $worksheet->getCell('F'.$row)->getValue();
    $options[] = $worksheet->getCell('G'.$row)->getValue();
    $options[] = $worksheet->getCell('H'.$row)->getValue();
    $options[] = $worksheet->getCell('I'.$row)->getValue();
   
    $rowexcel = $row -1;
               
    if($tech == '' || $difficulty == '' || $question == '' || $answer == '' || $Qtype == '' || $options[0] == '' || $options[1] == '' || $options[2] == '' || $options[3] == '')
    {
        array_push($error_log, "Blank field at Serial No ".$rowexcel);   
        $text = implode(",",$error_log);
        echo '<script type=\'text/javascript\'>'; 
        echo 'alert("'.$text.'");'; 
        echo '</script>';
    }
    if($options[] = $worksheet->getCell('J'.$row)->getValue()) 
        echo "<script type=\"text/javascript\">
        alert(\"Option should not greter than 4!\");
        window.location = \"add-question.php\"
        </script>";

    if(($Qtype != 'objective') && ($Qtype != 'subjective'))  
    {
        echo "<script type=\"text/javascript\">
        alert(\"Please Check Question Type\");
        window.location = \"add-question.php\"
        </script>"; 
    } 

}  
if(empty($error_log))
{ 
    for ($row = 2; $row <= $lastRow; $row++) 
    {
        $options = array();
        $tech = $worksheet->getCell('A'.$row)->getValue();
        $difficulty = $worksheet->getCell('B'.$row)->getValue();
        $question = $worksheet->getCell('C'.$row)->getValue();
        $answer = $worksheet->getCell('D'.$row)->getValue();
        $Qtype = $worksheet->getCell('E'.$row)->getValue();
        $options[] = $worksheet->getCell('F'.$row)->getValue();
        $options[] = $worksheet->getCell('G'.$row)->getValue();
        $options[] = $worksheet->getCell('H'.$row)->getValue();
        $options[] = $worksheet->getCell('I'.$row)->getValue();
        //valid question
        $sql_tech =  "SELECT tech_id from technology where tech_name = '".$tech."'";
        $user = mysqli_query($conn, $sql_tech);
        $tech_row = mysqli_fetch_array($user);

        $sql_difficulty = "SELECT level_id from difficulty_level where level_name = '".$difficulty."'";
        $user1 = mysqli_query($conn, $sql_difficulty);
        $level_row = mysqli_fetch_array($user1);

        $sql_question = "INSERT INTO question(tech_id, level_id, question, answer, question_type) 
        VAlUES('".$tech_row['tech_id']."','".$level_row['level_id']."','".$question."','".$answer."',
        '".$Qtype."')"; 
        $result = mysqli_query($conn, $sql_question);
        $row_qus = mysqli_fetch_array($result);
        
        $sql_id="SELECT que_id from question ORDER BY que_id DESC LIMIT 0 , 1";
        $idresult = mysqli_query($conn, $sql_id);
        $row_id = mysqli_fetch_array($idresult);
        $QUEID=$row_id['que_id'];
        
        foreach ($options as $option) 
        {
            if($Qtype == 'objective')
            $sql_option = "INSERT INTO options(que_id,obj_option) VALUES('".$row_id['que_id']."','".$option."')"; 
            $result1 = mysqli_query($conn, $sql_option);
            $row_opt = mysqli_fetch_array($result1); 
        }
        $rowexcel1 = $row -1;
        if($result == true && $result1 == true)
        {   
            echo "<script type=\"text/javascript\">
                confirm(\" Are you sure to import only valid questions\");
                window.location = \"add-question.php\"
                </script>";   

        }
        if($error_log != "")
        {
            array_push($error_log, "Please insert currect data at serial no:".$rowexcel1); 
            $text1 = implode(",",$error_log);
            echo '<script type=\'text/javascript\'>'; 
            echo 'alert("'.$text1.'");'; 
            echo '</script>';
        }
    }      
}
?>