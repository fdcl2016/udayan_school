@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Routine</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="{{ URL::to('/routine/create_routine')}}">Create Routine</a>
                        </li>
                        <li><a href="{{ URL::to('/routine/create_configuration')}}">Create Configuration</a></li>
                        <li><a href="{{ URL::to('/routine/list_of_configuration')}}">List of Configuration</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Create Routine</h3></strong></div><br/>
                            <div class="widget-header"></div>
                            <div class="widget-content">
                                <?php


                               $number_period = Session::get('number_period');
                                $weekly_holiday = Session::get('weekly_holyday');
                             $weekly_holiday1 = Session::get('weekly_holyday1');
                              $tiffin_breake = Session::get('tiffin_breake');
                                $shift = Session::get('shift');
                                $start_time = Session::get('start_time');
                                $class_duration = Session::get('class_duration');
                                $tiffin_duration1 = Session::get('tiffin_duration');
                                $class_name = Session::get('class_name');
                                $section = Session::get('section');
                                $configurationId= Session::get('idconfiguration');
                                $courseSectionId= Session::get('class_id');
                                $year = Session::get('year');



                                ?>
                                <script>
                                    var class_start_time;
                                    var duration1;
                                    var tiffen_start_time;
                                    var duration2;
                                    function set_Time(start_time,class_duration) {
                                        class_start_time=start_time;
                                        duration1=class_duration;
                                    }
                                    function set_Tiffen_Time(tiffen_duration) {
                                        tiffen_start_time=class_start_time;
                                        duration2=tiffen_duration;
                                    }
                                    function go() {
//document.write("Hello World!");
                                    }
                                    function getTiffenTime() {
// var start=class_start_time;
// var start_time=class_start_time;
// var duration=duration1;
// var class_duration=duration1;

                                        var start=tiffen_start_time;
                                        var start_time=tiffen_start_time;
                                        var duration=duration2;
                                        var class_duration=duration2;
                                        var time1_hr="";
                                        var time1_min="";

                                        time1_hr = start.split(":")[0];
                                        time1_min=start.split(":")[1];

                                        var a = parseInt(time1_hr);
                                        var b = parseInt(time1_min);
                                        var c = parseInt(duration);

                                        var minute_sum=b+c;
                                        hour=Math.floor(minute_sum/60);
                                        minute=minute_sum%60;
                                        temp=minute.toString();
                                        temp=temp.length;
                                        if (temp<2) { minute="0"+minute; };
                                        hour=a+hour;
                                        if (hour!=12) { hour=hour%12; }
                                        start_time=start;
                                        finishTime=hour+":"+minute;
                                        time=start+" - "+finishTime;
                                        class_start_time=finishTime;
                                        document.write("Tiffin");
                                    }

                                    function getTime() {
                                        var start=class_start_time;
                                        var start_time=class_start_time;
                                        var duration=duration1;
                                        var class_duration=duration1;
                                        var time1_hr="";
                                        var time1_min="";

                                        time1_hr = start.split(":")[0];
                                        time1_min=start.split(":")[1];

                                        var a = parseInt(time1_hr);
                                        var b = parseInt(time1_min);
                                        var c = parseInt(duration);

                                        var minute_sum=b+c;
                                        hour=Math.floor(minute_sum/60);
                                        minute=minute_sum%60;
                                        temp=minute.toString();
                                        temp=temp.length;
                                        if (temp<2) { minute="0"+minute; };
                                        hour=a+hour;
                                        if (hour!=12) { hour=hour%12; }
                                        start_time=start;
                                        finishTime=hour+":"+minute;
                                        time=start+" - "+finishTime;
                                        class_start_time=finishTime;
                                        document.write(time);
                                    }
                                </script>


                                <?php $number_perion=$number_period;
                                $holly_day=$weekly_holiday;
                                $holly_day1=$weekly_holiday1;
                                $tiffin_break=$tiffin_breake;

                                $tiffin_duration=$tiffin_duration1;
                                $countCourseTeacher=0;
                                $color=0;

                                $check_holyday1 = 7;


                               $check_holyday = 1;


                                ?>



                                @if ($holly_day=='saturday' )
                                    <?php $check_holyday=1;
                                          $check_holyday1=1;

                                    ?>
                                @endif
                                @if ($holly_day=='sunday')
                                    <?php $check_holyday=2;
                                           $check_holyday1=2;

                                    ?>
                                @endif
                                @if ($holly_day=='monday')
                                    <?php

                                     $check_holyday=3;
                                     $check_holyday1=3;

                                    ?>
                                @endif
                                @if ($holly_day=='tuesday')
                                    <?php

                                    $check_holyday=4;
                                    $check_holyday1=4;

                                    ?>
                                @endif
                                @if ($holly_day=='wednesday')
                                    <?php

                                     $check_holyday=5;
                                     $check_holyday1=5;

                                     ?>
                                @endif
                                @if ($holly_day=='thursday')
                                    <?php

                                     $check_holyday=6;
                                     $check_holyday1=6;

                                     ?>
                                @endif
                                @if ($holly_day=='friday' )
                                    <?php
                                    $check_holyday=7;
                                    $check_holyday1=7;

                                    ?>
                                @endif


                                {{ Form::open(array('url'=>'routine/routine', 'class'=>'form-inline','files' => true)) }}
                                <input type="hidden" name="course_section_id" value=<?php echo $courseSectionId ?> />
                                <input type="hidden" name="configuration_id" value= <?php echo $configurationId ?> />
                                <input type="hidden" name="number_of_period" value= <?php echo $number_perion ?> />
                                <input type="hidden" name="year" value= <?php echo $year; ?> />
                                    <div class="col-sm-12">
                                        <table class="table" >
                                     <tr class="success" >
                                         @for ($i = -1; $i <=$number_perion; $i++)
                                             @if($i%2==0)
                                             <th style="text-align:left;" valign="top">

                                                 @endif
                                             @if($i%2!=0)
                                             <th style="text-align:right;" valign="top">

                                             @endif

                                                 @if($i==-1)
                                                     <b>Class:</b>
                                                 @endif
                                                 @if($i==0)
                                                     <p>{{$class_name}}</p>
                                                 @endif
                                                 @if($i==1)
                                                     <b>section:</b>
                                                 @endif
                                                 @if($i==2)
                                                     <p>{{$section}}</p>
                                                 @endif
                                                 @if($i==3)
                                                     <b>Shift:</b>
                                                 @endif
                                                 @if($i==4)
                                                     <p>{{$shift}}</p>
                                                 @endif

                                             </th>

                                         @endfor
                                     </tr>
                                 </table>
                                        </div>
                                <div class="col-sm-12">
                                    <table class="table table-bordered" >
                                        <thead>

                                        <tr class="success">
                                            @for ($i = -1; $i <=$number_perion; $i++)
                                                <th style="border:0;">
                                                    @if($i==-1)
                                                        <script type="text/javascript">set_Time("<?= $start_time?>","<?= $class_duration?>");</script>
                                                        Day
                                                    @else
                                                        @if($tiffin_break==$i)
                                                            <script type="text/javascript">set_Tiffen_Time(<?=$tiffin_duration?>);</script>
                                                            <p>  <script type="text/javascript">getTiffenTime();</script></p>

                                                        @else
                                                          <p>  <script type="text/javascript">getTime();</script></p>
                                                        @endif
                                                    @endif




                                                </th>

                                            @endfor
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @for ($j = 1; $j <=7; $j++)
                                            @if($color==0)
                                                <tr>
                                            @else
                                                <tr>
                                                    @endif
                                                    @if($color==0)
                                                        <?php $color=1; ?>
                                                    @else
                                                        <?php $color=0; ?>
                                                    @endif
                                                    @for ($i = -1; $i <=$number_perion; $i++)


                                                        @if($i==-1)
                                                            @if($check_holyday==$j || $check_holyday1==$j)

                                                            @else
                                                                @if($j==1)
                                                                    <td>Saturday</td>
                                                                    <input type="hidden" name="day<?php echo $j;?>" value="Saturday" />
                                                                @endif

                                                                @if($j==2)
                                                                    <td>Sunday</td>
                                                                    <input type="hidden" name="day<?php echo $j;?>" value="Sunday" />
                                                                @endif

                                                                @if($j==3)
                                                                    <td>Monday</td>
                                                                    <input type="hidden" name="day<?php echo $j;?>" value="Monday" />
                                                                @endif

                                                                @if($j==4)
                                                                    <td>Tuesday</td>
                                                                    <input type="hidden" name="day<?php echo $j;?>" value="Tuesday" />
                                                                @endif

                                                                @if($j==5)
                                                                    <td>Wednesday</td>
                                                                    <input type="hidden" name="day<?php echo $j;?>" value="Wednesday" />
                                                                @endif

                                                                @if($j==6)
                                                                    <td>Thursday</td>
                                                                    <input type="hidden" name="day<?php echo $j;?>" value="Thursday" />
                                                                @endif

                                                                @if($j==7)
                                                                    <td>Friday</td>
                                                                    <input type="hidden" name="day<?php echo $j;?>" value="Friday" />
                                                                @endif
                                                            @endif
                                                        @else
                                                            <?php $countCourseTeacher++;?>
                                                            @if($check_holyday==$j || $check_holyday1==$j)

                                                            @else
                                                                @if($tiffin_break==$i)
                                                                    <td>----</td>
                                                                    <input type="hidden" name="course_teacher<?php echo $countCourseTeacher;?>" value="Tiffen" />
                                                                @else
                                                                    <td><select class="form-control" name="course_teacher<?php echo $countCourseTeacher;?>">
                                                                            <?php $sp = CourseTeacher::where('idclasssection','=',$courseSectionId)->get();?>
                                                                            @foreach($sp as $short)
                                                                                <option value="{{$short->short_name}}">{{$short->short_name}}</option>
                                                                            @endforeach
                                                                        </select></td>
                                                                @endif
                                                            @endif
                                                        @endif




                                                    @endfor
                                                </tr>
                                                @endfor
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-12"> <br/><br/></div>


                                <div class="col-sm-12">
                                    <center>{{Form::submit('create',['class'=>'btn btn-info'])}}</center>
                                </div>
                                {{Form::close()}}


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