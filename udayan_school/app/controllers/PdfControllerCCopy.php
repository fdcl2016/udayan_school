<?php

ini_set('max_execution_time', 300);

ini_set('memory_limit', '-1');


class PdfControllerCCopy extends \BaseController {


    public function pdf($sec,$term,$year){


        ini_set('max_execution_time', '300M');
        $user=Auth::user()->user_id;
        /*
                $servername = "10.36.46.6";
                $username = "iteamsco_udayan";
                $password = "ud@yan123";
                $dbname = "iteamsco_udayan_db";
        */



        $cls = Addclass::where('section',$sec)->first();




        $st = StudentToSectionUpdate::where('section',$sec)->where('year',$year)
            ->leftjoin('studentinfo', 'studentinfo.registration_id', '=', 'student_to_section_update.student_idstudentinfo')
            ->orderby('student_to_section_update.st_roll', 'ASC')->get();

        ob_start();

        ini_set('memory_limit', '-1');


        $html = ob_get_clean();
        $html = utf8_encode($html);

        $html='<html>
<head>
</head>
<body>';



        foreach($st as $s) {


            $html.='
<div style="margin-left: auto;margin-right: auto;width: 960px;background-color: ">
    <div style="width:120px;float: left;margin-top:-40px;margin-left:6px">

          <img style="margin-top:-40px"  src="../public/image/4d.gif"width="120" height="70" >
    </div>


    <div style="width:auto;float: left;text-align: center;margin-right:90px;margin-top:20px" >
        <p style="font-size: 20px;margin-top:20px;font-weight: bold;color:#000066">'. Config::get('schoolname.school') .'<br/>University Of Dhaka</p>
          <p style="font-size:18px" >
<b><u>ACADEMIC TRANSCRIPT</u></b>
        </p>
 <h4><b>'.'Test'.' Exam</b></h4>


    </div>


</div>
<br/>
<div style="margin-left: auto;width: 960px">

<div style="width:120px;float:left;margin-left:12px;margin-top: 2px">';

$stu = Studentinfo::where('registration_id',$s->student_idstudentinfo)->pluck('image');

if($stu){



$html.='<img src = "../public/uploads/'.$stu.'" width = "80" height = "90" >';


}else{



$html.='<img src = "../public/image/male.jpg" width = "80" height = "90" >';
}



if($sec=='A-COMMERCE'){

    $sec = 'Business Studies - A';
}elseif($sec=='B-COMMERCE'){

    $sec = 'Business Studies - B';
}else{

    $sec = $sec;
}

$html.='</div>

 <div style="width:auto;float: left;margin-left: 12px">

        <table >

            <tr>

                <td height="25" style="font-size:12px"><b>Name : </b>'.$s->sutdent_name.'&nbsp;&nbsp;&nbsp;</td>

            </tr>

            <tr>

                <td height="25" style="font-size:12px"><b>Class :</b>'.$s->class.'  &nbsp;<b>Section :</b>'.$sec.'  &nbsp;&nbsp;&nbsp;</td>

            </tr>
            <tr>

                <td height="25" style="font-size:12px"><b>Roll :&nbsp;'.$s->st_roll.' </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Student ID : '.$s->student_idstudentinfo.'</b>&nbsp;&nbsp;</td>

            </tr>
            <tr>

                <td height="25" style="font-size:12px"><b>Version :</b> &nbsp;BANGLA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> Year : '."2016".'</b></td>

            </tr>


        </table>


    </div>

    <div style="width: 150px;float: right;margin-left: 5px;position:relative;margin-top: -180px;margin-bottom: 20px">';

if($s->class== 'NINE' || $s->class== 'TEN'){

        $html.='<img src="../public/image/grade_.png" width="150" height="210">';

}else{

          $html.='<img src="../public/image/grade_11.png" width="150" height="210">';

}


    $html.='</div>
    </div>

<br/>
    <div style="width: 100%;float: left;margin-left: 12px;">



        <table  style="border-collapse: collapse;letter-spacing: 1px;width: 100%;font:arial" border="1" >

           <tr style="text-align: center" >
                <th width="300px" style="font-size: 18px"><b>Subject Name</b></th>
                 <th width="80px" style="font-size: 18px"><b>Full Marks</b></th>

                <th width="300px" style="font-size: 18px" colspan="3">

                    <table style="border-collapse: collapse;text-align: center;font-size: 18px;letter-spacing: 1px;width: 100%;" border="1">

                        <tr><th colspan="3">TOTAL Marks</th></tr>
                        <tr>

                            <th width="110px">Creative</th><th width="115px">MCQ</th><th width="110px">Practical</th>
                        </tr>
                    </table>
                </th>
                <th width="100px" style="font-size: 18px;">Obtained Mark</th>

                <th width="80" style="font-size: 18px;">Grade</th>
                <th width="100" style="font-size: 18px;">Grade Point</th>
            </tr>';


            $fs = AssignFourthSub::where('st_id',$s->student_idstudentinfo)->pluck('idsubject');

      

            $res = ConvertedMarks::where('st_id',$s->student_idstudentinfo)->where('year',$year)
                ->where('converted_marks.subjectid','!=',$fs)
                ->where('term',$term)
                ->leftjoin('subject', 'subject.idsubject', '=', 'converted_marks.subjectid')
                ->orderby('subject.priority', 'ASC')->get();

            $res_fourth = ConvertedMarks::where('st_id',$s->student_idstudentinfo)->where('year',$year)
                ->where('converted_marks.subjectid',$fs)
                ->where('term',$term)
                ->leftjoin('subject', 'subject.idsubject', '=', 'converted_marks.subjectid')
                ->orderby('subject.priority', 'ASC')->get();



            $count = 0;

            $total_m =0;

            $avg_grd = 0;


            $gpa =0;

            $fail_check =0;

            foreach ($res as $result) {

              

                    $tot = Subtot::where('class',$cls->class_name)->where('idsubject',$result->subjectid)->pluck('total');

                    $mx = ConvertedMarks::where('class_id',$cls->class_id)->where('term',$term)->where('subjectid',$result->subjectid)->max('total');



                    $html.='<tr style="text-align: center ;font-family:arial;font-size:18px">
                    <td width="300px" style="text-align: left;font-size: 18px"><b>'.$result->subject_name.'</b></td>';

                     if($tot == '60'){
                        $tot = 50;

                     }else{

                         $tot = $tot;
                     }


                    $html.='<td width="80px" style="text-align: center;font-size: 18px"><b>'.$tot.'</b></td>
                        <td width="110px" style="font-size:20px;text-align:center">'.$result->cq_conv.'</td><td style="font-size:18px;text-align:center" width="107px">'.$result->mcq_conv.'</td><td width="110px" style="font-size:18px;text-align:center">'.$result->practical.'</td>


                        <td width="80px" style="font-size:18px;text-align:center">

                           '.$result->total.'



                    </td>';

                    $total_m = $total_m + $result->total;

                    $avg_grd = $avg_grd + $result->point;

                    if($result->point < 1){
                        $fail_check = 1;
                    }

                    $count++;


                    $html.='<td width="100" style="text-align: center;font-weight: bold;font-size:18px;">

                            &nbsp;&nbsp; '.$result->grade.'


                     </td>
           <td width="100" style="font-weight: bold;font-size:18px;text-align:center">

                            &nbsp;&nbsp; '.$result->point.'
            </td>

                </tr>





 ';




            }



            foreach ($res_fourth as $result) {

                $tot = Subtot::where('class',$cls->class_name)->where('idsubject',$result->subjectid)->pluck('total');

                $mx = ConvertedMarks::where('class_id',$cls->class_id)->where('term',$term)->where('subjectid',$result->subjectid)->max('total');



                $html.='<tr style="text-align: center ;font-family:arial;font-size:20px">
                    <td width="300px" style="text-align: left;font-size: 18px"><b>'.$result->subject_name.' (4th sub)</b></td>
                     <td width="80px" style="text-align: center;font-size: 18px"><b>'.$tot.'</b></td>
                        <td width="110px" style="font-size:18px;text-align:center">'.$result->cq_conv.'</td><td style="font-size:18px;text-align:center" width="107px">'.$result->mcq_conv.'</td><td width="110px" style="font-size:18px;text-align:center">'.$result->practical.'</td>


                        <td width="80px" style="font-size:18px;text-align:center">

                           '.$result->total.'



                    </td>';

                $total_m = $total_m + $result->total;

        if($result->point < 2 )     {

            $r = 0;

        }  else{

            $r = $result->point - 2;
        }

                $avg_grd = $avg_grd + $r;

               //$count++;


                $html.='<td width="100" style="text-align: center;font-weight: bold;font-size:24px;">

                            &nbsp;&nbsp; '.$result->grade.'


                     </td>
           <td width="100" style="font-weight: bold;font-size:24px;text-align:center">

                            &nbsp;&nbsp; '.$r.'
            </td>

                </tr>





 ';

            }




            $str = RankModel::where('stid',$s->student_idstudentinfo)->where('term',$term)->where('year',$year)->first();


            //  }


            //    $ct = Teacherinfo::where('teacher_id','=',Auth::user()->email)->pluck('teacher_name');


            $html.='<tr style="text-align: center">
                <td colspan="5" style="text-align: center;font-weight: bold;font-size: 18px"> Total Marks And Total Grade Point</td>

                <td style="text-align: center;font-size: 18px">


                    <b>'.$total_m.'</b>

                </td>

                <td></td>
                <td style="text-align: center;font-size: 18px">
                    <b>'.$avg_grd.' </b>
                </td>
            </tr>
  </table>


    </div>

<div style="width: 960px;float: left;margin-left: 12px;margin-top: 12px"><table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >

            <tr>
                <td>&nbsp;&nbsp;<b>Summary</td> <td style="text-align: center"></td>

                 <td style="text-align: center"><b>Merit Position</b></td><td colspan="2" style="text-align: center">Attendance</td>

            </tr>

            <tr>';

            if($fail_check == 1){
                $gpa = 0.0;

            }else{

                if($sec == 'C-COMMERCE' && $year=='2015-2016') {
                    $gpa = sprintf('%.2f', ($avg_grd / ($count)));
                }else{

                    $gpa = sprintf('%.2f', ($avg_grd / $count));

                }

            }

 $cp = null;



 $cm = "";



$cp = RankModel::where('stid',$s->student_idstudentinfo)->first();

    if($gpa >5 ) $gpa= '5.0';


            $html.='<td>&nbsp;&nbsp;Grade Point Average (GPA</b>)</td><td style="text-align: center">'.$gpa.'</td>';




if(($cls->val < 12)  && $year=='2015-2016'){

    $cp = RankModel::where('stid',$s->student_idstudentinfo)->first();
}
   else{


   }


     if($gpa == 5.0 || $gpa == '5.0' )  $cm = "Excellent";
            if($gpa < 5.0 && $gpa >= 4.5 )  $cm = "Good result";
            if($gpa < 4.5 && $gpa >= 4.0 )  $cm = "Good. Try to improve yourself";
            if($gpa < 4.0 && $gpa >= 3.5 )  $cm = "Moderate. Do hardwork";
            if($gpa < 3.5 && $gpa >= 3.0 )  $cm = "Not good. Try to improve yourself";
            if($gpa < 3.0 && $gpa >= 2.5 )  $cm = "Not good. Try to improve yourself";
            if($gpa < 2.5 && $gpa >= 2.0 )  $cm = "You are not upto benchmark";
            if($gpa < 2.0 && $gpa >= 0.0 )  $cm = "Not Saitisfactory. Try hard next time.";

           $html.='<td rowspan="2" style="text-align: center">'."cp->rank".'</td><td style="text-align: center">Working Days</td><td style="text-align: center">N/A</td>

            </tr>

            <tr>';



            $html.='<td>&nbsp;&nbsp;Obtained Marks</td><td style="text-align: center;font-weight: bold">'.$total_m.'</td><td style="text-align: center" >Attendance</td><td style="text-align: center">N/A</td>

            </tr>

        </table>

    </div>

    <div style="width: 960px;float: left;margin-left: 12px;margin-top: 15px">




        <table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >



            <tr style="border: 1px solid">';

            //    $v = 'Try Hard For Next Exam';



            $html.=' <td style="padding: 10px;text-align: left">
                    <h4 style="margin-top: 1px;"> Remarks :'.$cm.'
                    </h4>
                </td>
            </tr>

        </table>

    </div>

</div>

<div style="width: 960px;float: left;margin-left: 12px;margin-top: 0px;background-color:">

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
        <h5> Powered By :
      &nbsp;&nbsp;Four D Communications Limited &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Result Published On :
      &nbsp;NOV 07,2016<br/></th>
            </h5>

            </tr>

 </table>
    </div>


';

            //break;

//$mpdf->Image("bdrenlogo.jpg",20,03,0.75*25.4,0.85*25.4,".jpg");

            $html .= "<pagebreak />";

//
            /*
if($fail > 0 ){

    $grp = 0.0;
}else{
    $grp = $grp;
}
*/

            /*

                 $ins = new RankModel();

                 $ins->stid = $stuid;
                 $ins->class = $row1['class'];
                 $ins->section = $row1['section'];
                 $ins->term = $term;
                 $ins->cgpa = $grp;
                 $ins->total = $total_m;

                 $ins->save();

            */

           // break;
        }


        $html.='
</body>
</html>';


        include("mpdf60/mpdf.php");


        $mpdf=new mPDF();
        $mpdf->AddPage();

        //   $mpdf->SetFont('Times New Roman',"B",12);
//$mpdf->SetXY(0*10.4, 0.8*15.4);
//$mpdf->SetTextColor(255,240,255);


        $mpdf->allow_charset_convertion=true;

        $mpdf->charset_in = 'UTF-8';

        $mpdf->writeHTML($html);







        $mpdf->Output('report.pdf','I');


        exit();

        // $stmt ->execute();
        // $result = $stmt ->setFetchMode(PDO::FETCH_ASSOC);

        // foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        //     echo $v;
        // }

//echo $result;
//$courseteacher = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->pluck('idclasssection');


// ob_start();
// $html = '<html>
// <head>
// </head>
// <p>'.$courseteacher.'</p>
// <body>';
// $html.='</body>';
// $html.='</html>';

// include("mpdf60/mpdf.php");

// $mpdf=new mPDF();
// $mpdf->writeHTML($html);

// $mpdf->Output();

// exit();


    }
}

