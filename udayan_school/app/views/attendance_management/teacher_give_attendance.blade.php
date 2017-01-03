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
            <div class="widget-content" style="overflow-x: auto">
                <div class="tabbable" style="overflow-x: auto">
                    <div class="tab-content" style="overflow-x: auto">
                            <ul class="nav nav-tabs">
                      <li class="active"><a href="{{URL::to('/attendance_management/teacher_give_attendance')}}">Take Attendance</a></li>
                      <li ><a href="{{URL::to('/attendance_management/attendance_book')}}">Attendance Book</a></li>
                        
                    </ul>
                    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Take Attendance</h3></strong></div>
                    <div id="stdregister_div"></div>
                        {{ Form::open(array('url'=>'attendance_management/teacher_give_attendance3', 'class'=>'form-inline')) }}
                        
                            <div class="widget-header"></div>
                            <div class="widget-content" style="overflow-x: auto">
                                <div class="table-responsive" style="overflow-x: auto">
                                    <div class="col-sm-12" style="overflow-x: auto">
                                        <div class="col-sm-2">
                                            <label for="class_name">Select Class:</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="cat" id="cat" class="form-control" required>
                                                <option value="">-&nbsp;Select Class & Section&nbsp;-</option>

                                           <?php

                                                $ct1 = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)
                                                        ->whereBetween('idclasssection', array(50, 56))
                                                        ->get();



                                                    $cnt = count($ct1);

                                                //    if($cnt > 0 ){
                                                 //   $clname = Addclass::where('class_id','=',$ct1->idclasssection)->get();

                                                   // }
                                                ?>
                                                @foreach($class as $cats)
                                                    <?php $cl = Addclass::where('class_id','=',$cats->idclasssection)->first();?>

                                                    @if($cl->value != 11)

                   <option value="{{$cl->class_id}}">{{$cl->class_name}} {{$cl->section}} </option>
                                                    
                                                 @endif
                                                @endforeach

                                                @if($cnt > 0)


             @foreach($ct1 as $cl)

<?php
          $clname = Addclass::where('class_id','=',$cl->idclasssection)->first();

?>


               <option value="{{$clname->class_id}}">{{$clname->class_name}} {{$clname->section}}</option>
                                             

@endforeach
   @endif

                                            </select>
                                        </div>


                                        <div class="col-sm-2">
                                            <label for="class_name">Select Year:</label>
                                        </div>

                                         <div class="col-sm-4">
                                         <select name="year" id="year" class="form-control" required>

                                         <option value="2016-2017">2016-2017</option>
                                         <option value="2015-2016">2015-2016</option>  

                                         </select>

                                       </div>

   <br/>   <br/>
<center>

                                       
                                           <br/> <button type="submit" id="mybtn" class="btn btn-info center-block">Insert</button>
                                       
</center>
                                    </div>
                                    {{Form::close()}}
                                    <div class="col-sm-12"><br/><br/></div>

                                    @if($student!=null)
                                        {{ Form::open(array('url'=>'attendance_management/teacher_give_attendance', 'class'=>'form-inline')) }}

<div class="col-sm-12">

<b>Class : </b> {{ $class_name }} &nbsp;&nbsp;<b>Section :</b> {{ $section }}


</div>

                                        <div class="col-sm-12">
<br/><br/>
                                            <div>Today's Date</div>
                                            <div class="input-control">
                                                <input type="text" id="popupDatepicker" name="date" placeholder="pick a date" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12"><br/><br/></div><br>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th class="resource-name">Student Roll</th>
                                                <th class="resource-name">Student Name</th>
                                                <th class="resource-name" style="width: 10px;">Attendance</th>

                                            </tr>
                                            </thead>
                                            <tbody>
{{Form::hidden('section',$section)}}
{{Form::hidden('class',$class_name)}}

                                            <?php $count=0;?>
                                            @foreach ($student as $mark)
                                                {{Form::hidden('idstudentinfo[]',$mark->student_idstudentinfo)}}
                                                <?php $st = Studentinfo::where('idstudentinfo','=',$mark->student_idstudentinfo)->first();

  $roll = StudentToSectionUpdate::where('student_idstudentinfo','=',$mark->student_idstudentinfo)->orderBy('st_roll')->pluck('st_roll');
?>
                                                <tr>
                                                    <td>{{$roll}}</td>
                                                    <td>{{$st->sutdent_name}}</td>
                                                    <td style="width: 10px;"><input type="checkbox" name="day{{$count++}}" value="1" style="width: 30px;height: 30px;" checked></td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>

                                </div>
                                <div class="col-sm-12"> <center><button type="submit" id="mybtn" class="btn btn-info center-block">Save</button></center></div>


                                @endif
                            </div>


                        </div>
                        @if(isset($shohag_msg))
                            <div class="widget-content" style="text-align: center"><strong>{{$shohag_msg}}</strong></div>
                        @endif

                        {{Form::close()}}


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
    </script>

@stop