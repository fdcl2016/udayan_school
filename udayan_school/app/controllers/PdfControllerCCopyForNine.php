<?php

ini_set('max_execution_time', 300);

ini_set('memory_limit', '-1');



class PdfControllerCCopyForNine extends \BaseController {

    function getStudentResultGrade ($term, $class, $result) {
        
        if($term == 'Half Yearly') {
            /* No need to check */
            $array = array(
                        'grade' => $result->h_grade,
                        'point' => $result->h_gp    
                    );

            return $array;
        }
        

        $sub_pass_mark = Subtot::where('idsubject', $result->idsubject)
                            ->where('class', $class)
                            ->first();
        
        $mark_config = MarksConfiguration::where('configuration_name', $sub_pass_mark->configuration_type)
                            ->groupby('configuration_type')
                            ->get();
        $pass_flag = 1;



                
        foreach($mark_config as $marks) {
            if($pass_flag > 0) {
                /* if only pass flag is true */
                if($marks->configuration_type == "MT") {  // MCQ


                 //   $range = $marks->total_marks;

                    $range = 82;

                    $mark = $result->h_mcq + $result->f_mcq;
            
                    $pass_mark = round($range * 0.4);

                    if($mark < $pass_mark) {

                        $pass_flag = 0;
                    } 

                    if($result->idsubject == 26) {
                        echo $mark."-mcq-".$pass_flag."-".$pass_mark."<br>";
                    }
                } else if ($marks->configuration_type == "HT") { // Hall Test


                 //   $range = $marks->total_marks;

            
                           
                    $range = 138;

                    $mark = $result->h_ht + $result->f_ht;

                    $pass_mark = round($range * 0.4);
                    if($mark < $pass_mark) {
                        $pass_flag = 0;
                    }

                    if($result->idsubject == 26) {
                        echo $mark."-cq-".$pass_flag."-".$pass_mark."<br>";
                    }
                } else if ($marks->configuration_type == "LT" ) { // Lab Test
                   // $range = $marks->total_marks;


                    
                     $range = 45;

                    $mark = $result->h_lab + $result->f_lab;

                    $pass_mark = round($range * 0.4);

                    if($mark < $pass_mark) {
                        $pass_flag = 0;
                    }

                    if($result->idsubject == 26) {
                        echo $mark."-lab-".$pass_flag."-".$pass_mark."<br>";
                    }
                }
            }
        }


    

        

        if($pass_flag ==0) {
            $array = array(
                        'grade' => 'F', 
                        'point' => '0.0',
                    );
        } else {



            $gp = GradingTable::where('total', '=', $sub_pass_mark->gt_total)->where('highest_range', '>=', $result->gt_total)->where('lowest_range', '<=', $sub_pass_mark->gt_total)->first();

            $array = array(
                        'grade' => $gp->grade, 
                        'point' => $gp->gpa,
                    );



        }
        
        return $array;
    }


    function class_nine_report_card() {

        $class = Session::get('class');
        $section = Session::get('section');
        $term = Session::get('term');
        $year = Session::get('year');

        $student_info = StudentToSectionUpdate::where('class', $class)
                            ->where('section', $section)
                            ->where('year', $year)
                            ->leftjoin('studentinfo', 'studentinfo.registration_id', '=', 'student_to_section_update.student_idstudentinfo')
                            ->orderby('student_to_section_update.st_roll', 'ASC')
                            ->get();

        ini_set('max_execution_time', '300M');
        $user=Auth::user()->user_id;

        ob_start();

        ini_set('memory_limit', '-1');

        $html = ob_get_clean();
        $html = utf8_encode($html);

        $html = '<!DOCTYPE html>
        <html>

        <style>
        .table, th, tr {
            text-align: center;
        }

        </style>

        <head>
            <title>Report Card - '.$class.'</title>
        </head>
        <body>';


       



        /* Report Card for each student */
        foreach ($student_info as $student) {

            $html.='<div style="margin-left: auto;margin-right: auto;width: 
                        960px;background-color: ">
                        
                        <div style="width:auto; float: left;text-align: center; margin-top:20px;" >

                            <p style="font-size: 20px; margin-top:20px;font-weight: bold;color:#000066">
                            <img style="margin-top:-40px; margin-right: 10px;"  src="../public/image/4d.gif" width="120" height="70" >'. Config::get('schoolname.school') .'<br/>University Of Dhaka</p>
                            <p style="font-size:18px" >
                                <b><u>ACADEMIC TRANSCRIPT</u></b>
                            </p>
                            <h4><b>'.'Test'.' Exam</b></h4>
                        </div>
                    </div>
                    <br/>
                    
                    <div style="margin-left: auto;width: 960px">

                        <div style="width:120px;float:left;margin-left:12px;margin-top: 2px">';
                    $student_image = Studentinfo::where('registration_id',$student->student_idstudentinfo)->pluck('image');

                    if($student_image) {
                        $html.='<img src = "../public/uploads/'.$student_image.'" width = "80" height = "90" >';
                    }else{
                        $html.='<img src = "../public/image/male.jpg" width = "80" height = "90" >';
                    }

                    if($section=='A-COMMERCE'){

                        $section = 'Business Studies - A';
                    }elseif($section=='B-COMMERCE'){

                        $section = 'Business Studies - B';
                    }else{

                        $section = $section;
                    }
                    $html.= '</div>
                            <div style="width:auto;float: left;margin-left: 12px">

                                <table >

                                    <tr>

                                        <td height="25" style="font-size:14px"><b>Name : </b>'.$student->sutdent_name.'&nbsp;&nbsp;&nbsp;</td>

                                    </tr>

                                    <tr>

                                        <td height="25" style="font-size:14px"><b>Class : </b>'.$class.'&nbsp;&nbsp;&nbsp;&nbsp;<b>Section : </b>'.$section.'</td>

                                    </tr>
                                    <tr>

                                        <td height="25" style="font-size:14px"><b>Roll :&nbsp;'.$student->st_roll.' </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Student ID : </b>'.$student->student_idstudentinfo.'</td>

                                    </tr>
                                    <tr>

                                        <td height="25" style="font-size:14px"><b>Version :</b> &nbsp;BANGLA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> Year : </b>'."2016".'</td>

                                    </tr>


                                </table>


                            </div>

                            <div style="width: 150px;float: right;margin-left: 5px;position:relative;margin-top: -180px;margin-bottom: 20px">';
                    if($student->class== 'NINE' || $student->class== 'TEN'){

                        $html.='<img src="../public/image/grade_.png" width="150" height="210">';

                    }else{

                        $html.='<img src="../public/image/grade_11.png" width="150" height="210">';

                    }


                    $html.='</div>
                        </div>

                        <br/>
                        <div style="width: 100%;float: left;margin-left: 12px;">
                            <table style="border-collapse: collapse;letter-spacing: 1px;width: 100%; font:arial; font-size: 12px" border="1" >
                                <tr style="background-color: lightgrey">
                                    <th></th>
                                    <th colspan="3">Half Yearly</th>
                                    <th colspan="3">Final</th>
                                    <th colspan="3">Total</th>
                                    <th colspan="3">Summary</th>
                                </tr>
                                <tr style="background-color: #E8E8E8; ">
                                    <td style=" font-size: 12px; text-align: center;"><b>Subject</b></td>
                                    <td style=" font-size: 10px; text-align: center; width: 6%"><b>MCQ</b></td>
                                    <td style=" font-size: 10px; text-align: center; width: 6%" ><b>CQ</b></td>
                                    <td style=" font-size: 10px; text-align: center; width: 6%" ><b>Lab</b></td>
                                    <td style=" font-size: 10px; text-align: center; width: 6%" ><b>MCQ</b></td>
                                    <td style=" font-size: 10px; text-align: center; width: 6%" ><b>CQ</b></td>
                                    <td style=" font-size: 10px; text-align: center; width: 6%" ><b>Lab</b></td>
                                    <td style=" font-size: 10px; text-align: center; width: 6%" ><b>MCQ Total</b></td>
                                    <td style=" font-size: 10px; text-align: center; width: 6%" ><b>CQ Total</b></td>
                                    <td style=" font-size: 10px; text-align: center; width: 6%" ><b>Lab Total</b></td>
                                    <td style=" font-size: 10px; text-align: center; width: 6%" ><b>Grand Total</b></td>
                                    <td style=" font-size: 10px; text-align: center; width: 6%" ><b>Grade</b></td>
                                    <td style=" font-size: 10px; text-align: center; width: 6%" ><b>GPA</b></td>
                                </tr>';

                            /* get result foreach subject */
                            $result_info = TStudentResult::where('st_id', $student->student_idstudentinfo)
                                            ->join('subject', 'subject.idsubject', '=', 't_st_result.subjectid')
                                            ->where('t_st_result.class', $class)
                                            ->where('t_st_result.section', $section)
                                            ->where('t_st_result.academic_year', $year)
                                            ->orderby('subject.priority', 'asc')
                                            ->get();
                            
                            $number_of_subjects = 0; // total number of subjects

                            $total =0;
                            $total_grade_point=0;

                            $rank_check =0;
                              $fail_check =0;

                            foreach ($result_info as $result) {

                               
                                 $count=0;

                                //debug


                                $grade = PdfControllerCCopyForNine::getStudentResultGrade ($term, $class, $result);
                                

                                $rank_check = $grade;
                                // if($result->idsubject == 26) {

                                // return "ghapla";
                                // }

                                $total += ($term == 'Final' ? $result->gt_total : $result->h_total);

                                $total_grade_point += $grade['point'];
                                $number_of_subjects++;

                                $html.='<tr>
                                            <td><b>'.$result->subject_name.'</b></td>
                                            <td style="text-align: center">'.$result->h_mcq.'</td>
                                            <td style="text-align: center">'.$result->h_ht.'</td>
                                            <td style="text-align: center">'.$result->h_lab.'</td>
                                            <td style="text-align: center">'.($term == 'Final' ? $result->f_mcq : '-').'</td>
                                            <td style="text-align: center">'.($term == 'Final' ? $result->f_ht : '-').'</td>
                                            <td style="text-align: center">'.($term == 'Final' ? $result->f_lab : '-').'</td>
                                            <td style="text-align: center">'.($term == 'Final' ? $result->h_mcq+$result->f_mcq : $result->h_mcq).'</td>
                                            <td style="text-align: center">'.($term == 'Final' ? $result->h_ht+$result->f_ht : $result->h_ht).'</td>
                                            <td style="text-align: center">'.($term == 'Final' ? $result->h_lab+$result->f_lab : $result->h_lab).'</td>
                                            <td style="text-align: center">'.($term == 'Final' ? $result->gt_total : $result->h_total).'</td>
                                            <td style="text-align: center"><b>'.$grade['grade'].'</b></td>
                                            <td style="text-align: center"><b>'.$grade['point'].'</b></td>
                                        </tr>';


                         
                if($grade['point'] == 0.0 || $grade['point'] == '0.0' || $grade['grade'] == 'F'){

                    $fail_check =1;

                    $rank_check =1;

                }

                $count++;

                            }
                            $html.='    <tr>
                                            <td colspan="10" style="text-align: center"><b>Total Marks And Total Grade Point</b></td>
                                            <td style="text-align: center"><b>'.$total.'</b></td>
                                            <td style="text-align: center">-</td>
                                            <td style="text-align: center"><b>'.sprintf('%.2f', $total_grade_point).'</b></td>
                                        </tr>
                                    </table>';



/********************************** NEW ADD *************************************/





$html.='<div style="width: 980px;float: left;margin-left: 0px;margin-top: 13px"><table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >

            <tr>
                <td>&nbsp;&nbsp;<b>Summary</td> <td style="text-align: center">---------</td>

                 <td style="text-align: center"><b>Merit Position</b></td><td colspan="2" style="text-align: center">Attendance</td>

            </tr>

            <tr>';

            if($fail_check  > 0){

                $gpa = 0.0;

            }else{


                    $gpa = sprintf('%.2f', ($total_grade_point / $number_of_subjects));

           
            }

 $cp = null;



 $cm = "";






            $html.='<td style="font-size:10px">&nbsp;&nbsp;Grade Point Average (GPA</b>)</td><td style="text-align: center">'.$gpa.'</td>';

            
           $html.='<td rowspan="2" style="text-align: center">'."N/A".'</td><td style="text-align: center">Working Days</td><td style="text-align: center">N/A</td>

            </tr>

            <tr>';



            $html.='<td style="font-size:10px">&nbsp;&nbsp;Obtained Marks</td><td style="text-align: center;font-weight: bold">'.$total.'</td><td style="text-align: center" >Attendance</td><td style="text-align: center">N/A</td>

            </tr>

        </table>

    </div>

    <div style="width: 980px;float: left;margin-left: 0px;margin-top: 20px">




        <table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >



            <tr style="border: 1px solid">';

            //    $v = 'Try Hard For Next Exam';


            if($gpa == 5.0 || $gpa == '5.0' )  $cm = "Excellent";
            if($gpa < 5.0 && $gpa >= 4.5 )  $cm = "Good result";
            if($gpa < 4.5 && $gpa >= 4.0 )  $cm = "Good. Try to improve yourself";
            if($gpa < 4.0 && $gpa >= 3.5 )  $cm = "Moderate. Do hardwork";
            if($gpa < 3.5 && $gpa >= 3.0 )  $cm = "Not good. Try to improve yourself";
            if($gpa < 2.5 && $gpa >= 2.0 )  $cm = "You are not upto benchmark";
            if($gpa < 2.0 && $gpa >= 0.0 )  $cm = "Not Saitisfactory. Try hard next time.";

            $html.=' <td style="padding: 6px;text-align: left">
                    <h4 style="margin-top: 1px;"> Remarks : '.$cm.'
                    </h4>
                </td>
            </tr>

        </table>

    </div>

</div>

<div style="width: 980px;float: left;margin-left: 12px;margin-top: 0px;background-color:">
<br/>


 <table>
        <tr >
            <th width="225px"></th>
            <th width="25px"></th>
            <th width="225px"></th>
            <th width="25px"></th>
            <th width="225px"></th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td rowspan="2" style="text-align: center">
                <img src = "../public/image/ps.jpg" width = "200px" height = "60px" />
                <hr/>
                <p style="font-size:10px"><b>Dr. Umme Salema Begum</b></p>
                <p style="font-size:10px">Principal</p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center">
                <!-- <br/> is used to align with the image -->
                <br/><br/>
                <hr/>
                <p style="font-size:10px"><b>'.Auth::user()->username.'</b></p>
                <p style="font-size:10px">Class Teacher</p>
            </td>
            <td></td>
            <td style="text-align: center">
                <!-- <br/> is used to align with the image -->
                <br/><br/>
                <hr/>
                <p style="font-size:10px"><b>Parent\'s/Guardian\'s</b></p>

                <p style="font-size:10px">Signature</p>
            </td>
        </tr>
    </table>
    </div>

        <div style="width: 960px;float: left;margin-top:8px;background-color:">
        <table>
           <tr><th width="960px" style="font-size:12px;text-align:left">

        <br/>
        <br/>
        <h5> Powered By :
      &nbsp;&nbsp;Four D Communications Limited &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Result Published On :
      &nbsp;Dec 14,2016<br/></th>
            </h5>

            </tr>

 </table>
    </div>


';


  $html .= "<pagebreak />";

   // debug for class-9

         // break;
        }
        /* end of for each student */
        $html .= '</body>
        </html>';

        include("mpdf60/mpdf.php");

        $mpdf=new mPDF("c", "A4-P");
        $mpdf->AddPage();

        //$mpdf->SetFont('Times New Roman',"B",12);
        //$mpdf->SetXY(0*10.4, 0.8*15.4);
        //$mpdf->SetTextColor(255,240,255);


        $mpdf->allow_charset_convertion=true;

        $mpdf->charset_in = 'UTF-8';

        $mpdf->writeHTML($html);







        $mpdf->Output('report.pdf','I');


        exit();

    }
}

