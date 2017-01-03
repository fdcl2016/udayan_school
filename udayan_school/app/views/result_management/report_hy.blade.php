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
        @if($term=='Final')
        <h3 style="margin-left: -100px;"><b>Annual Examination</b></h3>
        @else
            <h3 style="margin-left: -100px;"><b>Half Yearly Examination</b></h3>
        @endif

    </div>

    <table width="100%" style="background-color: ">

    </table>
</div>
<div style="margin-left: auto;background-color: ;margin-right: auto;width: 960px;">

    <div style="width: 160px;float: left;margin-left: 12px;margin-top: 30px;">

        <?php 
            if(count($student_info)) { 
        ?>
            <img src="{{asset('/image/maleandfemale.jpg')}}" width="130" height="140">

        <?php 
            } else {
        ?>

            <img src="{{asset('/uploads/'.$idstudent.'.PNG')}}" width="130" height="140">

        <?php } ?>

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
                <td><br/><b>Version :</b> &nbsp;&nbsp;{{$version}}&nbsp;&nbsp;&nbsp;<b> Year :</b> &nbsp;&nbsp;&nbsp;{{ substr($year, 0 , 4) }}
            </tr>


        </table>


    </div>

    <div style="width: 150px;float: left;margin-left: 5px;position:relative;margin-top: -45px;margin-bottom: 20px">
        <img src="{{asset('/image/grade.png')}}" width="190" height="220">
    </div>

    <div style="width: 960px;float: left;margin-left: 12px;margin-top: 25px">
        <?php 
                $result_info = TStudentResult::where('st_id', $idstudent)
                            ->where('t_st_result.class', $class)
                            ->where('academic_year', $year)
                            ->join('subject', 'subject.idsubject', '=', 't_st_result.subjectid')
                            ->orderby('subject.priority', 'ASC')->get();

        ?>
        <?php $total_mark = 0; $number_of_subject = 0; $total_gpa = 0; $gp = 0; ?>
            
        @if($term != 'Final')
        <table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >
            <tr style="text-align: center; ">
                <th rowspan="2" width="28.3%">Subject Name</th>
                <th rowspan="2" width="7.14%">Full Marks</th>
                <th rowspan="2" width="7.14%">Half Yearly</th>
                <th colspan="4" width="18.3%">Marks</th>
                <th rowspan="2" width="8.3%">Total</th>
                <th rowspan="2" width="8.3%">Grade</th>
                <th rowspan="2" width="8.3%">GPA</th>
            </tr>
            <tr style="text-align: center; ">
                <td width="7%"><b>CQ</b></td>
                <td width="7%"><b>MCQ</b></td>
                <td width="7%"><b>Practical</b></td>
                <td width="7%"><b>Total</b></td>
            </tr>
            @foreach($result_info as $result)
            <?php
                $full_mark = SubjectToClass::where('subjecttoclass.class', $class)
                            ->where('subjecttoclass.idsubject', $result->idsubject)
                            ->join('total_marks_with_config', 'total_marks_with_config.configuration_type', '=', 'subjecttoclass.markconfiguration_name')
                            ->pluck('f_total');

                $total_mark += $result->f_total; 
                $total_gpa += $result->f_gp;
                $number_of_subject++;
            ?>
            <tr>
                <td>{{ $result->subject }}</td>
                <td style="text-align: center; ">{{ $full_mark }}</td>
                <td style="text-align: center; ">{{ $result->h_total }}</td>
                <td style="text-align: center; ">{{ $result->f_ct+$result->f_ht }}</td>
                <td style="text-align: center; ">{{ $result->f_mcq }}</td>
                <td style="text-align: center; ">{{ $result->f_lab }}</td>
                <td style="text-align: center; ">{{ $result->f_total }}</td>
                <td style="text-align: center; ">{{ $result->gt_total }}</td>
                <td style="text-align: center; ">{{ $result->gt_grade }}</td>
                <td style="text-align: center; ">{{ $result->gt_gp }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="7" style="padding: 5px; font-weight: bold"> Total Marks and Total Grade Point</td>
                <td style="text-align: center; font-weight: bold">{{ $total_mark }}</td>
                <td style="text-align: center">-</td>
                <td style="text-align: center">
                    <b>{{ sprintf('%01.2f', $total_gpa) }}</b>
                </td>
            </tr>
        </table>
        @endif
        <!-- Report table from half yearly  -->
        @if($term != 'Half Yearly')
        <table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >
            <tr style="text-align: center; ">
                <th rowspan="2" width="28.3%">Subject Name</th>
                <th colspan="4" width="18.3%">Marks</th>
                <th rowspan="2" width="8.3%">Total</th>
                <th rowspan="2" width="8.3%">Grade</th>
                <th rowspan="2" width="8.3%">GPA</th>
            </tr>
            <tr style="text-align: center; ">
                <td width="7%"><b>CQ</b></td>
                <td width="7%"><b>MCQ</b></td>
                <td width="7%"><b>Practical</b></td>
                <td width="7%"><b>Total</b></td>
            </tr>
            @foreach($result_info as $result)
            <?php
                $full_mark = SubjectToClass::where('subjecttoclass.class', $class)
                            ->where('subjecttoclass.idsubject', $result->idsubject)
                            ->join('total_marks_with_config', 'total_marks_with_config.configuration_type', '=', 'subjecttoclass.markconfiguration_name')
                            ->pluck('f_total');

                $total_mark += $result->h_total; 
                $total_gpa += $result->h_gp;
                $number_of_subject++;
            ?>
            <tr>
                <td>{{ $result->subject }}</td>
                <td style="text-align: center; ">{{ $result->h_ct+$result->h_ht+$result->h_ra }}</td>
                <td style="text-align: center; ">{{ $result->h_mcq }}</td>
                <td style="text-align: center; ">{{ $result->h_lab }}</td>
                <td style="text-align: center; ">{{ $result->h_total }}</td>
                <td style="text-align: center; ">{{ $result->h_total }}</td>
                <td style="text-align: center; ">{{ $result->h_grade }}</td>
                <td style="text-align: center; ">{{ $result->h_gp }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5" style="padding: 5px; font-weight: bold"> Total Marks and Total Grade Point</td>
                <td style="text-align: center; font-weight: bold">{{ $total_mark }}</td>
                <td style="text-align: center">-</td>
                <td style="text-align: center">
                    <b>{{ sprintf('%01.2f', $total_gpa) }}</b>
                </td>
            </tr>
        </table>
        @endif
        <!-- end of half yearly report -->
    </div>

    <!-- Rank section for both final and half yearly -->
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
                if($student_rank->cgpa == 5.0 || $student_rank->cgpa  == 5.0 )  $remark = "Excellent";
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
</body>
</html>