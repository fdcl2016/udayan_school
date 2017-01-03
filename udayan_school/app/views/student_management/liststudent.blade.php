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
                        <li ><a href="{{ URL::to('/student_management/listeditstudent')}}">Edit Student</a></li>
                        <li ><a href="{{ URL::to('/student_management/assign_student_to_class_section')}}">Assign Student To Section</a></li>
                        {{--<li ><a href="{{ URL::to('/student_management/assign_student_to_section')}}">Student Promotion</a></li>--}}
                       
                    </ul>
                    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Student List</h3></strong></div>
                    <div id="stdregister_div"></div>


                    <div class="span11">

                        <div class="widget ">

                            <div class="widget-header">
                            </div>
                            <!-- /widget-header -->

                            <div class="widget-content">

                                 <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                                                        style="color:black">Search Student</h3></strong></div><br/>



                                                            <fieldset>
                                                                <div class="col-sm-4">
                                                                    <label >Select Year:</label>
                                                                    <select name="year" id="year" class="form-control" required>
                                                                        <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();?>
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
                                                                    <input type="submit" class="btn btn-info"  value="Search Student">

                                                                    </center>
                                                                </div>
                                                        </fieldset>





                            </div>
    </div>

    </div>
    <!-- /widget-content -->

    </div>
    <!-- /widget -->

    </div> <!-- /span8 -->

@stop
@section('content_footer')

    {{ HTML::style('/media/css/jquery.dataTables.css') }}
       {{--{{ HTML::script('/media/js/jquery.js') }} --}}
    {{ HTML::script('/media/js/jquery.dataTables.js') }}

    <script type="text/javascript" language="javascript" class="init">


        $(document).ready(function () {
            $('#example').dataTable({
                "aoColumns": [
                    {"orderSequence": ["asc", "desc"]},
                    {"orderSequence": ["desc", "asc"]},
                    {"orderSequence": ["desc", "asc", "asc"]},
                    {"orderSequence": ["asc", "desc"]},
                    {"orderSequence": ["asc", "desc"]},
                    null
                ]
            });
        });


    </script>
@stop