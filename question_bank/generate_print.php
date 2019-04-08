<?php
require_once('./pdf/vendor/autoload.php');
if(isset($_POST['submit']))
{
    $obj_type = $_POST['type'];
    $num_qus = $_POST['no_of_qus'];
    $tech_sel = $_POST['technology'];
    $level_sel = $_POST['level'];
    $qus_limit = $_POST['limit_qus'];
    $i=0;
    include("db-config.php");
   
    $html.='<table>
        <tbody>'; 
    $html1.='<table>
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
        $html .= '<tr style="margin-left:20px;">
            <td >'.$row['question'].'</td>   
            </tr>
            <tr>
            <td>'.$row['answer'].'</td> 
            </tr>';
        $html1 .= '<tr>
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
            </tr><br>';
        $html1 .= '<tr>
            <td >'.$optionName[0].'</td>  
            <td >'.$optionName[1].'</td>
            </tr>
            <tr>  
            <td >'.$optionName[2].'</td>  
            <td >'.$optionName[3].'</td>  
            </tr><br>';
                    
        }
        }
        $i=$i+1;                
        } 
        else
        {
                 echo "<script>
                  confirm(\"Please insert Question\");
                </script>";   die;
                    
        }
    }
    $html .= '</tbody></table>';
    $html1 .= '</tbody></table>';

    $random = uniqid();
    $extension = '.pdf';
    $file_name = 'questionPaper/'.$random.$extension;
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $mpdf->Output($file_name, 'F');


    $random1 = uniqid();
    $file_name1 = 'questionPaper/'.$random1.$extension;
    $mpdf1 = new \Mpdf\Mpdf();
    $mpdf1->WriteHTML($html1);
    $mpdf1->Output($file_name1, 'F');

    $previous="INSERT INTO previous_question_paper(previous_paper, previous_question)
    VALUES('".$file_name."', '".$file_name1."')";
    $que_paper=mysqli_query($conn, $previous);
    
    if($que_paper==true)
    {   
        echo  '<h3>Download</h3>
        <button type="submit"><a href='.$file_name.'>Question and Answer</a></button>
        <button type="submit"><a href='.$file_name1.'>Question</a></button>'; 
    }
    else
    {
        echo "failed";
    }
} 

?>
