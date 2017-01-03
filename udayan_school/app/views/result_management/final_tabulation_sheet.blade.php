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
                            <a href="{{ URL::to('/tabulationsheet')}}">Mark Sheet</a>
                        </li >
 <li>
                            <a href="{{ URL::to('/onesubject_tabulationsheet')}}">Subject wise Tabulation Sheet</a>
                        </li>
<li>
                            <a href="{{ URL::to('/studentwise_tabulationsheet')}}">Student wise Tabulation Sheet</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/tabulationsheet_all')}}">Tabulation Sheet</a>
                        </li>
                        <li class="active">
                            <a href="{{ URL::to('/final_tabulationsheet')}}">Final Tabulation Sheet</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/grace_management')}}">Grace Management</a>
                        </li>
                        <li>
                         <a href="{{ URL::to('/result_management/search_report_card')}}">Submission History</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/result_management/publish_result')}}">Publish Result</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/result_management/st_report_card')}}">Student Report Card</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/result_management/admin_custom_report') }}">Custom Report</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Final Tabulation Sheet</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
                            <div class="widget-header"></div>
                            <div class="widget-content">
                                {{Form::open(array('url'=>'/final_tabulationsheet', 'class'=>'form-inline')) }}
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
                                        <label>Select Class:</label>
                                        <select name="cat" id="cat" class="form-control" >
                                            <option value="">Select Class</option>
                                            @foreach($class as $cats)
                                                <option value="{{$cats->class_name}}">{{$cats->class_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Select Section:</label>
                                        <select name="sub" id="sub"  class="form-control">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                      <div class="form-group">
                                    <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-search"></i> Search</button><br>
                                </div>
                                </div>

                                {{Form::close()}}
<?php //$timereq1=0; //echo $stu_results; ?>
                               <br>
                                <div class="table-responsive" style="padding-left:1%;padding-right:1%">
                                    @if($students!=null&&$students!="[]")
<br>
                                        <table cellspacing="0" width="100%" border="0" style="border-collapse: collapse">

                                            <thead>
                                            <tr>
                                                <th><div></div></th> <th colspan="5"><div style="float: left; width: 33%;">Class:&nbsp; {{$classname}}</div>
                                                    <div style="display: inline-block; width: 25%;">Section:&nbsp;{{$sectionname}}</div></th>


                                            </tr>
                                            </thead>
                                        </table>
                                        <br/>
                                        <div style="border:1px solid gray;width:850px; height: 500px;  overflow-y:scroll;overflow-x:scroll;">
                                        <table border="1" cellspacing="0"  border="1" style="border-collapse: collapse">

                                            <tr>
                                            <th rowspan="2" style=" padding-left: 10px;padding-right:10px"><b>Roll</b></th>
                                                <th rowspan="2" style="padding-left: 10px;"><b>Student Name</b></th>
                                                  <?php $std_no = count($students); $sub_no = (count($stu_results))/$std_no;  ?>
                                                @for($i = 0 ; $i<=$sub_no ; $i++)

                                                    @if($i<$sub_no)
                                                    <th  bgcolor="<?php echo "#".rand(111111,999999); ?>" style="color: white; width: 360px; text-align: center">{{$stu_results[$i]->subject}}</th>
                                                    @else
                                                    <th  bgcolor="<?php echo "#".rand(111111,999999); ?>" style="color: white; width: 240px; text-align: center">{{"Total Marks"}}</th>
                                                    @endif
                                                    <?php //array_push($ar, $subject->subject_name); ?>
                                                @endfor
                                            </tr>

                                            <tr>
                                                @for($i = 0 ; $i<=$sub_no ; $i++)
                                                    <td>
                                                    <?php
                                                  /*   $ct=0;
                                                     $rt=0;
                                                     $lt=0;
                                                     $mcq=0;
                                                     $ht=0;
                                                     if ($stu_results[$i]->h_ct != null ) $ct=1;
                                                     if ($stu_results[$i]->h_ra != null) $rt=1;
                                                     if ($stu_results[$i]->h_lab != null)  $lt=1;
                                                     if ($stu_results[$i]->h_mcq != null) $mcq=1;
                                                     if ($stu_results[$i]->h_ht != null)   $ht=1; */
                                                     ?>
                                                        <table border="0" style=" table-layout: auto ;width: auto; border-collapse: collapse">
                                                          <tr>
                                                            <td width="120px">
                                                                <table style="background-color: #19bc9c">
                                                                    <th style="text-align: center; border-left: 1px solid black; border-right: 1px solid black;" colspan="3">Half Yearly</th>
                                                                        <tr>
                                                                            <td  style= "width: 40px; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><b>Total</b></td>
                                                                            <td  style="width: 40px; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><b>Grade</b></td>
                                                                            <td  style="width: 40px; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><b>Point</b></td>
                                                                        </tr>
                                                                  </table>
                                                             </td>
                                                             @if($i<$sub_no)
                                                             <td width="120px">
                                                                <table style="background-color: lightgreen">
                                                                    <th style="text-align: center; border-left: 1px solid black; border-right: 1px solid black;" colspan="3"> Final</th>
                                                                        <tr>
                                                                            <td  style="width: 40px; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><b>Total</b></td>
                                                                            <td  style="width: 40px; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><b>Grade</b></td>
                                                                            <td  style="width: 40px; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><b>Point</b></td>
                                                                        </tr>
                                                                  </table>
                                                             </td><td></td>
                                                             @endif
                                                             <td width="120px">
                                                                <table style=" background-color: #1189c4">
                                                                    <th style=" text-align: center; border-left: 1px solid black; border-right: 1px solid black;" colspan="3">Grand Total</th>
                                                                        <tr>
                                                                            <td  style="width: 40px; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><b>Total</b></td>
                                                                            <td  style="width: 40px; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><b>Grade</b></td>
                                                                            <td  style="width: 40px; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><b>Point</b></td>
                                                                        </tr>
                                                                  </table>
                                                             </td>


                                                          </tr>


                                                        </table>
                                                    </td>
                                                @endfor
                                            </tr><?php $cnt = 0; //echo count($stu_results);  ?>
                                            @for($i=0 ; $i < $std_no ; $i++)

                                            <?php $std = $i*$sub_no; $final_mark=0; $finalgp = 0;
                                             $id = $stu_results[$std]->st_id;
                                             $stu = Studentinfo::where('idstudentinfo','=',$id)->first();

                                             //$student_id = $student->S_ID;  $i=0; ?>
                                                <tr>
                                                    <td style=" padding-left: 10px;"><b>{{$stu->student_roll}}</b></td>
                                                    <td style=" padding-left: 10px;"><b>{{$stu->sutdent_name}}</b></td>
                                                    @for($j = 0 ; $j<= $sub_no ; $j++)
                                                    <?php

                                                        $htotal = 0;
                                                        $hpoint = 0;
                                                        $hgrade = 0;

                                                        $ftotal = 0;
                                                        $fpoint = 0;
                                                        $fgrade = 0;

                                                        $gtotal = 0;
                                                        $gpoint = 0;
                                                        $ggrade = 0;

                                                        if($j<$sub_no){
                                                        $result = $stu_results[$cnt]; $cnt++;

                                                        if($result->h_total != null) $htotal = $result->h_total; else $htotal =0;
                                                        $hpoint = $result->h_gp;
                                                        $hgrade = $result->h_grade;


                                                        if($result->f_total != null) $ftotal = $result->f_total; else $ftotal =0;
                                                        $fpoint = $result->f_gp;
                                                        $fgrade = $result->f_grade;
                                                        $finalgp += $fpoint;
                                                        $final_mark += $ftotal;

                                                          if($result->gt_total != null) $gtotal = ceil($result->gt_total/2); else $tgotal =0;
                                                        $gpoint = $result->gt_gp;
                                                        $ggrade = $result->gt_grade; }

                                                        else
                                                        {

                                                        $htotal = $rankH[$i]->total_mark;
                                                        $hpoint =$rankH[$i]->cgpa;
                                                        $hgrade =$rankH[$i]->grade;

                                                        $gtotal = $rankF[$i]->total_mark;
                                                        $gpoint = $rankF[$i]->cgpa;
                                                        $ggrade = $rankF[$i]->grade;

                                                        $ftotal = $final_mark;
                                                        $fpoint = sprintf("%.2f",$finalgp /$sub_no);
                                                        $fgrade =0;



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
                                                 ?>
                                                            <td >
                                                                <table border="0" style=" table-layout: fixed;width: 250px;height:50px" style="border-collapse:collapse ">
                                                                    <tr>

                                                                    <td align="center" style="background-color: #19bc9c; width: 40px; border-right: 1px solid black;">{{$htotal}}</td>
                                                                    <td align="center" style="background-color: #19bc9c; width: 40px; border-right: 1px solid black;">{{$hpoint}}</td>
                                                                    <td align="center" style="background-color: #19bc9c; width: 40px; border-right: 1px solid black;">{{$hgrade}}</td>
                                                                   @if($j<$sub_no)
                                                                    <td align="center" style="background-color: lightgreen; width: 40px; border-right: 1px solid black;">{{$ftotal}}</td>
                                                                    <td align="center" style="background-color: lightgreen; width: 40px; border-right: 1px solid black; ">{{$fpoint}}</td>
                                                                    <td align="center" style="background-color: lightgreen; width: 40px; border-right: 1px solid black; ">{{$fgrade}}</td>
                                                                    @endif
                                                                    <td align="center" style="background-color: #1189c4; width: 40px; border-right: 1px solid black;">{{$gtotal}}</td>
                                                                    <td align="center" style="background-color: #1189c4; width: 40px; border-right: 1px solid black;">{{$gpoint}}</td>
                                                                    <td align="center" style="background-color: #1189c4; width: 40px; border-right: 1px solid black;">{{$ggrade}}</td>

                                                                        <?php /* $rtotal = $result->total; //echo $rconfig;
                                                                        $gra=GradingTable::where('total','=',$rtotal)->where('highest_range', '>=', $total)->where('lowest_range', '<=', $total)->first();
                                                                       // echo $result->sutdent_name.":-> Total : ".$total ."- >>".$gra. "--:";



                                                                            $grade_l = $gra->grade;
                                                                            $grade_p = $gra->gpa;

                                                                        $rcls=$result->class;

                                                                        if($rcls != "Nine" && $rcls != "Ten")
                                                                         {
                                                                         if($total < ($rtotal/2))
                                                                             {
                                                                                 $grade_p = "0.00";
                                                                                 $grade_l = "F";

                                                                               }
                                                                         }

                                                                        */  ?>

                                                                    </tr>
                                                                </table>
                                                            </td>
                                                       <?php // $i++; break; } } ?>

                                                    @endfor
                                                </tr>
                                            @endfor

                                        </table>
                                        </div>

                                        <br/><br/>

                                        <!--   {{Form::open(['url'=>'pdf_tabulation_sheet_all'])}}

          {{Form::hidden('classname',$classname)}}
          {{Form::hidden('sectionname',$sectionname)}}

          {{Form::hidden('idclasssection',$idclasssection)}}
          {{Form::hidden('year',$year)}}

          <center><input type="submit" class="btn btn-info" style="width:220px;" value="Download as PDF"></center>
       {{Form::close()}} -->

                                    @endif


                                </div>
                            </div>
                        </div>

                    </div> <?php  $timereq2 = date("h")*3600 + date("i")*60 + date("s"); if(isset($timereq1)) echo "<br><center>Total Students : ".count($students).", Execution Time: ".($timereq2 - $timereq1)." Seconds</center>"; ?>
                </div>

            </div>
            <!-- /widget-content -->

        </div>
        <!-- /widget -->

    </div> <!-- /span8 -->

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