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

                        <li class="active"><a href="{{URL::to('/attendance_management/attendance_book')}}">My Attendance Book</a></li>
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


                                                $clssec = StudentToSectionUpdate::where('student_idstudentinfo','=',Auth::user()->email)->first();

                                              $clsid = Addclass::where('section','=',$clssec->section)->first();
                                            ?>

                                     <option value="{{$clsid->class_id}}">{{$clssec->class}} {{$clssec->section}}</option>

                                        </select>
                                    </div>





                                    <div class="col-sm-3">
                                        <button type="submit" id="mybtn" class="btn btn-info center-block">View</button>
                                    </div>
                                </div>

                            </div> <!-- /widget -->

                        </div> <!-- /span8 -->


                    </div> <!-- /widget-content -->

                    {{Form::close()}}

                    @if($attendances!=null && $attendances!='[]')


                            <div class="widget" style="overflow-x: auto">

                                <div class="widget-header">
                                    <h3>Attendance Book for Class : {{$clsName}}, Section : {{$secName}}, Month : {{$month}} </h3>
                                </div> <!-- /widget-header -->

                                <div class="widget-content"  style="overflow-y:hidden;overflow-x:scroll;">

                                    <div class="col-sm-12">
                                        <div class="table-responsive">

                                            <?php


                                            $roll = StudentToSectionUpdate::where('student_idstudentinfo','=',Auth::user()->email)->orderBy('st_roll')->pluck('st_roll');

                                            ?>

                                           <b><h2> Roll :  {{$roll}}</h2>  <h2>Name : <?php echo Studentinfo::where('registration_id',Auth::user()->email)->pluck('sutdent_name')
     ?></h2>
                                                <br/><br/>
                                            <table class="table table-bordered" style="width: 100%">
                                                <thead>
                                                <tr>

                                                    <th ><b>Subject</b></th>
                                                    <th ><b>Teacher</b></th>

                                                    @for($i=1;$i<=31;$i++)
                                                        <th>Day<?php echo $i?></th>
                                                    @endfor
                                                    <td><b>Total</b>(present)</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($attendances as $attendance)
                                                    <?php $count=0; ?>
                                                    <tr>
                                                        <td>
                                                            <?php


                                                            $sb = Subject::where('idsubject','=',$attendance->idsubject)->pluck('subject_name');

                                                            ?>

                                                            <b>

                                                                {{$sb}}</b></td>
                                                        <td ><b><?php echo TeacherInfo::where('idteacherinfo',$attendance->idteacher)->pluck('teacher_name')?></b></td>
                                                        @for($i=1;$i<=31;$i++)
                                                            <?php $var="Day" . $i;?>
                                                            @if($attendance->$var=='a')
                                                                <td><input type="checkbox" name="day" value="1" style="width: 30px;height: 30px;"disabled></td>
                                                            @elseif($attendance->$var=='p')
                                                                <?php $count++?>
                                                                <td><input type="checkbox" name="day" value="1" style="width: 30px;height: 30px;" checked disabled></td>
                                                                @elseif($attendance->$var=='h')
                                                                    <td></td>         

                                                         @endif
                                                        @endfor
                                                        <td><b>{{$count}}</b></td>
                                                    </tr>
                                                @endforeach

                                                </tbody>

                                            </table>
                                            <?php

                                            $p = 0;
                                            $a = 0;
                                            ?>


                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div> <!-- /widget -->
                            @if($classsection!=null)
                            {{Form::open(['url'=>'attendance_management/attendance_book_pdf'])}}

                            {{Form::hidden('month',$month)}}
                            {{Form::hidden('classsection',$classsection)}}

                                    <!--
                         <center><input type="submit" class="btn btn-info" style="width:220px;" value="Download as PDF"></center>

-->
                            {{Form::close()}}
                            @endif
                        <!-- /span8 -->


                </div> <!-- /widget-content -->



            </div> <!-- /widget -->
            @if(isset($shohag_msg))
                <div class="widget-content" style="text-align: center"><strong>{{$shohag_msg}}</strong></div>
            @endif

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