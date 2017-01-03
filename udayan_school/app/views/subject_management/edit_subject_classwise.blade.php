@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Subject Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li>
                            <a href="{{ URL::to('/subject_management/create_subject')}}">Create Subject</a>
                        </li>
                        <li><a href="{{ URL::to('/subject_management/edit_subject')}}">Edit Subject</a></li>
                        <li><a href="{{ URL::to('/subject_management/assign_subject_to_teacher')}}">Assign Subject To Teacher</a></li>
                        <li><a href="{{ URL::to('/subject_management/classwise_subject')}}">Classwise Subject</a></li>
                        <li   class="active"><a href="{{ URL::to('/subject_management/classwise_subject_list')}}">Classwise Subject List</a></li>
                        <li>
                            <a href="{{ URL::to('/result_management/configure_result')}}">Configure Result</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/result_management/list_of_config')}}">List of Configuration</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Assign Subject To Class</h3></strong></div><br/>
                        {{ Form::open(array('url'=>'subject_management/edit_subject_classwise')) }}
                        @if($subject!=null&&$subject!="")
                            {{Form::hidden('idsubjecttoclass',$subject->idsubjecttoclass)}}
                        <div class="fdcl_content_profile">
                            <div>
                                <div style="float: left;width: 20%">Class Name</div>
                                <div style="float: left;width: 50%;" data-role="input-control">
                                    <?php $class_name = Addclass::where('class_id','=',$subject->idclass)->first()->class_name;
                                    $subject_name = Subject::where('idsubject','=',$subject->idsubject)->first()->subject_name;
                                    ?>
                                        {{$class_name}}
                                </div>
                            </div>
                            <div><br/><br/><br/></div>
                            <div>
                                <div style="float: left;width: 20%">Subject Name</div>
                                <div style="float: left;width: 20%;"  data-role="input-control">
                                    {{$subject_name}}
                                </div>
                                <div style="float: left;width: 20%;margin-left: 5%;">Configuration Name</div>
                                <div style="float: left;width: 20%;"data-role="input-control">
                                    <select type="text" name="conf_name"  class="form-control"  required>
                                        <option value="{{$subject->markconfiguration_name}}">{{$subject->markconfiguration_name}}</option>
                                        @foreach($marks as $s)
                                            @if($s->configuration_name!=$subject->markconfiguration_name)
                                            <option value="{{$s->configuration_name}}">{{$s->configuration_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div><br/></div>
                            <div class="control-group col-sm-12">
                                <div class="controls">
                                    <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Save</button>
                                </div>
                            </div>
                        </div>

                        @endif
                        {{Form::close()}}

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