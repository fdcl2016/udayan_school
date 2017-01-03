@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Attendance Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">

                        <li class="active"><a href="{{URL::to('/attendance_management/student_attendance_view')}}">My Attendance Book</a></li>
                        <li class=""><a href="{{URL::to('/attendance_management/stattendance_book')}}">My Attendance View</a></li>

                    </ul>
                    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Attendance Book</h3></strong></div>
                    <div id="stdregister_div"></div>


                    <div class="span11">

                        <div class="widget ">

                            <div class="widget-header">
                            </div> <!-- /widget-header -->

                            <div class="widget-content">

                                {{Form::open(array('url'=>'attendance_management/student_attendance_view', 'class'=>'form-inline')) }}

                                <div class="col-sm-12">
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
                                    <div class="col-sm-3">
                                        <select name="classsection" id="classsection" class="form-control" required>
                                            <option value="">-&nbsp;Select Class & Section&nbsp;-</option>

                                            <?php

                                            $stu = Studentinfo::where('idstudentinfo','=',Auth::user()->email)->pluck('idstudentinfo');

                                            $st = StudentToSectionUpdate::where('student_idstudentinfo','=',$stu)->first();

                                            $cls = Addclass::where('class_name','=',$st->class)->where('section','=',$st->section)->pluck('class_id');



                                            $cl = Addclass::where('class_id','=',$cls)->first();

                                            ?>
                                            <option value="{{$cl->class_id}}">{{$cl->class_name}} {{$cl->section}}</option>

                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="submit" id="mybtn" class="btn btn-info center-block">View</button>
                                    </div>
                                </div>

                            </div> <!-- /widget -->

                        </div> <!-- /span8 -->


                    </div> <!-- /widget-content -->

                    {{Form::close()}}

                    @if($attendances!=null && $attendances!='[]')
                        <div class="span11">

                            <div class="widget ">

                                <div class="widget-header">
                                    <h3>Attendance Book for Class : {{$clsName}}, Section : {{$secName}}, Month : {{$month}} </h3>
                                </div> <!-- /widget-header -->

                                <div class="widget-content"  style="overflow-y:hidden;overflow-x:scroll;">

                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th><b>Id</b></th>
                                                    <th ><b>Name</b></th>
                                                    @for($i=1;$i<=31;$i++)
                                                        <th>Day<?php echo $i?></th>
                                                    @endfor
                                                    <td><b>Total</b>(present)</td>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php $count=0; ?>
                                                <tr>
                                                    <td><b>{{$attendances->Student_id}}</b></td>
                                                    <td ><b><?php echo Studentinfo::where('idstudentinfo','=',$attendances->Student_id)->pluck('sutdent_name')?></b></td>
                                                    @for($i=1;$i<=31;$i++)
                                                        <?php $var="Day" . $i;?>
                                                        @if($attendances->$var=='0')
                                                            <td><input type="checkbox" name="day" value="1" style="width: 30px;height: 30px;"disabled></td>
                                                        @elseif($attendances->$var=='1')
                                                            <?php $count++?>
                                                            <td><input type="checkbox" name="day" value="1" style="width: 30px;height: 30px;" checked disabled></td>
                                                        @endif
                                                    @endfor
                                                    <td><b>{{$count}}</b></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div> <!-- /widget -->

                        </div> <!-- /span8 -->


                </div> <!-- /widget-content -->


            </div> <!-- /widget -->

        </div> <!-- /span8 -->




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