application/x-httpd-php PdfController.php ( PHP script text )

<?php


class PdfController extends \BaseController {


    public function pdf($sec,$term,$year){


        function is_type_exist($mark_conf, $type)
        {
            $mark_conf = MarksConfiguration::where('configuration_name','=',$mark_conf)->where('configuration_type','=',$type)->get();

            return count($mark_conf);

        }

        function is_pass($mark_conf, $type, $mark)
        {
            $mark_conf = MarksConfiguration::where('configuration_name','=',$mark_conf)->where('configuration_type','=',$type)->first();
            if($type == "CT" || $type == "RT")
                $range = $mark_conf->total_marks;
            else
                $range =$mark_conf->converted_marks;

            if($type == "LT")
                $percent = 40;
            else
                $percent = 33;
            $pass_limit = round(($range * $percent) / 100);
            if($mark < $pass_limit)
                return 0;
            else
                return 1;

        }
        $ht_chk =0;
        $mcq_chk = 0;
        $lab_chk =0;







        ini_set('max_execution_time', '300M');
        $user=Auth::user()->user_id;

        $servername = "10.36.46.6";
        $username = "iteamsco_udayan";
        $password = "ud@yan123";
        $dbname = "iteamsco_udayan_db";
/*

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "iteamsco_devs_test";

*/
        $conn = new mysqli($servername, $username, $password, $dbname);


//$idclasssection  = "SELECT idclasssection FROM classteacher where idteacherinfo = '$user'";

        $sql = "SELECT student_idstudentinfo FROM student_to_section_update WHERE class = (SELECT class_name FROM addclass where class_id = (SELECT idclasssection FROM classteacher WHERE idteacherinfo = '$user')) AND section = (SELECT section FROM addclass where class_id = (SELECT idclasssection FROM classteacher WHERE idteacherinfo = '$user'))";

///version is need hear

        // $sql="SELECT student_to_section_update.class,studentinfo.student_roll,student_to_section_update.year,student_to_section_update.shift,student_to_section_update.section,studentinfo.sutdent_name FROM student_to_section_update  INNER JOIN studentinfo  ON studentinfo.idstudentinfo = student_to_section_update.student_idstudentinfo AND studentinfo.idstudentinfo=2015900227";


        // $sql="SELECT subject,total,h_total,h_grade h_gp,h_grade FROM t_st_result WHERE st_id=2015900227  GROUP BY subject";

        // $sql="SELECT rank,grade,counter_position FROM student_rank WHERE student_id = 2015900227";

        $result = $conn->query($sql);
        //$id=$conn->query($idclasssection);
        // $row = $result->fetch_assoc();


        //        // $row = $result->fetch_assoc();
        //        // //echo $row['class'];
        //print_r($row);


        ob_start();
        $html = ob_get_clean();
        $html = utf8_encode($html);

        $html='<html>
<head>
</head>
<body>';

        while($row = $result->fetch_assoc()) {

            $stuid=$row["student_idstudentinfo"];



            $sql1="SELECT student_to_section_update.class,student_to_section_update.st_roll,student_to_section_update.year,student_to_section_update.shift,student_to_section_update.section,studentinfo.sutdent_name FROM student_to_section_update  INNER JOIN studentinfo  ON studentinfo.idstudentinfo = student_to_section_update.student_idstudentinfo AND studentinfo.idstudentinfo=2016911310 Order by student_to_section_update.st_roll" ;

            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();

        

            $sql4 ="SELECT idsubject FROM assign_fourth_sub WHERE st_id = 2016911310";
            $result4 = $conn->query($sql4);
            $row4 = $result4->fetch_assoc();

            $r = $row4['idsubject'];





            $sql2="SELECT * FROM converted_marks INNER JOIN subject ON converted_marks.subjectid = subject.idsubject WHERE  converted_marks.st_id = $stuid Order by subject.priority";

            $result2= $conn->query($sql2);
            $row2 = $result1->fetch_assoc();

            $sql3="SELECT rank,grade,counter_position,total_mark,comment,cgpa FROM student_rank WHERE student_id = $stuid";
            $result3 = $conn->query($sql3);
            $row3 = $result3->fetch_assoc();








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
 <h4><b>'.$term.' Exam</b></h4>


    </div>

    
</div>
<br/>
<div style="margin-left: auto;width: 960px">

<div style="width:130px;float:left;margin-left:12px;margin-top: 2px">';
  $im = StudentInfo::where('idstudentinfo','=',$stuid)->where('image','=','')->get();

            $imcnt = count($im);
    $stid = $stuid;
     if($imcnt >0) {

        $html.='<img src = "../public/image/maleandfemale.jpg" width = "80" height = "90" >';

             }else{
         $html.='<img src = "../public/uploads/'.$stid.'.png" width = "80" height = "90" >';
     }

$html.='</div>

 <div style="width:auto;float: left;margin-left: 12px">

        <table >

            <tr>

                <td height="25"><b>Name : </b>'.$row1['sutdent_name'].' &nbsp;&nbsp;&nbsp;</td>

            </tr>

            <tr>

                <td height="25"><b>Class : </b>'.$row1['class'].' &nbsp;<b>Section :</b> '.$row1['section'].' &nbsp;&nbsp;&nbsp;</td>

            </tr>
            <tr>

                <td height="25"><b>Roll : </b>'.$row1['st_roll'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Student ID : </b>'.$stid.' &nbsp;&nbsp;</td>

            </tr>
            <tr>

                <td height="25"><b>Version :</b> &nbsp;BANGLA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> Session : </b>'.$row1['year'].'</td>

            </tr>


        </table>


    </div>

    <div style="width: 150px;float: right;margin-left: 5px;position:relative;margin-top: -200px;margin-bottom: 20px">
        <img src="../public/image/grade.png" width="150" height="210">
    </div>
    </div>
   

    <h3 style="margin-top: 15px;margin-right: 150px"><br/>OBTAINED MARKS</h3>

    ';

            $html.='<div style="width: 100%;float: left;margin-left: 12px;margin-top: 2px">

        
        <table  style="border-collapse: collapse;letter-spacing: 1px;width: 100%;font:arial" border="1" >

            <tr style="text-align: center" >
                <th width="300px" style="font-size: 26px"><b>Subject Name</b></th>
                 <th width="80px" style="font-size: 26px">Full Marks</th>
                <th width="300px" style="font-size: 26px" colspan="3">

                    <table style="border-collapse: collapse;text-align: center;font-size: 26px;letter-spacing: 1px;width: 100%;" border="1">

                        <tr><th colspan="3">Converted Marks</th></tr>
                        <tr>

                            <th width="110px">Creative</th><th width="115px">MCQ</th><th width="110px">Practical</th>
                        </tr>
                    </table>
                </th>
                <th width="100px" style="font-size: 26px;">Obtained Mark</th>

                <th width="80" style="font-size: 26px;">Grade</th>
                <th width="100" style="font-size: 26px;">Grade Point</th>
            </tr>';
            $u=0;
            $v = null;
            $total_m = 0;
            $coun = 0;
            $chk_grd = 0;

            while($row2 = $result2->fetch_assoc()) {

                //echo $row2['subject'];
                //echo $row1['sutdent_name'].' '.$row2['subject'].'<br>';



     $cls = Addclass::where('class_id', '=', $row2['class_id'])->first();
     


                $sub = SubjectToClass::where('class', '=', $row1['class'])->where('idsubject', '=', $row2['subjectid'])->pluck('markconfiguration_name');
                $cls_val = Addclass::where('class_name', '=', $cls->class)->where('section', '=', $sec)->pluck('value');

               $total_marks = TotalMarksConfiguration::where('configuration_type', '=', $sub)->pluck('total');



                $v = 0;

                $sb = Subject::where('idsubject',$row2['subjectid'])->pluck('subject_name');

                // if($term=='Half Yearly'){

          //  if (!(($row2['f_ht'] == 0 && $row2['subjectid'] == '20') || ($row2['f_ht'] == 0 && $row2['subjectid'] == '42'))) {
                    $html .= '

                <tr style="text-align: center ;font-family:arial;font-size:26px">
                    <td width="300px" style="text-align: left;font-size: 24px"><b>' . $sb . '</b></td>
                    <td width="60px" style="font-size:26px;text-align:center"> ' . $total_marks . '</td>
                        <td width="110px" style="font-size:26px;text-align:center">' . $row2['cq_total'] . '</td><td style="font-size:26px;text-align:center" width="107px">' . $row2['mcq_total'] . '</td><td width="110px" style="font-size:26px;text-align:center">' . $row2['practical'] . '</td>


                        <td width="80px" style="font-size:26px;text-align:center">

                           ' . $row2['total'] . '

                    </td>

                    ';

                    //$total_cg = $total_cg + $gpa;
                    $total_m = $total_m + $row2['total'];
                    $coun++;

                    $v = $v + $row2['point'];
                  
                    $html .= '<td width="100" style="text-align: center;font-weight: bold;font-size:26px;">

                            &nbsp;&nbsp;' . $row2['grade'] . '
                       
                           
                     </td>
           <td width="100" style="font-weight: bold;font-size:26px;text-align:center">
                       
                            &nbsp;&nbsp;' . $row2['point']. '
            </td>
       
                </tr>



                ';
                }
          //  }


            $ct = Teacherinfo::where('teacher_id','=',Auth::user()->email)->pluck('teacher_name');


            $html.='<tr style="text-align: center">
                <td colspan="5" style="text-align: center;font-weight: bold;font-size: 26px"> Total Marks And Total Grade Point</td>

                <td style="text-align: center;font-size: 26px">
                    

                    <b>'.$total_m.'</b>

                </td>

                <td></td>
                <td style="text-align: center;font-size: 26px">
                    <b> '.$v.'</b>
                </td>
            </tr>';


            $grp = sprintf('%.2f',($v/$coun));


            $html.='
  </table>


    </div>

<div style="width: 960px;float: left;margin-left: 12px;margin-top: 40px">';



            $html.='<table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >

            <tr>
                <td>&nbsp;&nbsp;<b>Summary</td> <td style="text-align: center"></td>';



            $html.='

                 <td style="text-align: center"><b>Merit Position</b></td><td colspan="2" style="text-align: center">Attendance</td>

            </tr>

            <tr>';
         
                $html.='<td>&nbsp;&nbsp;Grade Point Average (GPA</b>)</td><td style="text-align: center">'.$grp.'</td>';
            


//$student_rank = RankModel::where('stid','=','2016911310')->pluck('rank');

            $html.='<td rowspan="2" style="text-align: center">'."2".'</td><td style="text-align: center">Working Days</td><td style="text-align: center">N/A</td>

            </tr>

            <tr>
                <td>&nbsp;&nbsp;Obtained Marks</td><td style="text-align: center;font-weight: bold">'.$total_m.'</td><td style="text-align: center" >Attendance</td><td style="text-align: center">N/A</td>

            </tr>

        </table>

    </div>';

            $html.='<div style="width: 960px;float: left;margin-left: 12px;margin-top: 40px">




        <table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >



            <tr style="border: 1px solid">';
       //     if($student_rank == '0' || $student_rank== 0 || $student_rank == '0.0'){
          //      $v = 'FAILED';
       //     }else{
                $v = 'Try Hard For Next Exam';
        //    }
            $html.=' <td style="padding: 10px;text-align: left">
                    <h4 style="margin-top: 1px;"> Remarks : '.$v.'
                    </h4>
                </td>
            </tr>

        </table>

    </div>

</div>
';






            $html.='
<div style="width: 960px;float: left;margin-left: 12px;margin-top: 40px;background-color:">
<br/>
<br/>



    <table >
        <tr>


     <th width="250px">

                <hr style="width: 250px;font-family:Arial"/><p style="font-family:Arial">'.$ct.'</p>
                <p>Class Teacher</p>
            </th>

            <th width="100px"></th>

            <th width="150px">

                <hr style="width: 150px;"/>
                <p style="font-family:Arial">Parent\'s/Guardian\'s  Signature</p></th>

<th width="50px"></th>
            <th width="250px">

                <hr style="width: 250px;font-family:Arial"/><p style="font-family:Arial">Dr. Umme Salema Begum</p>
                <p>Principal</p>
            </th>

            <th width="100px"></th>



        </tr>

    </table>
    </div>

        <div style="width: 960px;float: left;margin-top:8px;background-color:">
        <table>
           <tr><th width="960px" style="font-size:12px;text-align:left">

        <br/><br/><br/>
        <h5> Powered By :
      &nbsp;&nbsp;Four D Communications Limited &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Result Published On :
      &nbsp;April 18,2016<br/></th>
            </h5>

            </tr>

 </table>
    </div>


';

       //    break;

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

        $mpdf->SetFont('Times New Roman',"B",14);
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

