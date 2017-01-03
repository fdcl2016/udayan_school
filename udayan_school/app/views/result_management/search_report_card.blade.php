@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">


                <i class="icon-list-ul"></i>
                <h3>Submission History</h3>
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
                            <a href="{{ URL::to('/final_tabulationsheet')}}">Final Tabulation Sheet</a>
                        </li>
                        <li>
                                <a href="{{ URL::to('/grace_management')}}">Grace Management</a>
                         </li>

                        <li class="active">
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

                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3 style="color:black">
                        <?php  if ($pterm!=null && $pyear!=null) echo "Viewing Submission History For Term: ".$pterm.", Session: ".$pyear; else echo "Result Publication"; ?></h3></strong>
                        </div><br/>
                        <div class="widget-content"><div class="widget-content">
                        <div class="col-sm-3">
                                    <div class="form-group">
                                     {{Form::open(array('url'=>'result_management/search_report_card', 'class'=>'form-inline')) }}
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
                                <div class="col-sm-3">
                                      <div class="form-group"><br>
                                    <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-search"></i> Search</button><br>
                                </div></div>
                                 {{Form::close()}}</div>

<?php
if ($pterm!=null && $pyear!=null)
           {
         if(isset($search_class) && isset($search_section) )
         $plist = TabulationSheetEditable::where('exam_type','=','HT')->where('term','=',$pterm)->where('academic_year','=',$pyear)->where('class','=',$search_class)->where('section','=',$search_section)->get();
         else
         $plist = TabulationSheetEditable::where('exam_type','=','HT')->where('term','=',$pterm)->where('academic_year','=',$pyear)->get();

                  ?>

                            <table id="example" class="display" cellspacing="0" width="100%">
                                <thead>
                                <tr>

                                    <th class="resource-name">Class Name</th>
                                    <th class="resource-name">Section Name</th>
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
                                        <td>{{$sub->class}} </td>
                                        <td>{{$sub->section}} </td>
                                        <?php $subname= Subject::where('idsubject','=',$sub->idsubject)->get(); ?>
                                        @foreach($subname as $s)
                                        <td>{{$s->subject_name}} </td>
                                        @endforeach
                                        <?php
                                        $prf=User::where('email',$sub->submitted_by)->first();
                                        ?>

                                        <td><a target="_blank" href="<?php echo '../profile_individual/'.$prf->user_id; ?>"> {{$prf->username}}</a></td>
                                        <td>{{date('d-m-Y     h:i A',strtotime($sub->submitted_at))}}</td>

                                        <td>{{date('d-m-Y     h:i A',strtotime($sub->approved_at))}}</td>
                                        <td style="text-align: center;"><?php $isap=$sub->approved_by; if(!$isap) echo "<font color=RED><i class='icon-remove'></i></font>"; else echo "<font color=GREEN><i class='icon-ok'></i></font>"; ?></td>

                                    </tr>

                                @endforeach
                                </tbody><br>
                            </table>

                    <?php

         }
                          ?>

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