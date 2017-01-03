@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget-content">
            <div class="widget ">
                <div class="tabbable">
                    <ul class="nav nav-tabs">


                        <li class="active"><a href="{{URL::to('/attendance_management/stattendance_book')}}">My Attendance View</a></li>

                    </ul>
                    <div class="widget widget-nopad">
                        <div class="widget-header"><i class="icon-calendar"></i>

                            <h3>Attendance view</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content" style="overflow-x: auto">
                            <div>
                                <br/>
                                <center>
                                    <div class="col-sm-4"></div>

                                    {{Form::open(array('url'=>'attendance_management/att', 'class'=>'form-inline')) }}

                                    <div class="col-sm-3">
                                        <select name="month" class="form-control" style="width:160px;">
                                            <option>-&nbsp;Select Month&nbsp;-</option>
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

                                </center>

                                <div>
                                    <div class="col-sm-3"><button type="submit" id="mybtn" class="btn btn-info center-block">Search</button>
                                    </div>
                                    {{Form::close()}}
                                    <?php
                                    //$month = 'November';

                                    $mydate=getdate(date("U"));

                                    if($month !=[] || $month!=null){


                                        $month =  $month;
                                    }
                                    else{
                                        $month =  $mydate['month'];
                                    }

                                    if ($month != null) {
                                        $current_month = $month;
                                        //$current_year = date('Y');
                                        $current_year = date('Y');
                                    } else {
                                        $current_month = date('F');
                                        $current_year = date('Y');
                                    }

                                    $id = Auth::user()->id;
                                    $currentuser = User::find($id);
                                    $idstudent_info = $currentuser->email;

                                    $attendance = AttendanceSheet::where('studentinfo_idstudentinfo', '=', $idstudent_info)
                                            ->where('month', '=', $current_month)
                                            ->where('year', '=', $current_year)
                                            ->first();

                                    $shift = StudentToSectionUpdate::where('student_idstudentinfo', '=', $idstudent_info)->pluck('shift');

                                    $holyday= Configuration::where('shift','=',$shift)->pluck('weekly_holyday');
                                    $holyday_= Configuration::where('shift','=',$shift)->pluck('weekly_holyday1');
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
 $month_num = $month_number[$current_month];

for($i=2 ; $i<=$month_num; $i++) {

  $day += cal_days_in_month(CAL_GREGORIAN,$i-1,date("Y")); //echo $day;

                                    }


                                   /* foreach ($months as $month) {
                                        if ($month == $current_month) {
                                            $month_num = $month_number[$month]; echo $current_month;
                                            break;
                                        } else {
if($month_number[$current_month] > 1 ) {
                                            $x = $x + 1;
                                            $day = $day + 29 + ($x + floor($x / 8)) % 2 + 2 % $x + 2 * floor(1 / $x); echo $day."<br>"; }
                                        }
                                    } */



                                   /* $int_year = (int)$current_year;
                                        if (($int_year % 4 == 0 && $int_year % 100 == 0) || $int_year % 400 == 0) $day_in_shohag_feb = 29 ; else $day_in_shohag_feb = 28 ;

                                        $days_in_month =$day_in_shohag_feb + ($month_num + floor($month_num / 8)) % 2 + 2 % $month_num + 2 * floor(1 / $month_num); */
  $days_in_month = cal_days_in_month(CAL_GREGORIAN,$month_num,date("Y"));


                                    $space_day = $day % 7;




                                    ?>
                                    <br>

                                    <div class="form-group col-sm-12">
                                        {{ Form::open(array('url'=>'/calender','class'=>'form-horizontal')) }}

                                    </div>

                                    <?php
                                    $cp = 0;
                                    $ca = 0;
                                    ?>

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
                                                            $holy11 = strtoupper($holyday_);
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
                                                                    @elseif ($holy1==$holy2 || $holy11==$holy2 )
                                                                        <?php  $id = "summery" . $counter;

                                                                        $type = "Holiday"?>
                                                                        <td bgcolor="#DBFFFF">
                                                                    @elseif ($day_database==0)
                                                                        <?php  $id = "summery" . $counter;

                                                                        ?>
                                                                        @if($dayint-1>=$count_day)
                                                                            <td bgcolor="#FF9999">
                                                                            <?php $count_absent++;

                                                                                 $ca++;

                                                                            $type = "absent"?>
                                                                        @else
                                                                            <td bgcolor="#FF9999">
                                                                            <?php $type = "absent";
                                                                                $ca++;
                                                                                ?>
                                                                        @endif

                                                                    @elseif ($day_database==1)
                                                                        <?php  $id = "summery" . $counter;

                                                                        $type = "Present"?>
                                                                        <td bgcolor="#80CC80">
                                                                        <?php $count_present++;

                                                                            $cp++;
                                                                            ?>
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


                                        <div class="form-group col-sm-12">
                                            <table>

                                                <tr>
                                                    <td>Present</td>
                                                    <td></td>

                                                    <td bgcolor="#80CC80" width="80"><p style="text-align:center" id="present_id"><?php echo $cp?></p></td>
                                                    <td></td>
                                                    <td>Absent</td>
                                                    <td></td>

                                                    <td bgcolor="#FF9999" width="80"><p style="text-align:center" id="absent_id"><?php echo $ca ?></p></td>

                                                    <td></td>
                                                    <td style="font-weight: bold"> day(s) </td>

                                                </tr>
                                            </table>

                                            {{Form::close()}}
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