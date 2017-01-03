@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>

                <h3>Student Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li >
                            <a href="{{ URL::to('/student_management/addstudent')}}">Add Student</a>
                        </li>
                        <li><a href="{{ URL::to('/student_management/listeditstudent')}}">Edit Student</a></li>
                        <li  ><a href="{{ URL::to('/student_management/assign_student_to_class_section')}}">Assign Student To Section</a></li>
                        {{--<li class="active"><a href="{{ URL::to('/student_management/assign_student_to_section')}}">Student Promotion</a></li>--}}
                        

                    </ul>
                   <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Assign Student To New Section</h3></strong></div>
                    <div id="stdregister_div"></div>

                  
            <div class="span11">            
                
                <div class="widget ">
                    
                    <div class="widget-header">
                    </div> <!-- /widget-header -->
                    
                    <div class="widget-content">
                        
                         {{ Form::open(array('url'=>'/changeshift', 'class'=>'form-horizontal')) }}
                    <fieldset>
                        <div class="control-group col-sm-5">
                            <label class="control-label" for="subject_name">Select Shift:</label>

                            <div class="controls">
                                <select name="shift" id="cat" class="span3" style="width:320px;">
                                    <option value="">-&nbsp;Select Shift&nbsp;-</option>
                                    @foreach($shifts as $cats)
                                        <option value="{{$cats->shift}}">{{$cats->shift}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /controls -->
                        </div>
                        <div class="control-group col-sm-5">
                            <label class="control-label" for="subject_name">Select Class:</label>

                            <div class="controls">
                                <select name="class" id="sub" style="width:320px" class="form-control">

                                </select>
                            </div>
                            <!-- /controls -->
                        </div>

                    </fieldset>


                    <br/>
                    <input type="submit" class="btn btn-info" style="width:120px;margin-left: 40%;" value="OK">
                    {{Form::close()}}
                        
                        
                    </div> <!-- /widget-content -->
                        
                </div> <!-- /widget -->
                
            </div> <!-- /span8 -->
<?php $i = 0;  if($classsection != null){
                    ?>
            <div class="span11">            
                
                <div class="widget ">
                    
                    <div class="widget-header">
                    </div> <!-- /widget-header -->
                    
                    <div class="widget-content">
                        
                         {{Form::open(array('url'=>'/postchangeshift'))}}
                    
                    <div class="form-group col-sm-4">
                        <label style="float: left;">Select Year:</label>
                        <select name="year" id="year" class="form-control" required>
                            <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();?>
                            @foreach($academic_year as $year)
                                <option value="{{$year->academic_year}}">{{$year->academic_year}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br/><br/> <br/><br/>

                    <div style="float:left;width: 100%;">
                        <div style="float: left;margin-left: 1%;padding-left: 1%;width: 15%;">{{Form::label('Student Name')}}</div>
                        <div style="float: left;margin-left: 3%;padding-left: 1%;width: 10%;">{{Form::label('Merit Position')}}</div>
                        <div style="float: left;margin-left: 3%;padding-left: 1%;width: 10%;">{{Form::label('CGPA Result')}}</div>
                        <div style="float: left;margin-left: 3%;padding-left: 1%;width: 10%;">{{Form::label('Marks')}}</div>
                        <div style=" float: left;margin-left: 3%;padding-left: 1%;width: 10%; ">{{Form::label('Previous Section')}}</div>
                        <div style=" float: left;margin-left: 3%;padding-left: 1%;width: 10%;">{{Form::label('Next Class')}}</div>
                        <div style=" float: left;margin-left: 3%;padding-left: 1%;width: 10%;">{{Form::label('Next Section')}}</div>

                    </div>
                    <br/><br/>
                    @foreach($classsection as $cl)
                            <?php $student = Studentinfo::where('idstudentinfo', '=', $cl->student_idstudentinfo)->first();
                            $class_value = Addclass::where('class_name','=',$cl->class)->first()->value;
                            $subject1 = Addclass::groupBy('class_name')->orderBy('value','ASC')->where('value','>',$class_value)->first();?>
                        @if($i%2==0)
                            <div style=" float:left;width: 100%;background-color: #f9f9f9;">
<br/>
                                <div style="float: left;margin-left: 1%;padding-left: 1%;width: 15%;">{{$student->sutdent_name}}</div>
                                {{Form::hidden('student_idstudentinfo[]',$cl->student_idstudentinfo)}}
                                <div style=" float: left;margin-left:3%;padding-left: 1%;width: 10%;">{{$cl->merit_position}}</div>
                                {{Form::hidden('merit_position[]',$cl->merit_position)}}
                                <div style=" float: left;margin-left:3%;padding-left: 1%;width: 10%;">{{$cl->resultCGPA}}</div>
                                {{Form::hidden('resultCGPA[]',$cl->resultCGPA)}}
                                <div style=" float: left;margin-left:3%;padding-left: 1%;width: 10%;">{{$cl->marks}}</div>
                                {{Form::hidden('marks[]',$cl->marks)}}
                                <div style=" float: left;margin-left:3%;padding-left: 1%;width: 10%;">{{$cl->section}}</div>
                                {{Form::hidden('p_section[]',$cl->section)}}
                                {{Form::hidden('p_class[]',$cl->class)}}
                                {{Form::hidden('p_shift[]',$cl->shift)}}
                                {{Form::hidden('idUpdate[]',$cl->idStudentToSectionUpdate)}}
                                <div style=" float: left;margin-left:3%;padding-left: 1%;width: 10%;">

                                    <input name="class[]" id="class<?php echo $i;?>" value="{{$subject1->class_name}}" style="width: 100px;background-color: #ffffff"  required>
                                </div>
                                <div style=" float: left;margin-left:3%;padding-left: 1%;width: 10%;">
                                    <select name="section[]" id="section<?php echo $i;?>" style="width: 100px;background-color: #ffffff;" required>
                                        <?php $section = Addclass::where('class_name','=',$subject1->class_name)->get();?>
                                        <option value="">Select Section</option>
                                        @foreach($section as $sec)
                                            <option value="{{$sec->section}}">{{$sec->section}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br/>
                        @endif
                        @if($i%2==1)
                            <div style="float:left;width: 100%;background-color: #ffffff">
<br/>
                                <div style="float: left;margin-left: 1%;padding-left: 1%;width: 15%;">{{$student->sutdent_name}}</div>
                                {{Form::hidden('student_idstudentinfo[]',$cl->student_idstudentinfo)}}
                                <div style=" float: left;margin-left:3%;padding-left: 1%;width: 10%;">{{$cl->merit_position}}</div>
                                {{Form::hidden('merit_position[]',$cl->merit_position)}}
                                <div style=" float: left;margin-left:3%;padding-left: 1%;width: 10%;">{{$cl->resultCGPA}}</div>
                                {{Form::hidden('resultCGPA[]',$cl->resultCGPA)}}
                                <div style=" float: left;margin-left:3%;padding-left: 1%;width: 10%;">{{$cl->marks}}</div>
                                {{Form::hidden('marks[]',$cl->marks)}}
                                <div style=" float: left;margin-left:3%;padding-left: 1%;width: 10%;">{{$cl->section}}</div>
                                {{Form::hidden('p_section[]',$cl->section)}}
                                {{Form::hidden('p_class[]',$cl->class)}}
                                {{Form::hidden('p_shift[]',$cl->shift)}}
                                {{Form::hidden('idUpdate[]',$cl->idStudentToSectionUpdate)}}

                                <div style=" float: left;margin-left:3%;padding-left: 1%;width: 10%;">

                                    <input name="class[]" id="class<?php echo $i;?>" value="{{$subject1->class_name}}" style="width: 100px;background-color: #f9f9f9"  required>
                                </div>
                                <div style=" float: left;margin-left:3%;padding-left: 1%;width: 10%;">
                                    <select name="section[]" id="section<?php echo $i;?>"
                                            style="width: 100px;background-color: #f9f9f9;" required>
                                        <?php $section = Addclass::where('class_name','=',$subject1->class_name)->get();?>
                                        <option value="">Select Section</option>
                                        @foreach($section as $sec)
                                            <option value="{{$sec->section}}">{{$sec->section}}</option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>
                            <br/>
                        @endif
                        <?php $i++;?>

                    @endforeach
                    <br/><br/>
                    <button type="submit" class="btn btn-primary" id="button" style="width:120px;margin-left: 40%;" ><i class="icon-save"></i> Save</button> 
                    {{Form::close()}}
                   
                        
                        
                    </div> <!-- /widget-content -->
                        
                </div> <!-- /widget -->
                
            </div> <!-- /span8 -->
 <?php }?>


                   

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
            $.get('<?php echo Config::get('baseurl.url');?>/ajax20?cat_id=' + cat_id, function (data) {
//console.log(data);
                $('#sub').empty();
                $.each(data, function (index, subcatObj) {
                    $('#sub').append('<option value="' + subcatObj.class_name + '">' + subcatObj.class_name + '</option>');
                })

            });
        });
        function ch(e) {
            text = "";
            text += "class" + e;
            text1 = "";
            text1 += "#section" + e;
//document.write('hello');
            var cat_id = document.getElementById(text).value;
// document.write(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/ajaxchange?cat_id=' + cat_id, function (data) {
//console.log(data);
                $(text1).empty();
                $.each(data, function (index, subcatObj) {
                    $(text1).append('<option value="' + subcatObj.section + '">' + subcatObj.section + '</option>');
                })

            });
        }
    </script>
@stop