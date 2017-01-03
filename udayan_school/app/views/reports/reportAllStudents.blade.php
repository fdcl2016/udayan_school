@extends('master.master')
@section('header')
    <link href="{{ URL::asset('master/css/pages/dashboard.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('master/calender/basic.css') }}" rel="stylesheet">
@stop
@section('content')


    <?php
    $rasel = 2;
    include_once(app_path().'/views/nav_config/a_reports.php');
    ?>

                    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">All Student List</h3></strong></div>
                    <div id="stdregister_div"></div>


                    <div class="span11">

                        <div class="widget ">

                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3>Udayan Higher Secondary School</h3>
                                    </div>


                                </div>
                            </div>
                            <!-- /widget-header -->



                            <div class="widget-content">

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center">Class</th>
                                        <th style="text-align: center">Details</th>
                                        <th style="text-align: center">Total Students</th>

                                    </tr>

                                    </thead>

                                    <tbody>
                                    @foreach($allclass as $cls)
                                        <tr>
                                            <td class="text-center" style="font-weight: bold; padding: 80px 10px; text-align: center">
                                                {{$cls->class_name}}
                                            </td>
                                            <td >
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <th style="text-align: center">Section</th>
                                                    <th style="text-align: center">Class Teacher</th>
                                                    <th style="text-align: center">Total Students</th>
                                                    <th style="text-align: center">Male Students</th>
                                                    <th style="text-align: center">Female Students</th>
                                                    <th style="text-align: center">Muslim Students</th>
                                                    <th style="text-align: center">Hindu Students</th>
                                                    <th style="text-align: center">Others</th>
                                                    </thead>
                                                    <?php
                                                    $allsec=ClassTeacherInfo::where('class_name','=',$cls->class_name)->get();
                                                    foreach ($allsec as $cl)
                                                    {
                                                    ?>

                                                    <tbody>
                                                    <tr>
                                                        <td  style="text-align: left">  {{$cl->section}}</td>
                                                        <td  style="text-align: left">
                                                            {{$cl->teacher_name}}</td>
                                                        <td  style="text-align: center">
                                                            <?php
                                                            $st_count = StudentToSection::where('class', '=',$cl->class_name)->where('section', '=', $cl->section)->get();
                                                            $count = count($st_count);
                                                            ?>
                                                            {{$count}}
                                                        </td>
                                                        <td  style="text-align: center">
                                                            <?php
                                                            $male = ClassWiseStd::where('std_gender','=','Male')->where('std_class','=',$cl->class_name)->where('std_section','=', $cl->section)->get();
                                                            $male_std = count($male);
                                                            ?>
                                                            {{$male_std}}
                                                        </td>
                                                        <td  style="text-align: center">
                                                            <?php
                                                            $feml_std = $count - $male_std;
                                                            echo $feml_std;
                                                            ?>
                                                        </td>
                                                        <td  style="text-align: center">
                                                            <?php
                                                            $religion_m = ClassWiseStd::where('std_religion','=','Islam')->where('std_class','=',$cl->class_name)->where('std_section','=', $cl->section)->get();
                                                            $std_religion_m = count($religion_m);
                                                            echo $std_religion_m;
                                                            ?>
                                                        </td>
                                                        <td  style="text-align: center">
                                                            <?php
                                                            $religion_h = ClassWiseStd::where('std_religion','=','Hidu')->where('std_class','=',$cl->class_name)->where('std_section','=', $cl->section)->get();
                                                            $std_religion_h = count($religion_h);
                                                            echo $std_religion_h;
                                                            ?>
                                                        </td>
                                                        <td  style="text-align: center">
                                                            <?php
                                                            $others = $count - ($std_religion_m+$std_religion_h);
                                                            echo $others;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                    <?php } ?>
                                                </table>
                                            </td>
                                            <td class="text-center" style="font-weight: bold; padding: 80px 10px; text-align: center">
                                                <?php
                                                $st_c_count = StudentToSection::where('class', '=',$cl->class_name)->get();
                                                $s_count = count($st_c_count);
                                                echo $s_count;
                                                ?>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
@section('content_footer')


    <link href="{{ URL::asset('date/jquery.datepick.css')}}" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ URL::asset('date/jquery.plugin.js')}}"></script>
    <scrit src="{{ URL::asset('date/jquery.datepick.js')}}"></scrit>


@stop