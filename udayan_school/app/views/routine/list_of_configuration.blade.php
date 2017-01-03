@extends('master.master')
@section('header')
@stop
@section('content')


    <?php
    $rasel = 3;
    include_once(app_path().'/views/nav_config/a_routine.php');
    ?>

    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Configure List</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
                            @if($lists!=null&&$lists!="[]")
                                <div class="widget-header"></div>
                                <div class="widget-content">

                                    <table id="example" class="display" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th class="resource-name">Shift</th>
                                            <th class="resource-name">Year</th>
                                            <th class="resource-link" style="width:11%"></th>

                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($lists as $list)
                                            <tr>
                                                <td>{{$list->shift}} </td>
                                                <td>{{$list->year}} </td>
                                                <td>
                                                    <a href="{{ URL::to('/routine/edit_config/'.$list->idconfiguration)}}"><span>Edit</span></a>
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            @endif
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
    {{--{{ HTML::script('/media/js/jquery.js') }} --}}
    {{ HTML::script('/media/js/jquery.dataTables.js') }}

    <script type="text/javascript" language="javascript" class="init">


        $(document).ready(function () {
            $('#example').dataTable({
                "aoColumns": [
                    {"orderSequence": ["asc", "desc"]},
                    {"orderSequence": ["asc", "desc"]},
                    null
                ]
            });
        });


    </script>
@stop