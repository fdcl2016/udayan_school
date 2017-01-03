@extends('master.master')
@section('header')
    <style type="text/css">
        #left_div {
            float: left;
            width: 50%;
        }
        #right_div {
            float: right;
            width: 50%;
        }
        tr,td,table{
            height:40px;

        }
    </style>
@stop
@section('content')


    <?php
            $rasel = 6;
    include(app_path().'/views/nav_config/a_subject_management.php');
    ?>



    <div class="tab-content">
        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                        style="color:black">Configure Result</h3></strong></div><br/>
        <div class="fdcl_content_profile">
            <div class="widget-header"></div>
            <div class="widget-content">

                <div style="padding-left:5%;padding-right:5%">

                    {{Form::open(array('url'=>'result_management/configure_result'))}}
                    <div style="width:100%; ">
                        <div style="width:100%;">
                            <div style=" width:100%;"><br>
                                <div id="left_div" style="width:30%;">

                                    <p><b>Configuration Name</b></p>

                                </div>
                                <div id="right_div" style="width:70%;">
                                    <input id="configuration_name" type="text" name="configuration_name"class="form-control" value="{{Input::old('configuration_name')}}" placeholder="Enter Name" style="width:160px;float:left" required>
                                </div>
                            </div>
                            <div  style="width:100%;height:40px;"></div>
                            <div id="left_div" style="width:60%;">

                                <p><b>Regular Assesment:</b></p>

                            </div>
                            <div id="right_div" style="width:40%;">
                                <input id="ra_marks" type="number" name="ra_marks"class="form-control" value="{{Input::old('ra_marks')}}" placeholder="Enter Marks" style="width:160px;float:right" >
                            </div>
                        </div>
                        <div  style="width:100%;height:40px;"></div>
                        <div style="padding-left:10%">
                            <table style="width:90%">
                                <tr><td><p>Class Work</p></td>
                                    <td><input id="class_work" type="number" name="class_work"class="form-control" value="{{Input::old('class_work')}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                    </td>
                                </tr>
                                <tr><td><p>Home Work</p></td>
                                    <td><input id="home_work" type="number" name="home_work"class="form-control" value="{{Input::old('home_work')}}" placeholder="Enter Marks" style="width:160px;float:right">
                                    </td>
                                </tr>
                                <tr><td><p>Both</p></td>
                                    <td><input id="both" type="number" name="both"class="form-control" value="{{Input::old('both')}}" placeholder="Enter Marks" style="width:160px;float:right">
                                    </td>
                                </tr>

                            </table>

                        </div>
                    </div>

                    <div style="width:100%;margin-top:5% ">
                        <div style=" width:100%;">
                            <div id="left_div" style="width:60%;">

                                <p><b>Class Test:</b></p>

                            </div>
                            <div id="right_div" style="width:40%;">
                                <input id="ct_marks" type="number" name="ct_marks"class="form-control" placeholder="Enter Marks" style="width:160px;float:right"  value="{{Input::old('ct_marks')}}" >
                            </div>
                        </div>
                        <div  style="width:100%;height:40px;"></div>
                        <div style="padding-left:10%">
                            <table style="width:90%">
                                <tr><td><p>Class Test 1:</p></td>
                                    <td><input id="class_test1" type="number" name="class_test1"class="form-control" value="{{Input::old('class_test1')}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                    </td>
                                </tr>
                                <tr><td><p>Class Test 2:</p></td>
                                    <td><input id="class_test2" type="number" name="class_test2"class="form-control" value="{{Input::old('class_test2')}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                    </td>
                                </tr>
                                <tr><td><p>Class Test 3:</p></td>
                                    <td><input id="class_test3" type="number" name="class_test3"class="form-control" value="{{Input::old('class_test3')}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                    </td>
                                </tr>
                                <tr><td><p>Class Test 3:</p></td>
                                    <td><input id="class_test4" type="number" name="class_test4"class="form-control" value="{{Input::old('class_test4')}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                    <div  style="width:100%;height:50px;"></div>
                    <div style="width:100%;margin-top:5% ">
                        <div style=" width:100%;">
                            <div id="left_div" style="width:60%;">

                                <p><b>Hall Test:</b></p>

                            </div>
                            <div id="right_div" style="width:40%;">
                                <input id="ht_marks" type="number" name="ht_marks"class="form-control" value="{{Input::old('ht_marks')}}" placeholder="Enter Marks" style="width:160px;float:right" >
                            </div>
                        </div>
                        <div  style="width:100%;height:40px;"></div>
                        <div style="padding-left:10%">
                            <table style="width:90%">
                                <tr><td><p>Hall Test Marks:</p></td>
                                    <td><input id="hall_test" type="number" name="hall_test"class="form-control" value="{{Input::old('hall_test')}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                    <div  style="width:100%;height:50px;"></div>
                    <div style="width:100%;margin-top:5% ">
                        <div style=" width:100%;">
                            <div id="left_div" style="width:60%;">

                                <p><b>MCQ</b></p>

                            </div>
                            <div id="right_div" style="width:40%;">
                                <input id="mcq_marks" type="number" name="mcq_marks"class="form-control" value="{{Input::old('mcq_marks')}}" placeholder="Enter Marks" style="width:160px;float:right" >
                            </div>
                        </div>
                        <div  style="width:100%;height:40px;"></div>
                        <div style="padding-left:10%">
                            <table style="width:90%">
                                <tr><td><p>MCQ Marks:</p></td>
                                    <td><input id="mcq" type="number" name="mcq"class="form-control" placeholder="Enter Marks" value="{{Input::old('mcq')}}" style="width:160px;float:right" >
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                    <div  style="width:100%;height:50px;"></div>

                    <div style="width:100%;margin-top:1% ">
                        <div style=" width:100%;">
                            <div id="left_div" style="width:60%;">

                                <p><b>Lab:</b></p>

                            </div>
                            <div id="right_div" style="width:40%;">
                                <input id="lab" type="number" name="lab"class="form-control" value="{{Input::old('lab')}}" placeholder="Enter Marks" style="width:160px;float:right" >
                            </div>
                        </div>
                        <div  style="width:100%;height:40px;"></div>
                        <div style="padding-left:10%">
                            <table style="width:90%">
                                <tr><td><p>Viva:</p></td>
                                    <td><input id="viva" type="number" name="viva"class="form-control" value="{{Input::old('viva')}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                    </td>
                                </tr>
                                <tr><td><p>Experiment:</p></td>
                                    <td><input id="experiment" type="number" name="experiment"class="form-control" value="{{Input::old('experiment')}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                    </td>
                                </tr>


                            </table>

                        </div>
                    </div>
                    <div  style="width:100%;height:50px;"></div>
                    <div style=" width:100%;">
                        <div id="left_div" style="width:60%;">

                            <p><b>Total:</b></p>

                        </div>
                        <div id="right_div" style="width:40%;">
                            <input id="total" type="number" name="total"class="form-control" value="{{Input::old('total')}}" placeholder="Enter Marks" style="width:160px;float:right" >
                        </div>
                    </div><br>
                    <center><div class="col-sm-12"><button type="submit" class="btn btn-info"><i class="icon-save"></i> Save</button></div></center>

                    {{Form::close()}}
                    <br>

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