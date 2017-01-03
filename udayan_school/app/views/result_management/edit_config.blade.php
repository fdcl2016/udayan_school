@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Result Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                           <li>
                            <a href="{{ URL::to('/subject_management/create_subject')}}">Create Subject</a>
                        </li>
                        <li><a href="{{ URL::to('/subject_management/edit_subject')}}">Edit Subject</a></li>
                        <li><a href="{{ URL::to('/subject_management/assign_subject_to_teacher')}}">Assign Subject To Teacher</a></li>
                        <li><a href="{{ URL::to('/subject_management/classwise_subject')}}">Classwise Subject</a></li>
                        <li><a href="{{ URL::to('/subject_management/classwise_subject_list')}}">Classwise Subject List</a></li>
                        <li>
                            <a href="{{ URL::to('/result_management/configure_result')}}">Configure Result</a>
                        </li>
                        <li class="active">
                            <a href="{{ URL::to('/result_management/list_of_config')}}">List of Configuration</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Configure Result</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
                            <div class="widget-header"></div>
                            <div class="widget-content">
                                {{Form::open(array('url'=>'result_management/edit_config'))}}

                                <div class="col-sm-10">
                                    <div class="col-sm-4"> <p><b>Configuration Name</b></p> </div>
                                    <div class="col-sm-6">  <input id="configuration_name" type="text" name="configuration_name"class="form-control" value="{{$configuration_name}}" placeholder="Enter Name" required></div>
                                </div>
                                <div  class="col-sm-10"><br/></div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <p style="float: left;"><b>Regular Assesment:</b></p>
                                    </div>
                                    <div class="col-sm-8">
                                        <input id="ramarks" type="number" name="ra_marks"class="form-control" value="{{$data['ra_total_marks']}}" placeholder="Enter Marks" style="width:120px;float:right" >
                                    </div>
                                </div>
                                <div style="padding-left:10%">
                                    <table style="width:90%">
                                        <tr><td><p>Class Work</p></td>
                                            <td><input id="classwork" type="number" name="class_work"class="form-control" value="{{$data['class_work']}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                            </td>
                                        </tr>
                                        <tr><td><p>Home Work</p></td>
                                            <td><input id="homework" type="number" name="home_work"class="form-control" value="{{$data['home_work'] }}" placeholder="Enter Marks" style="width:160px;float:right">
                                            </td>
                                        </tr>
                                        <tr><td><p>Both</p></td>
                                            <td><input id="both" type="number" name="both"class="form-control" value="{{$data['bothe']}}" placeholder="Enter Marks" style="width:160px;float:right">
                                            </td>
                                        </tr>

                                    </table>

                                </div>
                                <div  class="col-sm-10"><br/></div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">

                                        <p><b>Class Test:</b></p>
                                    </div>
                                    <div class="col-sm-8">
                                        <input id="ctmarks" type="number" name="ct_marks"class="form-control" placeholder="Enter Marks" style="width:120px;float:right"  value="{{$data['ct_total_marks']}}" >
                                    </div>
                                </div>
                                <div style="padding-left:10%">
                                    <table style="width:90%">
                                        <tr><td><p>Class Test 1:</p></td>
                                            <td><input id="classtest1" type="number" name="class_test1"class="form-control" value="{{$data['class_test_1']}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                            </td>
                                        </tr>
                                        <tr><td><p>Class Test 2:</p></td>
                                            <td><input id="classtest2" type="number" name="class_test2"class="form-control" value="{{$data['class_test_2']}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                            </td>
                                        </tr>
                                        <tr><td><p>Class Test 3:</p></td>
                                            <td><input id="classtest3" type="number" name="class_test3"class="form-control" value="{{$data['class_test_3']}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                            </td>
                                        </tr>
                                        <tr><td><p>Class Test 4:</p></td>
                                            <td><input id="classtest4" type="number" name="class_test4"class="form-control" value="{{$data['class_test_4']}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                                <div  class="col-sm-10"><br/></div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <p><b>Hall Test:</b></p>
                                    </div>
                                    <div class="col-sm-8">
                                        <input id="htmarks" type="number" name="ht_marks"class="form-control" value="{{$data['ht_total_marks']}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                    </div>
                                </div>
                                <div style="padding-left:10%">
                                    <table style="width:90%">
                                        <tr><td><p>Hall Test Marks:</p></td>
                                            <td><input id="halltest" type="number" name="hall_test"class="form-control" value="{{$data['Hall_Test']}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                                <div  class="col-sm-10"><br/></div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <p><b>MCQ</b></p>
                                    </div>
                                    <div class="col-sm-8">
                                        <input id="mcqmarks" type="number" name="mcq_marks"class="form-control" value="{{$data['mt_total_marks'] }}" placeholder="Enter Marks" style="width:160px;float:right" >
                                    </div>
                                </div>
                                <div style="padding-left:10%">
                                    <table style="width:90%">
                                        <tr><td><p>MCQ Marks:</p></td>
                                            <td><input id="mcq" type="number" name="mcq"class="form-control" placeholder="Enter Marks" value="{{$data['MCQ_Test'] }}" style="width:160px;float:right" >
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                                <div  class="col-sm-10"><br/></div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <p><b>Lab:</b></p>
                                    </div>
                                    <div class="col-sm-8">
                                        <input id="lab" type="number" name="lab"class="form-control" value="{{$data['lt_total_marks']}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                    </div>
                                    <div style="padding-left:10%">
                                        <table style="width:90%">
                                            <tr><td><p>Viva:</p></td>
                                                <td><input id="viva" type="number" name="viva"class="form-control" value="{{$data['viva']}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                                </td>
                                            </tr>
                                            <tr><td><p>Experiment:</p></td>
                                                <td><input id="experiment" type="number" name="experiment"class="form-control" value="{{$data['experiment'] }}" placeholder="Enter Marks" style="width:160px;float:right" >
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div  class="col-sm-10"><br/></div>
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <p><b>Total:</b></p>
                                        </div>
                                        <div class="col-sm-8">
                                            <input id="total" type="number" name="total"class="form-control" value="{{Input::old('total')}}" placeholder="Enter Marks" style="width:160px;float:right" >
                                        </div>
                                        <div  class="col-sm-10"><br/></div>
                                         <center><div class="col-sm-12"><button type="submit" class="btn btn-info"><i class="icon-save"></i> Save</button></div></center> 

                                        {{Form::close()}}

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
@stop