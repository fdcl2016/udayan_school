@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Staff Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li>
                            <a href="/staff_management/addteacher">Add Teacher</a>
                        </li>
                        <li class="active"><a href="/staff_management/listeditteacher">Edit Teacher</a></li>
                    </ul>
                    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Teacher List</h3></strong></div>
                    <div id="stdregister_div"></div>
                    <div class="span11">            
                
                <div class="widget ">
                    
                    <div class="widget-header">
                    </div> <!-- /widget-header -->
                    
                    <div class="widget-content">
                        
                       


        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th class="resource-name">Teacher Id</th>
                <th class="resource-name">Teacher Name</th>
                <th class="resource-name">Designation</th>
                <th class="resource-name">Mobile</th>
                <th class="resource-name">Email</th>
                <th class="resource-link" style="width:11%"></th>

            </tr>
            </thead>

            <tbody>
            @foreach($teachers as $sub)
                <tr>
                    <td>{{$sub->teacher_id}} </td>
                    <td>{{$sub->teacher_name}} </td>
                    <td>{{$sub->designation}} </td>
                    <td>{{$sub->personal_mobile}} </td>
                    <td>{{$sub->email}} </td>
                    <td><a href="/staff_management/editteacher/{{$sub->idteacherinfo}}"><span>edit</span></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>


                        
                        
                    </div> <!-- /widget-content -->
                        
                </div> <!-- /widget -->
                
            </div> <!-- /span8 -->
       
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
    {{ HTML::script('/media/js/jquery.dataTables.js') }}

    <script type="text/javascript" language="javascript" class="init">


        $(document).ready(function() {
            $('#example').dataTable( {
                "aoColumns": [
                    { "orderSequence": [ "asc","desc" ] },
                    { "orderSequence": [ "desc","asc" ] },
                    { "orderSequence": [ "desc", "asc", "asc" ] },
                    { "orderSequence": [ "asc","desc" ] },
                    { "orderSequence": [ "asc","desc" ] },
                    null
                ]
            } );
        } );


    </script>
@stop