@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Assignment Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">

                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Assignment</h3></strong></div><br/>


                        <?php $message = Assignment::where('idassignment','=',$id)->first();

                                $t = TeacherInfo::where('idteacherinfo','=',$message->idteacherinfo)->pluck('teacher_name');
                        ?>

                        @if($message!=null)




                            <table class="table">
                                <tr class="success">
                                    <td colspan="3"><i style='width:25px;height:20px;' class='fa fa-calendar'></i>{{$message->created_at}} (Given By : {{$t}})</td>
                                </tr>

                                <tr class="success">
                                    <td colspan="3"><b>{{$message->assignment_subject}} </b></td>
                                </tr>
                                <tr class="success">
                                    <td colspan="3"><b>{{$message->assignment_topic}} </b></td>
                                </tr>
                               
                                <tr class="success">
                                    <td colspan="3">{{$message->assignment_description}}</td>
                                </tr>

                                @if($message->filename!=null)
                                    <tr  class="success">
                                        <td colspan="3">
                                            <form action="{{ URL::to('assignment_management/getfile/'.$message->idassignment)}}">
                                                <button type="submit" class="btn btn-info"><i class="icon-download-alt"></i> Download This File</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                                <tr class="success">
                              @if(Auth::user()->type=='teacher')
                                    <td colspan="3"><a href="{{ URL::to('assignment_management/view_assignment')}}">Back</a> </td>
                               @else
                                <td colspan="3"><a href="{{ URL::to('assignment_management/student_assignment')}}">Back</a> </td>
                               @endif
                              </tr>
                            </table>
                        @endif
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