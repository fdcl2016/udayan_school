@extends('master.master')
@section('header')
    <style type="text/css">
        #left_div {
            float: left;
            width: 50%;
        }
        #right_div {
            float: right;
            width: 50%;
        }
        tr,td,table{
            height:40px;

        }
    </style>
@stop
@section('content')


    <?php
    $rasel = 5;
    include(app_path().'/views/nav_config/a_subject_management.php');
    ?>


    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">List of Subject</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
                            <table id="example" class="display" cellspacing="0" width="100%">
                                <thead>
                                <tr>

                                    <th class="resource-name">Class Name</th>
                                    <th class="resource-name">Subject Name</th>
                                    <th class="resource-name">Mark Configuration Name</th>
                                    <th class="resource-link" style="width:11%"></th>

                                </tr>
                                </thead>

                                <tbody>
                                @foreach($subject as $sub)
                                    <tr>
                                         <?php $class_name = Addclass::where('class_id','=',$sub->idclass)->first();
                                        $subject_name = Subject::where('idsubject','=',$sub->idsubject)->pluck('subject_name');
                                        ?>
                                        <td>{{$class_name->class_name}} </td>
                                        <td>{{$subject_name}} </td>
                                        <td>{{$sub->markconfiguration_name}} </td>
                                        <td><a href="{{ URL::to('/subject_management/edit_subject_classwise/'.$sub->idsubjecttoclass)}}" ><span><i class="icon-edit"></i></span></a></td>
                                    </tr>

                                @endforeach
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
    {{ HTML::style('/media/css/jquery.dataTables.css') }}
    {{--{{ HTML::script('/media/js/jquery.js') }}--}}
    {{ HTML::script('/media/js/jquery.dataTables.js') }}

    <script type="text/javascript" language="javascript" class="init">


        $(document).ready(function() {
            $('#example').dataTable( {
                "aoColumns": [
                    { "orderSequence": [ "asc","desc" ] },
                    { "orderSequence": [ "asc","desc" ] },
                    { "orderSequence": [ "asc","desc" ] },
                    null
                ]
            } );
        } );


    </script>
@stop