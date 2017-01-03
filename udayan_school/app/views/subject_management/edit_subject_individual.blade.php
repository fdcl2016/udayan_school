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
                        <li  class="active"><a href="{{ URL::to('/subject_management/edit_subject')}}">Edit Subject</a></li>
                        <li><a href="{{ URL::to('/subject_management/assign_subject_to_teacher')}}">Assign Subject To Teacher</a></li>
                        <li><a href="{{ URL::to('/subject_management/classwise_subject')}}">Classwise Subject</a></li>
                        <li><a href="{{ URL::to('/subject_management/classwise_subject_list')}}">Classwise Subject List</a></li>
                        <li>
                            <a href="{{ URL::to('/result_management/configure_result')}}">Configure Result</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/result_management/list_of_config')}}">List of Configuration</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Edit Subject</h3></strong></div><br/>
                        {{Form::open(array('url'=>'subject_management/post_edit_subject','class'=>'form-horizontal','files'=>'true'))}}
                        <fieldset>
                            <div class="control-group col-sm-8">
                                <label class="control-label" for="subject_name">Subject Name</label>
                                <div class="controls">
                                    <input type="text" class="span6" name="subject_name"  value="{{$subject->subject_name}}" required>
                                    {{Form::hidden('id',$subject->idsubject)}}
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <br /><br />
                            <div class="control-group col-sm-12">
                                <div class="controls">
                                    <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Save</button>
                                </div>

                            </div>
                        </fieldset>

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