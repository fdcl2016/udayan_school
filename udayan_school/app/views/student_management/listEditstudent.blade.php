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
                        <li class="active"><a href="{{ URL::to('/info')}}">Edit Student</a></li>
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

                                {{Form::open(array('url'=>'/info', 'class'=>'form-inline')) }}

                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Select Class:</label>
                                            <?php
                                            $class = Addclass::orderBy('value','ASC')->groupBy('class_name')->get();  ?>
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

                                    <br>

                                    <div class="col-sm-2">
                                        <div class="form-group">

                                            <button type="submit" class="btn btn-info" id="cat2fwf" style="margin-top: 5px;"><i class="icon-search"></i> Search</button><br>
                                        </div>
                                    </div>
                                </div>

                                {{Form::close()}}
                            </div>

                            @if($class_data!=null && $class_data!="[]")
                                <div class="widget-content">


                                    <table id="example" class="display" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th class="resource-name">Student Roll</th>
                                            <th class="resource-name">Student Name</th>
                                            <th class="resource-name">Class</th>
                                            <th class="resource-name">Section</th>
                                            <th class="resource-name">Mobile</th>
                                            <th class="resource-link" style="width:11%"></th>

                                        </tr>
                                        </thead>

                                        <tbody>


                                        @foreach($class_data as $sub)
                                        <tr>
                                            <td>{{$sub->std_roll}} </td>
                                            <td>{{$sub->std_name}} </td>
                                            <td>{{$sub->std_class}} </td>
                                            <td>{{$sub->std_section}} </td>
                                            <td>{{$sub->mobile}} </td>

                                            <td>
                                                <a href="{{URL::to('student_management/listeditstudent/editstudent/'.$sub->std_reg_no)}}"><span>Edit</span></a>
                                            </td>

                                        </tr>
                                            @endforeach

                                        </tbody>
                                    </table>



                                </div>
                                @endif

                                        <!-- /widget-content -->

                        </div>
                        <!-- /widget -->

                    </div>
                    <!-- /span8 -->


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

    {{ HTML::style('/media/css/jquery.dataTables.css') }}
    {{--{{ HTML::script('/media/js/jquery.js') }} --}}
    {{ HTML::script('/media/js/jquery.dataTables.js') }}

    <script type="text/javascript" language="javascript" class="init">


        $(document).ready( function() {
            $('#example').dataTable({
                "aaSorting": [[ 2, 'asc' ]],


            });
        });


    </script>
    <script>
        $("#cat").on('change', function (e) {
            console.log(e);
//document.write('hello');
            var cat_id = e.target.value;
// document.write(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/ajax5?cat_id=' + cat_id, function (data) {
//console.log(data);
                $('#sub').empty();
                $('#sub').append('<option value="">Select Section</option>');
                $.each(data, function (index, subcatObj) {
                    $('#sub').append('<option value="' + subcatObj.section + '">' + subcatObj.section + '</option>');
                })

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