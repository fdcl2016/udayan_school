@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Notice Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">

                    <div class="tab-content">

                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Show Notice</h3></strong></div><br/>
                        @if($notice!=null)
                            <table class="table">
                                <tr class="success">
                                    <td colspan="3"><i style='width:25px;height:20px;' class='icon-calendar'></i> {{$notice->date}}</td>
                                </tr>

                                <tr class="success">
                                    <td colspan="3"><b>{{$notice->title}}</b></td>
                                </tr>
                                <tr  class="success">
                                    <td colspan="3">{{$notice->short_desc}}</td>
                                </tr>
                                <tr class="success">
                                    <td colspan="3">{{$notice->description}}</td>
                                </tr>
                                @if($notice->filename!=null)
                                    <tr  class="success">
                                        <td colspan="3">
                                            <form action="/notice_management/getfile/{{$notice->idnotice}}">
                                                <button type="submit" class="btn btn-info"><i class="icon-download-alt"></i> Download This File</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                                <tr class="success">
                                    <td colspan="3"><a href="{{ URL::to('/notice_management/show_notice_all')}}">back</a> </td>
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