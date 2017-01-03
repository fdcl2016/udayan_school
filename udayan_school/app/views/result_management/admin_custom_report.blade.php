@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">
            <?php
                if(isset($msg)) {
                    echo $msg;
                    $msg = "";
                }
            ?>
            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Result Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                          <li >
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
                        <li>
                            <a href="{{ URL::to('/result_management/search_report_card')}}">Submission History</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/result_management/publish_result')}}">Publish Result</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/result_management/st_report_card')}}">Student Report Card</a>
                        </li>
                        <li class="active">
                            <a href="{{ URL::to('/result_management/admin_custom_report') }}">Custom Report</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Custom Report</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
                            <div class="widget-header"></div>
                            <div class="widget-content">
                                {{Form::open(array('url'=>'result_management/admin_custom_report', 'class'=>'form-inline')) }}
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Select Year: </label>
                                    <select name="year" id="year" class="form-control" required>
                                        <option value="">Select Year </option>
                                        <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();?>
                                        @foreach($academic_year as $year)
                                            <option value="{{$year->academic_year}}">{{$year->academic_year}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                    </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Select Term:</label>
                                    <select name="term" id="term" class="form-control" required>
                                        <option value="">Select Term</option>
                                        <option value="Half Yearly">Half Yearly</option>
                                        <option value="Final">Final</option>
                                        <option value="Half Yearly">First Term</option>
                                        <option value="Final">Second Term</option>
                                    </select>
                                </div>
                                    </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Select Class:</label>
                                    <select name="cat" id="cat" class="form-control"  required>
                                        <option value="">Select Class</option>
                                        <?php 
                                            $class = Addclass::groupby('value')
                                                ->orderBy('value', 'asc')
                                                ->get();
                                        ?>
                                        @foreach($class as $cats)
                                            <option value="{{$cats->class_name}}">{{$cats->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                    <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Select Section:</label>
                                    <select name="sub" id="sub"  class="form-control" required>
                                        <option>Select Section</option>
                                    </select>
                                </div>
                                    </div>
                                        <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" id="gender" class="form-control"  required>
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="combined">Combined</option>
                                       
                                    </select>
                                </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <br/><br/>
                                        <center>
                                            <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-search"></i> Search</button><br>
                                        </center>
                                    </div>
                                </div>

                                {{Form::close()}}

                                

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
//document.write('hello');
            var cat_id = e.target.value;
// document.write(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/ajax5?cat_id=' + cat_id, function (data) {
//console.log(data);
                $('#sub').empty();
                $.each(data, function (index, subcatObj) {
                    $('#sub').append('<option value="' + subcatObj.section + '">' + subcatObj.section + '</option>');
                })
                $('#sub').append('<option value="combined">Combined</option>');

            });
        });

             $("#sub").on('change', function (e) {
            console.log(e);
//document.write('hello');
            var section = e.target.value;
            var classs=document.getElementById('cat').value;
//document.write(section);
             $.get('<?php echo Config::get('baseurl.url');?>/classsectionsubjectss?section=' + section, 'classs='+classs, function (data) {

                $('#subject').empty();
                $.each(data, function (index, subcatObj) {

                    $('#subject').append('<option value="' + subcatObj.subject_name + '">' + subcatObj.subject_name + '</option>');
                })

            });
        });


        i = 0;

    </script>
@stop