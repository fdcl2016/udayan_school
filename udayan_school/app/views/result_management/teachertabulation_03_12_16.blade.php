<?php

ini_set('max_execution_time', 300);

ini_set('memory_limit', '-1');


$stu_results=TStudentResult::where('class', '=', $class)
        ->where('section','=',$section)
        ->where('academic_year','=',$year)
        ->orderby('st_id', 'ASC')->orderby('subject', 'ASC')->get();


$st = StudentToSectionUpdate::where('section',$section)->where('year',$year)
        ->leftjoin('studentinfo', 'studentinfo.registration_id', '=', 'student_to_section_update.student_idstudentinfo')
        ->orderby('student_to_section_update.st_roll', 'ASC')->get();


//$fs = AssignFourthSub::where('st_id',$s->student_idstudentinfo)->pluck('idsubject');

//if($fs){
//   $fs = $fs;
//}else{

$fs = 21;
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


$subname = ConvertedMarks::where('class_id',$idclasssection)
        ->leftjoin('subject', 'subject.idsubject', '=', 'converted_marks.subjectid')
        ->orderby('subject.priority', 'ASC')
        ->groupBy('converted_marks.subjectid')->get();


$std_no = count($students);




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
 <h4><b>'.$term.' Exam&nbsp;-'.$year.'</b></h4>


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

 <table   border="1" cellspacing="1"  style="border-collapse: collapse;">
                            <tr style="text-align: center; width:100%;">MCQ</tr>

                            <tr>
                                <td style="text-align: center;font-size: 26px;" width="100px">CT</td><td style="text-align: center;font-size: 26px;width:10%">CQ</td><td style="text-align: center;font-size: 26px;width:10%">Total</td>
                                <td style="text-align: center;font-size: 26px;width:10%">CT</td><td style="text-align: center;font-size: 26px;width:10%">MCQ</td><td style="text-align: center;font-size: 26px;width:10%">Total</td>
                                <td align="center" style="text-align: center;font-size: 26px;width:12% "><b>Practical</b></td><td align="center" style="text-align: center;font-size: 26px;width:10% "><b>Total</b></td><td align="center" style="text-align: center;font-size: 26px;width:10% "><b>Grade</b></td><td align="center" style="text-align: center;font-size: 26px;width:10% "><b>GPA</b></td>
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
            $ct_cq = "NA";
            $ct_tot = "NA";
            $ct_conv = "NA";
            $ct_mcq = "NA";
            $ct_mtot = "NA";
            $ct_mcq_conv = "NA";
            $prac = "NA";
            $grade = "NA";
            $gpa = 0;
            $tot = 0;

        }


        $st_fs = AssignFourthSub::where('st_id',$s->student_idstudentinfo)->where('class_id',$idclasssection)->where('idsubject',$s1->idsubject)->get();




        $html.='<td>

<table   border="1" cellspacing="1"  style="border-collapse: collapse;">
                            <tr style="text-align: center; width:100%;">MCQ</tr>

                            <tr>
                                <td style="text-align: center;font-size: 26px;" width="100px">'.$ct_cq.'</td><td style="text-align: center;font-size: 26px;width:10%">'.$ct_tot.'</td><td style="text-align: center;font-size: 26px;width:10%">'.$ct_conv.'</td>
                                <td style="text-align: center;font-size: 26px;width:10%">'.$ct_mcq.'</td><td style="text-align: center;font-size: 26px;width:10%">'.$ct_mtot.'</td><td style="text-align: center;font-size: 26px;width:10%">'.$ct_mcq_conv.'</td>
                                <td align="center" style="text-align: center;font-size: 26px;width:12% "><b>'.$prac.'</b></td>';



        if($grade=="NA"){

            $html.='<td align="center" style="text-align: center;font-size: 26px;width:10% "><b>'.$tot.'</b></td><td align="center" style="text-align: center;font-size: 26px;width:10% "><b>'.$grade.'</b></td><td align="center" style="text-align: center;font-size: 26px;width:10% "><b>'.$gpa.'</b></td>';



        }
        else{

            $html.='<td align="center" style="text-align: center;font-size: 26px;width:10% "><b>'.$tot.'</b></td>';



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


                $html.='<td align="center" style="text-align: center;font-size: 26px;width:10%; "><b>'.$total_grade.'</b></td>';
                $html.='<td align="center" style="text-align: center;font-size: 26px;width:10% "><b>'.$gp_avg.'</b></td>';



            }
            else{




                $sum_point = $sum_point + $gp_avg;
                $count++;


                if($total_grade=="F" || $gp_avg<1 ){
                    $is_fail=1;
                    $fail_count= $fail_count+1;

                    $html.='<td align="center" style="text-align: center;font-size: 26px;width:10%;color: red "><b>'.$total_grade.'</b></td>';
                    $html.='<td align="center" style="text-align: center;font-size: 26px;width:10%;color: red "><b>'.$gp_avg.'</b></td>';

                }
                else{

                    $html.='<td align="center" style="text-align: center;font-size: 26px;width:10%"><b>'.$total_grade.'</b></td>';
                    $html.='<td align="center" style="text-align: center;font-size: 26px;width:10%;"><b>'.$gp_avg.'</b></td>';

                }

}
            }


        $html.='</tr>

                        </table>
</td>';




}
    $html.='<td><table border="1" style="width: 150px;border-collapse: collapse;font-size: 26px;text-align: center"><tr><td>'.$sum_total.'</td>';

        $grdpoint= "";

    if($fail_count>0){

        $point_avg =0;
    }
    else{


    if($idclasssection==56)$point_avg = sprintf('%.2f',( $sum_point/ ($count))); else $point_avg = sprintf('%.2f',( $sum_point/ ($count)));

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

        $html.='<td style="font-size: 28px;width: 150px;text-align: center;color:red">F('.($fail_count).')</td>';
        }

    elseif($is_fail!=0 && $fourth_fail==0){

        $html.='<td style="font-size: 26px;width: 150px;text-align: center;color:red">F('.$fail_count.')</td>';
    }

        else{


            $html.='<td style="font-size: 26px;width: 150px;text-align: center">'.$total_grade_final.'</td>';
         }

    $html.='<td style="font-size: 26px;width: 150px;text-align: center">'.$point_avg.'</td>';

    $html.='</tr></table></td></tr>';


}







$html.='</table>
                                        </div>

                                        <br/><br/>

              <div style="width: 100%; text-align: center;font-weight: bold">Total Student:'.$std_no.' , Number of Passed Student: '.($std_no - $num_st_fail).', Number of fail Student: '.$num_st_fail.'</div>
                                        </div></body></html>';



//}


include("mpdf60/mpdf.php");


$mpdf=new mPDF('c','A4-L');
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