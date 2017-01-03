<?php


ini_set('max_execution_time', 300);

ini_set('memory_limit', '-1');


$stu_results=TStudentResult::where('class', '=', $class)
        ->where('section','=',$section)
        ->where('academic_year','=',$year)
        ->orderby('st_id', 'ASC')->orderby('subject', 'ASC')->get();


$st = StudentToSectionUpdate::where('section',$section)->where('class',$class)->where('year',$year)->leftjoin('studentinfo', 'studentinfo.registration_id', '=', 'student_to_section_update.student_idstudentinfo')
        ->orderby('student_to_section_update.st_roll', 'ASC')->get();


//$fs = AssignFourthSub::where('st_id',$s->student_idstudentinfo)->pluck('idsubject');

//if($fs){
//   $fs = $fs;
//}else{

//
//
//$res = ConvertedMarks::where('year',$year)
//        ->where('converted_marks.subjectid','!=',$fs)
//        ->where('term',$term)
//        ->leftjoin('subject', 'subject.idsubject', '=', 'converted_marks.subjectid')
//        ->orderby('subject.priority', 'ASC')->get();

//$res_fourth = ConvertedMarks::where('st_id',$s->student_idstudentinfo)->where('year',$year)
//        ->where('converted_marks.subjectid',$fs)
//        ->where('term',$term)
//        ->leftjoin('subject', 'subject.idsubject', '=', 'converted_marks.subjectid')
//        ->orderby('subject.priority', 'ASC')->get();


$subname = TStudentResult::where('idclasssection',$idclasssection)
        ->leftjoin('subject', 'subject.idsubject', '=', 't_st_result.subjectid')
        ->orderby('subject.priority', 'ASC')
        ->groupBy('t_st_result.subjectid')->get();


$std_no = count($st);




$html = '<html>

<body>






   <div class="table-responsive" style="padding-left:1%;padding-right:1%">';
if(count($students)){

    $html.='<br>
      <div style="margin-left: auto;margin-right: auto;width: 960px;background-color: ">


    <div style="width:auto;float: left;text-align: center;margin-right:90px;margin-top:12px" >
        <p style="font-size: 22px;margin-top:20px;font-weight: bold;color:#000066">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="margin-top:-40px"  src="../public/image/4d.gif"width="80" height="50" >&nbsp;<span style="font-size: 26px">'. Config::get('schoolname.school') .'</span><br/><span style="text-align:center">University Of Dhaka</span></p>
          <p style="font-size:18px" >
<b style="text-align:center">&nbsp;&nbsp;&nbsp;&nbsp;<u>TABULATION SHEET OF CLASS '."$class"."(".$section.")". '; &nbsp;&nbsp;'.$term.' Exam&nbsp;-'.$year.'</u></b>
        </p>

    </div>


</div>
                                       
                                        <div>
                                        <table border="1" cellspacing="0"  border="1" style="border-collapse: collapse">

                                            <tr>
                                                <th rowspan="2" style=" padding-left: 10px;padding-right:10px;font-size: 18px;width:100px"><b>Roll</b></th>
                                                <th  rowspan="2"  style=" padding-left: 10px;font-size: 18px;width:100px"><b>Student Name</b></th>';


    //  $std_no = count($students); $sub_no = (count($stu_results))/$std_no;
    $cls_val = Addclass::where('class_id','=',$idclasssection)->pluck('value');
    //   $count_sub_no = $sub_no;


    foreach($subname as $s){



        $html.='<th style="text-align: center; padding-left: 10px;font-size: 26px">'.$s->subject_name.'</th>';

    }
    $html.='<th style="text-align: center; padding-left: 10px;font-size: 26px">Summary</th>
                                            </tr>';

}
$html.='


 <tr>';
foreach($subname as $s){

    $html.='<td>

 <table  border="1" cellspacing="1"  style="border-collapse: collapse;">
                     

                            <tr>
                                <td style="text-align: center;font-size: 18px;" width="80px">Half Yearly</td><td style="text-align: center;font-size: 18px;" width="70px">Final</td><td style="text-align: center;font-size: 18px;" width="80px">Grand Total</td>
                                <td align="center" style="text-align: center;font-size: 18px;" width="70px"><b>Grade</b></td><td align="center" style="text-align: center;font-size: 18px;" width="70px"><b>GPA</b></td>
                            </tr>

                        </table>
</td>';

}

$html.=' <td>
    <table border="1" style=" table-layout: fixed;width: 700px;" style="border-collapse: collapse">
        <tr>


            
            
            <td align="center" style=" border-left: 1px solid black;font-size: 20px;width: 100px"><b>Half Yearly</b></td>
            <td align="center" style=" border-left: 1px solid black;font-size: 20px;width: 100px"><b>Final</b></td>
            <td align="center" style=" border-left: 1px solid black; font-size: 20px;width: 100px"><b>Annual</b></td>
            <td align="center" style=" border-left: 1px solid black; font-size: 20px;width: 100px"><b>Grade</b></td>
            <td align="center" style=" border-left: 1px solid black; font-size: 20px;width: 100px"><b>Gpa</b></td>
            <td align="center" style=" border-left: 1px solid black; font-size: 20px;width: 100px"><b>Status</b></td>
            <td align="center" style=" border-left: 1px solid black; font-size: 20px;width: 100px"><b>Merit</b></td>

        </tr>
    </table>
</td>
</tr>';

$total = 0;
$avg_gp = 0;

$count = 0;
$fail_count = 0;
$num_st_fail=0;
$num_st_pass=0;

foreach($st as $s ){

    $is_fail = 0;
    $fail_count=0;
    $sum_point =0;
    $sum_total=0;
    $count=0;
    $fourth_fail=0;
    $gp_avg=0;
    
    $half_total=0;
    $final_total=0;
    $grand_total=0;
    $final_tot = 0;
    

    $html.='<tr><td style="text-align: center;font-size: 20px;width:40px">'.$s->st_roll.'</td><td style="font-size: 20px;width: 350px">'.$s->sutdent_name.'</td>';

    foreach($subname as $s1){



        $re = TStudentResult::where('st_id',$s->student_idstudentinfo)->where('academic_year',$year)
                ->where('idclasssection',$idclasssection)
                ->where('subjectid',$s1->idsubject)
                ->first();



          $rnk = RankModel::where('stid',$s->student_idstudentinfo)->where('term',$term)->where('year',$year)->first();                                                  
         // $rnk =0;                                                  

$count++;


        $html.='<td>

<table   border="1" cellspacing="1"  style="border-collapse: collapse;">
                            

                            <tr>
                                <td style="text-align: center;font-size:16px;" width="80px">'.$re->h_total.'</td><td style="text-align: center;font-size: 16px;" width="70px">'.$re->f_total.'</td><td style="text-align: center;font-size: 16px;" width="80px">'.$re->gt_total.'</td>';
                                
                              if($re->gt_grade=='F')
                            {
                                $html.='<td style="text-align: center;font-size: 16px;color:red;font-weight:bold" width="70px">'.$re->gt_grade.'</td>';
        
        $fail_count++;
        
                              } else{
            
                             $html.='<td style="text-align: center;font-size: 16px;" width="70px">'.$re->gt_grade.'</td>';
                              }
            
        
        $html.='<td style="text-align: center;font-size: 16px;" width="70px">'.$re->gt_gp.'</td>';
        

        
                         $half_total = $half_total + $re->h_total;
                         $final_total = $final_total + $re->f_total;
        
                        //$final_tot = $final_tot + $re_gt_total;


            $sum_total = $sum_total + $re->gt_total;

            $gp_avg = $gp_avg + $re->gt_gp;





            if($gp_avg >= 5.00) {$total_grade = "A+"; $gp_avg ="5.00";}
            if($gp_avg <= 4.99 && $gp_avg >= 4.00) $total_grade = "A";
            if($gp_avg <= 3.99 && $gp_avg >= 3.50) $total_grade = "A-";
            if($gp_avg <= 3.49 && $gp_avg >= 3.00) $total_grade = "B";
            if($gp_avg <= 2.99 && $gp_avg >= 2.00) $total_grade = "C";
            if($gp_avg <= 1.99 && $gp_avg >= 1.00) $total_grade = "D";
            if($gp_avg <= 0.99 && $gp_avg >= 0.00) $total_grade = "F";





                $sum_point = $sum_point + $gp_avg;
              
        //$count++;


            



        $html.='</tr>

                        </table>
</td>';


    }
    $html.='<td><table border="1" style="width: 100px;border-collapse: collapse;font-size: 20px;text-align: center"><tr><td>'.$half_total.'</td>';
    
    $html.='<td>'.$final_total.'</td>';
    
    $html.='<td>'.($half_total + $final_total).'</td>';

    $grdpoint= "";

    if($fail_count>0){

        $point_avg =0;
    }
    else{


       // $point_avg = sprintf('%.2f',($sum_point/ ($count))); 
        
        $point_avg = $rnk->cgpa; 

    }

    if($point_avg <1){

        $point_avg =0;
    }


    if($point_avg >= 5.00) {$total_grade_final = "A+"; $point_avg ="5.00";}
    if($point_avg <= 4.99 && $point_avg >= 4.00) $total_grade_final = "A";
    if($point_avg <= 3.99 && $point_avg >= 3.50) $total_grade_final = "A-";
    if($point_avg <= 3.49 && $point_avg >= 3.00) $total_grade_final = "B";
    if($point_avg <= 2.99 && $point_avg >= 2.00) $total_grade_final = "C";
    if($point_avg <= 1.99 && $point_avg >= 1.00) $total_grade_final = "D";
    if($point_avg <= 0.99 && $point_avg >= 0.00) $total_grade_final = "F";






    if($fail_count>0){

        $num_st_fail ++;

        $html.='<td style="font-size: 20px;width: 100px;text-align: center;color:red">F('.($fail_count).')</td>';
    }

  

    else{
      
           $num_st_pass ++;

        $html.='<td style="font-size: 20px;width: 100px;text-align: center">'.$total_grade_final.'</td>';
    }

    $html.='<td style="font-size: 20px;width: 100px;text-align: center">'.$rnk->cgpa.'</td>';
    
    if($fail_count>0){
    
    $html.='<td style="font-size: 20px;width: 100px;text-align: center">Fail</td>';
          $html.='<td style="font-size: 20px;width: 100px;text-align: center">NA</td>';
    }
    
    else{
        $html.='<td style="font-size: 20px;width: 100px;text-align: center">Pass</td>';
          $html.='<td style="font-size: 20px;width: 100px;text-align: center">'.$rnk->rank.'</td>';
        
    }
  

    $html.='</tr></table></td></tr>';

    
  //  break;

}







$html.='</table>
                                        </div>


              <div style="width: 100%; text-align: center;font-weight: bold"><br/>Total Student:'.$std_no.' , Number of Failed Student: '.($std_no - $num_st_pass).', Number of Passed Student: '.$num_st_pass.'</div>
                                        </div></body></html>';



//}


include("mpdf60/mpdf.php");


$mpdf=new mPDF('c','A3-L');
$mpdf->AddPage();

$mpdf->SetFont('Times New Roman',"B",10);
//$mpdf->SetXY(0*10.4, 0.8*15.4);
//$mpdf->SetTextColor(255,240,255);


$mpdf->allow_charset_convertion=true;

$mpdf->charset_in = 'UTF-8';

$mpdf->writeHTML($html);


$mpdf->Output();


exit();
?>