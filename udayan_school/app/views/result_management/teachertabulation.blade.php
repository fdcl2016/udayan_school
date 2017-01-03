<?php

ini_set('max_execution_time', 300);

ini_set('memory_limit', '-1');


// $stu_results=TStudentResult::where('class', '=', $class)
//         ->where('section','=',$section)
//         ->where('academic_year','=',$year)
//         ->orderby('st_id', 'ASC')->orderby('subject', 'ASC')->get();


$st = StudentToSectionUpdate::where('section',$section)->where('year',$year)
        ->leftjoin('studentinfo', 'studentinfo.registration_id', '=', 'student_to_section_update.student_idstudentinfo')
        ->orderby('student_to_section_update.st_roll', 'ASC')->get();


//$fs = AssignFourthSub::where('st_id',$s->student_idstudentinfo)->pluck('idsubject');

//if($fs){
//   $fs = $fs;
//}else{

$fs = 45;
//}

$res = ConvertedMarks::where('year',$year)
        ->where('converted_marks.subjectid','!=',$fs)
        ->where('term',$term)
        ->leftjoin('subject', 'subject.idsubject', '=', 'converted_marks.subjectid')
        ->orderby('subject.priority', 'ASC')->get();

//$res_fourth = ConvertedMarks::where('st_id',$s->student_idstudentinfo)->where('year',$year)
//        ->where('converted_marks.subjectid',$fs)
//        ->where('term',$term)
//        ->leftjoin('subject', 'subject.idsubject', '=', 'converted_marks.subjectid')
//        ->orderby('subject.priority', 'ASC')->get();


$subname = ConvertedMarks::where('class_id',$idclasssection)->where('year',$year)->where('term',$term)
        ->leftjoin('subject', 'subject.idsubject', '=', 'converted_marks.subjectid')
        ->orderby('subject.priority', 'ASC')
        ->groupBy('converted_marks.subjectid')->get();


$std_no = count($st);




$html = '<html>

<body>






   <div class="table-responsive" style="padding-left:1%;padding-right:1%">';
if(count($students)){

    $html.='<br>
      <div style="margin-left: auto;margin-right: auto;width: 960px;background-color: ">



    <div style="width:auto;float: left;text-align: center;margin-right:90px;margin-top:20px" >
        <p style="font-size: 22px;margin-top:20px;font-weight: bold;color:#000066"><img style="margin-top:-40px"  src="../public/image/4d.gif"width="80" height="50" >&nbsp;<span style="font-size: 28px">'. Config::get('schoolname.school') .'</span><br/><span style="text-align:center">University Of Dhaka</span></p>
          <p style="font-size:18px" >
<b style="text-align:center"><u>TABULATION SHEET OF CLASS '.$class."(".$section.")". '</u></b>
        </p>
 <h4><b>'.$term.' Exam&nbsp;-'."2016".'</b></h4>


    </div>


</div>
                                        <br/>
                                        <div>
                                        <table border="1" cellspacing="0"  border="1" style="border-collapse: collapse">

                                            <tr>
                                                <th rowspan="2" style=" padding-left: 10px;padding-right:10px;font-size: 26px;width:100px"><b>Roll</b></th>
                                                <th  rowspan="2"  style=" padding-left: 10px;font-size: 26px;width: 600px"><b>Student Name</b></th>';


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

 <table   border="1" cellspacing="1" table-layout: fixed;width: 620px style="border-collapse: collapse;">
                            <tr style="text-align: center; width:100%;">MCQ</tr>

                            <tr>
                                <td style="text-align: center;font-size: 26px;width:100px">CQ</td>
                               <td style="text-align: center;font-size: 26px;width:100px">MCQ</td>
                                <td align="center" style="text-align: center;font-size: 26px;width:100px"><b>Practical</b></td><td align="center" style="text-align: center;font-size: 26px;width:100px "><b>Total</b></td><td align="center" style="text-align: center;font-size: 26px;width:100px "><b>Grade</b></td><td align="center" style="text-align: center;font-size: 26px;width:100px"><b>GPA</b></td>
                            </tr>

                        </table>
</td>';

}

$html.=' <td>
    <table border="1" style=" table-layout: fixed;width: 250px;" style="border-collapse: collapse">
        <tr>


            <td align="center" style=" border-left: 1px solid black;font-size: 26px;width: 150px"><b>Total</b></td>
            <td align="center" style=" border-left: 1px solid black;font-size: 26px;width: 150px"><b>Grade</b></td>
            <td align="center" style=" border-left: 1px solid black; font-size: 26px;width: 150px"><b>GPA</b></td>
            <td align="center" style=" border-left: 1px solid black; font-size: 26px;width: 150px"><b>Status</b></td>
            <td align="center" style=" border-left: 1px solid black; font-size: 26px;width: 150px"><b>Merit</b></td>

        </tr>
    </table>
</td>
</tr>';

$total = 0;
$avg_gp = 0;
$count = 0;
$fail_count = 0;
$num_st_fail=0;
foreach($st as $s ){

    $is_fail = 0;
    $fail_count=0;
    $sum_point =0;
    $sum_total=0;
    $count=0;
    $fourth_fail=0;

    $html.='<tr><td style="text-align: center;font-size: 26px;width:100px">'.$s->st_roll.'</td><td style="font-size: 26px;width: 600px">'.$s->sutdent_name.'</td>';

    foreach($subname as $s1){



        $re = ConvertedMarks::where('st_id',$s->student_idstudentinfo)->where('year',$year)
                ->where('term',$term)
                ->where('class_id',$idclasssection)
                ->where('subjectid',$s1->idsubject)
                ->first();
        if(count($re))
        {
            $ct_cq = $re->cq_ct;
            $ct_tot = $re->cq_total;
            $ct_conv = $re->cq_conv;
            $ct_mcq = $re->mcq_ct;
            $ct_mtot = $re->mcq_total;
            $ct_mcq_conv = $re->mcq_conv;
            $prac= $re->practical;
            $tot = $re->total;
            $grade = $re->grade;
            $gpa = $re->point;

        }
        else
        {
            $ct_cq = "0";
            $ct_tot = "0";
            $ct_conv = "0";
            $ct_mcq = "0";
            $ct_mtot = "0";
            $ct_mcq_conv = "0";
            $prac = "0";
            $grade = "0";
            $gpa = 0;
            $tot = 0;

        }


        $st_fs = AssignFourthSub::where('st_id',$s->student_idstudentinfo)->where('class_id',$idclasssection)->where('idsubject',$s1->idsubject)->first();

 //$rnk = RankModel::where('stid',$s->student_idstudentinfo)->where('term',$term)->where('year',$year)->first();   


    $rnk = RankModel::where('stid',$s->student_idstudentinfo)->where('year',$year)->where('term',$term)->pluck('rank');

if(!$rnk || $rnk=="" || $rnk==[]){
  
  $rnk = "N/A";

}else{

  $rnk = $rnk;
}


        $html.='<td>

<table   border="1" cellspacing="1"  style="border-collapse: collapse;">
                            <tr style="text-align: center; width:100%;">MCQ</tr>

                            <tr>
                                <td style="text-align: center;font-size: 26px;width:100px">'.$ct_tot.'<td style="text-align: center;font-size: 26px;width:100px">'.$ct_mtot.'</td>
                                <td align="center" style="text-align: center;font-size: 26px;width:100px"><b>'.$prac.'</b></td>';



        if($grade=="NA"){

            $html.='<td align="center" style="text-align: center;font-size: 26px;width:10% "><b>'.$tot.'</b></td><td align="center" style="text-align: center;font-size: 26px;width:100px "><b>'.$grade.'</b></td><td align="center" style="text-align: center;font-size: 26px;width:100px"><b>'.$gpa.'</b></td>td align="center" style="text-align: center;font-size: 26px;width:10% "><b>Fail</b></td>td align="center" style="text-align: center;font-size: 26px;width:10% "><b>0</b></td>';



        }
        else{

            $html.='<td align="center" style="text-align: center;font-size: 26px;width:100px "><b>'.$tot.'</b></td>';



            $sum_total = $sum_total + $tot;


            $gp_avg = $gpa ;




            if($gp_avg >= 5.00) {$total_grade = "A+"; $gp_avg ="5.00";}
            if($gp_avg <= 4.99 && $gp_avg >= 4.00) $total_grade = "A";
            if($gp_avg <= 3.99 && $gp_avg >= 3.50) $total_grade = "A-";
            if($gp_avg <= 3.49 && $gp_avg >= 3.00) $total_grade = "B";
            if($gp_avg <= 2.99 && $gp_avg >= 2.00) $total_grade = "C";
            if($gp_avg <= 1.99 && $gp_avg >= 1.00) $total_grade = "D";
            if($gp_avg <= 0.99 && $gp_avg >= 0.00) $total_grade = "F";




            if((count($st_fs)>0)){

                if($gpa < 2) $gp_avg = 0 ; else $gp_avg= $gpa -2;




                if($gp_avg >= 5.00) {$total_grade = "A+"; $gp_avg ="5.00";}
                if($gp_avg <= 4.99 && $gp_avg >= 4.00) $total_grade = "A";
                if($gp_avg <= 3.99 && $gp_avg >= 3.50) $total_grade = "A-";
                if($gp_avg <= 3.49 && $gp_avg >= 3.00) $total_grade = "B";
                if($gp_avg <= 2.99 && $gp_avg >= 2.00) $total_grade = "C";
                if($gp_avg <= 1.99 && $gp_avg >= 1.00) $total_grade = "D";
                if($gp_avg <= 0.99 && $gp_avg >= 0.00) $total_grade = "F";



                $sum_point = $sum_point + $gp_avg;


                if($total_grade=="F"){
                    $fourth_fail =1;
                }


                $html.='<td align="center" style="text-align: center;font-size: 26px;width:100px; "><b>'.$total_grade.'</b></td>';
                $html.='<td align="center" style="text-align: center;font-size: 26px;width:100px"><b>'.$gp_avg.'</b></td>';



            }
            else{




                $sum_point = $sum_point + $gp_avg;
                $count++;


                if($total_grade=="F" || $gp_avg< 1 ){
                    $is_fail=1;
                    $fail_count= $fail_count+1;

                    $html.='<td align="center" style="text-align: center;font-size: 26px;width:100px;color: red "><b>'.$total_grade.'</b></td>';
                    $html.='<td align="center" style="text-align: center;font-size: 26px;width:100px;color: red "><b>'.$gp_avg.'</b></td>';

                }
                else{

                    $html.='<td align="center" style="text-align: center;font-size: 26px;width:100px"><b>'.$total_grade.'</b></td>';
                    $html.='<td align="center" style="text-align: center;font-size: 26px;width:100px;"><b>'.$gp_avg.'</b></td>';

                }

}
            }


        $html.='</tr>

                        </table>
</td>';




}
    $html.='<td><table border="1" style="width: 150px;border-collapse: collapse;font-size: 26px;text-align: center"><tr><td>'.$sum_total.'</td>';

        $grdpoint= "";

    if($fail_count > 0){

        $point_avg =0;
    }
    else{


    if($idclasssection==56)$point_avg = sprintf('%.2f',( $sum_point/ ($count))); else $point_avg = sprintf('%.2f',( $sum_point/ ($count)));

     }

    if($point_avg < 1){

        $point_avg =0;
    }


    if($point_avg >= 5.00) {$total_grade_final = "A+"; $point_avg ="5.00";}
    if($point_avg <= 4.99 && $point_avg >= 4.00) $total_grade_final = "A";
    if($point_avg <= 3.99 && $point_avg >= 3.50) $total_grade_final = "A-";
    if($point_avg <= 3.49 && $point_avg >= 3.00) $total_grade_final = "B";
    if($point_avg <= 2.99 && $point_avg >= 2.00) $total_grade_final = "C";
    if($point_avg <= 1.99 && $point_avg >= 1.00) $total_grade_final = "D";
    if($point_avg <= 0.99 && $point_avg >= 0.00) $total_grade_final = "F";






        if($fail_count > 0){

            $num_st_fail ++;

        $html.='<td style="font-size: 28px;width: 150px;text-align: center;color:red">F('.($fail_count).')</td>';
        }

    elseif($is_fail!=0 && $fourth_fail < 1){

        $html.='<td style="font-size: 26px;width: 150px;text-align: center;color:red">F('.$fail_count.')</td>';
    }

        else{


            $html.='<td style="font-size: 26px;width: 150px;text-align: center">'.$total_grade_final.'</td>';
         }

    $html.='<td style="font-size: 28px;width: 150px;text-align: center">'.$point_avg.'</td>';

   if($fail_count > 0){ 

$html.='<td style="font-size: 26px;width: 150px;text-align: center;color:red">Fail</td>';

}else{


$html.='<td style="font-size: 26px;width: 150px;text-align: center;color:green">Pass</td>';
}

$html.='<td style="font-size: 26px;width: 150px;text-align: center">'.$rnk.'</td>

    ';

    $html.='</tr></table></td></tr>';


    //break;


}






$class_teacher_name = Auth::user()->username;


$html.='</table>
                                        </div>

                                        <br/><br/>

              <div style="width: 100%; text-align: center;font-weight: bold">Total Student:'.$std_no.' , Number of Passed Student: '.($std_no - $num_st_fail).', Number of fail Student: '.$num_st_fail.'</div>
                                        </div>


                                         <div style="position: relative; margin: auto; top: 0; right: 0; bottom: 0; left: 0; width: 850px;">
                                            <br/>                                            
                                            <table style="table-layout: fixed; width: 100%;" >
                                                <tr>
                                                    <td width="50px">
                                                        <img src="./image/grade_.png" height="70px"/>
                                                    </td>
                                                    <td width="133px" style="text-align: center; font-size: 10px">
                                                        <b>Teacher\'s signs
                                                        </td>
                                                <td style="border: 1px solid;">
                                                    
                                                    </td>
                                                    <td width="133px" style="text-align: center; font-size: 10px">
                                                        <b>Class Teacher\'s Signature:
                                                    </td>
                                                    <td width="133px" style="text-align: center; font-size: 10px">
                                                        <br/>
                                                        <br/>
                                                        <hr/>
                                                        Class Teacher
                                                        <br/>
                                                        '.$class_teacher_name.'
                                                        </td>
                                                    <td width="133px" style="text-align: center; font-size: 10px">
                                                        <b>Principal\'s Signature: 
                                                    </td>
                                                    <td width="133px" style="text-align: center; font-size: 10px">
                                                        <img src="./image/ps.jpg" width="80px" height="20px"/>
                                                        <hr/>
                                                        Principal Signature
                                                        <br/>
                                                        Dr. Umme Salema Begum
                                                    </td> 
                                                </tr>
                                            </table>
                                            </div>
                                        </body></html>


                                        </body></html>';



//}


include("mpdf60/mpdf.php");


$mpdf=new mPDF('c','A1-L');
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