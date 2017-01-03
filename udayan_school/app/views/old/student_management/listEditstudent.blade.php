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
                        <li class="active"><a href="/student_management/listeditstudent">Edit Student</a></li>
                        <li><a href="/student_management/assign_student_to_section">Assign Student To Section</a></li>
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


                                <table id="example" class="display" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="resource-name">Registration Id</th>
                                        <th class="resource-name">Student Name</th>
                                        <th class="resource-name">Class</th>
                                        <th class="resource-name">Section</th>
                                        <th class="resource-name">Mobile</th>
                                        <th class="resource-link" style="width:11%"></th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($student as $sub)
                                        <tr>
                                            <td>{{$sub->registration_id}} </td>
                                            <td>{{$sub->sutdent_name}} </td>
                                            <?php $ss = StudentToSectionUpdate::where('student_idstudentinfo', '=', $sub->idstudentinfo)->first();
                                            if($ss != ""){?>
                                            <td>{{$ss->class}} </td>
                                            <td>{{$ss->section}} </td>
                                            <?php } else{?>
                                            <td></td>
                                            <td></td>
                                            <?php }?>
                                            <td>{{$sub->p_mobile}} </td>
                                            <td>
                                                <a href="listeditstudent/editstudent/{{$sub->idstudentinfo}}"><span>Edit</span></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>


                            </div>
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