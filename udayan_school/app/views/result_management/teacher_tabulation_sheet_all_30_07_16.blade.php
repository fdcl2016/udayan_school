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

                                <?php
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
                                ?>



                                {{Form::close()}}
<?php $std_no = count($students);  //$timereq1=0; //echo $stu_results; ?>
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

                                                    ?>
                                                @for($i = 0 ; $i<$sub_no ; $i++)

                                                    <th style="text-align: center; padding-left: 10px;">{{$stu_results[$i]->subject}}</th>
                                                    <?php //array_push($ar, $subject->subject_name); ?>
                                                @endfor
                                                 <th style="text-align: center; padding-left: 10px;">Summary</th>
                                            </tr>

                                            <tr>
                                                @for($i = 0 ; $i<$sub_no ; $i++)
                                                    <td>
                                                    <?php
                                                     $ct=0;
                                                     $rt=0;
                                                     $lt=1;
                                                     $mcq=1;
                                                     $ht=1;
                                                     if ($stu_results[$i]->h_ct != null ) $ct=0;
                                                     if ($stu_results[$i]->h_ra != null) $rt=0;
                                                     if ($stu_results[$i]->h_lab != null)  $lt=1;
                                                     if ($stu_results[$i]->h_mcq != null) $mcq=1;
                                                     if ($stu_results[$i]->h_ht != null)   $ht=1;
                                                     ?>
                                                        <table border="0" style=" table-layout: fixed;width: 250px;" style="border-collapse: collapse">
                                                            <tr>
                                                                    @if($rt)
                                                                    <td align="center" style=" border-right: 1px solid black;">RA</td>
                                                                    @endif
                                                                    @if($ct)
                                                                    <td align="center" style=" border-right: 1px solid black;">CT</td>
                                                                    @endif

                                                                    @if($ht)
                                                                    <td align="center" style=" border-right: 1px solid black;">CQ</td>
                                                                    @endif

                                                                    @if($mcq)
                                                                    <td align="center" style="border-right: 1px solid black; ">MCQ</td>
                                                                    @endif
                                                                     @if($lt)
                                                                    <td align="center" style="  ">Lab</td>
                                                                    @endif

                                                                    <td align="center" style=" border-left: 1px solid black;"><b>Total</b></td>
                                                                    <td align="center" style=" border-left: 1px solid black;"><b>Grade</b></td>
                                                                    <td align="center" style=" border-left: 1px solid black; width: auto"><b>Point</b></td>

                                                            </tr>
                                                        </table>
                                                    </td>
                                                @endfor
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

                                            <?php $cnt = 0;  $total_fail = 0;//echo count($stu_results);   ?>
                                            @for($i=0 ; $i < $std_no ; $i++)

                                            <?php $std = $i*$sub_no; $gp_all =0.0; $all_total = 0; $is_fail =0;
                                             $id = $stu_results[$std]->st_id;
                                             $stu = Studentinfo::where('idstudentinfo','=',$id)->first();
                                             $st_roll_no = $stu_results[$std]->st_roll;

                                             //$student_id = $student->S_ID;  $i=0; ?>
                                                <tr>
                                                    <td style=" padding-left: 10px;"><b>{{$st_roll_no}}</b></td>
                                                    <td style=" padding-left: 10px; width: 100%"><b>{{$stu->sutdent_name}}</b></td>
                                                    @for($j = 0 ; $j< $sub_no ; $j++)
                                                    <?php   $result = $stu_results[$cnt]; $cnt++;
                                                    $sub = SubjectToClass::where('class','=',$classname)->where('idsubject','=',$result->subjectid)->pluck('markconfiguration_name');


                                                    $is_fourth_sub = AssignFourthSub::where('st_id','=',$id)->where('year','=',$year)->first();

                                                    $discarded_sub = FourthSub::where('class_id','=',$idclasssection)->where('type','=',"F")->where('idsubject','!=',$is_fourth_sub->idsubject)->pluck('idsubject');
                                                   // echo "This Sub:".$result->subjectid." Fouth Sub:".$is_fourth_sub->idsubject;

                                                   if($result->subjectid == $is_fourth_sub->idsubject) $is_fourth_sub =1; else $is_fourth_sub=0;

                                                    if($term == "Half Yearly")
                                                    {
                                                        if($result->h_ra != null) $ra_marks = $result->h_ra; else $ra_marks =0;
                                                        if($result->h_ct != null) $ct_marks = $result->h_ct; else $ct_marks =0;
                                                        if($result->h_ht != null) $ht_marks = $result->h_ht; else $ht_marks =0;
                                                        if($result->h_lab != null) $lab_marks = $result->h_lab; else $lab_marks =0;
                                                        if($result->h_mcq != null) $mcq_marks = $result->h_mcq; else $mcq_marks =0;
                                                        if($result->h_total != null) $total = $result->h_total; else $total =0;
                                                        $point = $result->h_gp;
                                                        $grade = $result->h_grade;

                                                    }

                                                    if($term == "Final")
                                                    {
                                                        if($result->f_ra != null) $ra_marks = $result->f_ra; else $ra_marks =0;
                                                        if($result->f_ct != null) $ct_marks = $result->f_ct; else $ct_marks =0;
                                                        if($result->f_ht != null) $ht_marks = $result->f_ht; else $ht_marks =0;
                                                        if($result->f_lab != null) $lab_marks = $result->f_lab; else $lab_marks =0;
                                                        if($result->f_mcq != null) $mcq_marks = $result->f_mcq; else $mcq_marks =0;
                                                        if($result->f_total != null) $total = $result->f_total; else $total =0;
                                                        $point = $result->f_gp;
                                                        $grade = $result->f_grade;

                                                    }
                                            //foreach($stu_results as $result){

                                           // if ($i>= count($students)) break;

                                          //  if($student_id == $result->S_ID && $result->subject_name == $ar[$i]) {

                                            /* $result=StudentResult::where('idclasssection','=',$idclasssection)
                                                                ->where('S_ID','=',$student->S_ID)
                                                                ->where('subject_name','=',$subject->subject_name)
                                                                ->where('Year','=',$year)
                                                                ->where('term','=',$term)->first(); */

                                                 //$total=0;


                                                     $ct=0;
                                                     $rt=0;
                                                     $lt=1;
                                                     $mcq=1;
                                                     $ht=1;
                                                     if ($result->h_ct != null ) $ct=0;
                                                     if ($result->h_ra != null) $rt=0;
                                                     if ($result->h_lab != null)  $lt=1;
                                                     if ($result->h_mcq != null) $mcq=1;
                                                     if ($result->h_ht != null)   $ht=1;



                                                 ?>
                                                            <td >
                                                                <table border="0" style=" table-layout: fixed;width: 250px;height:50px" style="border-collapse:collapse ">
                                                                    <tr>
                                                                    @if($rt)
                                                                    <td align="center" style="border-right: 1px solid black; width: 32px">{{$ra_marks}}</td>
                                                                    @endif


                                                                    @if($ct)
                                                                    <td align="center" style="border-right: 1px solid black; width: 32px">@if($result->subjectid == $discarded_sub) {{"N/A"}} @else{{$ct_marks}} @endif</td>
                                                                    @endif

                                                                    @if($ht)
                                                                    <td align="center" style=" border-right: 1px solid black; width: 32px">@if($result->subjectid == $discarded_sub) {{$ht_marks}} @else {{$ht_marks}} @endif</td>
                                                                    @endif

                                                                    @if($mcq)
                                                                    <td align="center" style="border-right: 1px solid black; width: 32px">@if($result->subjectid == $discarded_sub) {{$mcq_marks}} @else{{$mcq_marks}} @endif</td>
                                                                    @endif
                                                                     @if($lt)
                                                                    <td align="center" style=" width: 32px">@if($result->subjectid == $discarded_sub) {{$lab_marks}} @else {{$lab_marks}} @endif</td>
                                                                    @endif


                                                                        <?php $rtotal = $result->total; //echo $rconfig;
                                                                        $gra=GradingTable::where('total','=',$rtotal)->where('highest_range', '>=', $total)->where('lowest_range', '<=', $total)->first();
                                                                       // echo $result->sutdent_name.":-> Total : ".$total ."- >>".$gra. "--:";



                                                                            $grade_l = $gra->grade;
                                                                            $grade_p = $gra->gpa;

                                                                            if(is_type_exist($sub, "HT"))
                                            {
                                              $chk = is_pass($sub,"HT", $ht_marks);
                                              if(!$chk) {
                                               $grade_p="0.00";
                                                $grade_l="F";
                                                $ht_chk =1; $fail_type= "HT";


                                              }

                                            }
                                            if(is_type_exist($sub, "MT"))
                                            {
                                              $chk = is_pass($sub,"MT", $mcq_marks);
                                              if(!$chk) {
                                               $grade_p="0.00";
                                                $grade_l="F";
                                                $mcq_chk =1; $fail_type= "MT";

                                              }

                                            }
                                            if(is_type_exist($sub, "LT"))
                                            {
                                              $chk = is_pass($sub,"LT", $lab_marks);
                                              if(!$chk) {
                                               $grade_p="0.00";
                                                $grade_l="F";
                                                $lab_chk =1; $fail_type= "LT";

                                              }
                                            }

                                             if(!$is_fourth_sub && $grade_l == "F")  $is_fail ++;
                                             if($idclasssection >= 54 && $idclasssection <= 56)
                                             {
                                                 if($result->subjectid == $discarded_sub && !$ht_marks) $is_fail--;
                                                 $count_sub_no = $sub_no - 2;

                                             }
                                             if($idclasssection >= 50 && $idclasssection <= 53) $count_sub_no = $sub_no - 1;






                                                                            $gp_all += $grade_p;
                                                                            if($is_fourth_sub && $grade_p >= 2) $gp_all -= 2;
                                                                            $all_total += $total;

                                                                        $rcls=$result->class;

                                                                     /*   if($rcls != "Nine" && $rcls != "Ten")
                                                                         {
                                                                         if($total < ($rtotal/2))
                                                                             {
                                                                                 $grade_p = "0.00";
                                                                                 $grade_l = "F";

                                                                               }
                                                                         }
                                                                    $bgcolor="<?php echo '('.rand(200,255).','.rand(200,255).','.rand(10,180).')';
                                                                     */

                                                                          ?>

                                                                            <td align="center" style="border-left: 1px solid black; width: 32px"><b>@if($result->subjectid == $discarded_sub) {{$total}} @else {{$total}} @endif</b></td>
                                                                            <td align="center" style="border-left: 1px solid black; width: 32px"><b>@if($result->subjectid == $discarded_sub) {{$grade_l}} @else @if($grade_l == "F")<font color="red">{{$grade_l}}</font>@else {{$grade_l}} @endif @endif </b></td>
                                                                            <td align="center" style="border-left: 1px solid black; width: 32px"><b>@if($result->subjectid == $discarded_sub) {{$grade_p}} @else {{$grade_p}} @endif</b></td>


                                                                    </tr>
                                                                </table>

                                                    @endfor
 </td>
                                                       <?php $gp_avg = sprintf("%.2f",$gp_all/$count_sub_no);
                                                       if($gp_avg >= 5.00) {$total_grade = "A+"; $gp_avg ="5.00";}
                                                       if($gp_avg <= 4.99 && $gp_avg >= 4.00) $total_grade = "A";
                                                       if($gp_avg <= 3.99 && $gp_avg >= 3.50) $total_grade = "A-";
                                                       if($gp_avg <= 3.49 && $gp_avg >= 3.00) $total_grade = "B";
                                                       if($gp_avg <= 2.99 && $gp_avg >= 2.00) $total_grade = "C";
                                                       if($gp_avg <= 1.99 && $gp_avg >= 1.00) $total_grade = "D";
                                                       if($gp_avg <= 0.99 && $gp_avg >= 0.00) $total_grade = "F";

                                                       if($is_fail)
                                                        {
                                                         $total_grade = "F";
                                                         $gp_avg ="0.00";
                                                         $total_fail++;
                                                        // echo $total_fail;

                                                        } ?>
                                                            <td >
                                                                <table border="0" style=" table-layout: fixed;width: 250px;height:50px" style="border-collapse:collapse ">
                                                                    <tr>

                                                                            <td align="center" style=" width: 32px"><b>{{$all_total}}</b></td>
                                                                            <td align="center" style="border-left: 1px solid black; width: 32px"><b>{{$total_grade}} @if($is_fail){{" (".$is_fail.")"}}@endif</b></td>
                                                                            <td align="center" style="border-left: 1px solid black; width: 32px"><b>{{$gp_avg}}</b></td>


                                                                    </tr>
                                                                </table>
                                                            </td>
                                                </tr>
                                            @endfor

                                        </table>
                                        </div>

                                        <br/><br/>                                        <!--   {{Form::open(['url'=>'pdf_tabulation_sheet_all'])}}

          {{Form::hidden('classname',$classname)}}
          {{Form::hidden('sectionname',$sectionname)}}

          {{Form::hidden('idclasssection',$idclasssection)}}
          {{Form::hidden('year',$year)}}

          <center><input type="submit" class="btn btn-info" style="width:220px;" value="Download as PDF"></center>
       {{Form::close()}} -->

                 
@endif


                                </div>
                            </div>
                        </div><br>
@if(count($students) && count($stu_results))
<div style="width: 100%; text-align: center;font-weight: bold">{{ "Total Student: ".$std_no.", Number of Passed Student: ".($std_no - $total_fail).", Number of fail Student: ".$total_fail;}}</div>@endif
                    </div> <?php

                    $timereq2 = date("h")*3600 + date("i")*60 + date("s"); if(isset($timereq1)) echo "<br><center>Total Students : ".count($students).", Execution Time: ".($timereq2 - $timereq1)." Seconds</center>"; ?>
                </div>

            </div>
            <!-- /widget-content -->
    @if($stu_results == "[]" )<div class="widget-content" style="color: red; text-align: center; font-size: 16px">Result not prepared yet.</div> @endif
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