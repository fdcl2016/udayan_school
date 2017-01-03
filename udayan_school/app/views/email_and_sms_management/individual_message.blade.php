@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Email & SMS Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                  
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Message</h3></strong></div><br/>
                    

    <?php $message = MessageCL::where('idmessage','=',$id)->first();?>

    @if($message!=null)
     
   
       

            <table class="table">
                <tr class="success">
                    <td colspan="3"><i style='width:25px;height:20px;' class='fa fa-calendar'></i>{{$message->created_at}}</td>
                </tr>

                <tr class="success">
                    <td colspan="3"><b>{{$message->message_subject}} </b></td>
                </tr>
                <tr class="success">
                    <td colspan="3">{{$message->message_description}}</td>
                </tr>
                <tr class="success">
                    <td colspan="3"><a href="{{ URL::to('/showmessage')}}">back</a> </td>
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