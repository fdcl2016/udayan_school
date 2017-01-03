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
                        <li>
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
                        <li class="active">
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

                    </ul>
            <div class="tab-content">
             <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                             style="color:black">Search Report Card</h3></strong></div><br/>

             {{ Form::open(array('url'=>'result_management/st_report_card2', 'class'=>'form-horizontal')) }}
             <fieldset>
                 <div class="control-group col-sm-5">
                     <label class="control-label">Select Year:</label>
                     <div class="controls">
                      <select name="year" id="year" class="form-control" required>
                        <option>Select Year</option>
                         <?php

                          $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();



                          ?>

                         
                        @foreach($academic_year as $year)
                             <option value="{{$year->academic_year}}">{{$year->academic_year}}</option>
                         @endforeach
                        


                       
                     </select>
                             </div>
                 </div>

                 <div class="control-group col-sm-5">
                     <label class="control-label" for="class_name">Select Term:</label>
                     <div class="controls">
                     <select name="term" id="term" class="form-control" required>
                        <option value="">Select Term</option>
                        <option value="Half Yearly">Half Yearly</option>
                        <option value="Final">Final</option>
                     </select>
                     </div>
                 </div>
                 <div class="control-group col-sm-2"></div>
                 <div class="control-group col-sm-5">
                     <label  class="control-label" for="class_name">Select Class:</label>
                     <div class="controls">
                     <select name="class_section" id="class_section" class="form-control" required>
                         <option value="">-&nbsp;Select Class&nbsp;-</option>

                       
                      </select>
                                                   </div>
                                               </div>

                                             

                                               <div class="control-group col-sm-12">
                                               <center>
                                                <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-download"></i> Download</button>  
                                               </center>
                                               </div>
                                           </fieldset>



                                           {{Form::close()}}


                            <div class="control-group col-sm-12">
                            
                            </div>   

                            <div class="fdcl_content_profile">
                                               <table id="example12" class="display" cellspacing="0" width="100%">
                                                   <thead>

                                                   </thead>

                                                   <tbody>


                                                   </tbody>
                                               </table>
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

        });

    </script>     
@stop