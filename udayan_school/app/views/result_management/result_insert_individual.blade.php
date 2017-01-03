@extends('master.master')
@section('header')
@stop
@section('content')

    <div class="span12">

        <div class="widget ">
            <?php
                if(isset($msg) && !empty($msg)) {
                    echo "<div class='alert alert-success'><strong><h3 style='color:black' align='center'>$msg</h3></strong></div>";
                }
            ?>
            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Result Management</h3>
            </div>
            <div class="widget-content" style="overflow-x:auto">
                <div class="tabbable">
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Insert Result</h3>
                                        <?php
                                            echo "<center><div style='color: black'><strong>Class:</strong> $course->class_name" . "&nbsp;&nbsp;&nbsp;&nbsp;<strong>Section:</strong> $course->section" . "&nbsp;&nbsp;&nbsp;&nbsp;<strong>Subject:</strong> $subject_name" . "&nbsp;&nbsp;&nbsp;&nbsp;<strong>Term:</strong> $term" . "&nbsp;&nbsp;&nbsp;&nbsp;<b>Year:</strong> $year" . "</div></center>";
                                        ?>
                                        </strong>
                                        </div><br/>
                        <div class="fdcl_content_profile">
                            <?php
                            $clsname=$course->class_name;
                            //$cls_val = Addclass::where('class_name','=',$clsname)->pluck('value');
                            $secs=$sec; //echo $clsname.$secs;
                            $classinfo = Addclass::where('class_name','=',$clsname)->first();
                            $cls_val = $classinfo->value;
                            $configuration_name2=SubjectToClass::where('class','=',$classinfo->class_name)->where('idsubject','=',$data2)->first();
                            $configuration_name = $configuration_name2->markconfiguration_name;
                            $configuration_type=$type;
                            $marks_cofig=MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=',$configuration_type)->get();


                            $courseteacher = CourseTeacher::where('idcourseteacher','=',$idcourse)->first();

                             if($courseteacher->type == "N") {
                             $marks_config=StudentToSectionUpdate::where('class','=',$course->class_name)->where('section','=',$sec)->where('year',$year)->orderBy('st_roll', 'asc')->get();
}
                            if($courseteacher->type == "RM") {
                            $marks_config = StudentToSectionUpdate::where('class','=',$course->class_name)->where('section','=',$sec)
                                            ->leftjoin('studentinfo', 'student_to_section_update.student_idstudentinfo', '=', 'studentinfo.registration_id', 'left')
                                            ->where('studentinfo.religion','=', 'Islam')
                                            ->orderBy('st_roll', 'asc')->get(); }

                             if($courseteacher->type == "RH") {
                            $marks_config = StudentToSectionUpdate::where('class','=',$course->class_name)->where('section','=',$sec)
                                            ->leftjoin('studentinfo', 'student_to_section_update.student_idstudentinfo', '=', 'studentinfo.registration_id', 'left')
                                            ->where('studentinfo.religion','=', 'Hindu')
                                            ->orderBy('st_roll', 'asc')->get(); }

                               if($courseteacher->type == "RC") {
                            $marks_config = StudentToSectionUpdate::where('class','=',$course->class_name)->where('section','=',$sec)
                                            ->leftjoin('studentinfo', 'student_to_section_update.student_idstudentinfo', '=', 'studentinfo.registration_id', 'left')
                                            ->where('studentinfo.religion','=', 'Christian')
                                            ->orderBy('st_roll', 'asc')->get(); }


                                if($courseteacher->type == "RB") {
                            $marks_config = StudentToSectionUpdate::where('class','=',$course->class_name)->where('section','=',$sec)
                                            ->leftjoin('studentinfo', 'student_to_section_update.student_idstudentinfo', '=', 'studentinfo.registration_id', 'left')
                                            ->where('studentinfo.religion','=', 'Buddhist')
                                            ->orderBy('st_roll', 'asc')->get(); }


                             if($courseteacher->type == "AG") {
                            $marks_config = StudentToSectionUpdate::where('class','=',$course->class_name)->where('section','=',$sec)
                                            ->leftjoin('studentinfo', 'student_to_section_update.student_idstudentinfo', '=', 'studentinfo.registration_id', 'left')
                                            ->where('studentinfo.gender','=', 'Male')
                                            ->orderBy('st_roll', 'asc')->get(); }

                            if($courseteacher->type == "HS") {
                            $marks_config = StudentToSectionUpdate::where('class','=',$course->class_name)->where('section','=',$sec)
                                            ->leftjoin('studentinfo', 'student_to_section_update.student_idstudentinfo', '=', 'studentinfo.registration_id', 'left')
                                            ->where('studentinfo.gender','=', 'Female')
                                            ->orderBy('st_roll', 'asc')->get(); }



                            ?>
                            {{Form::open(array('url'=>'/regular_assesment', 'class'=>'form-inline')) }}
                            <div class="table-responsive" style="padding-left:3%;padding-right:3%">
                                {{Form::hidden('type',$type)}}
                                {{Form::hidden('subject',$data2)}}
                                {{Form::hidden('year',$year)}}
                                {{Form::hidden('term',$term)}}
                                {{Form::hidden('class',$clsname)}}
                                {{Form::hidden('section',$secs)}}
                                {{Form::hidden('idcourseteacher',$course->class_id)}}
                                {{Form::hidden('configuration_name',$configuration_name)}}


                                <table class="table table-bordered table-striped" style="overflow-x:auto">
                                    <thead>
                                    <tr>
                                        <th class="resource-name">Student Roll</th>
                                        <th class="resource-name">Student Name</th>
                                        @foreach ($marks_cofig as $mark)
                                            @if($cls_val > 8 && ($data2 != 15 && $data2 != 16 && $data2 != 17) && $mark->ct_type !=2)
                                            <script>

                                                function xamName(name)
                                                {
                                                    if(name=="class_work")
                                                    {
                                                        document.write("Class Work");
                                                    }
                                                    else if(name=="home_work")
                                                    {
                                                        document.write("Home Work");
                                                    }
                                                    else if(name=="bothe")
                                                    {
                                                        document.write("Both");
                                                    }
                                                    else if(name=="class_test_1")
                                                    {
                                                        document.write("CT 1 Creative<br>");
                                                    }
                                                    else if(name=="class_test_2")
                                                    {
                                                        document.write("CT 1 MCQ<br>");
                                                    }
                                                    else if(name=="class_test_3")
                                                    {
                                                        document.write("CT 2 Creative<br>");
                                                    }
                                                    else if(name=="class_test_4")
                                                    {
                                                        document.write("CT 2 MCQ<br>");
                                                    }
                                                    else if(name=="Hall_Test")
                                                    {
                                                        document.write("Hall Test");
                                                    }
                                                    else if(name=="viva")
                                                    {
                                                        document.write("Experiment");
                                                    }
                                                    else if(name=="experiment")
                                                    {
                                                        document.write("Experiment");
                                                    }
                                                    else if(name=="MCQ_Test")
                                                    {
                                                        document.write("MCQ");
                                                    }

                                                }
                                            </script>                                            <th>
                                                <script>xamName('<?php echo $mark->exam_name?>')</script>
                                           ( 0 - {{$mark->weighted_marks}} ) </th>
                                           @else
                                            <script>


                                                function xamName(name)
                                                {
                                                    if(name=="class_work")
                                                    {
                                                        document.write("Class Work");
                                                    }
                                                    else if(name=="home_work")
                                                    {
                                                        document.write("Home Work");
                                                    }
                                                    else if(name=="bothe")
                                                    {
                                                        document.write("Both");
                                                    }
                                                    else if(name=="class_test_1")
                                                    {
                                                        document.write("Class Test 1");
                                                    }
                                                    else if(name=="class_test_2")
                                                    {
                                                        document.write("Class Test 2");
                                                    }
                                                    else if(name=="class_test_3")
                                                    {
                                                        document.write("Class Test 3");
                                                    }
                                                    else if(name=="class_test_4")
                                                    {
                                                        document.write("Class Test 4");
                                                    }
                                                    else if(name=="Hall_Test")
                                                    {
                                                        document.write("Hall Test");
                                                    }
                                                    else if(name=="viva")
                                                    {
                                                        document.write("Experiment");
                                                    }
                                                    else if(name=="experiment")
                                                    {
                                                        document.write("Experiment");
                                                    }
                                                    else if(name=="MCQ_Test")
                                                    {
                                                        document.write("MCQ");
                                                    }

                                                }
                                            </script>
                                            <th>
                                                <script>xamName('<?php echo $mark->exam_name?>')</script>
                                           ( 0 - {{$mark->weighted_marks}} ) </th>
                                           @endif
                                        @endforeach

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count=0; $exam_name1 = "Default"; $exam_name2 = "Default"; $exam_name3 = "Default"; $exam_name4 = "Default"; ?>
                                    @foreach ($marks_config as $mark_conf)
                                        <?php
                                        $id=$mark_conf->student_idstudentinfo;
                                        $student = Studentinfo::where('registration_id','=',$mark_conf->student_idstudentinfo)->pluck('sutdent_name');
                                        ?>
                                        <?php $count++; ?>
                                        <tr>
                                            <td>{{$mark_conf->st_roll}}</td>
                                            <td>{{$student}}</td>
                                            {{Form::hidden('idstudentinfo'.$count,$id)}}
                                            {{--<input type="text" name="idstudentinfo{{$count}}" value="{{$id}}" hidden>--}}
                                            <?php
                                            $result=null;
                                            if($courseteacher!=null||$courseteacher!="")
                                            {

                                                if($type == "RT")
                                                {
                                                    $result = ResultRegularAssessment::where('courseteacher_idcourseteacher','=',$courseteacher->idcourseteacher)->where('studentinfo_idstudentinfo','=',$id)->where('academic_year','=',$year)->where('term','=',$term)->first();
                                                    $exam_name1 = "class_work";
                                                    $exam_name2 = "home_work";
                                                    $exam_name3 = "bothe";
                                                }
                                                if($type == "CT")
                                                {
                                                    $result = ResultClassTest::where('courseteacher_idcourseteacher','=',$courseteacher->idcourseteacher)->where('studentinfo_idstudentinfo','=',$id)->where('academic_year','=',$year)->where('term','=',$term)->first();

                                                    $exam_name1 = "class_test_1";
                                                    $exam_name2 = "class_test_2";
                                                    $exam_name3 = "class_test_3";
                                                    $exam_name4 = "class_test_4";
                                                }
                                                if($type == "HT")
                                                {
                                                    $result = ResultHallTest::where('courseteacher_idcourseteacher','=',$courseteacher->idcourseteacher)->where('studentinfo_idstudentinfo','=',$id)->where('academic_year','=',$year)->where('term','=',$term)->first();
                                                    $exam_name1 = "Hall_Test";
                                                }
                                                if($type == "LT")
                                                {
                                                    $result = ResultLabTest::where('courseteacher_idcourseteacher','=',$courseteacher->idcourseteacher)->where('studentinfo_idstudentinfo','=',$id)->where('academic_year','=',$year)->where('term','=',$term)->first();
                                                    $exam_name1 = "viva";
                                                    $exam_name2 = "experiment";
                                                }
                                                if($type == "MT")
                                                {
                                                    $result = ResultMCQTest::where('courseteacher_idcourseteacher','=',$courseteacher->idcourseteacher)->where('studentinfo_idstudentinfo','=',$id)->where('academic_year','=',$year)->where('term','=',$term)->first();
                                                    $exam_name1 = "MCQ_Test";
                                                }
                                            }
                                            if($result!=null&&$type == "RT"){
                                                $val1 = $result->classwork;
                                                $exam_name1 = "class_work";
                                                $val2 = $result->homework;
                                                $exam_name2 = "home_work";
                                                $val3 = $result->bothe;
                                                $exam_name3 = "bothe";
                                            }
                                            else if($result!=null&&$type == "CT"){
                                                $val1 = $result->ct1;
                                                $exam_name1 = "class_test_1";
                                                $val2 = $result->ct2;
                                                $exam_name2 = "class_test_2";
                                                $val3 = $result->ct3;
                                                $exam_name3 = "class_test_3";
                                                $val4 = $result->ct4;
                                                $exam_name4 = "class_test_4";
                                            }
                                            else if($result!=null&&$type == "HT"){
                                                $val1 = $result->hall_test_marks;
                                                $exam_name1 = "Hall_Test";
                                            }
                                            else if($result!=null&&$type == "LT"){
                                                $val1 = $result->viva_marks;
                                                $exam_name1 = "viva";
                                              //  $val2 = $result->experiment_marks;
                                                $exam_name2 = "experiment";
                                                 $val2 = $result->viva_marks;
                                            }
                                            else if($result!=null&&$type == "MT"){
                                                $val1 = $result->mcq_marks;
                                                $exam_name1 = "MCQ_Test";
                                            }
                                            else{
                                                $val1 = null;
                                                $val2 = null;
                                                $val3 = null;
                                                $val4=null;
                                            }
                                            ?>
                                            <?php $cc =0;?>
                                            @foreach ($marks_cofig as $mark)
                                                <?php $cc++; ?>
                                                @if($cc==1) <!-- for class > 8 for ICT show only MCQ CT type -->
                                                    <td> <input type="text" name="{{$mark->exam_name}}<?php echo $count?>" id="{{$mark->exam_name}}<?php echo $count?>" class="form-control"  value="<?php if($configuration_name == 'config09car' && $type == 'CT') { echo $val2; } else { echo $val1; }?>" onkeyup="booleanCall('<?php echo $type;?>','{{$configuration_name}}','{{$exam_name1}}','{{$mark->exam_name}}<?php echo $count?>','{{$count}}')" style="width:100%;height:30px"><p id="{{$count}}" style="color: red;"></p></td>

                                                @elseif($cc==2)
                                                    <td> <input type="text" name="{{$mark->exam_name}}<?php echo $count?>" id="{{$mark->exam_name}}<?php echo $count?>" class="form-control"  value="{{$val2}}" onkeyup="booleanCall('<?php echo $type;?>','{{$configuration_name}}','{{$exam_name2}}','{{$mark->exam_name}}<?php echo $count?>','{{$count}}')" style="width:100%;height:30px"><p id="{{$count}}" style="color: red;"></p></td>

                                                @elseif($cc==3)
                                                    <td> <input type="text" name="{{$mark->exam_name}}<?php echo $count?>" id="{{$mark->exam_name}}<?php echo $count?>" class="form-control"  value="{{$val3}}" onkeyup="booleanCall('<?php echo $type;?>','{{$configuration_name}}','{{$exam_name3}}','{{$mark->exam_name}}<?php echo $count?>','{{$count}}')" style="width:100%;height:30px"><p id="{{$count}}" style="color: red;"></p></td>
                                                @elseif($cc==4)
                                                    <td> <input type="text" name="{{$mark->exam_name}}<?php echo $count?>" id="{{$mark->exam_name}}<?php echo $count?>" class="form-control"  value="{{$val4}}" onkeyup="booleanCall('<?php echo $type;?>','{{$configuration_name}}','{{$exam_name4}}','{{$mark->exam_name}}<?php echo $count?>','{{$count}}')" style="width:100%;height:30px"><p id="{{$count}}" style="color: red;"></p></td>

                                                @endif
                                            @endforeach

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                            </div>
                            <div class="col-sm-12"><center>
                                    <button type="submit" id="mybtn" class="btn btn-success center-block"><i class="icon-save"></i> Save</button>
                                </center></div>
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


    <script>
        function booleanCall(a,b,c,d,e)
        {
            var data2 = document.getElementById(d).value;
            var data3 = parseInt(data2);
            if (data2==null || data2==""||data2==" "||data2=="  "||data2=="   "||data2=="    ")
            {
                document.getElementById(d).style.border = '1px solid #ccc';
                document.getElementById("mybtn").disabled = false;
                document.getElementById(e).innerHTML = null;
            }
            else{
                $.get('<?php echo Config::get('baseurl.url');?>/ajaxboolean?a=' + a + '&b=' + b + '&c=' + c + '&d=' + data2, function (data) {
                    //  alert(data);
                    if(data==0)
                    {
                        document.getElementById(d).style.border = '1px solid red';
                        document.getElementById("mybtn").disabled = true;
                        document.getElementById(e).innerHTML = "Not a Number";
                    }
                    if(data==2)
                    {
                        document.getElementById(d).style.border = '1px solid red';
                        document.getElementById("mybtn").disabled = true;
                        document.getElementById(e).innerHTML = "Number out of bound";
                    }
                    if(data==1)
                    {
                        document.getElementById(d).style.border = '1px solid #ccc';
                        document.getElementById("mybtn").disabled = false;
                        document.getElementById(e).innerHTML = null;
                    }

                });
            }


        }
    </script>

@stop
