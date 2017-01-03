@extends('master.master')
@section('header')


@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>

                <h3>Student Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">

                    <div class="alert alert-info" style="border-left: 5px solid #33D685;">
                        <strong>
                            <h3>
                                <a href="{{ URL::to('/reports/report/')}}">
                                    Students Report
                                </a>
                                >
                                <a href="{{ URL::to('/reports/report/class/'.$cls)}}">
                                {{$cls}}
                                </a>
                                >
                                {{$sec}}
                            </h3>
                        </strong>
                    </div>

                    <div id="stdregister_div"></div>



                        <div class="widget ">

                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3>Class Name : {{$cls}} ({{$sec}})</h3>
                                    </div>


                                </div>
                            </div>
                            <!-- /widget-header -->



                            <div class="widget-content" style="overflow-x:auto">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3>Class Teacher : {{$class_teacher}}</h3>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4>Total Students: {{$count}}</h4>
                                    </div>

                                    <div class="col-sm-12">
                                        <h4>Total Male Students: {{$male}}</h4>
                                    </div>

                                    <div class="col-sm-12">
                                        <h4>Total Female Students: {{$female}}</h4><br><br>


                                    </div>
                                </div>


                                <table class="table table-bordered" >
                                    <thead>

                                    <tr>
                                        <th style="text-align: center">Roll</th>
                                        <th style="text-align: center">Student Name</th>
                                        <th style="text-align: center">Action</th>




                                    </tr>
                                    </thead>

                                    <?php
                                    $c = 1;
                                    ?>
                                    <tbody>
                                    @foreach($st as $sub)
                                        <tr>


                                            <td style="text-align: center">
<?php 
if($sec == 'TULIP-A' || $sec == 'MAGNOLIA-A' || $sec == 'SHIMUL' || $sec == 'SHIULI' || $sec == 'SHAPLA'){
echo $c++;
}
else{
echo $sub->st_roll;
}


?>

</td>
                                            <td style="text-align: left">
                                              <?php


  $cl = ClassWiseStd::where('std_reg_no','=',$sub->student_idstudentinfo)->pluck('std_name');

  $cls = Studentinfo::where('registration_id','=',$sub->student_idstudentinfo)->pluck('sutdent_name');

$clm = ClassWiseStd::where('std_reg_no','=',$sub->student_idstudentinfo)->pluck('mobile');
                                                ?>
                                                {{$cls}}

                                            </td>
                                            <td style="text-align: center">

    <a href="{{URL::to('student_management/listeditstudent/editstudent/'.$sub->student_idstudentinfo)}}"><i class="icon-edit"></i></a>
                                               

                                            </td>


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{Form::open(['url'=>'list_st'])}}
                                <input type="hidden" name="class" value="{{$cls}}"/>
                                {{Form::hidden('sec',$sec)}}



                                                   <center>
                                                  <br>
                                                   <button type="submit" class="btn btn-info" id="cat2fwf" style="width:220px;" ><i class="icon-download-alt"></i> Download as PDF</button>
                                                   </center>
                                                    </form>


                            </div>
                            <!-- /widget-content -->

                        </div>
                        <!-- /widget -->

                   
                    <!-- /span8 -->


                </div>
            </div>

        </div>
    </div>


@stop
@section('content_footer')

    {{ HTML::style('/media/css/jquery.dataTables.css') }}
    {{--{{ HTML::script('/media/js/jquery.js') }} --}}
    {{ HTML::script('/media/js/jquery.dataTables.js') }}


@stop