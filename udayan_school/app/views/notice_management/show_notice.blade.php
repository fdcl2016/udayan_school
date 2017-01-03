@extends('master.master')
@section('header')
@stop
@section('content')


    <?php
    $rasel = 2;
    include_once(app_path().'/views/nav_config/a_notice.php');
    ?>
    <div class="tab-content">
        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                        style="color:black">Show Notice</h3></strong></div><br/>
        @if($notice!=null)
            @foreach($notice as $n)
                <table class="table">
                    <tr class="success">
                        <td colspan="3"><i style='width:25px;height:20px;' class='icon-calendar'></i> {{$n->date}}</td>
                    </tr>

                    <tr class="success">
                        <td colspan="3"><b><a href="{{ URL::to('/notice_management/individual_notice/'.$n->idnotice)}}">{{$n->title}}</a> </b></td>
                    </tr>
                    @if($n->filename!=null)
                        <tr  class="success">
                            <td colspan="3">
                                <form action="/notice_management/getfile/{{$n->idnotice}}">
                                    <button type="submit" class="btn btn-info"><i class="icon-download-alt"></i> Download This File</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                </table>
            @endforeach
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