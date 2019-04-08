<?php
require_once('./pdf/vendor/autoload.php');
if(isset($_POST['submit']))
{
    $obj_type = $_POST['type'];
    $num_obj_que=$_POST['limit_objques'];
     $num_sub_que=$_POST['limit_subques'];
    $tech_sel = $_POST['technology'];
    $level_sel = $_POST['level'];
    $qus_limit = $_POST['limit_qus'];
    $obj_que=$_POST['limit_objque'];
    $sub_que=$_POST['limit_subque'];
   $quetype=implode(',', $obj_type);
  
    $i=0;
    include("db-config.php");
   
    $html.='<table>
        <tbody>'; 
    $html1.='<table>
        <tbody>'; 

        
// if($quetype =='objective,subjective'){
//             echo "hello";
//       $sql2= "SELECT * FROM question where tech_id='".$tech_sel[$i]."' && level_id='".$level_sel[$i]."' && question_type='objective' limit ".$obj_que[$i];
//          $query2=mysqli_query($conn, $sql2);
//          $rowobj=mysqli_fetch_assoc($query2);
//          print_r($rowobj); exit();
//       $sql3="SELECT * FROM question where tech_id='".$tech_sel[$i]."' && level_id='".$level_sel[$i]."' && question_type='subjective' limit ".$sub_que[$i];
//         $query6=mysqli_query($conn, $sql3)
//          $rowsub=mysqli_fetch_assoc($query6);
//           print_r($rowsub); exit();
//     if($rowobj== true && $rowsub==true )
//         {
//         $html .= '<tr style="margin-left:20px;">
//             <td>'.$rowobj['question'].'</td>   
//                <td>'.$rowsub['question'].'</td>   
//             </tr>
//             <tr>
//                <td>'.$rowsub['answer'].'</td> 
//             <td>'.$rowobj['answer'].'</td> 
//             </tr>';
//         $html1 .= '<tr>
//             <td >'.$rowobj['question'].'</td>   
//             </tr>';  

//         }
// }
         
    
    foreach($tech_sel as $technologies)
    {  
          $sql1="SELECT * FROM question where tech_id='".$technologies."' && level_id='".$level_sel[$i]."' &&
          question_type IN ('".implode("','",$obj_type)."') ORDER BY RAND() limit ".$qus_limit[$i];
        $query1=mysqli_query($conn, $sql1);
        $count=mysqli_num_rows($query1);
       // echo $count;die();

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
        if(($quetype =='objective,subjective')||($quetype =='objective'))
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
        $sum=$obj_que[$i] + $sub_que[$i];
             if($qus_limit[$i]!=$sum){
                echo "<script> 
                    confirm(\"Sum of the objective and subjective question should be equal to Number of question\");
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
