@extends('master.master')
@section('header')
@stop
@section('content')


    <?php
    $rasel = 2;
    include_once(app_path().'/views/nav_config/a_routine.php');
    ?>

    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Configure Routine</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
                            <div class="widget-header"></div>
                    <div class="widget-content">
                        {{Form::open(array('url'=>'routine/create_configuration', 'class'=>'form-inline')) }}
                        <div class="col-sm-6">
                            <label class="col-sm-6">Shift:</label>
                            <select name="shift" class="col-sm-5">
                                <option value="Morning">Morning</option>";
                                <option value="Day">Day</option>"
                                <option value="Afternoon">Afternoon</option>"
                                <option value="Evening">Evening</option>"
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label  class="col-sm-6"> Number of Period:</label>
                            <select id="number_period" name="number_period" class="col-sm-5">
                                <option value="1">1</option>"
                                <option value="2">2</option>"
                                <option value="3">3</option>"
                                <option value="4">4</option>"
                                <option value="5">5</option>"
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div><br><br>

                        <div class="col-sm-6">
                            <label class="col-sm-6">Tiffin after which Period:</label>
                            <select id="tiffin_breake" name="tiffin_breake" class="col-sm-5">
                                <option value="1">1</option>"
                                <option value="2">2</option>"
                                <option value="3">3</option>"
                                <option value="4">4</option>"
                                <option value="5">5</option>"
                                <option value="6">6</option>"
                                <option value="7">7</option>"
                                <option value="8">8</option>"
                                <option value="9">9</option>"
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-sm-6">Weekly Holyday:</label>
                            <select id="weekly_holyday" name="weekly_holyday" class="col-sm-3">

                                <option value="saturday">Saturday</option>

                            <!--

                                <option value="sunday">Sunday</option>
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option> -->

                            </select>

                            <select id="weekly_holyday1" name="weekly_holyday1" class="col-sm-3" >
                            <option value="Friday">Friday</option>

                             </select>
                                                      </div><br><br>
                        <div class="col-sm-6">
                            <label class="col-sm-6">Class Start Time:</label>
                            <input type="text" id="hour" name="hour" min="1" max="12" placeholder="HH"
                                   style="width:11%">
                            <input type="text" id="min" name="min" min="1" max="60" placeholder="Min"
                                   style="width:11%">
                            <select id="ampm" name="ampm" style="width:17%">
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-sm-6"> Class Duration (min):</label>
                            <input id="class_duration" type="text" name="class_duration"class="col-sm-5">
                        </div><br><br>
                        <div class="col-sm-6">
                            <label class="col-sm-6"> Tiffin Duration (min):</label>
                            <input id="tiffin_duration" type="text" name="tiffin_duration"class="col-sm-5">
                        </div>
                        <div class="col-sm-6">
                            <label class="col-sm-6">Select Year:</label>
                            <select name="year" id="year" class="col-sm-5" required>
                                <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();?>
                                @foreach($academic_year as $year)
                                    <option value="{{$year->academic_year}}">{{$year->academic_year}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12"><br/></div><br/>
                        <div class="col-sm-12" style="padding-left:340px">
                            <input type="button" value="Show Routine" onclick="myFunction()"class="btn btn-info">
                        </div>
                        <div class="col-sm-12"><br/></div>
                        <div class="col-sm-12" id="addmore1"></div>

                        {{Form::close()}}

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
    <script type="text/javascript">

        start=0;
        var my_function_call_limit=0;

        function myFunction(){
            //class_start_time=document.getElementById('class_start_time').value;
            class_start_hour = document.getElementById('hour').value;
            class_start_min = document.getElementById('min').value;
            ampm = document.getElementById('ampm').value;
            class_start_time = class_start_hour + ":" + class_start_min;

            number_period=document.getElementById('number_period').value;
            class_duration=document.getElementById('class_duration').value;
            tiffin_breake=document.getElementById('tiffin_breake').value;
            holly_day=document.getElementById('weekly_holyday').value;
            holly_day1=document.getElementById('weekly_holyday1').value;
            tiffin_durations=document.getElementById('tiffin_duration').value;

            var j;
            var k;
            var check=0;
            var chec=0;
            var check1=0;
            var check2=0;
            var text=" ";
            var color=0;
            var check_holyday=7;
            var check_holyday1=7;


            if (holly_day=='saturday') {check_holyday=1;}
            if (holly_day=='sunday') {check_holyday=2;}
            if (holly_day=='monday') {check_holyday=3;}
            if (holly_day=='tuesday') {check_holyday=4;}
            if (holly_day=='wednesday') {check_holyday=5;}
            if (holly_day=='thursday') {check_holyday=6;}
            if (holly_day=='friday') {check_holyday=7;}


                        if (holly_day1=='saturday') {check_holyday1=1;}
                        if (holly_day1=='sunday') {check_holyday1=2;}
                        if (holly_day1=='monday') {check_holyday1=3;}
                        if (holly_day1=='tuesday') {check_holyday1=4;}
                        if (holly_day1=='wednesday') {check_holyday1=5;}
                        if (holly_day1=='thursday') {check_holyday1=6;}
                        if (holly_day1=='friday') {check_holyday1=7;}

            text +="<table class=\'table table-bordered\'>";
            for (j = 0; j <8; j++) {
                if (check1==0 && check2==0) {
                    text +="<thead>";
                    text +="<tr class=\'warning\' >";
                    for (var i = -1; i <=number_period; i++) {

                        if (tiffin_breake==i) {
                            text +="<th>"+getTiffen( class_start_time , tiffin_durations )+"</th>";
                        }
                        else{
                            if (check==0 || chec==0) {
                                text +="<th>Time/Day</th>";
                            }
                            else{

                                text +="<th>"+getTime( class_start_time , class_duration )+"</th>";
                            }
                            check++;
                            chec++;
                        }
                    }
                    text +="</tr>";
                    text +="</thead>";
                    text +="<tbody>";
                }

                else
                {
                    if(color==0){
                        text +="<tr class=\'success\'>";
                    }
                    else {text +="<tr class=\'danger\'>";}

                    for (var l = -1; l <=number_period; l++) {

                        if (check_holyday==j || check_holyday1==j) {

                        }
                        else {

                            if (tiffin_breake == l) {
                                text += "<td>--</td>";
                            }


                            else {
                                if (l == -1) {
                                    if (check_holyday == j || check_holyday1==j) {

                                    }
                                    else {
                                        if (j == 1) {
                                            text += "<td >Saturday</td>";
                                        }
                                        ;
                                        if (j == 2) {
                                            text += "<td >Sunday</td>";
                                        }
                                        ;
                                        if (j == 3) {
                                            text += "<td >Monday</td>";
                                        }
                                        ;
                                        if (j == 4) {
                                            text += "<td >Tuesday</td>";
                                        }
                                        ;
                                        if (j == 5) {
                                            text += "<td >Wednesday</td>";
                                        }
                                        ;
                                        if (j == 6) {
                                            text += "<td >Thursday</td>";
                                        }
                                        ;
                                        if (j == 7) {
                                            text += "<td >Friday</td>";
                                        }
                                        ;
                                    }


                                }
                                else {
                                    if (check_holyday == j || check_holyday1==j) {

                                    } else {
                                        text += "<td>class</td>";
                                    }
                                }
                            }
                        }

                        check++;
                        chec++;


                    }text +="</tr>";
                }

                check1++;
                chec++;

                if (color==0) {
                    color=1;
                }
                else{
                    color=0;
                }

            }
            text +="</tbody>";
            text +="</table><br><center><input type=\'submit\' value=\'Save\' class=\'btn btn-info\'></center><br><br>";

            if (class_start_time!='' && class_duration!='') {

                document.getElementById('addmore1').innerHTML = text + '\
                                  ';


            }

            else{
                alert("Fill Class Starting Time and Class Duration");
            }

        }




        function getTime(start_time,class_duration)
        {
            var start=start_time;
            var duration=class_duration;
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
            if (temp<2) {
                minute="0"+minute;
            };
            hour=a+hour;
            if (hour!=12) {
                hour=hour%12;
            }


            start_time=start;
            finishTime=hour+":"+minute;
            time=start+"-<br>"+finishTime;
            class_start_time=finishTime;
            return time;
        }

        function getTiffen(start_time,class_duration){
            var start=start_time;
            var duration=class_duration;
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
            if (temp<2) {
                minute="0"+minute;
            };
            hour=a+hour;
            if (hour!=12) {
                hour=hour%12;
            }
            start_time=start;
            finishTime=hour+":"+minute;
            time=start+"-"+finishTime;
            class_start_time=finishTime;
            return "(Tiffin)";
        }

    </script>

    <script>
        $("#cat").on('change',function (e) {
            console.log(e);
//document.write('hello');
            var cat_id = e.target.value;
// document.write(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/ajax?cat_id=' +cat_id,function(data)
            {
//console.log(data);
                $('#sub').empty();
                $.each(data,function(index,subcatObj)
                {
                    $('#sub').append('<option value="'+subcatObj.section+'">'+subcatObj.section+'</option>');
                })

            });
        });


        i=0;

    </script>
@stop




