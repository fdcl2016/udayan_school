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
                       
                          <li><a href="{{URL::to('/attendance_management/teacher_give_attendance')}}">Take Attendance</a></li>
                          <li class="active"><a href="{{URL::to('/attendance_management/attendance_book')}}">Attendance Book</a></li>
                      </ul>
                      <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                      style="color:black">Attendance Book</h3></strong></div>
                      <div id="stdregister_div"></div>
   

  <div class="span11">            

    <div class="widget ">

      <div class="widget-header">
      </div> <!-- /widget-header -->

      <div class="widget-content">

  {{Form::open(array('url'=>'attendance_management/attendance_book', 'class'=>'form-inline')) }}
        
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

    $ct1 = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)
                          ->whereBetween('idclasssection', array(50, 56))
                          ->get();

     $cnt = count($ct1);
     
     //if($cnt > 0 ){
     //    $clname = Addclass::where('class_id','=',$ct1)->first();

    // }
     ?>
     @foreach($class as $cats)
         <?php $cl = Addclass::where('class_id','=',$cats->idclasssection)->first();?>

@if($cl->value != 11)

         <option value="{{$cl->class_id}}">{{$cl->class_name}} {{$cl->section}}</option>
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



            <?php

            $ct1 = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)
                    ->whereBetween('idclasssection', array(50, 56))
                    ->first();

            $cnt1 = count($ct1);


        ?>


            @if($cnt1 > 0)
                <?php
        $sb = Subject::where('idsubject','=',$ct1->idsubject)->first();
        ?>
        <div class="col-sm-3">
                    <select name="idsubject" id="idsubject" class="form-control" required>
                        <option value="">-&nbsp;Select Subject &nbsp;-</option>
                <option value="{{$ct1->idsubject}}">{{$sb->subject_name}}</option>
                    </select>
        </div>
            @endif

    <div class="col-sm-3">
        <select name="year" id="year" class="form-control" required>
            <option value="">-&nbsp;Select year &nbsp;-</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
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
        <th><b>Roll</b></th>
        <th ><b>Name</b></th>
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


  $roll = StudentToSectionUpdate::where('student_idstudentinfo','=',$attendance->Student_id)->orderBy('st_roll','ASC')->pluck('st_roll');

?>

<b>

{{$roll}}</b></td>
        <td ><b><?php echo Studentinfo::where('idstudentinfo',$attendance->Student_id)->pluck('sutdent_name')?></b></td>
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
        <?php

        $idsubject = Courseteacher::where('idclasssection','=',$classsection)->where('idteacherinfo','=',Auth::user()->user_id)->pluck('idsubject');
        ?>
        <div class="row">
            <div class="col-sm-12" align="middle">
                <a href="{{URL::to('/attendance_management/attendance_bookmahbub/'.$classsection.'/'.$month.'/'.$idsubject.'/'.$year)}}"><button type="button" class="btn btn-primary">Download</button></a>
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
  </div> <!-- /span8 -->


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
  @section('content_footer')
  @stop