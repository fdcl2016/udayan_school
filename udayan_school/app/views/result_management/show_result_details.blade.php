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
                        <li class="active">
                            <a href="{{ URL::to('/result_management/student_result')}}">Show Result</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Details Mark</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
                            <div class="widget-header"></div>
                            <div class="widget-content">
                        <div class="table-responsive" style="padding-left:3%;padding-right:3%">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="resource-name">Exam Name</th>
                                    <th class="resource-name">Marks</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php if($type=="RT"){?>
                                <tr>
                                    <td>Class Work</td>
                                    <td>{{$result->classwork}}</td>
                                </tr>
                                <tr>
                                    <td>Home Work</td>
                                    <td>{{$result->homework}}</td>
                                </tr>
                                <tr>
                                    <td>Both</td>
                                    <td>{{$result->bothe}}</td>
                                </tr>

                                <?php }?>
                                <?php if($type=="CT"){?>
                                <tr>
                                    <td>Class Test 1</td>
                                    <td>{{$result->ct1}}</td>
                                </tr>
                                <tr>
                                    <td>Class Test 2</td>
                                    <td>{{$result->ct2}}</td>
                                </tr>
                                <tr>
                                    <td>Class Test 3</td>
                                    <td>{{$result->ct3}}</td>
                                </tr>
                                <tr>
                                    <td>Class Test 4</td>
                                    <td>{{$result->ct4}}</td>
                                </tr>

                                <?php }?>
                                <?php if($type=="HT"){?>
                                <tr>
                                    <td>Hall Test Marks</td>
                                    <td>{{$result->hall_test_marks}}</td>
                                </tr>
                                <?php }?>
                                <?php if($type=="LT"){?>
                                <tr>
                                    <td>Viva Marks</td>
                                    <td>{{$result->viva_marks}}</td>
                                </tr>
                                <tr>
                                    <td>Experimental Marks</td>
                                    <td>{{$result->experiment_marks}}</td>
                                </tr>
                                <?php }?>
                                <?php if($type=="MT"){?>
                                <tr>
                                    <td>MCQ Test</td>
                                    <td>{{$result->mcq_marks}}</td>
                                </tr>

                                <?php }?>

                                </tbody>
                            </table>

                        </div>
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
@stop