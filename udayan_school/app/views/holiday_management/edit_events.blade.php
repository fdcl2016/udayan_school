@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Holiday Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li>
                            <a href="{{ URL::to('/holiday_management/create_events')}}">Create Events</a>
                        </li>
                        <li><a href="{{ URL::to('/holiday_management/create_annual_calender')}}">Create Annual Calender</a></li>
                    <li>
                            <a href="{{ URL::to('/holiday_management/show_events')}}">Show Events</a>
                        </li>
                        <li><a href="{{ URL::to('/holiday_management/view_annual_calender')}}">View Academic Calender</a></li>
                    </ul>
                    <div class="tab-content">
                    <?php $start_time = $events->start_time; //echo $start_time;
                    $shour = chop(substr($start_time,-7,2),":");
                    $smin = substr($start_time,-4,2);
                    $sampm= substr($start_time,-2);
                     //echo "<br>".$shour."<br>".$smin."<br>".$sampm;

                     $end_time = $events->end_time; //echo $end_time;
                                         $ehour = chop((substr($end_time,-7,2)),":");
                                         $emin = substr($end_time,-4,2);
                                         $eampm= substr($end_time,-2);
                                          //echo "<br>".$ehour."<br>".$emin."<br>".$eampm;
                     //$sh= array();
                    //$sh= explode(':',$start_time,2); echo $$sh[0]?>
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Edit Events</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
                            <div class="widget-header"></div>
                            <div class="widget-content">
                        {{Form::open(array('url'=>'holiday_management/edit_events', 'onsubmit'=>'return isPassed(this); return false;', 'class'=>'form-inline','files'=>'true')) }}
                        <br><br>
                        <div class="form-group col-sm-6">
                            <label>From: <div id="chkStrDate"></div></label>
                            <input value="<?php echo $events->start_date;?>"  type="text" class="input-control form-control" id="popupDatepicker" name="start_date"
                                   placeholder="pick a date"required>
                        </div>
                        <div class="form-group col-sm-6" >
                            <label>To:</label>
                            <input value="<?php echo $events->end_date;?>" type="text" class="input-control form-control" id="popupDatepicker2" name="end_date"
                                   placeholder="pick a date"required>
                        </div>
                        <br><br>
                        <div class="form-group col-sm-6">
                            <label style=";"> Start Time:</label>
                            <input value="<?php echo $shour?>" type="text" id="hour" name="hour1" min="1" max="12" placeholder="HH"
                                   style="width:11%">
                            <input value="<?php echo $smin?>" type="text" id="min" name="min1" min="1" max="60" placeholder="Min"
                                   style="width:11%">
                            <select id="ampm" name="ampm1" style="width:17%">
                                <?php
                                if($sampm == "AM") $other = "PM";
                                else $other = "AM";
                                ?>
                                <option value="<?php echo $sampm; ?>" ><?php echo $sampm; ?></option>
                                <option value="<?php echo $other; ?>" ><?php echo $other; ?></option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label style="">End Time</label>
                            <input value="<?php echo $ehour?>" type="text" id="hour" name="hour" min="1" max="12" placeholder="HH"
                                   style="width:11%">
                            <input value="<?php echo $emin?>" type="text" id="min" name="min" min="1" max="60" placeholder="Min"
                                   style="width:11%">
                            <select id="ampm" name="ampm" style="width:17%">
                            <?php
                                if($eampm == "AM") $other = "PM";
                                else $other = "AM";
                                ?>
                                <option value="<?php echo $eampm; ?>" ><?php echo $sampm; ?></option>
                                <option value="<?php echo $other; ?>" ><?php echo $other; ?></option>
                            </select>
                        </div><br><br>
                        <div class="form-group col-sm-6">
                            <label  style="">Event Name:</label>
                            <input value="<?php echo $events->event_name;?>" id="event_name" type="text" name="event_name" class="form-control" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label style=""> Event Place:</label>
                            <input id="event_place" type="text" name="event_place"class="form-control" value="<?php echo $events->event_place;?>" required>
                        </div><br><br>
                        <div class="form-group col-sm-12">
                            <label style=""> Event Description:</label>
                            <textarea id="event_description" type="text" name="event_description"class="form-control fdcl_textarea_height" style="" required><?php echo $events->event_description;?></textarea>
                        </div><br><br>
                        <div class="form-group col-sm-12">
                            <label style=""> Event image</label>
                            <input id="event_image" type="file" name="event_image"class="form-control">
                        </div><br><br>
                        <div class="form-group col-sm-10">
                         {{Form::hidden('event_id',$events->idevents)}}
                            <input type="submit" value="Update" onclick="myFunction()"class="btn btn-info"><br><br>
                        </div>

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

      function isPassed()
        {

        //var chk;

        //chk=true;

        var startDate = new Date(document.getElementById('popupDatepicker').value);
        var endDate = new Date(document.getElementById('popupDatepicker2').value);
        if(startDate > endDate)
        {
        document.getElementById('chkStrDate').innerHTML= "<div style='color: red; font-size: 14px;'>Start date can't be after end date.</div>";
        //alert("Start date can't be after end date.");
        return false;

        }

        var now = new Date();
        if (endDate < now) {
        document.getElementById('chkEndDate').innerHTML= "<div style='color: red; font-size: 14px;'>Date must be in the future.</div>";

            //alert("Date must be in the future");
            return false;
           }
         return true;

        }

    </script>
@stop