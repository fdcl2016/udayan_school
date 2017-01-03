@extends('master.master')
@section('header')
    <link href="{{ URL::asset('master/css/pages/dashboard.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('master/calender/basic.css') }}" rel="stylesheet">
@stop
@section('content')
    <div class="span6">
        <div class="widget widget-nopad">
            <div class="widget-header"><i class="icon-list-alt"></i>

                <h3> Stats</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="widget big-stats-container">
                    <div class="widget-content">
                        <h6 class="bigstats">This is school stats option</h6>
 <?php $stdno= User::where('type','=','student')->get();
        $tno= User::where('type','=','teacher')->get();
	       $countstudent= count($stdno);
	        $countteacher=count($tno); ?>
                        <div id="big_stats" class="cf">
                            <div class="stat">No. of Students<br> <span class="value"><?php echo $countstudent; ?></span></div>
                            <!-- .stat -->

                            <div class="stat">No. of Teachers<br> <span class="value"><?php echo $countteacher; ?></span></div>
                            <!-- .stat -->

                            <div class="stat">Active Students (web) <span class="value">922</span></div>
                            <!-- .stat -->

                            <div class="stat"> Facebook Members <span class="value">2500</span></div>
                            <!-- .stat -->
                        </div>
                    </div>
                    <!-- /widget-content -->

                </div>
            </div>
        </div>
        <!-- /widget -->
        <div class="widget widget-nopad">
            <div class="widget-header"><i class="icon-calendar"></i>

                <h3>Event & Holiday</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div>
                    <?php
                    if ($month != null) {
                        $current_month = $month;
                        $current_year = date('Y');
                    } else {
                        $current_month = date('F');
                        $current_year = date('Y');
                    }

                    $id = Auth::user()->id;
                    $currentuser = User::find($id);
                    $idstudent_info = $currentuser->user_id;

                    $attendance = AttendanceSheet::where('studentinfo_idstudentinfo', '=', $idstudent_info)
                            ->where('month', '=', $current_month)
                            ->where('year', '=', $current_year)
                            ->first();

                    $shift = StudentToSectionUpdate::where('student_idstudentinfo', '=', $idstudent_info)->pluck('shift');

                        $holyday= Configuration::where('shift','=',$shift)->pluck('weekly_holyday');
                    $like_month="%" . $current_month . "%";
                    $allevents= EventAnnualCalender::where('h_date','LIKE',$like_month)->where('ac_year','LIKE','%'.$current_year.'%')->get();



                    $count = 0;

                    for ($i = 1; $i <= 31; $i++) {
                        $date[$i] = "no";
                        $tepes[$i] = "no";
                        $names[$i] = "no";


                    }
                    for ($i = 1; $i <= 31; $i++) {
                        foreach ($allevents as $event) {

                            $date4 = $event->h_date;


                            if ($i / 10 < 1) {
                                $days = "0" . "$i" . " " . $current_month . " " . $current_year;
                                if ($date4 == $days) {
                                    $date[$i] = "yes";
                                    $types[$i] = $event->type;
                                    $names[$i] = $event->name;
                                }

                            } else {
                                $days = "$i" . " " . $current_month . " " . $current_year;
                                if ($date4 == $days) {
                                    $date[$i] = "yes";
                                    $types[$i] = $event->type;
                                    $names[$i] = $event->name;
                                }

                            }

                        }
                    }





                    $year = array(
                            "2000" => 6,
                            "2001" => 1,
                            "2002" => 2,
                            "2003" => 3,
                            "2004" => 4,
                            "2005" => 6,
                            "2006" => 0,
                            "2007" => 1,
                            "2008" => 2,
                            "2009" => 4,
                            "2010" => 5,
                            "2011" => 6,
                            "2012" => 0,
                            "2013" => 2,
                            "2014" => 3,
                            "2015" => 4,
                            "2016" => 5,
                            "2017" => 0,
                            "2018" => 1,
                            "2019" => 2,
                            "2020" => 3,
                            "2021" => 5,
                            "2022" => 6,
                            "2023" => 0,
                            "2024" => 1,
                            "2025" => 3,
                            "2026" => 4,
                            "2027" => 5,
                            "2028" => 6,
                            "2029" => 1,


                    );

                    $month_number = array(
                            "January" => 1,
                            "February" => 2,
                            "March" => 3,
                            "April" => 4,
                            "May" => 5,
                            "June" => 6,
                            "July" => 7,
                            "August" => 8,
                            "September" => 9,
                            "October" => 10,
                            "November" => 11,
                            "December" => 12,

                    );

                    $months = array("January", "February", "March", "April", "May",
                            "June", "July", "August", "September", "October",
                            "November", "December");
                    $days = array("Sunday", "Monday", "Tuesday", "Wednesday",
                            "Thursday", "Friday", "Saturday");


                    $month_num;
                    $days_in_month;

                    $counter = -1;
                    $count_day = 0;
                    $count_day1 = 1;
                    $count_present = 0;
                    $count_absent = 0;
                    $dayint=0;
                    $day=0;

                    $x = 0;
                    $day = $year[$current_year];


                    foreach ($months as $month) {
                        if ($month == $current_month) {
                            $month_num = $month_number[$month];
                            break;
                        } else {
                            $x = $x + 1;
                            $day = $day + 28 + ($x + floor($x / 8)) % 2 + 2 % $x + 2 * floor(1 / $x);
                        }
                    }



                    if ($months[1] == $current_month) {
                        $int_year = (int)$current_year;

                        if ($int_year % 4 == 0) {

                            if ($int_year % 100 == 0) {

                                if ($int_year % 400 == 0) {

                                    $days_in_month = 29 + ($month_num + floor($month_num / 8)) % 2 + 2 % $month_num + 2 * floor(1 / $month_num);

                                } else {
                                    $days_in_month = 28 + ($month_num + floor($month_num / 8)) % 2 + 2 % $month_num + 2 * floor(1 / $month_num);
                                }

                            } else {
                                $days_in_month = 28 + ($month_num + floor($month_num / 8)) % 2 + 2 % $month_num + 2 * floor(1 / $month_num);
                            }

                        } else {
                            $days_in_month = 28 + ($month_num + floor($month_num / 8)) % 2 + 2 % $month_num + 2 * floor(1 / $month_num);

                        }
                    } else {
                        $days_in_month = 28 + ($month_num + floor($month_num / 8)) % 2 + 2 % $month_num + 2 * floor(1 / $month_num);

                    }
                    $space_day = $day % 7;



                    ?>
                    <br>

                    <div class="form-group col-sm-12">
                        {{ Form::open(array('url'=>'/calender','class'=>'form-horizontal')) }}
                        <div class="col-sm-6">
                            <div class="col-sm-6"><label for="comment">Enter Month:</label></div>
                            <div class="col-sm-6"><select class="form-control" name="month" id="month" onchange=""
                                                          size="1">
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary"> Search</button>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <table>

                            <tr>
                                <td>Present</td>
                                <td></td>

                                <td bgcolor="#80CC80" width="80"><p style="text-align:center" id="present_id"></p></td>
                                <td></td>
                                <td>Absent</td>
                                <td></td>

                                <td bgcolor="#FF9999" width="80"><p style="text-align:center" id="absent_id"></p></td>

                            </tr>
                        </table>

                        {{Form::close()}}
                    </div>
                    <br>
<div class="form-group col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered" border="10">
                            <thead>
                            <tr>
                                <th colspan="7" bgcolor="#DBFFFF"><p class="text-center"> {{$current_month}}
                                        ,{{$current_year}} </p></th>
                            </tr>
                            <tr>
                                @foreach($days as $day)
                                    <th bgcolor="#DBFFFF">{{$day}}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0; $i< 6; $i++)
                                <tr>

                                    @foreach($days as $day)
                                        <?php  $counter++?>
                                        <?php

                                                  $daysss=date('d');
                                                  $dayint = (int)$daysss;

                                                ?>

                                        <?php
                                        $eventdesc = '';
                                        if ($attendance != null) {
                                            if ($count_day / 10 < 1) {
                                                $dayss = "day0" . $count_day1;

                                                $day_database = $attendance->$dayss;
                                            } else {
                                                $dayss = "day" . $count_day1;
                                                $day_database = $attendance->$dayss;
                                            }

                                        } else {
                                            $day_database = 3;
                                        }



                                        $holy1 = strtoupper($holyday);
                                        $holy2 = strtoupper($day);

                                        ?>



                                        @if($counter < $space_day)
                                            <td>
                                                @endif
                                                @if($counter>=$space_day)

                                                    <?php  $count_day++; ?>



                                                    @if($count_day<=$days_in_month)
                                                        @if ($date[$count_day1]=="yes")
                                                            @if($types[$count_day1]!=null)
                                                                <?php  $id = "summery" . $counter;

                                                                $type = $types[$count_day1];
                                                                $name = $names[$count_day1];

                                                                if ($type == "event") {
                                                                    $event_descs = EventsManagement::where('event_name', '=', $name)->first();
                                                                    //echo $name;
                                                                    if ($event_descs != "") {
                                                                        $eventdesc = $event_descs->event_description;
                                                                        $startDate = $event_descs->start_date;
                                                                        $endDate = $event_descs->end_date;
                                                                        $startTime = $event_descs->start_time;
                                                                        $endTime = $event_descs->end_time;
                                                                        $eventPlace = $event_descs->event_place;
                                                                        $eventName = $event_descs->event_name;


                                                                    }


                                                                } elseif ($type == "annual_calender") {

                                                                   $event_descs1= AnnualCalender::where('holiday_name','=',$name)->where('ac_year','LIKE','%'.$current_year.'%')->first();

                                                                    if ($event_descs1 != null) {
                                                                        $eventdesc = $event_descs1->holiday_description;

                                                                        $startDate = $event_descs1->from_date;
                                                                        $endDate = $event_descs1->to_date;
                                                                        $nameOfHolyday = $event_descs1->holiday_name;
                                                                        $typeOfHolyday = $event_descs1->holiday_type;

                                                                    }

                                                                }

                                                                ?>


                                                                @if($type=="event")

                                                <td   bgcolor="#66FFFF" class="modal-td"onclick="myFunctionEvent('<?php echo $id; ?>','<?php echo addslashes(htmlspecialchars($eventdesc));?>','<?php echo $startDate;?>','<?php echo $endDate;?>','<?php echo $startTime;?>','<?php echo $endTime;?>','<?php echo $eventPlace;?>','<?php echo $eventName;?>' )">

                                                    @elseif($type=="annual_calender")
                                                <td  bgcolor="#66FFFF" class="modal-td"onclick="myFunctionAnualCalender('<?php echo $id; ?>','<?php echo addslashes(htmlspecialchars($eventdesc)); ?>','<?php echo $startDate; ?>','<?php echo $endDate; ?>','<?php echo $nameOfHolyday; ?>','<?php echo $typeOfHolyday; ?>' )">

                                                    @endif

                                                @endif
                                                @elseif ($holy1==$holy2)
                                                    <?php  $id = "summery" . $counter;

                                                    $type = "Holiday"?>
                                            <td bgcolor="#DBFFFF">
                                                @elseif ($day_database==0)
                                                    <?php  $id = "summery" . $counter;

                                                    ?>
                                            @if($dayint-1>=$count_day)
                                             <td bgcolor="#FF9999">
                                                <?php $count_absent++;$type = "Absent"?>
                                            @else
                                               <td>
                                               <?php $type = ""?>
                                            @endif

                                                @elseif ($day_database==1)
                                                    <?php  $id = "summery" . $counter;

                                                    $type = "Present"?>
                                            <td bgcolor="#80CC80">
                                                <?php $count_present++;?>
                                                @elseif ($day_database==3)
                                                    <?php
                                                    $type = ""?>
                                            <td>
                                                @endif

                                                @if($count_day1< 31)
                                                    <?php  $count_day1++ ?>
                                                @endif



                                                {{$count_day}}
                                                @if($eventdesc==null)
                                                    <p id="<?php echo $id?>">{{$type}}</p>
                                                @else

                                                    <div id='container'>

                                                        <div id='content'>
                                                            <div id='basic-modal'>
                                                                @if($type=="event")
                                                                    <a href="">{{$eventName}}</a>
                                                                @elseif($type=="annual_calender")
                                                                    <a href="">{{$nameOfHolyday}}</a>
                                                                @else
                                                                    {{$type}}
                                                                @endif


                                                            </div>

                                                        </div>

                                                    </div>
                                                @endif


                                            </td>

                                        @endif
                                        @endif

                                    @endforeach

                                </tr>
                            @endfor
                            </tbody>
                        </table>
                       </div>
                        <input id="absent" type="hidden" value="<?php echo $count_absent?>">
                        <input id="present" type="hidden" value="<?php echo $count_present?>">

                    </div>
                    <p id="demo"></p>

                    <div id="basic-modal-content"></div>


                </div>
            </div>
            <!-- /widget-content -->
        </div>
    </div>

    <!-- /span6 -->
    <div class="span6">
        <div class="widget">
            <div class="widget-header"><i class="icon-bookmark"></i>

                <h3>Important Shortcuts</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="shortcuts">
                    <a href="{{URL::to('/attendance_management/student_attendance_view')}}" class="shortcut"><i
                                class="shortcut-icon icon-file"></i><span
                                class="shortcut-label">Attendance Management</span> </a>
                    <a href="{{URL::to('/assignment_management/student_assignment')}}" class="shortcut"><i
                                class="shortcut-icon icon-file-text-alt icon-2x"></i><span class="shortcut-label">Assignment Management</span>
                    </a>
                <?php


                        $st_sess = Auth::user()->email;
                        $s= StudentToSection::where('student_idstudentinfo','=',$st_sess)->get();
                        $classsectionid = CurrentstudentClasssectionid::where('sutdent_id','=',$st_sess)->get();

                        $pub = PublishResult::all();

                        $term12 = ResultHallTest::where('studentinfo_idstudentinfo','=',$st_sess)->get();
                        $pb='N';


                       // echo $st_sess;

                        foreach($s as $st)
                        {
                        $year = $st-> year;
                        }
                        foreach($term12 as $t)
                        {
                        $term = $t-> term;
                        }

                       foreach($classsectionid as $cls)
                       {
                        $clsid = $cls->Class_id;
                       }


                       foreach($pub as $p){

                            $pb = $p->published;
                       }

                ?>

                @if($pb == 'Y')

                    <a href="{{ URL::to('/report12/'.$st_sess.'/'.$year.'/'.$term.'/'.$clsid)}}" class="shortcut"><i class="shortcut-icon icon-user"></i><span class="shortcut-label">Student Report</span> </a>
                @else

                <a href="{{ URL::to('/result_management/report_blank')}}" class="shortcut"><i class="shortcut-icon icon-user"></i><span class="shortcut-label">Student Report</span> </a>

                @endif

                    <a href="{{URL::to('/fees_management/student_fees_payslip_monthwise_view')}}" class="shortcut"><i
                                class="shortcut-icon icon-dollar"></i> <span class="shortcut-label">Fees&nbsp;&nbsp;&nbsp;&nbsp;  Management</span>
                    </a>

                </div>
                <!-- /widget-content -->
            </div>
            <!-- /widget -->
            <div class="widget">
                <div class="widget-header"><i class="icon-signal"></i>

                    <h3>Yearwise Student Result/Attendance</h3>
                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                    <canvas id="area-chart" class="chart-holder" height="250" width="538"></canvas>
                    <!-- /area-chart -->
                </div>
                <!-- /widget-content -->
            </div>
            <!-- /widget -->
            <div class="widget widget-nopad">
                <div class="widget-header"><i class="icon-list-alt"></i>

                    <h3> Notice/Announcement</h3>
                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                    <ul class="news-items">
                        <li>

                            <div class="news-item-date"><span class="news-item-day">29</span> <span
                                        class="news-item-month">Aug</span></div>
                            <div class="news-item-detail"><a href="http://www.egrappler.com/thursday-roundup-40/"
                                                             class="news-item-title" target="_blank">Thursday Roundup #
                                    40</a>

                                <p class="news-item-preview"> This is our web design and development news series where
                                    we share our favorite design/development related articles, resources, tutorials and
                                    awesome freebies. </p>
                            </div>

                        </li>
                        <li>

                            <div class="news-item-date"><span class="news-item-day">15</span> <span
                                        class="news-item-month">Jun</span></div>
                            <div class="news-item-detail"><a
                                        href="http://www.egrappler.com/retina-ready-responsive-app-landing-page-website-template-app-landing/"
                                        class="news-item-title" target="_blank">Retina Ready Responsive App Landing Page
                                    Website Template – App Landing</a>

                                <p class="news-item-preview"> App Landing is a retina ready responsive app landing page
                                    website template perfect for software and application developers and small business
                                    owners looking to promote their iPhone, iPad, Android Apps and software
                                    products.</p>
                            </div>

                        </li>
                        <li>

                            <div class="news-item-date"><span class="news-item-day">29</span> <span
                                        class="news-item-month">Oct</span></div>
                            <div class="news-item-detail"><a
                                        href="http://www.egrappler.com/open-source-jquery-php-ajax-contact-form-templates-with-captcha-formify/"
                                        class="news-item-title" target="_blank">Open Source jQuery PHP Ajax Contact Form
                                    Templates With Captcha: Formify</a>

                                <p class="news-item-preview"> Formify is a contribution to lessen the pain of creating
                                    contact forms. The collection contains six different forms that are commonly used.
                                    These open source contact forms can be customized as well to suit the need for your
                                    website/application.</p>
                            </div>

                        </li>
                    </ul>
                </div>
                <!-- /widget-content -->
            </div>
            <!-- /widget -->
        </div>
        <!-- /span6 -->
    </div>

    @stop
            <!-- /span6 -->
@section('content_footer')
    <script src="{{ URL::asset('master/js/excanvas.min.js') }}"></script>
    <script src="{{ URL::asset('master/js/chart.min.js') }}" type="text/javascript"></script>
    <script language="javascript" type="text/javascript"
            src="{{ URL::asset('master/js/full-calendar/fullcalendar.min.js') }}"></script>

    <script src="{{ URL::asset('master/js/base.js') }}"></script>
    <script>

        var lineChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    data: [65, 59, 90, 81, 56, 55, 40]
                },
                {
                    fillColor: "rgba(151,187,205,0.5)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    data: [28, 48, 40, 19, 96, 27, 100]
                }
            ]

        }

        var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData);


        var barChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,1)",
                    data: [65, 59, 90, 81, 56, 55, 40]
                },
                {
                    fillColor: "rgba(151,187,205,0.5)",
                    strokeColor: "rgba(151,187,205,1)",
                    data: [28, 48, 40, 19, 96, 27, 100]
                }
            ]

        }

        $(document).ready(function () {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        calendar.fullCalendar('renderEvent',
                                {
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                },
                                true // make the event "stick"
                        );
                    }
                    calendar.fullCalendar('unselect');
                },
                editable: true,
                events: [
                    {
                        title: 'All Day Event',
                        start: new Date(y, m, 1)
                    },
                    {
                        title: 'Long Event',
                        start: new Date(y, m, d + 5),
                        end: new Date(y, m, d + 7)
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d - 3, 16, 0),
                        allDay: false
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d + 4, 16, 0),
                        allDay: false
                    },
                    {
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false
                    },
                    {
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false
                    },
                    {
                        title: 'Birthday Party',
                        start: new Date(y, m, d + 1, 19, 0),
                        end: new Date(y, m, d + 1, 22, 30),
                        allDay: false
                    },
                    {
                        title: 'EGrappler.com',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        url: 'http://EGrappler.com/'
                    }
                ]
            });
        });
    </script>

    <script type='text/javascript' src="{{ URL::asset('master/calender/jquery.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset('master/calender/jquery.simplemodal.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset('master/calender/basic.js') }}"></script>

    <script>
        var absent = document.getElementById("absent").value;
        var present = document.getElementById("present").value;
        document.getElementById("present_id").innerHTML = present;
        document.getElementById("absent_id").innerHTML = absent;

        function myFunctionEvent(id, eventdesc, startDate, endDate, startTime, endTime, eventPlace, eventName) {

            text = " ";
            text += "<div style=\'width:100%;height:100%\'>";
            text += "<table border: \'none\'>";
            text += "<tbody>";
            text += "<tr>";
            text += "<td><i style=\'width:25px;height:20px;float:right;margin-left:5px;font-size:1.5em\' class=\'icon-calendar\'></i></td>";
            text += "<td>" + startDate + " To " + endDate + "</td>";

            text += "<td><i style=\'width:25px;height:20px;float:right;margin-left:5px;font-size:1.5em\' class=\'fa fa-clock-o\'></i></td>";
            text += "<td>" + startTime + " To " + endTime + "</td>";
            text += "</tr>";
            text += "</tbody>";
            text += "</table>";

            text += "<table border: \'none\' >";

            text += "<tr>";
            text += "<td colspan=\'2\'><h3 >" + eventName + "</h3><p>" + eventdesc + "</p></td>";

            text += "</tr>";


            text += "<tr>";
            text += "<td><b ><p style=\'float:left\'>Place : </p><p style=\'float:left\'>" + eventPlace + "</p> </b></td>";
            text += "</tr>";
            text += "</tbody>";
            text += "</table>";
            text += "</div>";


            $('#basic-modal-content').empty();
            $('#basic-modal-content').append(text);

        }

        function myFunctionAnualCalender(id, eventdesc, startDate, endDate, nameOfHolyday, typeOfHolyday) {

            text = " ";
            text += "<div style=\'width:100%;height:100%\'>";
            text += "<table border: \'none\'>";
            text += "<tbody>";
            text += "<tr>";
            text += "<td><i style=\'width:25px;height:20px;float:right;margin-left:5px;font-size:1.5em\' class=\'icon-calendar\'></i></td>";
            text += "<td>" + startDate + " To " + endDate + "</td>";
            text += "</tr>";
            text += "</tbody>";
            text += "</table>";

            text += "<table border: \'none\' >";
            text += "<tbody>";
            text += "<tr>";
            text += "<td colspan=\'2\'><h3>" + nameOfHolyday + "</h3><p>" + eventdesc + "</p></td>";

            text += "</tr>";
            text += "</tbody>";
            text += "</table>";
            text += "</div>";

            $('#basic-modal-content').empty();
            $('#basic-modal-content').append(text);

        }

    </script>


@stop
@section('header')
    <link href="{{ URL::asset('master/css/pages/dashboard.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('master/calender/basic.css') }}" rel="stylesheet">
@stop
@section('content')
    <div class="span6">
        <div class="widget widget-nopad">
            <div class="widget-header"><i class="icon-list-alt"></i>

                <h3> Stats</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="widget big-stats-container">
                    <div class="widget-content">
                        <h6 class="bigstats">This is school stats option</h6>

                        <div id="big_stats" class="cf">
                            <div class="stat">No. of Students <span class="value">851</span></div>
                            <!-- .stat -->

                            <div class="stat">No. of Staffs <span class="value">423</span></div>
                            <!-- .stat -->

                            <div class="stat">Active Students (web) <span class="value">922</span></div>
                            <!-- .stat -->

                            <div class="stat"> Facebook Members <span class="value">2500</span></div>
                            <!-- .stat -->
                        </div>
                    </div>
                    <!-- /widget-content -->

                </div>
            </div>
        </div>
        <!-- /widget -->
        <div class="widget widget-nopad">
            <div class="widget-header"><i class="icon-calendar"></i>

                <h3>Event & Holiday</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div>
                    <?php
                    if ($month != null) {
                        $current_month = $month;
                        $current_year = date('Y');
                    } else {
                        $current_month = date('F');
                        $current_year = date('Y');
                    }

                    $id = Auth::user()->id;
                    $currentuser = User::find($id);
                    $idstudent_info = $currentuser->user_id;

                    $attendance = AttendanceSheet::where('studentinfo_idstudentinfo', '=', $idstudent_info)
                            ->where('month', '=', $current_month)
                            ->where('year', '=', $current_year)
                            ->first();

                    $shift = StudentToSectionUpdate::where('student_idstudentinfo', '=', $idstudent_info)->pluck('shift');

                        $holyday= Configuration::where('shift','=',$shift)->pluck('weekly_holyday');
                    $like_month="%" . $current_month . "%";
                    $allevents= EventAnnualCalender::where('h_date','LIKE',$like_month)->where('ac_year','LIKE','%'.$current_year.'%')->get();



                    $count = 0;

                    for ($i = 1; $i <= 31; $i++) {
                        $date[$i] = "no";
                        $tepes[$i] = "no";
                        $names[$i] = "no";


                    }
                    for ($i = 1; $i <= 31; $i++) {
                        foreach ($allevents as $event) {

                            $date4 = $event->h_date;


                            if ($i / 10 < 1) {
                                $days = "0" . "$i" . " " . $current_month . " " . $current_year;
                                if ($date4 == $days) {
                                    $date[$i] = "yes";
                                    $types[$i] = $event->type;
                                    $names[$i] = $event->name;
                                }

                            } else {
                                $days = "$i" . " " . $current_month . " " . $current_year;
                                if ($date4 == $days) {
                                    $date[$i] = "yes";
                                    $types[$i] = $event->type;
                                    $names[$i] = $event->name;
                                }

                            }

                        }
                    }





                    $year = array(
                            "2000" => 6,
                            "2001" => 1,
                            "2002" => 2,
                            "2003" => 3,
                            "2004" => 4,
                            "2005" => 6,
                            "2006" => 0,
                            "2007" => 1,
                            "2008" => 2,
                            "2009" => 4,
                            "2010" => 5,
                            "2011" => 6,
                            "2012" => 0,
                            "2013" => 2,
                            "2014" => 3,
                            "2015" => 4,
                            "2016" => 5,
                            "2017" => 0,
                            "2018" => 1,
                            "2019" => 2,
                            "2020" => 3,
                            "2021" => 5,
                            "2022" => 6,
                            "2023" => 0,
                            "2024" => 1,
                            "2025" => 3,
                            "2026" => 4,
                            "2027" => 5,
                            "2028" => 6,
                            "2029" => 1,


                    );

                    $month_number = array(
                            "January" => 1,
                            "February" => 2,
                            "March" => 3,
                            "April" => 4,
                            "May" => 5,
                            "June" => 6,
                            "July" => 7,
                            "August" => 8,
                            "September" => 9,
                            "October" => 10,
                            "November" => 11,
                            "December" => 12,

                    );

                    $months = array("January", "February", "March", "April", "May",
                            "June", "July", "August", "September", "October",
                            "November", "December");
                    $days = array("Sunday", "Monday", "Tuesday", "Wednesday",
                            "Thursday", "Friday", "Saturday");


                    $month_num;
                    $days_in_month;

                    $counter = -1;
                    $count_day = 0;
                    $count_day1 = 1;
                    $count_present = 0;
                    $count_absent = 0;
                    $dayint=0;
                    $day=0;

                    $x = 0;
                    $day = $year[$current_year];


                    foreach ($months as $month) {
                        if ($month == $current_month) {
                            $month_num = $month_number[$month];
                            break;
                        } else {
                            $x = $x + 1;
                            $day = $day + 28 + ($x + floor($x / 8)) % 2 + 2 % $x + 2 * floor(1 / $x);
                        }
                    }



                    if ($months[1] == $current_month) {
                        $int_year = (int)$current_year;

                        if ($int_year % 4 == 0) {

                            if ($int_year % 100 == 0) {

                                if ($int_year % 400 == 0) {

                                    $days_in_month = 29 + ($month_num + floor($month_num / 8)) % 2 + 2 % $month_num + 2 * floor(1 / $month_num);

                                } else {
                                    $days_in_month = 28 + ($month_num + floor($month_num / 8)) % 2 + 2 % $month_num + 2 * floor(1 / $month_num);
                                }

                            } else {
                                $days_in_month = 28 + ($month_num + floor($month_num / 8)) % 2 + 2 % $month_num + 2 * floor(1 / $month_num);
                            }

                        } else {
                            $days_in_month = 28 + ($month_num + floor($month_num / 8)) % 2 + 2 % $month_num + 2 * floor(1 / $month_num);

                        }
                    } else {
                        $days_in_month = 28 + ($month_num + floor($month_num / 8)) % 2 + 2 % $month_num + 2 * floor(1 / $month_num);

                    }
                    $space_day = $day % 7;



                    ?>
                    <br>

                    <div class="form-group col-sm-12">
                        {{ Form::open(array('url'=>'/calender','class'=>'form-horizontal')) }}
                        <div class="col-sm-6">
                            <div class="col-sm-6"><label for="comment">Enter Month:</label></div>
                            <div class="col-sm-6"><select class="form-control" name="month" id="month" onchange=""
                                                          size="1">
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary"> Search</button>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <table>

                            <tr>
                                <td>Present</td>
                                <td></td>

                                <td bgcolor="#80CC80" width="80"><p style="text-align:center" id="present_id"></p></td>
                                <td></td>
                                <td>Absent</td>
                                <td></td>

                                <td bgcolor="#FF9999" width="80"><p style="text-align:center" id="absent_id"></p></td>

                            </tr>
                        </table>

                        {{Form::close()}}
                    </div>
                    <br>
<div class="form-group col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered" border="10">
                            <thead>
                            <tr>
                                <th colspan="7" bgcolor="#DBFFFF"><p class="text-center"> {{$current_month}}
                                        ,{{$current_year}} </p></th>
                            </tr>
                            <tr>
                                @foreach($days as $day)
                                    <th bgcolor="#DBFFFF">{{$day}}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0; $i< 6; $i++)
                                <tr>

                                    @foreach($days as $day)
                                        <?php  $counter++?>
                                        <?php 

                                                  $daysss=date('d');
                                                  $dayint = (int)$daysss;
                                                  
                                                ?>

                                        <?php
                                        $eventdesc = '';
                                        if ($attendance != null) {
                                            if ($count_day / 10 < 1) {
                                                $dayss = "day0" . $count_day1;

                                                $day_database = $attendance->$dayss;
                                            } else {
                                                $dayss = "day" . $count_day1;
                                                $day_database = $attendance->$dayss;
                                            }

                                        } else {
                                            $day_database = 3;
                                        }



                                        $holy1 = strtoupper($holyday);
                                        $holy2 = strtoupper($day);

                                        ?>



                                        @if($counter < $space_day)
                                            <td>
                                                @endif
                                                @if($counter>=$space_day)

                                                    <?php  $count_day++; ?>

                                                    

                                                    @if($count_day<=$days_in_month)
                                                        @if ($date[$count_day1]=="yes")
                                                            @if($types[$count_day1]!=null)
                                                                <?php  $id = "summery" . $counter;

                                                                $type = $types[$count_day1];
                                                                $name = $names[$count_day1];

                                                                if ($type == "event") {
                                                                    $event_descs = EventsManagement::where('event_name', '=', $name)->first();
                                                                    //echo $name;
                                                                    if ($event_descs != "") {
                                                                        $eventdesc = $event_descs->event_description;
                                                                        $startDate = $event_descs->start_date;
                                                                        $endDate = $event_descs->end_date;
                                                                        $startTime = $event_descs->start_time;
                                                                        $endTime = $event_descs->end_time;
                                                                        $eventPlace = $event_descs->event_place;
                                                                        $eventName = $event_descs->event_name;


                                                                    }


                                                                } elseif ($type == "annual_calender") {

                                                                   $event_descs1= AnnualCalender::where('holiday_name','=',$name)->where('ac_year','LIKE','%'.$current_year.'%')->first();

                                                                    if ($event_descs1 != null) {
                                                                        $eventdesc = $event_descs1->holiday_description;

                                                                        $startDate = $event_descs1->from_date;
                                                                        $endDate = $event_descs1->to_date;
                                                                        $nameOfHolyday = $event_descs1->holiday_name;
                                                                        $typeOfHolyday = $event_descs1->holiday_type;

                                                                    }

                                                                }

                                                                ?>

                                          
                                                                @if($type=="event")

                                                <td   bgcolor="#66FFFF" class="modal-td"onclick="myFunctionEvent('<?php echo $id; ?>','<?php echo addslashes(htmlspecialchars($eventdesc));?>','<?php echo $startDate;?>','<?php echo $endDate;?>','<?php echo $startTime;?>','<?php echo $endTime;?>','<?php echo $eventPlace;?>','<?php echo $eventName;?>' )">

                                                    @elseif($type=="annual_calender")
                                                <td  bgcolor="#66FFFF" class="modal-td"onclick="myFunctionAnualCalender('<?php echo $id; ?>','<?php echo addslashes(htmlspecialchars($eventdesc)); ?>','<?php echo $startDate; ?>','<?php echo $endDate; ?>','<?php echo $nameOfHolyday; ?>','<?php echo $typeOfHolyday; ?>' )">

                                                    @endif

                                                @endif
                                                @elseif ($holy1==$holy2)
                                                    <?php  $id = "summery" . $counter;

                                                    $type = "Holiday"?>
                                            <td bgcolor="#DBFFFF">
                                                @elseif ($day_database==0)
                                                    <?php  $id = "summery" . $counter;

                                                    ?>
                                            @if($dayint-1>=$count_day)
                                             <td bgcolor="#FF9999">
                                                <?php $count_absent++;$type = "Absent"?>
                                            @else
                                               <td> 
                                               <?php $type = ""?>
                                            @endif
                                           
                                                @elseif ($day_database==1)
                                                    <?php  $id = "summery" . $counter;

                                                    $type = "Present"?>
                                            <td bgcolor="#80CC80">
                                                <?php $count_present++;?>
                                                @elseif ($day_database==3)
                                                    <?php
                                                    $type = ""?>
                                            <td>
                                                @endif

                                                @if($count_day1< 31)
                                                    <?php  $count_day1++ ?>
                                                @endif
                                                
                                               
                                                 
                                                {{$count_day}}
                                                @if($eventdesc==null)
                                                    <p id="<?php echo $id?>">{{$type}}</p>
                                                @else

                                                    <div id='container'>

                                                        <div id='content'>
                                                            <div id='basic-modal'>
                                                                @if($type=="event")
                                                                    <a href="">{{$eventName}}</a>
                                                                @elseif($type=="annual_calender")
                                                                    <a href="">{{$nameOfHolyday}}</a>
                                                                @else
                                                                    {{$type}}
                                                                @endif


                                                            </div>

                                                        </div>

                                                    </div>
                                                @endif


                                            </td>

                                        @endif
                                        @endif

                                    @endforeach

                                </tr>
                            @endfor
                            </tbody>
                        </table>
                       </div>
                        <input id="absent" type="hidden" value="<?php echo $count_absent?>">
                        <input id="present" type="hidden" value="<?php echo $count_present?>">

                    </div>
                    <p id="demo"></p>

                    <div id="basic-modal-content"></div>


                </div>
            </div>
            <!-- /widget-content -->
        </div>
    </div>

    <!-- /span6 -->
    <div class="span6">
        <div class="widget">
            <div class="widget-header"><i class="icon-bookmark"></i>

                <h3>Important Shortcuts</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="shortcuts">
                    <a href="{{URL::to('/attendance_management/student_attendance_view')}}" class="shortcut"><i
                                class="shortcut-icon icon-file"></i><span
                                class="shortcut-label">Attendance Management</span> </a>
                    <a href="{{URL::to('/assignment_management/student_assignment')}}" class="shortcut"><i
                                class="shortcut-icon icon-file-text-alt icon-2x"></i><span class="shortcut-label">Assignment Management</span>
                    </a>

                    <a href="{{ URL::to('/result_management/student_result')}}" class="shortcut"><i class="shortcut-icon icon-user"></i><span class="shortcut-label">Student Report</span> </a>


                    <a href="{{URL::to('/fees_management/student_fees_payslip_monthwise_view')}}" class="shortcut"><i
                                class="shortcut-icon icon-dollar"></i> <span class="shortcut-label">Fees&nbsp;&nbsp;&nbsp;&nbsp;  Management</span>
                    </a>

                </div>
                <!-- /widget-content -->
            </div>
            <!-- /widget -->
            <div class="widget">
                <div class="widget-header"><i class="icon-signal"></i>

                    <h3>Yearwise Student Result/Attendance</h3>
                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                    <canvas id="area-chart" class="chart-holder" height="250" width="538"></canvas>
                    <!-- /area-chart -->
                </div>
                <!-- /widget-content -->
            </div>
            <!-- /widget -->
            <div class="widget widget-nopad">
                <div class="widget-header"><i class="icon-list-alt"></i>

                    <h3> Notice/Announcement</h3>
                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                    <ul class="news-items">
                        <li>

                            <div class="news-item-date"><span class="news-item-day">29</span> <span
                                        class="news-item-month">Aug</span></div>
                            <div class="news-item-detail"><a href="http://www.egrappler.com/thursday-roundup-40/"
                                                             class="news-item-title" target="_blank">Thursday Roundup #
                                    40</a>

                                <p class="news-item-preview"> This is our web design and development news series where
                                    we share our favorite design/development related articles, resources, tutorials and
                                    awesome freebies. </p>
                            </div>

                        </li>
                        <li>

                            <div class="news-item-date"><span class="news-item-day">15</span> <span
                                        class="news-item-month">Jun</span></div>
                            <div class="news-item-detail"><a
                                        href="http://www.egrappler.com/retina-ready-responsive-app-landing-page-website-template-app-landing/"
                                        class="news-item-title" target="_blank">Retina Ready Responsive App Landing Page
                                    Website Template – App Landing</a>

                                <p class="news-item-preview"> App Landing is a retina ready responsive app landing page
                                    website template perfect for software and application developers and small business
                                    owners looking to promote their iPhone, iPad, Android Apps and software
                                    products.</p>
                            </div>

                        </li>
                        <li>

                            <div class="news-item-date"><span class="news-item-day">29</span> <span
                                        class="news-item-month">Oct</span></div>
                            <div class="news-item-detail"><a
                                        href="http://www.egrappler.com/open-source-jquery-php-ajax-contact-form-templates-with-captcha-formify/"
                                        class="news-item-title" target="_blank">Open Source jQuery PHP Ajax Contact Form
                                    Templates With Captcha: Formify</a>

                                <p class="news-item-preview"> Formify is a contribution to lessen the pain of creating
                                    contact forms. The collection contains six different forms that are commonly used.
                                    These open source contact forms can be customized as well to suit the need for your
                                    website/application.</p>
                            </div>

                        </li>
                    </ul>
                </div>
                <!-- /widget-content -->
            </div>
            <!-- /widget -->
        </div>
        <!-- /span6 -->
    </div>

    @stop
            <!-- /span6 -->
@section('content_footer')
    <script src="{{ URL::asset('master/js/excanvas.min.js') }}"></script>
    <script src="{{ URL::asset('master/js/chart.min.js') }}" type="text/javascript"></script>
    <script language="javascript" type="text/javascript"
            src="{{ URL::asset('master/js/full-calendar/fullcalendar.min.js') }}"></script>

    <script src="{{ URL::asset('master/js/base.js') }}"></script>
    <script>

        var lineChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    data: [65, 59, 90, 81, 56, 55, 40]
                },
                {
                    fillColor: "rgba(151,187,205,0.5)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    data: [28, 48, 40, 19, 96, 27, 100]
                }
            ]

        }

        var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData);


        var barChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,1)",
                    data: [65, 59, 90, 81, 56, 55, 40]
                },
                {
                    fillColor: "rgba(151,187,205,0.5)",
                    strokeColor: "rgba(151,187,205,1)",
                    data: [28, 48, 40, 19, 96, 27, 100]
                }
            ]

        }

        $(document).ready(function () {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        calendar.fullCalendar('renderEvent',
                                {
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                },
                                true // make the event "stick"
                        );
                    }
                    calendar.fullCalendar('unselect');
                },
                editable: true,
                events: [
                    {
                        title: 'All Day Event',
                        start: new Date(y, m, 1)
                    },
                    {
                        title: 'Long Event',
                        start: new Date(y, m, d + 5),
                        end: new Date(y, m, d + 7)
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d - 3, 16, 0),
                        allDay: false
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d + 4, 16, 0),
                        allDay: false
                    },
                    {
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false
                    },
                    {
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false
                    },
                    {
                        title: 'Birthday Party',
                        start: new Date(y, m, d + 1, 19, 0),
                        end: new Date(y, m, d + 1, 22, 30),
                        allDay: false
                    },
                    {
                        title: 'EGrappler.com',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        url: 'http://EGrappler.com/'
                    }
                ]
            });
        });
    </script>

    <script type='text/javascript' src="{{ URL::asset('master/calender/jquery.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset('master/calender/jquery.simplemodal.js') }}"></script>
    <script type='text/javascript' src="{{ URL::asset('master/calender/basic.js') }}"></script>

    <script>
        var absent = document.getElementById("absent").value;
        var present = document.getElementById("present").value;
        document.getElementById("present_id").innerHTML = present;
        document.getElementById("absent_id").innerHTML = absent;

        function myFunctionEvent(id, eventdesc, startDate, endDate, startTime, endTime, eventPlace, eventName) {

            text = " ";
            text += "<div style=\'width:100%;height:100%\'>";
            text += "<table border: \'none\'>";
            text += "<tbody>";
            text += "<tr>";
            text += "<td><i style=\'width:25px;height:20px;float:right;margin-left:5px;font-size:1.5em\' class=\'icon-calendar\'></i></td>";
            text += "<td>" + startDate + " To " + endDate + "</td>";

            text += "<td><i style=\'width:25px;height:20px;float:right;margin-left:5px;font-size:1.5em\' class=\'fa fa-clock-o\'></i></td>";
            text += "<td>" + startTime + " To " + endTime + "</td>";
            text += "</tr>";
            text += "</tbody>";
            text += "</table>";

            text += "<table border: \'none\' >";

            text += "<tr>";
            text += "<td colspan=\'2\'><h3 >" + eventName + "</h3><p>" + eventdesc + "</p></td>";

            text += "</tr>";


            text += "<tr>";
            text += "<td><b ><p style=\'float:left\'>Place : </p><p style=\'float:left\'>" + eventPlace + "</p> </b></td>";
            text += "</tr>";
            text += "</tbody>";
            text += "</table>";
            text += "</div>";


            $('#basic-modal-content').empty();
            $('#basic-modal-content').append(text);

        }

        function myFunctionAnualCalender(id, eventdesc, startDate, endDate, nameOfHolyday, typeOfHolyday) {

            text = " ";
            text += "<div style=\'width:100%;height:100%\'>";
            text += "<table border: \'none\'>";
            text += "<tbody>";
            text += "<tr>";
            text += "<td><i style=\'width:25px;height:20px;float:right;margin-left:5px;font-size:1.5em\' class=\'icon-calendar\'></i></td>";
            text += "<td>" + startDate + " To " + endDate + "</td>";
            text += "</tr>";
            text += "</tbody>";
            text += "</table>";

            text += "<table border: \'none\' >";
            text += "<tbody>";
            text += "<tr>";
            text += "<td colspan=\'2\'><h3>" + nameOfHolyday + "</h3><p>" + eventdesc + "</p></td>";

            text += "</tr>";
            text += "</tbody>";
            text += "</table>";
            text += "</div>";

            $('#basic-modal-content').empty();
            $('#basic-modal-content').append(text);

        }

    </script>


@stop