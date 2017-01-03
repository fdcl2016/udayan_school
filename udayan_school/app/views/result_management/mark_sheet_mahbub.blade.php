<?php
ob_start();

ini_set('memory_limit', '-1');

$html = ob_get_clean();

$html = utf8_encode($html);

$link = mysqli_connect("localhost", "root", "", "iteams_db");

ini_set('max_execution_time', 300);

 if($link === false){

        die("ERROR: Could not connect. " . mysqli_connect_error());
    }


    $sql = "SELECT *
           FROM t_st_result
           LEFT JOIN student_to_section_update ON t_st_result.st_id = student_to_section_update.student_idstudentinfo 
           LEFT JOIN studentinfo ON t_st_result.st_id = studentinfo.registration_id
           where t_st_result.class = '$classname' And t_st_result.section = '$sectionname' And t_st_result.subject = '$subjectname' And t_st_result.academic_year= '$year2'
          group by student_to_section_update.st_roll  ORDER BY student_to_section_update.st_roll";  
       






    /*$sql = "SELECT t_st_result.f_ra , t_st_result.f_mcq , t_st_result.f_ht , t_st_result.f_total , t_st_result.f_grade , t_st_result.f_gp , t_st_result.gt_ra , t_st_result.gt_mcq , t_st_result.gt_ht , t_st_result.gt_total , t_st_result.gt_grade , t_st_result.gt_gp , student_to_section_update.st_roll , studentinfo.sutdent_name from t_st_result , student_to_section_update , studentinfo where  t_st_result.st_id = student_to_section_update.student_idstudentinfo And t_st_result.st_id = studentinfo.registration_id And t_st_result.class = '$classname' And t_st_result.section = '$sectionname'
        And t_st_result.subject = '$subjectname' ORDER BY student_to_section_update.st_roll";*/
            

   
      
   



$wi = "width=50px";
$wi1 = "width=185px";
   

$html =' <p style="text-align:center"><img align:right; src="image/4d.gif" alt="Four D" width="100" height="100"></img><h2>UDAYAN UCHCHA MADHYAMIK BIDYALAYA</h2></p>
         <h3>Subject : '.$subjectname.'</h3>
         <h3>Class : '.$classname.'   Section : '.$sectionname.'</h3>
         <h3>Term : '.$term.'   Year : '.$year2.' </h3>';
         

$html .=' <style>
table {
    border: 1px solid black;
    border-collapse: collapse;
    

   
}
h2,h3,h4{
    text-align: center;
}


td {
   font-size: 70%;
   text-align : center ;
}


</style>       
<table border="1">


  <tr>
    <th '.$wi.'>Roll</th>
    <th '.$wi1.'>Name</th>
    <th '.$wi.'>Regular Assesment</th>
    <th '.$wi.'>CT</th>
    <th '.$wi.'>CQ</th>
    <th '.$wi.'>LAB</th>
    <th '.$wi.'>MCQ</th>
    <th '.$wi.'>Total</th>
    <th '.$wi.'>Grade</th>
    <th '.$wi.'>GPA</th>
</tr>';



 if($result=mysqli_query($link,$sql)){

        if(mysqli_num_rows($result) > 0){

            while ($row = mysqli_fetch_array($result)){


                     //Studentinfo::where('registration_id','=',$row["st_roll"])
                     
       
            
            if ($term == 'Half Yearly'){

    

            $html.='<tr>
              <td '.$wi.'>'.$row["st_roll"].'</td>
              <td style="text-align:left" '.$wi1.'>'.$row["sutdent_name"].'</td>
              <td '.$wi.'>'.$row["h_ra"].'</td>
              <td '.$wi.'>'.$row["h_ct"].'</td>
              <td '.$wi.'>'.$row["h_ht"].'</td>
              <td '.$wi.'>'.$row["h_lab"].'</td>
              <td '.$wi.'>'.$row["h_mcq"].'</td>
              <td '.$wi.'>'.$row["h_total"].'</td>
              <td '.$wi.'>'.$row["h_grade"].'</td>
              <td '.$wi.'>'.$row["h_gp"].'</td>

             </tr>';
        
        } 
    


    else {
       
         
            $html.='<tr>
             <td '.$wi.'>'.$row["st_roll"].'</td>
              <td style="text-align:left" '.$wi1.'>'.$row["sutdent_name"].'</td>
              <td '.$wi.'>'.$row["f_ra"].'</td>
              <td '.$wi.'>'.$row["f_ct"].'</td>
              <td '.$wi.'>'.$row["f_ht"].'</td>
              <td '.$wi.'>'.$row["f_lab"].'</td>
              <td '.$wi.'>'.$row["f_mcq"].'</td>
              <td '.$wi.'>'.$row["f_total"].'</td>
              <td '.$wi.'>'.$row["f_grade"].'</td>
              <td '.$wi.'>'.$row["f_gp"].'</td>

             </tr>';



}




            }
            $html .='</table>';
        }
    }






include("mpdf60/mpdf.php");

$mpdf=new mPDF();

$mpdf->allow_charset_convertion=true;

$mpdf->charset_in = 'UTF-8';

$mpdf->writeHTML($html5);
$mpdf->writeHTML($html);


$val = $classname.'_'.$sectionname.'_marksheet';

$mpdf->Output($val,'I');
exit();
?>
