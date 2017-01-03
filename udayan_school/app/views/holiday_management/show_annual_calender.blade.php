@extends('master.master')
@section('header')
    <link href="{{ URL::asset('master/css/pages/dashboard.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('master/calender/basic.css') }}" rel="stylesheet">
@stop
@section('content')


    <?php
    $rasel = 4;
    include_once(app_path().'/views/nav_config/a_holiday_management.php');
    ?>

    <div id="basic-modal-content"> </div>
    <div class="tab-content">
        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                        style="color:black">Showing Annual Calender</h3></strong></div><br/>
        <div class="fdcl_content_profile">
            <div class="widget-header"></div>
            <div class="widget-content">

                <?php $i=1; ?>

                <div id="addclass" style=" align-content:center; border:1px solid gray;width:auto; max-height: 450px; height: auto;  overflow-y:scroll;overflow-x:hidden;">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="resource-link" style="width:5%">SL No</th>
                                <th class="resource-link" style="width:20%">Holiday Title</th>
                                <th class="resource-link" style="width:11%">Holiday Type</th>
                                <th class="resource-link" style="width:11%">Start Time</th>
                                <th class="resource-link" style="width:11%">End Time</th>
                                <th class="resource-link" style="width:11%">View</th>
                                <th class="resource-link" style="width:11%">Edit</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($calender as $event)

                                <tr>
                                    <td >{{$i++}}</td>
                                    <td>{{$event->holiday_name}}</td>
                                    <td>{{$event->holiday_type}}</td>
                                    <td>{{date("d-m-Y", strtotime($event->from_date))}}</td>
                                    <td>{{date("d-m-Y", strtotime($event->to_date))}}</td>
                                    <td>
                                        <div id='container' >

                                            <div id='content' >
                                                <div id='basic-modal'>
                                                    <div bgcolor="#66FFFF" class="modal-td"onclick="myFunctionAnualCalender('<?php echo $event->idannualcalender; ?>','<?php echo addslashes(htmlspecialchars($event->holiday_description)); ?>','<?php echo date('d-m-Y',strtotime($event->from_date)); ?>','<?php echo date('d-m-Y',strtotime($event->to_date)); ?>','<?php echo $event->holiday_name; ?>','<?php echo $event->holiday_type; ?>' )"><button class="btn btn-primary"><i class="icon-external-link"></i></button>  </div>
                                                </div>

                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <?php
                                        $date = new DateTime($event->to_date);
                                        $now = new DateTime();

                                        if($date < $now)
                                        echo 'Passed';
                                        else {

                                        ?>
                                        <a href="<?php echo 'edit_annual_calender/'.$event->idannualcalender; ?>"> <button class="btn btn-primary"><i class="icon-external-link"></i></button></a><?php } ?></td>
                                </tr>
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
    <script src="{{ URL::asset('date/jquery.datepick.js')}}"></script>
    <script>
        $(function() {
            $('#popupDatepicker').datepick();
        });
        $(function() {
            $('#popupDatepicker2').datepick();
        });

        function myFunctionAnualCalender(id,eventdesc,startDate,endDate,nameOfHolyday,typeOfHolyday){

            text =" ";
            text +="<div style=\'width:100%;height:100%\'>";
            text +="<table border: \'none\'>";
            text +="<tbody>";
            text +="<tr>";
            text +="<td><i style=\'width:25px;height:20px;float:right;margin-left:5px;font-size:1.5em\' class=\'icon-calendar\'></i></td>";
            text +="<td>"+startDate+" To "+endDate+"</td>";
            text +="</tr>";
            text +="</tbody>";
            text +="</table>";

            text +="<table border: \'none\' >";
            text +="<tbody>";
            text +="<tr>";
            text +="<td colspan=\'2\'><h3>"+nameOfHolyday+"</h3><p>"+eventdesc+"</p></td>";

            text +="</tr>";
            text +="</tbody>";
            text +="</table>";
            text +="</div>";

            $('#basic-modal-content').empty();
            $('#basic-modal-content').append(text);

        }

    </script>

    <script src="{{ URL::asset('master/js/excanvas.min.js') }}"></script>
    <script src="{{ URL::asset('master/js/chart.min.js') }}" type="text/javascript"></script>
    <script language="javascript" type="text/javascript" src="{{ URL::asset('master/js/full-calendar/fullcalendar.min.js') }}"></script>

    <script src="{{ URL::asset('master/js/base.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset('master/calender/jquery.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset('master/calender/jquery.simplemodal.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset('master/calender/basic.js') }}"></script>

@stop