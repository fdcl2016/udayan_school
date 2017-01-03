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
                            <a href="{{ URL::to('/result_management/teacher_result_insert')}}">Insert Marks</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/view_marksheet')}}">Mark Sheet</a>
                        </li>
                         <li>
                            <a href="{{ URL::to('/view_tabulationsheet')}}">Tabulation Sheet</a>
                        </li>
                          <li class="active">
                            <a href="{{ URL::to('/submit_marks')}}">Subject Mark Submit</a>
                        </li>
                          <?php 

                          $clt = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->first();

                          if(count($clt)>0){
                          ?>
                           <li>
                             <a href="{{ URL::to('/result_management/st_report_card2')}}">Student Report Card</a>
                        </li>
                        <!-- if class teacher show tab -->
                        <?php 
                          $class_teacher = ClassTeacher::where('idteacherinfo', Auth::user()->user_id)->first(); 
                        ?>
                        @if(!empty($class_teacher))
                        <li>
                          <a href="{{ URL::to('/result_management/custom_report') }}">Custom Report</a>
                        </li>
                        @endif

<?php } ?>
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3 style="color:black">
                        <?php if($class && $section) { echo "Submit Marks for Term: ".$term12.", Session: ".$year12;// echo "Marks Submission"; ?></h3></strong>
                        </div><br/>

                        <div class="fdcl_content_profile"><div class="widget-header" style="text-align: center"><b>Class: {{$class}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Section : {{$section}}</b></div>
                            <table id="example" class="display" cellspacing="0" width="100%">
                                <thead>
                                <tr>


                                    <th class="resource-name">Subject Name</th>
                                    <th class="resource-name">Submitted By</th>
                                    <th class="resource-name">Submitted at</th>
                                    <th class="resource-name">Approved at</th>
                                    <th class="resource-name">Approved</th>

                                </tr>
                                </thead>

                                <tbody>
                                @foreach($plist as $sub)
                                    <tr>

                                        <?php $subname= Subject::where('idsubject','=',$sub->idsubject)->get();
                                         $teacher_name= User::where('email','=',$sub->submitted_by)->pluck('username');
                                         ?>
                                        @foreach($subname as $s)
                                        <td>{{$s->subject_name}} </td>
                                        @endforeach
                                        <td>{{$teacher_name}}</td>
                                        <td>{{$sub->submitted_at}}</td>

                                        <td>{{$sub->approved_at}}</td>
                                        <td style="text-align: center;"><?php $isap=$sub->approved_by; if(!$isap) echo "<font color=RED><i class='icon-remove'></i></font>"; else echo "<font color=GREEN><i class='icon-ok'></i></font>"; ?></td>

                                    </tr>

                                @endforeach
                                </tbody><br>
                            </table>

                    <?php
                     $counts = PublishResult::where('approved','=','Y')->where('class','=',$class)->where('section','=',$section)->where('term','=',$term12)->where('year','=',$year12)->get();
                     $count_a = TabulationSheetEditable::where('approved_by','=','0')->where('class','=',$class)->where('section','=',$section)->where('term','=',$term12)->where('academic_year','=',$year12)->get();
                     $pb_chk = PublishResult::all();
                     $pb_chk =count($pb_chk); if(!$pb_chk )  $pb_chk =1;
                     if(isset($counts))$chk_approved = count($counts); else $chk_approved =0;
                     if(isset($count_a))$chk_all = count($count_a); else $chk_all =0;

/*
                     $user = User::where('email','=',Auth::user()->email)->get();


                     foreach($user as $u){
                     $username = $u->username;
                    }
*/           if(!$chk_approved && !$chk_all && $pb_chk){

                    ?>
                             {{Form::open(['url'=>'post_submitted_marks'])}}

                            {{Form::hidden('year',$year12)}}
                            {{Form::hidden('term',$term12)}}
                             {{Form::hidden('class',$class)}}
                            {{Form::hidden('section',$section)}}



                         <center> <br><button type="submit" class="btn btn-info" id="publishbtn" style="width:220px;" ><i class="icon-download-alt"></i> Submit Marks</button></center>

                        {{Form::close()}}


                       <?php }
                             else
                              {
                              if($chk_all)
                              echo "<br><h4 style='text-align: center; color:red'>Some approval still on pending!</h4>";
                               if($chk_approved)
                                                            echo "<br><h4 style='text-align: center; color:red'>Already Submitted!</h4>";

                               }
                           //else echo "<h2 style='text-align: center; color:green'>No result to publish!</h2>";?>




                            </div>
                            <?php  }
                                                         else {
                                                          echo "<font color=red>Access denied! This arena is accessible only to the class teacher."; ?></font></h3></strong>
                                                                                  </div><br/>
                                                         <?php } ?>
                    </div>

                </div>

            </div>




        </div>
    </div>

    </div>
    <!-- /widget-content -->
 @if(isset($shohag_msg) )<div class="widget-content" style="color: red; text-align: center; font-size: 16px">{{$shohag_msg}}</div> @endif
    </div>
    <!-- /widget -->

    </div> <!-- /span8 -->

@stop
@section('content_footer')
    <script> /*
        $("#cat").on('change',function (e) {
            console.log(e);

            var cat_id = e.target.value;
            cc = cat_id;
            $.get('//echo Config::get('baseurl.url');?/ajax?cat_id=' +cat_id,function(data)
            {

                $('#sub').empty();
//                $('#sub').append('<option value="all">All Section</option>')
                $.each(data,function(index,subcatObj)
                {
                    $('#sub').append('<option value="'+subcatObj.section+'">'+subcatObj.section+'</option>');
                })

            });
        }); */

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


        } );


    </script>
@stop