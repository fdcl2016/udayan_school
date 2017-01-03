@extends('master.master')
@section('header')
@stop
@section('content')


    <?php
    $rasel = 1;
    include_once(app_path().'/views/nav_config/a_holiday_management.php');
    ?>



    <div class="tab-content">
        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                        style="color:black">Create Events</h3></strong></div><br/>
        <div class="fdcl_content_profile">
            <div class="widget-header"></div>
            <div class="widget-content">

                {{Form::open(array('url'=>'holiday_management/create_events','onsubmit'=>'return isPassed(this); return false;', 'class'=>'form-inline','files'=>'true'))}}
                <br><br>
                <div class="form-group col-sm-6">
                    <label>From: <div id="chkStrDate"></div></label>
                    <input onkeypress="clearAll()" onclick="clearAll()" type="text" class="input-control form-control" id="popupDatepicker" name="start_date"
                           placeholder="pick a date"required>
                </div>
                <div class="form-group col-sm-6" >
                    <label>To:<div id="chkEndDate"></div></label>
                    <input onkeypress="clearAll()" onclick="clearAll()" type="text" class="input-control form-control" id="popupDatepicker2" name="end_date"
                           placeholder="pick a date"required>
                </div>
                <br><br>
                <div class="form-group col-sm-6">
                    <label style=";"> Start Time:</label>
                    <input type="text" id="hour" name="hour1" min="1" max="12" placeholder="HH"
                           style="width:11%" required>
                    <input type="text" id="min" name="min1" min="1" max="60" placeholder="Min"
                           style="width:11%" required>
                    <select id="ampm" name="ampm1" style="width:17%">
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label style="">End Time</label>
                    <input type="text" id="hour" name="hour" min="1" max="12" placeholder="HH"
                           style="width:11%" required>
                    <input type="text" id="min" name="min" min="1" max="60" placeholder="Min"
                           style="width:11%" required>
                    <select id="ampm" name="ampm" style="width:17%">
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                </div><br><br>
                <div class="form-group col-sm-6">
                    <label  style="">Event Name:</label>
                    <input id="event_name" type="text" name="event_name" class="form-control" required>
                </div>
                <div class="form-group col-sm-6">
                    <label style=""> Event Place:</label>
                    <input id="event_place" type="text" name="event_place"class="form-control" required>
                </div><br><br>
                <div class="form-group col-sm-12">
                    <label style=""> Event Description:</label>
                    <textarea id="event_description" type="text" name="event_description"class="form-control fdcl_textarea_height" style="" required></textarea>
                </div><br><br>
                <div class="form-group col-sm-12">
                    <label style=""> Event image</label>
                    <input id="event_image" type="file" name="event_image"class="form-control">
                </div><br><br>
                <div class="form-group col-sm-10">
                    <input type="submit" value="save" class="btn btn-info"><br><br>
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
        function clearAll(){
            document.getElementById('chkStrDate').innerHTML="";
            document.getElementById('chkEndDate').innerHTML="";
        }
    </script>
@stop