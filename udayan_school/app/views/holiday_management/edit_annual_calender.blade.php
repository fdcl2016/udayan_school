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
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Edit Annual Calender</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
                            <div class="widget-header"></div>
                            <div class="widget-content">
                                {{Form::open(array('url'=>'holiday_management/edit_annual_calender', 'onsubmit'=>'return isPassed(this); return false;', 'class'=>'form-inline','files'=>'true')) }}
                                <br><br>
                                <div class="form-group col-sm-3">
                                    <label> Annual Year:</label>
                                    <select id="annual_year" type="text" name="annual_year"class="form-control col-sm-4"required>
                                        <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();?>
                                        @foreach($academic_year as $year)
                                            <option value="{{$year->academic_year}}">{{$year->academic_year}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label>From: <div id="chkStrDate"></div></label>
                                    <input value="<?php echo $events->from_date;?>" type="text" class="input-control form-control" id="popupDatepicker" name="start_date"
                                           placeholder="pick a date"required>
                                </div>
                                <div class="form-group col-sm-6" >
                                    <label>To: <div id="chkEndDate"></div></label>
                                    <input value="<?php echo $events->to_date;?>" type="text" class="input-control form-control" id="popupDatepicker2" name="end_date"
                                           placeholder="pick a date"required>
                                </div>
                                <br><br><br>
                                <div class="form-group col-sm-6">
                                    <label>Holiday Name:</label>
                                    <input value="<?php echo $events->holiday_name;?>" id="holiday_name" type="text" name="holiday_name" class="form-control"required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label> Holiday Type:</label>
                                    <select id="holiday_type" type="text" name="holiday_type"class="form-control"required>
                                        <?php $type=$events->holiday_type;
                                        if ($type == "Government" )
                                          { ?>
                                                <option selected value="Government">Govt.</option>
                                                <option value="Official">Official</option>
                                                <option value="Other">Other</option>

                                          <?php }

                                          elseif($type == "Official" )
                                          { ?>
                                                <option value="Government">Govt.</option>
                                                <option selected value="Official">Official</option>
                                                <option value="Other">Other</option>

                                          <?php }
                                         else
                                          { ?>
                                                <option value="Government">Govt.</option>
                                                <option value="Official">Official</option>
                                                <option selected value="Other">Other</option>

                                          <?php } ?>


                                    </select>
                                </div><br><br>
                                <div class="form-group col-sm-12">
                                    <label> Event Description:</label>
                                    <textarea id="event_description" type="text" name="event_description"class="form-control"required><?php echo $events->holiday_description;?></textarea>
                                </div><br><br>
                                <div class="form-group col-sm-12">
                                 {{Form::hidden('event_id',$events->idannualcalender)}}
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