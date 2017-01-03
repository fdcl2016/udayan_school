@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>ClassRoom Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li>
                            <a href="{{ URL::to('/classroom_management/create_class')}}">Create Class</a>
                        </li>
                        <li class="active"><a href="{{ URL::to('/classroom_management/edit_class')}}">Edit Class</a></li>
                        <li><a href="{{ URL::to('/classroom_management/assign_teacher_to_section')}}">Assign Course Teacher</a></li>
                        <li><a href="{{ URL::to('/classroom_management/assign_class_teacher')}}">Assign Class Teacher</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Edit Class</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
                        <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="resource-name">Class Name</th>
                                <th>Sections</th>
                                <th class="resource-link" style="width:11%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($classes as $class)
                                <?php $class_name=$class->class_name?>
                                @if($class_name !=null)
                                    <tr>
                                        <td><input value="{{$class->value}}" hidden></td>
                                        <td>{{$class_name}}</td>
                                        <td>
                                            <?php $sections = Addclass::where('class_name','=',$class_name)->get();
                                            ?>
                                             <?php $i=0; $j=2;?>
                                            @foreach($sections as $section)
                                              
                                                @if($i==$j)
                                                 <?php echo ",&nbsp";?>
                                                @endif
                                                 <?php $i=$j;?>
                                                {{$section->section}}
                                            @endforeach
                                        </td>
                                        <td style="text-align: center;"><a href="{{ URL::to('/classroom_management/editable_class/'.$class->class_id)}}" class="btn btn-primary"><span><i class="icon-edit"></i></span></a></td>
                                    </tr>
                                @endif
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