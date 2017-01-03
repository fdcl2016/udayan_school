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
                            <a href="{{ URL::to('/result_management/teacher_result_insert')}}">Insert Marks</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/view_marksheet')}}">Mark Sheet</a>
                        </li>
                        <li>
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

                        <!-- if class teacher show tab -->
                        <?php 
                          $class_teacher = ClassTeacher::where('idteacherinfo', Auth::user()->user_id)->first(); 
                        ?>
                        @if(!empty($class_teacher))
                        <li class="active">
                          <a href="{{ URL::to('/result_management/custom_report') }}">Custom Report</a>
                        </li>
                        @endif

                    </ul>
                    <div class="tab-content">

                        <div class="alert alert-info" style="border-left: 5px solid #33D685;">
                            <strong><h3 style="color:black">Custom Report</h3></strong>
                        </div>
                        <br/>

                        <div class="widget-header"></div>
                        <div class="widget-content">

                            {{ Form::open(array('url'=>'result_management/custom_report', 'class'=>'form-inline')) }}
                            <div class="col-sm-4">
                                <div class="form-group">

                                    <label>Select Term:</label>
                                    <select name="term" id="term" class="form-control" required>
                                        <option value="">Select Term</option>
                                        <option value="Half Yearly">Half Yearly</option>
                                        <option value="Final">Final</option>
                                    </select>

                                </div>
                            </div> 

                            <div class="col-sm-4">
                                <div class="form-group">

                                    <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();?>
                                    <label>Select Year:</label>
                                    <select name="year" id="year" class="form-control" required>
                                        <option value="">Select Year</option>
                                        @foreach($academic_year as $year)
                                        <option value="{{ $year->academic_year }}">{{ $year->academic_year }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    
                                    <label>Select Class & Section:</label>
                                    <select name="class_section" id="class_section" class="form-control" required>
                                        <option>Select Class Section</option>
                                    </select>

                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <br/>
                                <center>

                                    <div class="form-group">
                                        <input type="submit" value="search" id="catfhg" class="btn btn-info" style="width:80px;"><br>
                                    </div>
                                    
                                </center> 
                            </div>
                            {{ Form::close() }}
                        </div>
                        <br/>

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
        $("#year").on('change',function (e) {

            var academic_year = e.target.value;
            //console.log(academic_year);
           
            $.get('<?php echo Config::get('baseurl.url'); ?>ajaxyearsection?academic_year='+academic_year, function(data) {
                console.log(data);

                $('#class_section').empty();
                $.each(data, function(index, classSectionObject) {
                    $('#class_section').append('<option>'+ classSectionObject.class_name+' '+ classSectionObject.section +'</option> ');
                }) 
            });

            /*console.log(e);
            //document.write('hello');
            var cat_id = e.target.value;
            data = cat_id;
            // document.write(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/ajaxresult?cat_id=' +cat_id,function(data)
            {
                //console.log(data);
                $('#sub').empty();
                $.each(data,function(index,subcatObj)
                {
                    $('#sub').append('<option value="'+subcatObj.idcourseteacher+'">'+subcatObj.subject_name+'</option>');
                })

            });*/
        });

    </script>       

@stop
