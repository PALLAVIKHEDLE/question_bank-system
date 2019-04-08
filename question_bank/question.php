<?php
  
require_once('./pdf/vendor/autoload.php');
if(isset($_POST['submit']))
{

      // print_r($_POST);
    $obj_type = $_POST['type'];
    $num_qus = $_POST['no_of_qus'];
    $tech_sel = $_POST['technology'];
    $level_sel = $_POST['level'];
    $qus_limit = $_POST['limit_qus'];
    $i=0;
    include("db-config.php");
    $html.='<table>
         <tbody>'; 
          
    foreach($tech_sel as $technologies)
    {  
        $sql1="SELECT * FROM question where tech_id='".$technologies."' && level_id='".$level_sel[$i]."' && question_type='".$obj_type."' ORDER BY RAND() limit ".$qus_limit[$i];
        $query1=mysqli_query($conn, $sql1);
        $count=mysqli_num_rows($query1);
        if($count>0)
        {
            while($row = $query1->fetch_assoc())
            {
                $html .= '<tr>
                    <td >'.$row['question'].'</td>   
                    </tr>';
                     if($obj_type == 'objective')
                     {
                        $optionname="SELECT obj_option FROM options where que_id='".$row['que_id']."'";
                        $query3 = mysqli_query($conn,$optionname);
                        $optionName = array();
                        while($rowoptionName = $query3->fetch_assoc()){
                        $optionName[] = $rowoptionName['obj_option'];
                        }
                        $html .= '<tr>
                        <td >'.$optionName[0].'</td>  
                        <td >'.$optionName[1].'</td>
                        </tr>
                        <tr>  
                        <td >'.$optionName[2].'</td>  
                        <td >'.$optionName[3].'</td>  
                        </tr>';
                    
                    }
            }
             $i=$i+1;                
        } 
        else
        {

            echo "<script type=\"text/javascript\">
                alert(\"Please Insert question.\");
                window.location = \"generate-question.php\"
                </script>";    

        }
    }
    $html .= '</tbody></table>';



$random = (date('Y-m-d H:i:s:u'));
$extension = '.pdf';
$file_name = 'questionPaper/'.$random.$extension;
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output($file_name, 'F');

 $previous="INSERT INTO previous_question_paper(previous_paper)VALUES('".$file_name."')";
 $que_paper=mysqli_query($conn, $previous);
 //$pre_que=mysqli_fetch_assoc($que_paper);
 if($que_paper==true){
   // echo "success";
      $sql = "SELECT * FROM previous_question_paper ORDER BY pre_que_id";
    $result = mysqli_query($conn, $sql);
    while($rowprevious = $result->fetch_assoc()){
                      
               $previous_paper=$rowprevious['previous_paper'];
               echo '<a href="'.$previous_paper.'">papers</a><br>';

      }
 }else{
    echo "failed";
 }
 
} 

?>  