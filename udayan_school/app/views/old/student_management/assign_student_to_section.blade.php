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
                        <li>
                            <a href="/student_management/addstudent">Add Student</a>
                        </li>
                        <li><a href="/student_management/listeditstudent">Edit Student</a></li>
                        <li class="active"><a href="/student_management/assign_student_to_section">Assign Student To
                                Section</a></li>
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
                            <label class="control-label" for="subject_name">Select class:</label>

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
                    
                    <div class="form-group">
                        <label style="float: left;">Select Year:</label>
                        <select name="year" id="year" class="form-control"
                                style="float: left;width:320px;margin-left: 80px;;" required>
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
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
                        $subject1 = Addclass::groupBy('class_name')->get();?>
                        @if($i%2==0)
                            <div style=" float:left;width: 100%;background-color: #f9f9f9;">

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

                                    <select name="class[]" id="class<?php echo $i;?>"
                                            style="width: 100px;background-color: #ffffff"
                                            onchange="ch(<?php echo $i;?>)" required>
                                        <option>-&nbsp;Select Class&nbsp;-</option>
                                        {{--<option value="">.....</option>--}}
                                        @foreach($subject1 as $cats)
                                            <option value="{{$cats->class_name}}">{{$cats->class_name}}</option>
                                        @endforeach
                                    </select></div>
                                <div style=" float: left;margin-left:3%;padding-left: 1%;width: 10%;">
                                    <select name="section[]" id="section<?php echo $i;?>"
                                            style="width: 100px;background-color: #ffffff;" required>

                                    </select>
                                </div>
                            </div>
                            <br/>
                        @endif
                        @if($i%2==1)
                            <div style="float:left;width: 100%;background-color: #ffffff">

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

                                    <select name="class[]" id="class<?php echo $i;?>"
                                            style="width: 100px;background-color: #f9f9f9;"
                                            onchange="ch(<?php echo $i;?>)" required>

                                        {{--<option value="">.....</option>--}}
                                        @foreach($subject1 as $cats)
                                            <option value="{{$cats->class_name}}">{{$cats->class_name}}</option>
                                        @endforeach
                                    </select></div>
                                <div style=" float: left;margin-left:3%;padding-left: 1%;width: 10%;">
                                    <select name="section[]" id="section<?php echo $i;?>"
                                            style="width: 100px;background-color: #f9f9f9;" required>

                                    </select>
                                </div>

                            </div>
                            <br/>
                        @endif
                        <?php $i++;?>

                    @endforeach
                    <br/><br/>
                    <input type="submit" class="btn btn-info" style="width:120px;margin-left: 40%;" value="Save">
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
            $.get('/ajax20?cat_id=' + cat_id, function (data) {
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
            $.get('/ajaxchange?cat_id=' + cat_id, function (data) {
//console.log(data);
                $(text1).empty();
                $.each(data, function (index, subcatObj) {
                    $(text1).append('<option value="' + subcatObj.section + '">' + subcatObj.section + '</option>');
                })

            });
        }
    </script>
@stop