@extends('master.master')
@section('header')
    <link href="{{ URL::asset('master/css/pages/dashboard.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('master/calender/basic.css') }}" rel="stylesheet">
@stop
@section('content')


    <?php
    $rasel = 1;
    include_once(app_path().'/views/nav_config/a_reports.php');
    ?>
    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3>Students Report</h3></strong></div>
    <div id="stdregister_div"></div>
    <div class="tab-content">


        <div class="row">

            <div class="span11" style="margin-left:25px">

                    <div class="widget">
                        <div class="widget-header"> <i class="icon-bookmark"></i>
                            <h3>Classes</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <div class="shortcuts">

                                <?php

                                $class_name = Addclass::groupBy('class_name')->orderBy('value','ASC')->get();
                                ?>

                                @foreach($class_name as $cl)

                                    <a href="{{ URL::to('/reports/report/class/'.$cl->class_name)}}" class="shortcut"><i class="shortcut-icon icon-book"></i><span class="shortcut-label">{{$cl->class_name}}</span> </a>

                                @endforeach                  </div>
                            <!-- /widget-content -->
                        </div>
                  
                </div>



            </div>
            <!-- /span8 -->


        </div>
        <!-- /row -->


    </div>
    <!-- /container -->
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


    <link href="{{ URL::asset('date/jquery.datepick.css')}}" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ URL::asset('date/jquery.plugin.js')}}"></script>
    <scrit src="{{ URL::asset('date/jquery.datepick.js')}}"></scrit>


@stop