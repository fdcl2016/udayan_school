@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">

                <i class="icon-list-ul"></i>
                <h3>Publish Result</h3>
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
                        <li>
                            <a href="{{ URL::to('/tabulationsheet_all')}}">Tabulation Sheet</a>
                        </li>
                        <li>
                                <a href="{{ URL::to('/grace_management')}}">Grace Management</a>
                         </li>
                          <li>
                            <a href="{{ URL::to('/final_tabulationsheet')}}">Final Tabulation Sheet</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/result_management/search_report_card')}}">Submission History</a>
                        </li>
                         <li class="active">
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
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3 style="color:black">

                        <?php if ($pterm!=null && $pyear!=null && $src_class!=null) echo "Publish Result for Class: ".$src_class.", Term: ". $pterm.", Session: ".$pyear; else echo "Result Publication"; ?></h3></strong>

                        </div><br/>
                        <div class="widget-content">
                       <div class="widget-content">
                        {{Form::open(array('url'=>'result_management/publish_result', 'class'=>'form-inline')) }}

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
                                    <div class="form-group"><label>Select Term</label>
                                      <select name="term" id="term" class="form-control" >
                                            <option value="Half Yearly">Half Yearly</option>
                                                <option value="Final">Final</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                      <div class="form-group"><br>
                                    <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-search"></i> Search</button><br>
                                </div></div>
                                 {{Form::close()}}

</div>

<?php
if ($pterm!=null && $pyear!=null)
           { //if(isset($sel_classes) ) echo $sel_classes;

                  ?>

                            <table id="example" class="display" cellspacing="0" width="100%">
                                <thead>
                                <tr>

                                    <th class="resource-name">Class Name</th>
                                    <th class="resource-name">Section Name</th>
                                    <th class="resource-name">Class Teacher</th>
                                    <th class="resource-name">Submitted at</th>
                                    <th class="resource-name">Submitted?</th>
                                </tr>
                                </thead>

                                <tbody>
                       @foreach($sel_classes as $cls)
                                <?php $sub = ClassTeacher::where('idclasssection','=',$cls->class_id)->where('academic_year','=',$pyear)->first(); if(count($sub)) $teacherinfo = $sub->idteacherinfo; else $teacherinfo = 0; ?>
                                    <tr>
                                        <td>{{$cls->class_name}} </td>
                                        <td>{{$cls->section}} </td>
                                        <?php $ap_name = User::where('user_id','=',$teacherinfo)->where('type','=',"teacher")->pluck('username'); ?>
                                        <td> @if ($ap_name == "") {{"N/A"}} @else <a target="_blank" href="<?php  echo '../profile_individual/'.$teacherinfo; ?>">{{$ap_name}}</a>@endif</td>
                                       <?php  $plist = PublishResult::where('term','=',$pterm)->where('year','=',$pyear)->where('class','=',$cls->class_name)->where('section','=',$cls->section)->first();
                                        if (count($plist)) {
                                        $ap_at =$plist->approved_at;
                                        $isap=$plist->approved_by;
                                        }
                                        else
                                        {

                                        $ap_at = "N/A";
                                        $isap =0;

                                        }
                                        ?>
                                        <td>@if($ap_at == "N/A"){{$ap_at}} @else {{date('d-m-Y     h:i A',strtotime($ap_at))}}

@endif

</td>
                                        <td style="text-align: center;"><?php  if(!$isap) echo "<font color=RED><i class='icon-remove'></i></font>"; else echo "<font color=GREEN><i class='icon-ok'></i></font>"; ?></td>

                                    </tr>

                                @endforeach
                                </tbody><br>
                            </table>

                    <?php
                     $count = TabulationSheetEditable::where('approved_by','=','0')->where('term','=',$pterm)->where('academic_year','=',$pyear)->where('class','=',$src_class)->get();
                     $chkExist = count(TabulationSheetEditable::where('term','=',$pterm)->where('academic_year','=',$pyear)->where('class','=',$src_class)->get());

                     $c = count($count);
                     $counts = PublishResult::where('published','=','Y')->where('term','=',$pterm)->where('year','=',$pyear)->where('class','=',$src_class)->get();
                     $c_publish = count($counts);
                     $user_id = Auth::user()->email;
/*
                     $user = User::where('email','=',Auth::user()->email)->get();


                     foreach($user as $u){
                     $username = $u->username;
                    }
*/           if(!$c & !$c_publish && $chkExist){

                    ?>
                             {{Form::open(['url'=>'publish'])}}

                            {{Form::hidden('year',$pyear)}}
                            {{Form::hidden('term',$pterm)}}
                             {{Form::hidden('user_id',$user_id)}}


                         <center> <br><button type="submit" class="btn btn-info" id="publishbtn" style="width:220px;" ><i class="icon-download-alt"></i> Publish Result</button></center>

                        {{Form::close()}}


                       <?php }
                             else {

                             if(($c || !$chkExist) && isset($src_class)) echo "<br><h4 style='text-align: center; color:red'>Some approval still on pending!</h4>";
                             if($c_publish) echo "<br><h4 style='text-align: center; color:green'>$pterm Result Published for Class $src_class, Session: $pyear!</h4>";

                             }

                           }
                        //   else if() echo "<h2 style='text-align: center; color:green'>Something went wrong. Check Class and Section!</h2>";?>




                            </div>
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


    </script>

    {{ HTML::style('/media/css/jquery.dataTables.css') }}
    {{--{{ HTML::script('/media/js/jquery.js') }}--}}
    {{ HTML::script('/media/js/jquery.dataTables.js') }}

    <script type="text/javascript" language="javascript" class="init">


        $(document).ready(function() {
            $('#example').dataTable( {
                "aoColumns": [
                    { "orderSequence": [ "asc","desc" ] },
                    { "orderSequence": [ "asc","desc" ] },
                    { "orderSequence": [ "asc","desc" ] },
                    null
                ]
            } );

            $('#publishbtn').click(function() {
                            alert("Done");
                        } );
        } );


    </script>
@stop