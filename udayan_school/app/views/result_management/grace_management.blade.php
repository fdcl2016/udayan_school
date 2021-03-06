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
                        </li>
 <li>
                            <a href="{{ URL::to('/onesubject_tabulationsheet')}}">Subject wise Tabulation Sheet</a>
                        </li>
<li>
                            <a href="{{ URL::to('/studentwise_tabulationsheet')}}">Student wise Tabulation Sheet</a>
                        </li>
                        <li >
                            <a href="{{ URL::to('/tabulationsheet_all')}}">Tabulation Sheet</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/final_tabulationsheet')}}">Final Tabulation Sheet</a>
                        </li>
                        <li class="active">
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
                                        style="color:black">Failed Students</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
                            <div class="widget-header"></div>
                            <div class="widget-content">
                                {{Form::open(array('url'=>'/grace_management', 'class'=>'form-inline')) }}
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Select Year:</label>
                                        <select name="year" id="year" class="form-control">
                                            <option value="">Select Year</option>
                                            <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get(); $count = 0; ?>
                                            @foreach($academic_year as $years)
                                                <option value="{{$years->academic_year}}">{{$years->academic_year}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
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
                                <div class="col-sm-4">
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
                                @if (isset($is_pub))
                                         @if($is_pub== 0)
                                          <br><div style="margin-left:30%; color: #ff0000; font-size: 20px;"> {{"Final result has not published for this class yet."}}</div>
                                         @endif
                                      @endif
                                </div>

                                <div class="table-responsive" style="padding-left:1%;padding-right:1%">
                                    @if($results!=null&&$results!="[]")

                                
                                     {{Form::close()}}
                                     {{Form::open(['url'=>'/grace_management_filter'])}}
                                     {{Form::hidden('syear',$year)}}
                                     {{Form::hidden('ssec',$sectionname)}}
                                     {{Form::hidden('sclass',$classname)}}
     <center> <br><table>
      <tr style="width: auto"><td >Filter by Grace : </td><td>
      <input type="text" name="grace" /></td>
      <td>
      <button type="submit" class="btn btn-info" id="cat2f"><i class="icon-search"></i>Filter</button></td></tr>
                                    </table></center><br>
                                                                     {{Form::close()}}


                                        <table cellspacing="0" width="100%" border="0" style="border-collapse: collapse">

                                            <thead>
                                            <tr>
                                                <th><div></div></th> <th colspan="5"><div style="float: left; width: 33%;">Class:&nbsp;                   {{$classname}}</div>
                                                    <div style="display: inline-block; width: 25%;">Section:&nbsp;{{$sectionname}}</div></th>

                                            </tr>
                                            </thead>
                                        </table>
                                        <br/>

                                        <div id="addclass" style=" align-content:center; border:1px solid gray;width:auto; height: 450px;  overflow-y:scroll;overflow-x:hidden;">
                                           <div class="table-responsive">
                                               <table class="table table-bordered table-striped">
                                                   <thead>
                                                      <tr>
                                                        <th class="resource-link" style="width:11%">Roll</th>
                                                        <th class="resource-name">Student Name</th>
                                                        <th class="resource-link" style="width:11%"># of failed subjects</th>
                                                        <th class="resource-link" style="width:11%">Details</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                            <?php $std_no = count($students); $sub_no = (count($results))/$std_no; $cnt=0; $pass_std = array(); ?>
                                             @for($i=0 ; $i < $std_no ; $i++)
                                                    <?php  $fail=0; $fail1=0; $new_fail=1;  $std = $i*$sub_no; $id = $results[$std]->st_id; ?>
                                                    @if($id == $rank[$i]->student_id && $rank[$i]->pass_type == "fail")
                                                @for($j = 0 ; $j< $sub_no ; $j++)

                                                        <?php
                                                       /* $result=StudentResult::where('idclasssection','=',$idclasssection)
                                                                                ->where('S_ID','=',$student->S_ID)
                                                                                ->where('subject_name','=',$subject->subject_name)
                                                                                ->where('Year','=',$year)->get(); */
                                                         $rslt = $results[$cnt]; $cnt++;
                                                        // $rtm=0; $ctm=0; $htm=0; $ltm=0; $mcqm=0; $tmm=0;


                                                         $total = $rslt->total;
                                                         /*

                                                         if(isset($rslt->RT_Marks)) $rtm=$rslt->RT_Marks; else $rtm= 0;
                                                         if(isset($rslt->CT_Marks))$ctm = $rslt->CT_Marks; else $ctm= 0;
                                                         if(isset($rslt->HT_Marks)) $htm = $rslt->HT_Marks; else $htm= 0;
                                                         if(isset($rslt->LT_Marks)) $ltm = $rslt->LT_Marks; else $ltm= 0;
                                                         if(isset($rslt->MCQ_Marks)) $mcqm = $rslt->MCQ_Marks; else $mcqm = 0;

                                                         $tmm=$rtm + $ctm +$htm +$ltm +$mcqm; */
                                                         $tmm = $rslt->gt_total;
                                                         $tmm = ceil($tmm/2);

                                                         $gg = GradingTable::where('total','=',$total)->where('grade','=','F')->first();
                                                         if($gg->grade != "A+" && ($gg->highest_range - $tmm)== 0)
                                                            {
                                                            $tmm++;
                                                            $gg = GradingTable::where('total','=',$total)->where('highest_range', '>=', $tmm)->where('lowest_range', '<=', $tmm)->first();
                                                            }
                                                          //  echo $tmm.", ".$gg->highest_range.", ".$rslt->config."--->";
                                                         $hr=$gg->highest_range;

                                                         if($rslt->class != "Nine" && $rslt->class != "Ten") $hr = ($total/2) -1;
                                                         $prev_hr = $hr;
                                                         if(isset($filters))
                                                         {
                                                            $filter= round(($filters * $total)/100);
                                                            $hr = $hr-$filter;
                                                         }
                                                         if($tmm <= $prev_hr) $fail++;

                                                         if($filters)  if($tmm <= $hr) $fail1++;


                                                         /* $gg=GradingTable::where('total','=',$total)->where('grade','=','F')->first();
                                                         $hr=$gg->highest_range;


                                                         $grd = $rslt->gt_grade;
                                                         $gp = $rslt->gt_gp;
                                                         $tmm= $rslt->gt_total;
                                                         $tmm = ceil($tmm / 2);

                                                         if(isset($filters)
                                                         {
                                                            $tmm= $rslt->gt_total;
                                                            $tmm = ceil($tmm / 2);
                                                            $filter= round(($filters * $total)/100);
                                                            $tmm = $tmm+$filter;
                                                            $gg = GradingTable::where('total','=',$total)->where('highest_range', '>=', $tmm)->where('lowest_range', '<=', $tmm)->first();
                                                            //$grd=$gg->grade;

                                                         }


                                                         if($rslt->class != "Nine" && $rslt->class != "Ten")
                                                         {
                                                           $hr= ($total/2) -1;
                                                           if($grd == "C" || $grd == "D")
                                                            {
                                                            $grd="F";
                                                            $gp="0.00";
                                                            }

                                                         }
                                                         if($grd == "F") $fail++; */

                                                         ?>

                                                   @endfor
                                                   @else
                                                         <?php $cnt = $cnt +$sub_no; ?>
                                                         @endif
                                                   <?php $new_fail= $fail -$fail1; if(!$filters) $fail1 =$fail; ?>

                            @if($fail > 0 && $fail1) <?php $count++; ?>
                                       <tr style="color: red">
                                                    <?php $stu = Studentinfo::where('idstudentinfo','=',$id)->first();  ?>

                                                    <td><b>{{$stu->student_roll}}</b></td>
                                                    <td><b>{{$stu->sutdent_name}}</b></td>
                                                    <td><b>{{$fail1}}</b></td>
                                                    <td><a href="{{ URL::to('/failedstudentdetails/'.$id.'/Final/'.$results[$std]->academic_year)}}" target="_blank" class="btn btn-primary"><span><i class="icon-external-link"></i></span></a></td>



                                                </tr>
                                                @endif


                            @if($fail > 0 && !$fail1)
                                       <tr style="color: green">
                                                    <?php $stu = Studentinfo::where('idstudentinfo','=',$id)->first(); array_push($pass_std,$id);  ?>

                                                    <td><b>{{$stu->student_roll}}</b></td>
                                                    <td><b>{{$stu->sutdent_name}}</b></td>
                                                    <td><b>{{"Passed with grace"}}</b></td>
                                                    <td><a href="{{ URL::to('/failedstudentdetails/'.$id.'/Final/'.$results[$std]->academic_year)}}" target="_blank" class="btn btn-primary"><span><i class="icon-external-link"></i></span></a></td>

                                                </tr>
                                                @endif
                                            @endfor


                                        </table>
                                        </div>
                                        </div>
                                        <br>
                                        <center><?php

                                         echo "Total Number of Students : ".count($students)." | No. of failed students: ".$count; if(isset($filters)) if($filters>0) echo " with ".$filters."% grace"; ?>
                                         </center>
                                        <br/><br/>
                                        @if($filters)

           {{Form::open(['url'=>'grace_grant'])}}

          {{Form::hidden('classname',$classname)}}
          {{Form::hidden('sectionname',$sectionname)}}

          <?php if(count($pass_std)) Session::set('newpass_std', $pass_std); ?>
          {{Form::hidden('filters',$filters)}}
          {{Form::hidden('year',$year)}}

          <center><input type="submit" class="btn btn-info" style="width:120px;" value="Grant"></center>
       {{Form::close()}}
       @endif


                                    @endif

                                </div>


                            </div>

                        </div>


                    </div>
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