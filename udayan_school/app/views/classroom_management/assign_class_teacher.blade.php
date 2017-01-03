@extends('master.master')
@section('header')
@stop
@section('content')


    <?php
    $rasel = 2;
    include_once(app_path().'/views/nav_config/a_classroom_management.php');
    ?>

    <div class="tab-content">
        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                        style="color:black">Assign Class Teacher</h3></strong></div>
        <br/>


        {{ Form::open(array('url'=>'classroom_management/search_courseteacher', 'class'=>'form-horizontal')) }}
        <fieldset>
            <div class="control-group col-sm-12">
                <div class="control-group col-sm-2">
                    <label>Select Year:</label></div>
                <div class="control-group col-sm-3">
                    <select name="year" id="year" class="form-control" required>
                        <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();?>
                        @foreach($academic_year as $year)
                            <option value="{{$year->academic_year}}">{{$year->academic_year}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="control-group col-sm-3"><button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-search"></i> Search</button></div>
            </div>
        </fieldset>
        {{Form::close()}}

        @if($year2!=null)
            <div class="fdcl_content_profile">
                <div class="widget-header"></div>
                <div class="widget-content">

                    {{ Form::open(array('url'=>'classroom_management/assign_class_teacher', 'class'=>'form-horizontal')) }}
                    <div class="table-responsive" style="padding-left:15%;padding-right:15%">

                        <table  class="table table-bordered table-striped" border="1" cellspacing="0"  border="1" style="border-collapse: collapse" width="100%">
                            <thead>
                            <tr>
                                <th style="width: 25%;padding-left: 10px;padding-right:10px;text-align: center;">Class</th>
                                <th style="width: 25%; padding-left: 10px;text-align: center;">Section</th>
                                <th style="width: 50%; padding-left: 10px;text-align: center;">Teacher Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $classes = Addclass::orderBy('value', 'ASC')->get();?>
                            @foreach($classes as $class)
                                <tr>
                                    <td style="width: 25%;text-align: center;">{{$class->class_name}}</td>
                                    <td style="width: 25%;text-align: center;">{{$class->section}}</td>
                                    {{Form::hidden('idclasssection[]',$class->class_id)}}
                                    {{Form::hidden('ac_year[]',$year2)}}
                                    <?php $courseteacher = CourseTeacher::where('idclasssection', '=', $class->class_id)->groupBy('idteacherinfo')->get();?>

<td><select name="idteacherinfo[]" class="class_teacher">
 <option value="{{"Select Teacher"}}">{{"Select Teacher"}}</option>
 @foreach($courseteacher as $course)
                                                        <option value="{{$course->idteacherinfo}}">{{$course->short_name}}</option>
                                                    @endforeach
</select>
</td>
 </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><br/>
                    <center>   <div class="control-group col-sm-12"><button type="submit" class="btn btn-primary" id="button"><i class="icon-save"></i> Save</button></div>
                    </center>      {{Form::close()}}
                </div>
            </div>
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
@stop