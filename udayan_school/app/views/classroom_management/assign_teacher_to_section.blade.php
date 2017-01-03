@extends('master.master')
@section('header')
@stop
@section('content')


    <?php
    $rasel = 1;
    include_once(app_path().'/views/nav_config/a_classroom_management.php');
    ?>


    <div class="tab-content">
        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                        style="color:black">Assign Course Teacher</h3></strong></div><br/>

        {{ Form::open(array('url'=>'classroom_management/courseteacher12', 'class'=>'form-horizontal')) }}
        <fieldset>
            <div class="col-sm-4">
                <label >Select Year:</label>
                <select name="year" id="year" class="form-control" required>
                    <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'ASC')->get();?>
                    @foreach($academic_year as $year)
                        <option value="{{$year->academic_year}}">{{$year->academic_year}}</option>
                    @endforeach
                </select>
            </div>
            <div class="control-group col-sm-4">
                <label for="class_name">Select Class:</label>
                <select name="cat" id="cat" class="form-control">
                    <option value="">-&nbsp;Select Class&nbsp;-</option>
                    @foreach($class as $cats)
                        <option value="{{$cats->class_name}}">{{$cats->class_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="control-group col-sm-4">
                <label for="section_name">Select Section:</label>

                <select name="sub" id="sub" class="form-control" required>

                </select>

            </div>
            <div class="control-group col-sm-12"><br/></div>
            <div class="control-group col-sm-12">
                <center>
                    <input type="submit" class="btn btn-info"  value="Assign Teacher">

                </center>
            </div>
        </fieldset>


        <div><br/></div>
        {{Form::close()}}
        {{Form::open(array('url'=>'classroom_management/assign_teacher_to_section','class'=>'form-horizontal'))}}
        <?php $i=0;  if($classsection!=null){
        ?>
        {{Form::hidden('year12',$year12)}}
        <div class="fdcl_content_profile">
            <div class="widget-header">
            <b> Class : </b> {{$section->class_name }} &nbsp;&nbsp; <b>Section :</b> {{$section->section}}
            </div>
            <div class="widget-content">
                @foreach($classsection as $cl)
                    @if($i==0)
                        <?php $subject = Subject::where('idsubject','=',$cl->idsubject)->first();?>
                        <div class="control-group col-sm-5">
                            <label style="padding-right: 20px;">Subject Name:</label>
                        @if($subject->type == 'R')
                            <div>{{$subject->subject_name}} {{"(ISLAM)"}}</div><br/>
                                <div>{{$subject->subject_name}} {{"(HINDU)"}}</div>
                        @elseif($subject->type == 'A')
                                <div>{{$subject->subject_name}} </div><br/>
                                <div>{{$subject->subject_name}} {{"(HOME SCIENCE)"}}</div>
                        @else
                                <div>{{$subject->subject_name}} </div>
                         @endif
                        </div>
                        {{Form::hidden('idsubject[]',$cl->idsubject)}}
                        {{Form::hidden('idclass[]',$section->class_id)}}
                        <div class="control-group col-sm-5">
                            <label style="padding-right: 20px;">Teacher Name:</label>

                            <select class="form-control" name="idteacherinfo[]" required>
                                <?php $teacher = SubjectAssign::where('subject_idsubject','=',$cl->idsubject)->get();?>
                                @if($teacher!="[]")
                                    @foreach($teacher as $ts)
                                        <?php $t = TeacherInfo::where('idteacherinfo','=',$ts->teacher_idteacherinfo)->first();?>
                                        <option value="{{$t->idteacherinfo}}">{{$t->teacher_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @else
                        <?php $subject = Subject::where('idsubject','=',$cl->idsubject)->first();
                        $sb = $subject->subject_name;
                        ?>
                        <div class="control-group col-sm-5">
                            @if($subject->type == 'R')
                                <div>{{$subject->subject_name}} {{"(ISLAM)"}}</div><br/>
                                <div>{{$subject->subject_name}} {{"(HINDU)"}}</div>
                            @elseif($subject->type == 'A')
                                <div>{{$subject->subject_name}} </div><br/>
                                <div>{{$subject->subject_name}} {{"(HOME SCIENCE)"}}</div>
                            @else
                                <div>{{$subject->subject_name}} </div>
                            @endif
                        </div>
                        {{Form::hidden('idsubject[]',$cl->idsubject)}}
                        {{Form::hidden('idclass[]',$section->class_id)}}

                        @if($subject->type =='R')
                            <div class="control-group col-sm-5">

                                <select class="form-control" name="idteacherinfo[]" required>
                                    <option value="Select Islam Teacher">{{"Select Islam Teacher"}}</option>
                                    <?php $teacher = SubjectAssign::where('subject_idsubject','=',$cl->idsubject)->get();?>
                                    @if($teacher!="[]")
                                        @foreach($teacher as $ts)
                                            <?php $t = TeacherInfo::where('idteacherinfo','=',$ts->teacher_idteacherinfo)->first();?>
                                            <option value="{{$t->idteacherinfo}}">{{$t->teacher_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                </br>

                                <select class="form-control" name="idteach" required>
                                    <option value="Select Hindu Teacher">{{"Select Hindu Teacher"}}</option>
                                    <?php $teacher = SubjectAssign::where('subject_idsubject','=',$cl->idsubject)->get();?>
                                    @if($teacher!="[]")
                                        @foreach($teacher as $ts)
                                            <?php $t = TeacherInfo::where('idteacherinfo','=',$ts->teacher_idteacherinfo)->first();?>
                                            <option value="{{$t->idteacherinfo}}">{{$t->teacher_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        @elseif($subject->type =='A')


                            <div class="control-group col-sm-5">

                                <select class="form-control" name="idteacherinfo[]" required>
                                    <option value="Select Islam Teacher">{{"Select Agriculture Teacher"}}</option>
                                    <?php $teacher = SubjectAssign::where('subject_idsubject','=',$cl->idsubject)->get();?>
                                    @if($teacher!="[]")
                                        @foreach($teacher as $ts)
                                            <?php $t = TeacherInfo::where('idteacherinfo','=',$ts->teacher_idteacherinfo)->first();?>
                                            <option value="{{$t->idteacherinfo}}">{{$t->teacher_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                </br>

                                <select class="form-control" name="idteach1" required>
                                    <option value="Select Hindu Teacher">{{"Select Home Science Teacher"}}</option>
                                    <?php $teacher = SubjectAssign::where('subject_idsubject','=',$cl->idsubject)->get();?>
                                    @if($teacher!="[]")
                                        @foreach($teacher as $ts)
                                            <?php $t = TeacherInfo::where('idteacherinfo','=',$ts->teacher_idteacherinfo)->first();?>
                                            <option value="{{$t->idteacherinfo}}">{{$t->teacher_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        @else
                            <div class="control-group col-sm-5">
                                <select class="form-control" name="idteacherinfo[]" required>
                                    <?php $teacher = SubjectAssign::where('subject_idsubject','=',$cl->idsubject)->get();?>
                                    @if($teacher!="[]")
                                        @foreach($teacher as $ts)
                                            <?php $t = TeacherInfo::where('idteacherinfo','=',$ts->teacher_idteacherinfo)->first();?>
                                            <option value="{{$t->idteacherinfo}}">{{$t->teacher_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif


                    @endif
                    <?php $i++;?>
                @endforeach
                <br/><br/>
                <div class="control-group col-sm-12"> <button type="submit" class="btn btn-primary" id="button"><i class="icon-save"></i> Save</button></div>
            </div>
        </div>
        {{Form::close()}}
        <?php }?>

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
        $("#cat").on('change',function (e) {
            console.log(e);
//document.write('hello');
            var cat_id = e.target.value;
// document.write(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/ajax?cat_id=' +cat_id,function(data)
            {
//console.log(data);
                $('#sub').empty();
                $.each(data,function(index,subcatObj)
                {
                    $('#sub').append('<option value="'+subcatObj.section+'">'+subcatObj.section+'</option>');
                })

            });
        });
    </script>
@stop