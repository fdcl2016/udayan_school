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
                            <a href="{{ URL::to('/result_management/student_result')}}">View Marks</a>
                        </li>
                        <li class="">
                          <a href="{{ URL::to('/result_management/student_report_card')}}">View Report</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Result</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
                            {{ Form::open(array('url'=>'/showresultlink', 'class'=>'form-inline')) }}
                            <center><div class="form-group">
                                    {{Form::hidden('idclass',$idclass)}}
                                    <label style="padding-right:80px;">Select Subject</label>
                                    <select name="cat" id="cat" class="form-control" style="width:320px;">
                                        <option value="">-&nbsp;Select Subject &nbsp;-</option>
                                        @foreach($subject as $cats)
                                            <?php $sub = Subject::where('idsubject','=',$cats->idsubject)->first();?>
                                            <option value="{{$sub->subject_name}}">{{$sub->subject_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </center>
                            <br/><br/>
                            <center><input type="submit" class="btn btn-info" style="width:120px;" value="show result"></center>
                            <div><br/></div>
                            {{Form::close()}}
                            @if($subject2!=null&&$idclass2!=null)
                                <?php
                                $subjectname = Subject::where('subject_name','=',$subject2)->first();
                                    if($subjectname!=""){
                                $course = CourseTeacher::where('idsubject','=',$subjectname->idsubject)->where('idclasssection','=',$idclass2)->first();
                                        if($course!=""){
                                $ra = ResultRegularAssessment::where('studentinfo_idstudentinfo','=',Auth::user()->email)->where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->first();
                                $ca = ResultClassTest::where('studentinfo_idstudentinfo','=',Auth::user()->email)->where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->first();
                                $la = ResultLabTest::where('studentinfo_idstudentinfo','=',Auth::user()->email)->where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->first();
                                $ha = ResultHallTest::where('studentinfo_idstudentinfo','=',Auth::user()->email)->where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->first();
                                $ma = ResultMCQTest::where('studentinfo_idstudentinfo','=',Auth::user()->email)->where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->first();

                                $cls_sec = Addclass::where('class_id','=', $idclass)->first();
                                $pub = PublishResult::where('class', '=' ,$cls_sec->class_name)->where('section', '=', $cls_sec->section)->where('published', '=', 'Y')->orderby('term')->first();

                                ?>

                                <div id="addclass">
                                    <div class="table-responsive" style="padding-left:15%;padding-right:15%"> @if(count($pub)) Term :  {{$pub->term}}   @endif
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th class="resource-name">Mark Category</th>
                                                <th class="resource-link" >Achieved Marks</th>
                                                <th class="resource-link" style="width:11%">Counted Marks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $rt = "RT";
                                            $ht = "HT";
                                            $ct = "CT";
                                            $lt = "LT";
                                            $mt = "MT";
                                            ?>
                                            @if($ra!=null||$ra!="")
                                                <tr>
                                                    <td>Regular Assessment</td>
                                                    <td> @if(isset($ra->classwork)) <b> Classwork: </b>{{$ra->classwork}}@endif
                                                    @if(isset($ra->homework))<br> <b>Homework: </b>{{$ra->homework}} @endif</td>
                                                    <td>
                                                     {{$ra->converted_marks}}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if($ca!=null||$ca!="")
                                                <tr>
                                                    <td>Class Test</td>
                                                    <td>
                                                    @if($cls_sec->value >8)
                                                        @if(isset($ca->ct1))  <b>CT 1 Creative:</b> {{$ca->ct1}}<br> @endif
                                                        @if(isset($ca->ct2))  <b>CT 1 MCQ: {{$ca->ct2}} </b><br> @endif
                                                        @if(isset($ca->ct3)) <b>CT 2 Creative: {{$ca->ct3}} </b><br> @endif
                                                        @if(isset($ca->ct4)) <b> CT 2 MCQ: {{$ca->ct4}} </b><br> @endif
                                                    @else
                                                        @if(isset($ca->ct1))<b>Class Test 1: {{$ca->ct1}} </b><br> @endif
                                                        @if(isset($ca->ct2)) <b>Class Test 2: {{$ca->ct2}} </b><br> @endif
                                                        @if(isset($ca->ct3))<b> Class Test 3: {{$ca->ct3}} </b><br> @endif
                                                        @if(isset($ca->ct4))<b>Class Test 4: {{$ca->ct4}} </b><br> @endif
                                                    @endif
                                                    </td>
                                                    <td>
                                                       {{$ca->converted_marks}}
                                                    </td>
                                                </tr>
                                            @endif

                                            @if(count($pub))

                                            @if($ha!=null||$ha!="")
                                                <tr>
                                                    <td>Hall Test</td>
                                                    <td>{{$ha->hall_test_marks}}</td>
                                                    <td>
                                                     {{$ha->converted_marks}}
                                                    </td>
                                                </tr>
                                            @endif

                                            @if($la!=null||$la!="")
                                                <tr>
                                                    <td>Lab Test</td>
                                                    <td>  @if(isset($la->viva_marks))  <b>Viva Marks: </b> {{$la->viva_marks}} @endif
                                                    @if(isset($la->experiment_marks))<br> <b> Experiment Marks: </b>{{$la->experiment_marks}}@endif</td>
                                                    <td>
                                                        {{$la->converted_marks}}
                                                    </td>
                                                </tr>
                                            @endif

                                            @if($ma!=null||$ma!="")
                                                <tr>
                                                    <td>MCQ test</td>
                                                    <td>{{$ma->mcq_marks}}</td>
                                                    <td>
                                                       {{$ma->converted_marks}}
                                                    </td>
                                                </tr>
                                            @endif
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <?php }}?>
                            @endif

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