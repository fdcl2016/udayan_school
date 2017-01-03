<html>
<head>
</head>
<body>
<div style="margin-left: auto;margin-right: auto;width: 960px; ">
    <div style="width: 160px;float: left;margin-left: 12px;margin-top: 10px;">
        <?php

            $idstudent = Auth::user()->email;
            $student_name = Auth::user()->username;

            $student_info = Studentinfo::where('registration_id','=', $idstudent)->get();

            $version = "BANGLA";
        ?>
        <img src="{{asset('/image/4d.gif')}}" width="110" height="70">


    </div>

    <div style="width: 750px;float: left;text-align: center;margin-top: 25px" >
        <h1 style="margin-left: -100px;color:#2b4167;font-family: Arial"><?php echo Config::get('schoolname.school');?></h1><p style="font-size: 22px;margin-left: -100px;color: #2b4167;font-weight: bold;font-family: Arial">
             University of Dhaka
        </p>

        <h3 style="margin-left: -100px;"><b>ACADEMIC TRANSCRIPT</b><hr style="width: 300px"></h3>


<?php 



if($term=='Final' && $class=='ELEVEN')

{
  echo '<h3 style="margin-left: -100px;"><b>Second Semester Examination</b></h3>';
}

 else if($term=='Final' && $class=='TWELVE'){

  echo '<h3 style="margin-left: -100px;"><b>TEST Examination</b></h3>';

}


else if($term=='Half Yearly' && ($class=='ELEVEN' || $class=='TWELVE'))
{

echo '<h3 style="margin-left: -100px;"><b>First Semester Examination</b></h3>';
}
 else{

echo '<h3 style="margin-left: -100px;"><b>'.$term.'Examination</b></h3>';
}
?>


    </div>

    <table width="100%" style="background-color: ">

    </table>
</div>
<div style="margin-left: auto;background-color: ;margin-right: auto;width: 960px;">

    <div style="width: 160px;float: left;margin-left: 12px;margin-top: 30px;">

        <?php 
         

$stu = Studentinfo::where('registration_id',$idstudent)->pluck('image');

if($stu){

?>



<img src = "{{asset('/uploads/'.$stu)}}" width = "110" height = "120" >

<?php
}else{

?>
<img src="{{asset('/image/maleandfemale.jpg')}}" width="130" height="140">
<?php
}




 ?>

    </div>

    <div style="width: 600px;float: left;margin-left: 3px;margin-top: 25px">

        <table >

            <tr>

                <td><b>Name : </b>{{$student_name}}</td>

            </tr>

            <tr height="20">

                <td><br/><b>Class : </b>{{$class}}&nbsp;&nbsp;&nbsp;<b>Section : </b> {{$section}}
                </td>

            </tr>
            <tr>

                <td><br/><b>Roll : </b>{{$student_roll}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Student ID :</b> &nbsp;&nbsp;{{$idstudent}}</td>

            </tr>
            <tr>
                <td><br/><b>Version :</b> &nbsp;&nbsp;{{$version}}&nbsp;&nbsp;&nbsp;<b> Session:</b> &nbsp;&nbsp;&nbsp;{{$year}}&nbsp;&nbsp;&nbsp;</td>

            </tr>


        </table>


    </div>

    <div style="width: 150px;float: left;margin-left: 5px;position:relative;margin-top: -45px;margin-bottom: 20px">
        <img src="{{asset('/image/grade_11.png')}}" width="190" height="220">
    </div>

    <div style="width: 960px;float: left;margin-left: 12px;margin-top: 25px">

        <!--  Start of result table  -->
        <table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >

            <tr style="text-align: center;font-family: Arial">
                <th width="360px" >Subject Name</th>
                <th width="300px" style="" colspan="3">

                    <table style="border-collapse: collapse;text-align: center;letter-spacing: 1px;width: 100%;" border="1">
                        <tr>Marks</tr>
                        <tr>
                            <td width="110px">Creative</td><td width="115px">MCQ</td><td width="110px">Practical</td>
                        </tr>

                    </table>
                </th>
                <th width="100px" style="">Total Marks</th>
                <th width="80" style="">Grade</th>
                <th width="100" style="">GPA</th>
            </tr>
            <?php
                $result_info = ConvertedMarks::where('st_id', $idstudent)
                                ->where('term', $term)
                                ->where('year', $year)
                                ->join('subject', 'subject.idsubject', '=', 'converted_marks.subjectid')
                                ->orderby('subject.priority', 'ASC')->get();

                $fourth_subject_id = AssignFourthSub::where('year', $year)
                                    ->where('st_id', $idstudent)
                                    ->pluck('idsubject');   
            ?>
            <!-- foreache -->
            <!-- Total mark and number of subjectdeclaration-->
            <?php 
                $total_mark = 0; 
                $number_of_subject = 0; 
                $total_gpa = 0; 
                $gp = 0; 
                $fourth_subject_name = "";
                $fourth_subject_cq_conv = "";
                $fourth_subject_mcq_conv = "";
                $fourth_subject_practical = "";
                $fourth_subject_total = "";
                $fourth_subject_grade = "";
                $fourth_subject_point = "";
            ?>
            
            @foreach($result_info as $result)

            <!-- Total mark initialization-->
            <?php 
                if ($result->subjectid == $fourth_subject_id) {
                    /* saving fourth subject's info to print at the bottom of the table */
                    $fourth_subject_name = $result->subject_name." <b>(4th subject)";  
                    $fourth_subject_cq_conv = $result->cq_conv;
                    $fourth_subject_mcq_conv = $result->mcq_conv;
                    $fourth_subject_practical = $result->practical;
                    $fourth_subject_total = $result->total;
                    $fourth_subject_grade = $result->grade;
                    $fourth_subject_point = $result->point;
                    $total_gpa += ($result->point > 2 ? $result->point - 2 : 0);
                } else {
                    $subject_name = $result->subject_name; 
                    $total_gpa += $result->point;
                    $number_of_subject++;
                }
                $total_mark += $result->total; 
            ?>
            <!-- print results except for fourth subject's -->
            @if(!($result->subjectid == $fourth_subject_id))
            <tr>
                <td >{{ $subject_name }}</td>
                <td style="text-align: center; width: 100px">{{ $result->cq_conv }}</td>
                <td style="text-align: center; width: 100px">{{ $result->mcq_conv }}</td>
                <td style="text-align: center; width: 100px">{{ $result->practical }}</td>
                <td style="text-align: center">{{ $result->total }}</td>
                <td style="text-align: center">{{ $result->grade }}</td>
                <td style="text-align: center">{{ $result->point }}</td>
            </tr>
            @endif
            @endforeach
            <!-- fourth subject's result -->
            <tr>
                <td >{{ $fourth_subject_name }}</td>
                <td style="text-align: center; width: 100px">{{ $fourth_subject_cq_conv }}</td>
                <td style="text-align: center; width: 100px">{{ $fourth_subject_mcq_conv }}</td>
                <td style="text-align: center; width: 100px">{{ $fourth_subject_practical }}</td>
                <td style="text-align: center">{{ $fourth_subject_total }}</td>
                <td style="text-align: center">{{ $fourth_subject_grade }}</td>
                <td style="text-align: center">{{ $fourth_subject_point }}</td>
            </tr>
            <!-- end of foreach -->
            <tr style="text-align: center">
                <td colspan="4" style="text-align: center; font-weight: bold"> Total Marks and Total Grade Point</td>
                <td style="text-align: center; font-weight: bold">{{ $total_mark }}</td>
                <td>-</td>
                <td>
                    <b>{{ sprintf('%01.2f', $total_gpa) }}</b>
                </td>
            </tr>

        </table>
        <!-- end of result table -->
    </div>

    <div style="width: 960px;float: left;margin-left: 12px;margin-top: 40px">
        <!-- Student rank  -->
        <?php
            $student_rank = RankModel::where('stid', $idstudent)
                            ->where('term', $term)
                            ->where('year', $year)->first();
        ?>

        <!-- start of rank table -->
        <table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >

            <tr>
                <td>&nbsp;&nbsp;<b>Result Summary</b></td><td style="text-align: center"></td>
                <td style="text-align: center"><b>Merit Position</b></td>
                <td colspan="2" style="text-align: center"><b>Attendance</b></td>
            </tr>

            <tr>
                <td>&nbsp;&nbsp;<b>Grade Point Average (GPA</b>)</td>
                <td style="text-align: center; font-weight: bold">{{ sprintf('%01.2f',$student_rank->cgpa) }}</td>
                <td rowspan="2" style="text-align: center;font-size:24px"><b>{{ $student_rank->rank }}</b></td>
                <td style="text-align: left">&nbsp;Working Days</td><td style="text-align: center">N/A</td>

            </tr>

            <tr>
                <td>&nbsp;&nbsp;Total Marks</td><td style="text-align: center;font-weight: bold">{{ $total_mark }}</td>
                <td style="text-align: left">&nbsp;Attendance</td><td style="text-align: center">N/A</td>

            </tr>

        </table>
        <!-- end of rank table -->
        
    </div>


    <div style="width: 960px;float: left;margin-left: 12px;margin-top: 40px">




        <table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >

            <!-- remark generator -->
            <?php
                if($student_rank->cgpa == 5.0 || $student_rank->cgpa  == '5.0' )  $remark = "Excellent";
                if($student_rank->cgpa  < 5.0 && $student_rank->cgpa  >= 4.5 )  $remark = "Good result";
                if($student_rank->cgpa  < 4.5 && $student_rank->cgpa  >= 4.0 )  $remark = "Good. Try to improve yourself";
                if($student_rank->cgpa  < 4.0 && $student_rank->cgpa  >= 3.5 )  $remark = "Moderate. Do hardwork";
                if($student_rank->cgpa  < 3.5 && $student_rank->cgpa  >= 3.0 )  $remark = "Not good. Try to improve yourself";
                if($student_rank->cgpa  < 2.5 && $student_rank->cgpa  >= 2.0 )  $remark = "You are not upto benchmark";
                if($student_rank->cgpa  < 2.0 && $student_rank->cgpa  >= 0.0 )  $remark = "Not Saitisfactory. Try hard next time.";
            ?>      

            
            <tr style="border: 1px solid">
                <td style="padding: 10px;text-align: left">
                    <p style="margin-top: 1px;"> <b>Remarks :</b> 
                        {{ $remark }}
                    </p>
                </td>
            </tr>

        </table>
        <!-- end of remark table -->
    </div>


</div>

<div style="width: 960px;  margin-left: 200px; margin-right: auto">

    <table width="100%" style="padding-top: 20px">

        <tr>
            <td style="text-align: center;">Powered By : Four D Communications Limited</td> 
        </tr>

    </table>

</div>
<br/>

</body>
</html>