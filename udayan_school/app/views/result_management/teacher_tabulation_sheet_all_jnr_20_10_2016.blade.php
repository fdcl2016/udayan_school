@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">
            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Result Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li>
                            <a href="{{ URL::to('/result_management/teacher_result_insert')}}">Insert Marks</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/view_marksheet')}}">Mark Sheet</a>
                        </li>
                        <li class="active">
                            <a href="{{ URL::to('/view_tabulationsheet')}}">Tabulation Sheet</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/submit_marks')}}">Subject Mark Submit</a>
                        </li>
                        <?php

                        $clt = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->first();

                        if(count($clt)>0){
                        ?>
                        <li>
                            <a href="{{ URL::to('/result_management/st_report_card2')}}">Student Report Card</a>
                        </li>

                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Tabulation Sheet</h3></strong></div><br/>

                        <?php
                        if(isset($msg)) {
                            echo $msg;
                        }
                        ?>
                        <div class="widget-header"></div>
                        <div class="widget-content" >
                            {{Form::open(array('url'=>'/view_tabulationsheet', 'class'=>'form-inline')) }}
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Select Year:</label>
                                    <select name="year" id="year" class="form-control">
                                        <option value="">Select Year</option>
                                        <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();?>
                                        @foreach($academic_year as $years)
                                            <option value="{{$years->academic_year}}">{{$years->academic_year}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Select Term:</label>
                                    <select name="term" id="term" class="form-control">
                                        <option value="Half Yearly">Half Yearly</option>
                                        <option value="Final">Final</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Select Class & Section:</label>
                                    <select name="cat" id="cat" class="form-control" >

                                        <?php $idclass = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->get(); ?>
                                        @foreach($idclass as $cats)
                                            <?php $classname12 = Addclass::where('class_id','=',$cats->idclasssection)->first();?>
                                            <option value="{{$cats->idclasssection}}">{{$classname12->class_name}} {{$classname12->section}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-search"></i> Search</button><br>
                                </div>
                            </div>




                            {{Form::close()}}
                            <?php $std_no = count($students);  //$timereq1=0; //echo $stu_results;

                            $subname = TStudentResult::where('idclasssection',$idclasssection)
                                    ->leftjoin('subject', 'subject.idsubject', '=', 't_st_result.subjectid')
                                    ->orderby('subject.priority', 'ASC')
                                    ->groupBy('t_st_result.subjectid')->get();


                            $st = StudentToSectionUpdate::where('section',$sectionname)->where('year',$year)
                                    ->leftjoin('studentinfo', 'studentinfo.registration_id', '=', 'student_to_section_update.student_idstudentinfo')
                                    ->orderby('student_to_section_update.st_roll', 'ASC')->get();

                            ?>
                            <br>
                            <div class="table-responsive" style="padding-left:1%;padding-right:1%">

                                @if(count($students) && count($stu_results))
                                    <br>
                                    <table cellspacing="0" width="100%" border="0" style="border-collapse: collapse">

                                        <thead>
                                        <tr>
                                            <th><div></div></th> <th colspan="5"><div style="float: left; width: 33%;">Class:&nbsp; {{$classname}}</div>
                                                <div style="display: inline-block; width: 25%;">Section:&nbsp;{{$sectionname}}</div><div style="display: inline-block; width: 25%;">Term:&nbsp;{{$term}}</div></th>


                                        </tr>
                                        </thead>
                                    </table>
                                    <br/>
                                    <div style="border:1px solid gray;width:1080px; height: 500px;  overflow-y:scroll;overflow-x:scroll;">
                                        <table border="1" cellspacing="0"  border="1" style="border-collapse: collapse">

                                            <tr>
                                                <th rowspan="2" style=" padding-left: 10px;padding-right:10px"><b>Roll</b></th>
                                                <th rowspan="2" style=" padding-left: 10px;"><b>Student Name</b></th>
                                                <?php $std_no = count($students); $sub_no = (count($stu_results))/$std_no;
                                                $cls_val = Addclass::where('class_id','=',$idclasssection)->pluck('value');
                                                $count_sub_no = $sub_no;

                                                $sb = ConvertedMarks::where('class_id',$idclasssection)->get();

                                                $num_st_fail = 0;


                                                ?>

                                                @foreach($subname as $s)

                                                    <th style="text-align: center; padding-left: 10px;font-size: 14px">{{$s->subject_name}}</th>

                                                @endforeach
                                                <th style="text-align: center; padding-left: 10px;">Summary</th>
                                            </tr>

                                            <tr>
                                                @foreach($subname as $s)
                                                    <td>

                                                        <table border="0" style=" table-layout: fixed;width: 350px;" style="border-collapse: collapse">
                                                            <tr>



                                                                <td align="center" style=" border-right: 1px solid black;width:45px">RA</td>
                                                                <td align="center" style=" border-right: 1px solid black;width:45px">CT</td>
                                                                <td align="center" style=" border-right: 1px solid black;width:45px">CQ</td>

                                                                <td align="center" style="border-right: 1px solid black;width:45px">MCQ</td>

                                                                <td align="center" style=" border-left: 1px solid black;width:45px">Lab</td>

                                                                <td align="center" style=" border-left: 1px solid black;width:45px"><b>Total</b></td>
                                                                <td align="center" style=" border-left: 1px solid black;width:45px"><b>Grade</b></td>
                                                                <td align="center" style=" border-left: 1px solid black;width:45px"><b>Point</b></td>

                                                            </tr>
                                                        </table>
                                                    </td>
                                                @endforeach
                                                <td>
                                                    <table border="0" style=" table-layout: fixed;width: 250px;" style="border-collapse: collapse">
                                                        <tr>


                                                            <td align="center" style=" border-left: 1px solid black;"><b>Total</b></td>
                                                            <td align="center" style=" border-left: 1px solid black;"><b>Grade</b></td>
                                                            <td align="center" style=" border-left: 1px solid black; width: auto"><b>GPA</b></td>

                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <?php

                                            $count  = 0;  $sum_total = 0;
                                            $sum_grade = "";
                                            $is_fail  = 0;
                                            $fail_count = 0;
                                            $total_fail = 0;$total=0; $avg_gp = 0; ?>


                        @foreach($st as $s)

                                            <?php $count  = 0;  $sum_total = 0;$is_fail  = 0;
                                            $fail_count = 0;
                                            $sum_grade = "";
                                            $sum_point = 0;

                                            ?>

                                            <tr>
                                                <td style=" padding-left: 10px;"><b>{{$s->st_roll}}</b></td>
                                                <td style=" padding-left: 10px; width: 100%"><b>{{$s->sutdent_name}}</b></td>






                                                @foreach($subname as $s1)
                                                    <?php

                                                    $re = TStudentResult::where('st_id',$s->student_idstudentinfo)->where('academic_year',$year)
                                                           ->where('idclasssection',$idclasssection)
                                                            ->where('subjectid',$s1->idsubject)
                                                            ->first();






                                                    if(count($re))
                                                    {
                                                        if($term=="Half Yearly")    {

                                                            $ra = $re->h_ra;
                                                            $ct = $re->h_ct;
                                                            $ht = $re->h_ht;
                                                            $mcq = $re->h_mcq;
                                                            $lab = $re->h_lab;
                                                            $tot = $re->h_total;
                                                            $grade = $re->h_grade;
                                                            $gp_avg = $re->h_gp;

                                                        }else{

                                                            $ra = $re->g_ra;
                                                            $ct = $re->g_ct;
                                                            $ht = $re->g_ht;
                                                            $mcq = $re->g_mcq;
                                                            $lab = $re->g_lab;
                                                            $tot = $re->g_total;
                                                            $grade = $re->g_grade;
                                                            $gp_avg = $re->g_gp;

                                                        }

                                                    }
                                                    else
                                                    {
                                                        $ra = "NA";
                                                        $ct = "NA";
                                                        $ht = "NA";
                                                        $mcq = "NA";
                                                        $lab = "NA";
                                                        $tot = 0;
                                                        $grade = "NA";
                                                        $gp_avg = 0;
                                                    }


                                                    //   $total_mark = Subtot::where('class',$classname)->where('idsubject',$re->subjectid)->pluck('total');







                                                    ?>
                                                    <td >
                                                        <table border="0" style=" table-layout: fixed;width: 250px;height:50px" style="border-collapse:collapse ">
                                                            <tr>



                                                                <td align="center" style=" border-right: 1px solid black; width:45px">{{$ra}} </td>

                                                                <td align="center" style="border-right: 1px solid black; width:45px">{{$ct}}</td>

                                                                <td align="center" style=" width: 45px;border-right: 1px solid black;">{{$ht}}</td>
                                                                <td align="center" style="width:45px;border-right: 1px solid black;">{{$mcq}}</td>
                                                                <td align="center" style=" width:45px;border-right: 1px solid black;">{{$lab}}</td>


                                                                            <?php



                                                                            $sum_total = $sum_total + $tot;
                                                                            $sum_point = $sum_point + $gp_avg;



                                                                            ?>



                                                                            <td align="center" style=" width: 45px;border-right: 1px solid black;">{{$tot}}</td>


                                                                            @if($grade =="F"|| $grade=='F' )

                                                                                <?php
                                                                       $is_fail=1;
                                                                        $fail_count++;

                                                                    ?>


                                                                                <td align="center" style=" width:45px;border-right: 1px solid black;color:red">{{$grade}}</td>

                                                                            @else
                                                                                <td align="center" style="width:45px;border-right: 1px solid black;">{{$grade}}</td>


                                                                            @endif

                                                                            <td align="center" style="width:45px;">{{$gp_avg}}</td>




                                                                     <?php
                                                                            $count++;



                                                                            ?>











                                                                {{--<td align="center" style="border-left: 1px solid black; width: 32px"><b>@if($result->subjectid == $discarded_sub) {{$total}} @else {{$total}} @endif</b></td>--}}
                                                                {{--<td align="center" style="border-left: 1px solid black; width: 32px"><b>@if($result->subjectid == $discarded_sub) {{$grade_l}} @else @if($grade_l == "F")<font color="red">{{$grade_l}}</font>@else {{$grade_l}} @endif @endif </b></td>--}}
                                                                {{--<td align="center" style="border-left: 1px solid black; width: 32px"><b>@if($result->subjectid == $discarded_sub) {{$grade_p}} @else {{$grade_p}} @endif</b></td>--}}


                                                            </tr>
                                                        </table>


                                                    </td>
                                                @endforeach

                                                <td >
                                                    <table border="0" style=" table-layout: fixed;width: 250px;height:50px" style="border-collapse:collapse ">
                                                        <tr>

                                                            <td align="center" style=" width: 32px"><b>{{$sum_total}}</b></td>

                                                            <?php

                                                            if($is_fail==1){

                                                                $grade_point = 0;
                                                            }
                                                            else{

                                                                if($idclasssection==56){

                                                                    $grade_point = sprintf("%.2f",($sum_point/($count-1)));

                                                                }else{

                                                                    $grade_point = sprintf("%.2f",($sum_point/($count)));

                                                                }
                                                            }

                                                            if($grade_point >= 5.00) {$avg_grade = "A+"; $grade_point ="5.00";}
                                                            if($grade_point <= 4.99 && $grade_point >= 4.00) $avg_grade = "A";
                                                            if($grade_point <= 3.99 && $grade_point >= 3.50) $avg_grade = "A-";
                                                            if($grade_point <= 3.49 && $grade_point >= 3.00) $avg_grade = "B";
                                                            if($grade_point <= 2.99 && $grade_point >= 2.00) $avg_grade = "C";
                                                            if($grade_point <= 1.99 && $grade_point >= 1.00) $avg_grade = "D";
                                                            if($grade_point <= 0.99 && $grade_point >= 0.00) $avg_grade = "F";




                                                            ?>



                                                            @if($avg_grade=="F")

                                                                <?php
                                                                $num_st_fail++;
                                                                ?>
                                                                <td align="center" style="border-left: 1px solid black;color:red ;width: 32px"><b>

                                                                        {{"F ("}}{{$fail_count}} {{")"}} </b></td>
                                                            @else
                                                                <td align="center" style="border-left: 1px solid black; width: 32px"><b>

                                                                        {{$avg_grade}} </b></td>

                                                            @endif


                                                            <td align="center" style="border-left: 1px solid black; width: 32px"><b>{{$grade_point}}</b></td>




                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </table>
                                    </div>

                                    <br/><br/>

                                    {{Form::open(['url'=>'pdf_tabulation_sheet_all_new_jnr'])}}

                                    {{Form::hidden('classname',$classname)}}
                                    {{Form::hidden('sectionname',$sectionname)}}
                                    {{Form::hidden('term',$term)}}
                                    {{Form::hidden('idclasssection',$idclasssection)}}
                                    {{Form::hidden('year',$year)}}

                                    <center><input type="submit" class="btn btn-info" style="width:220px;" value="Download as PDF"></center>
                                    {{Form::close()}}


                                @endif


                            </div>
                        </div>
                    </div><br>
                    @if(count($students) && count($stu_results))
                        <div style="width: 100%; text-align: center;font-weight: bold">{{ "Total Student: ".$std_no.", Number of Passed Student: ".($std_no - $num_st_fail).", Number of Failed Student: ".$num_st_fail;}}</div>@endif
                </div> <?php

                $timereq2 = date("h")*3600 + date("i")*60 + date("s"); if(isset($timereq1)) echo "<br><center>Total Students : ".count($students).", Execution Time: ".($timereq2 - $timereq1)." Seconds</center>"; ?>
            </div>

        </div>
        <!-- /widget-content -->
        @if($stu_results == "[]" )<div class="widget-content" style="color: red; text-align: center; font-size: 16px">Result not prepared yet.</div>


        @endif
    </div>
    <!-- /widget -->

    <!-- /span8 -->

@stop
@section('content_footer')
    <script>
        $("#cat").on('change', function (e) {
            console.log(e);
            var cat_id = e.target.value;
            $.get('<?php echo Config::get('baseurl.url');?>/ajax5?cat_id=' + cat_id, function (data) {
                $('#sub').empty();
                $.each(data, function (index, subcatObj) {
                    $('#sub').append('<option value="' + subcatObj.section + '">' + subcatObj.section + '</option>');
                })

            });
        });


        i = 0;

    </script>
@stop