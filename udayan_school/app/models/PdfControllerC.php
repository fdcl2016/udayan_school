<?php


class PdfControllerC extends \BaseController {


    public function pdf($sec,$term,$year){







        ini_set('max_execution_time', '300M');
        $user=Auth::user()->user_id;
/*
        $servername = "10.36.46.6";
        $username = "iteamsco_udayan";
        $password = "ud@yan123";
        $dbname = "iteamsco_udayan_db";
*/

     



        $st = StudentToSectionUpdate::where('section','MOYNA')->where('year',$year)
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
 <h4><b>'.$term.' Exam</b></h4>


    </div>

    
</div>
<br/>
<div style="margin-left: auto;width: 960px">

<div style="width:130px;float:left;margin-left:12px;margin-top: 2px">


<img src = "../public/uploads/'."2016911101".'.png" width = "80" height = "90" >

</div>

 <div style="width:auto;float: left;margin-left: 12px">

        <table >

            <tr>

                <td height="25"><b>Name : </b>'.$s->sutdent_name.'&nbsp;&nbsp;&nbsp;</td>

            </tr>

            <tr>

                <td height="25"><b>Class :</b>'.$s->class.'  &nbsp;<b>Section :</b>'.$sec.'  &nbsp;&nbsp;&nbsp;</td>

            </tr>
            <tr>

                <td height="25"><b>Roll :&nbsp;'.$s->st_roll.' </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Student ID : '.$s->student_idstudentinfo.'</b>&nbsp;&nbsp;</td>

            </tr>
            <tr>

                <td height="25"><b>Version :</b> &nbsp;BANGLA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> Session : '.$year.'</b></td>

            </tr>


        </table>


    </div>

    <div style="width: 150px;float: right;margin-left: 5px;position:relative;margin-top: -180px;margin-bottom: 20px">
        <img src="../public/image/grade.png" width="150" height="210">
    </div>
    </div>
   

    <div style="width: 100%;float: left;margin-left: 12px;">

     

        <table  style="border-collapse: collapse;letter-spacing: 1px;width: 100%;font:arial" border="1" >

            <tr style="text-align: center" >
                <th width="300px" style="font-size: 22px"><b>Subject Name</b></th>
                 <th width="80px" style="font-size: 20px">Full Marks</th>
                
                <th width="100px" style="font-size: 20px;">Obtained Mark</th>

                <th width="100px" style="font-size: 20px;"> Highest Mark </th>

                <th width="80" style="font-size: 20px;">Grade</th>
                <th width="100" style="font-size: 20px;">Grade Point</th>
            </tr>';




            $res = TStudentResult::where('st_id',$s->student_idstudentinfo)
                                 ->leftjoin('subject', 'subject.idsubject', '=', 't_st_result.subjectid')
                                 ->orderby('subject.priority', 'ASC')->get();


                     foreach ($res as $result) {
                                 	
                     	$tot = Subtot::where('idsubject',$result->subjectid)->pluck('total');

                     $mx = TStudentResult::where('section',$sec)->where('subjectid',$result->subjectid)->max('h_total');                 

          $html.='<tr style="text-align: center ;font-family:arial;font-size:26px">
                    <td width="300px" style="text-align: left;font-size: 24px"><b>'.$result->subject.'</b></td>
                    <td width="60px" style="font-size:20px;text-align:center"> '.$tot.'</td>
                        <td width="110px" style="font-size:20px;text-align:center">'.$result->h_total.'</td><td width="100px" style="font-size:20px;text-align:center">'.$mx.'</td>


                       

                    <td width="100" style="text-align: center;font-weight: bold;font-size:18px;">

                            &nbsp;&nbsp; '.$result->h_grade.'
                       
                           
                     </td>
           <td width="100" style="font-weight: bold;font-size:18px;text-align:center">
                       
                            &nbsp;&nbsp; '.$result->h_gp.'
            </td>
       
                </tr>





 ';

                }
          //  }


        //    $ct = Teacherinfo::where('teacher_id','=',Auth::user()->email)->pluck('teacher_name');


            $html.='<tr style="text-align: center">
                <td colspan="3" style="text-align: center;font-weight: bold;font-size: 20px"> Total Marks And Total Grade Point</td>

                <td style="text-align: center;font-size: 26px">
                    

                    <b>80</b>

                </td>

                <td></td>
                <td style="text-align: center;font-size: 24px">
                    <b> 100</b>
                </td>
            </tr>
  </table>


    </div>

<div style="width: 960px;float: left;margin-left: 12px;margin-top: 15px"><table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >

            <tr>
                <td>&nbsp;&nbsp;<b>Summary</td> <td style="text-align: center"></td>

                 <td style="text-align: center"><b>Merit Position</b></td><td colspan="2" style="text-align: center">Attendance</td>

            </tr>

            <tr>

            <td>&nbsp;&nbsp;Grade Point Average (GPA</b>)</td><td style="text-align: center">4.00</td>

            <td rowspan="2" style="text-align: center">2</td><td style="text-align: center">Working Days</td><td style="text-align: center">N/A</td>

            </tr>

            <tr>
                <td>&nbsp;&nbsp;Obtained Marks</td><td style="text-align: center;font-weight: bold">80</td><td style="text-align: center" >Attendance</td><td style="text-align: center">N/A</td>

            </tr>

        </table>

    </div>

    <div style="width: 960px;float: left;margin-left: 12px;margin-top: 20px">




        <table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >



            <tr style="border: 1px solid">';
     
                $v = 'Try Hard For Next Exam';

            $html.=' <td style="padding: 10px;text-align: left">
                    <h4 style="margin-top: 1px;"> Remarks : '.$v.'
                    </h4>
                </td>
            </tr>

        </table>

    </div>

</div>

<div style="width: 960px;float: left;margin-left: 12px;margin-top: 0px;background-color:">
<br/>
<br/>



    <table >
        <tr>


     <th width="250px">

                <hr style="width: 250px;font-family:Arial"/><p style="font-family:Arial">ABC</p>
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

