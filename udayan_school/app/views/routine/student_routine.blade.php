@extends('master.master')
@section('header')
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
time=start+"-<br>"+finishTime;
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
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>My Routine</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Routine</h3></strong></div><br/>
                        <div class="fdcl_content_profile_routine">
                            <div class="table-responsive" style="padding-left:1%;padding-right:1%">

                                @if($number_of_period!=null)
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="success">
                                                @for ($i = -1; $i <=$number_of_period; $i++)
                                                <th style="border:0;">
                                                    @if($i==-1)
                                                    <script type="text/javascript">set_Time("<?= $class_start_time?>","<?= $class_duration?>");</script>
                                                    Day
                                                    @else
                                                    @if($tiffin_break==$i)
                                                    <script type="text/javascript">set_Tiffen_Time(<?=$tiffin_duration?>);</script>
                                                    <script type="text/javascript">getTiffenTime();</script>

                                                    @else
                                                    <script type="text/javascript">getTime();</script>
                                                    @endif  
                                                    @endif




                                                </th>

                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($routines as $routine)
                                            <tr>
                                                <td>
                                                    <?php echo $routine->day;?>
                                                </td>
                                                <?php $count=1;?>
                                                @for($i=0; $i<=$number_of_period; $i++)
                                                    <td>
                                                        <?php $pi = "p" . $count++;?>
                                                        <?php echo $routine->$pi;?>
                                                    </td>
                                                @endfor
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
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

@stop