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
    $rasel = 7;
    include_once(app_path().'/views/nav_config/a_subject_management.php');
    ?>


    <div class="tab-content">
        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                        style="color:black">List of Configuration</h3></strong></div><br/>
        <div class="fdcl_content_profile">
            @if($lists!=null&&$lists!="[]")
                <div class="widget-header"></div>
                <div class="widget-content">

                    <table id="example" class="display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="resource-name">Configuration Name</th>
                            <th class="resource-link" style="width:11%"></th>

                        </tr>
                        </thead>

                        <tbody>
                        @foreach($lists as $list)
                            <tr>
                                <td>{{$list->configuration_name}} </td>
                                <td>
                                    <a href="{{ URL::to('/result_management/edit_config/'.$list->configuration_name)}}"><span>Edit</span></a>
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
                    null
                ]
            });
        });


    </script>
@stop