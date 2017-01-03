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
            <div class="widget-content" style="overflow-x:auto">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                              <li>
                            <a href="{{ URL::to('/result_management/teacher_result_insert')}}">Insert Marks</a>
                        </li>
                        <li class="active">
                            <a href="{{ URL::to('/view_marksheet')}}">Mark Sheet</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/view_tabulationsheet')}}">Tabulation Sheet</a>

                        </li>
                        <li>
                            <a href="{{ URL::to('/submit_marks')}}">Subject Mark Submit</a>
                        </li>
<?php 

$clt = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->first();

if(count($clt)>0){
?>
 <li>
                             <a href="{{ URL::to('/result_management/st_report_card2')}}">Student Report Card</a>
                        </li>

<?php } ?>
                    </ul>
                    <div class="tab-content"> <?php

                     function ShohagModifiedConfCT($configuration_name, $st_id, $term, $idsub, $year)
    {

        $conv_mark = 0; $configuration_total = 100;
        if($configuration_name == "confcls09ict") { $conv_mark = 5; $ct_total=40; $ht_mark =20; $configuration_total = 50;}
        if( $configuration_name == "confcls09phy") { $conv_mark = 10; $ct_total=35; $ht_mark =40; }
        if($configuration_name == "confcls09ban1st") { $conv_mark = 10; $ct_total=50; $ht_mark =60; }
        if($configuration_name == "confcls09ban2nd") { $conv_mark = 20; $ct_total=70; $ht_mark =100; }
        if($configuration_name == "confcls09com") { $conv_mark = 10; $ct_total=50; $ht_mark =60;}

        if(!$conv_mark) return 0;
        $ct = ResultClassTest::where('studentinfo_idstudentinfo','=',$st_id)->where('idsubject','=',$idsub)->where('term','=',$term)->where('academic_year','=',$year)->orderby('academic_year','DESC')->first();

        $ct1 =0; $ct2=0;
        if (isset($ct->ct1)) $ct1 = $ct->ct1;

        if($configuration_name == "confcls09ban2nd")
        {
            if(isset($ct->ct2)) $ct2 = $ct->ct2;
        }
        else
        {
            if(isset($ct->ct3)) $ct2 = $ct->ct3;
        }


        $ct_given_mark = $ct1+ $ct2;

        $ct_conv_given_mark = ($ct_given_mark * $conv_mark) / $ct_total;

       // $ht_conv_given_mark = ((($ct_conv_given_mark + $ht) * $ht_mark) / ($conv_mark+$ht_mark));

        return ceil($ct_conv_given_mark);

    }

     function ShohagModifiedConfMCQ($configuration_name,  $st_id, $term, $idsub, $year)
    {

        $conv_mark = 0; $configuration_total = 100;
        if($configuration_name == "confcls09ict") { $conv_mark = 5; $ct_total=20; $mcq_mark =15; $configuration_total = 50;}
        if( $configuration_name == "confcls09phy") { $conv_mark = 10; $ct_total=35; $mcq_mark =35; }
        if($configuration_name == "confcls09ban1st") { $conv_mark = 10; $ct_total=30; $mcq_mark =40; }
        if($configuration_name == "confcls09com") { $conv_mark = 10; $ct_total=30; $mcq_mark =40;}

        if(!$conv_mark) return 0;
        $ct = ResultClassTest::where('studentinfo_idstudentinfo','=',$st_id)->where('idsubject','=',$idsub)->where('term','=',$term)->where('academic_year','=',$year)->orderby('academic_year','DESC')->first();
         $ct1 =0; $ct2=0;
        if (isset($ct->ct2))  $ct1=$ct->ct2;
        if(isset($ct->ct4)) $ct2= $ct->ct4;

        $ct_given_mark = $ct1+ $ct2;

        $ct_conv_given_mark = ($ct_given_mark * $conv_mark) / $ct_total;

        //$mt_conv_given_mark = ((($ct_conv_given_mark + $mt) * $mcq_mark) / ($conv_mark+$mcq_mark));

        return ceil($ct_conv_given_mark);

    }


                    function is_type_exist($mark_conf, $type)
                     {
                     $mark_conf = MarksConfiguration::where('configuration_name','=',$mark_conf)->where('configuration_type','=',$type)->get();

                     return count($mark_conf);

                     }

                     function is_pass($mark_conf, $type, $mark)
                     {
                     $mark_conf = MarksConfiguration::where('configuration_name','=',$mark_conf)->where('configuration_type','=',$type)->first();
                     if($type == "CT" || $type == "RT")
                        $range = $mark_conf->total_marks;
                     else
                        $range =$mark_conf->converted_marks;

                        if($type == "LT")
                         $percent = 40;
                        else
                         $percent = 33;
                      $pass_limit = round(($range * $percent) / 100);
                      if($mark < $pass_limit)
                      return 0;
                      else
                      return 1;

                     }
                     $ht_chk =0;
                     $mcq_chk = 0;
                     $lab_chk =0;
                     //if(isset($results)) { echo $results; return  $results;} ?>
<!--
<font color=red><strong>Marks submission is currently unavailable here. Please be present in room no 107 within 10:00 AM to 5:00 PM for inserting and/or submit marks. Support team will guide you where you can save and submit marks smoothly. Thank you.</strong></font><br>- iTEAMS Support Team.<br> 

-->
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Mark Sheet</h3></strong></div><br/>

                            <div class="widget-header"></div>
                            <div class="widget-content">
                                {{Form::open(array('url'=>'/view_marksheet', 'class'=>'form-inline')) }}
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Select Year:</label>
                                        <select name="year" id="year" class="form-control">
                                            <option value="">Select Year</option>
                                            <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();?>
                                            @foreach($academic_year as $year)
                                                <option value="{{$year->academic_year}}">{{$year->academic_year}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Select Term:</label>
                                        <select name="term" id="term" class="form-control">
                                            <option value="">Select Term</option>
                                            <option value="Half Yearly">Half Yearly</option>
                                            <option value="Final">Final</option>
                                      

                                        </select>
                                    </div>
                                </div> @if(isset($course)){{$course}} @endif
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Select Class & Section:</label>
                                        <select name="cat" id="cat" class="form-control" >
                                            <option value="">Select Class</option>
                                            @foreach($class as $cats)
                                                <?php $classname12 = Addclass::where('class_id','=',$cats->idclasssection)->first();?>
                                                <option value="{{$cats->idclasssection}}">{{$classname12->class_name}} {{$classname12->section}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Select Subject:</label>
                                        <select name="subject" id="subject" class="form-control" >
                                            <option value="">Select Subject</option>
                                            @foreach($subjects as $subject)
                                                <option value="{{$subject->subject_name}}">{{$subject->subject_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="submit" value="search" id="catfhg" class="btn btn-info" style="width:80px;"><br>
                                    </div>
                                </div>

                                {{Form::close()}}

                                <div class="col-sm-10"> <br><br><br> </div>
                                <div class="table-responsive" style="padding-left:10%;padding-right:10%"> 
<?php $i=0; ?>

                                    @if(count($results) || count($conv_marks))
        <?php
                                    $sub = SubjectToClass::where('class','=','NINE')->where('idsubject','=','31')->pluck('markconfiguration_name');
                                    $cls_val = Addclass::where('class_name','=',$classname)->where('section','=',$sectionname)->pluck('value');

                                     ?>
<br>

            @if($cls_val > 8)

                                        <table cellspacing="" width="100%" border="0" style="border-collapse: collapse;float: none; overflow: hidden; ">

                                            <thead>

                                                <th><div></div></th> <th colspan="3"><div style="float: left; width: auto;">Class:&nbsp;{{$classname}}</div> <div style="float: left; width: auto; margin-left: 20%">Section:&nbsp;{{$sectionname}}</div><div style="float: right; width: auto; margin-left: 2%" >Term:&nbsp;{{$term}}</div> <br><br><div style="float: left; width: auto;" >Subject:&nbsp;{{$subjectname}}</div><div style="float: right; width: auto; margin-left: 2%" >Course Teacher:&nbsp;<a target="_blank" href="<?php echo'profile_individual/'.$cteacher->idteacherinfo;?>"> {{$cteacher->teacher_name}}</a></div>
                                                <br><br>
                                                 <div style="text-align: center; color:green">@if($cls_val > 8){{"<h3><b>*CT Creative and CT MCQ Marks are converted and added to Hall Test and MCQ Total respectively.<b></h3>"}}@endif</div>
                                                </th>

                                            </tr>
                                            </thead></table><br>

                                  <div class="wrap" style="width: 900px">
                                        <table class="">

                                        <thead style="background-color: lightgrey">
                                            <tr>
                                                <th style=" text-align: center;">Student Roll</th>
                                                <th style=" text-align: center; width:200px;">Student Name</th>


                                                <th style="text-align: center">
                                                    <table  style="text-align: center;border-collapse: collapse">
                                                        <tr style="text-align: center;">Creative</tr>

                                                        <tr style="width: 300px">
                                                            <td >CT</td><td >CQ</td><td style="width: auto">Total</td>

                                                        </tr>

                                                    </table>

                                                </th>

                                                <th style="text-align: center">
                                                    <table  style="text-align: center;border-collapse: collapse">
                                                        <tr style="text-align: center;">MCQ</tr>

                                                        <tr>
                                                            <td >CT</td><td>MCQ</td><td style="">Total</td>

                                                        </tr>

                                                    </table>

                                                </th>



                                                    <th style=" text-align: center;">Lab</th>


                                                    <th style=" text-align: center;">Total</th>




                                                <th style="text-align: center">Grade </th>
                                                <th style="text-align: center">Point</th>

                                            </tr>
                                        </thead>
</table>

                                      <div class="inner_table">

                                          <table>



                                              @foreach($conv_marks as $result)


                                                  <tr >


            <?php
                                                      $std = Studentinfo::where('idstudentinfo', '=', $result->st_id)->first();

                                                      ?>
                                                      <td style=" text-align: center;">{{$result->st_roll}}</td>
                                                      <td style=" width:200px;">{{$std->sutdent_name}}</td>

                                                          <td align="center">

                                                              <table  style="text-align: center;border-collapse: collapse">


                                                                  <tr>
                                                                      <td style="">{{$result->cq_ct}}</td><td style="">{{$result->cq_total}}</td><td style="">{{$result->cq_conv}}</td>

                                                                  </tr>
                                                              </table>

                                                          </td>






                                                          <td align="center">

                                                              <table  style="text-align: center;border-collapse: collapse">


                                                                  <tr>
                                                                      <td style="">{{$result->mcq_ct}}</td><td style="">{{$result->mcq_total}}</td><td style="">{{$result->mcq_conv}}</td>


                                                                  </tr>

                                                              </table>

                                                          </td>



                    <td style=" text-align: center;">{{$result->practical}}</td>



                    <td align="center">{{$result->total}}</td>





                <td style=" text-align: center;">{{$result->grade}}</td>
                <td style=" text-align: center;">{{$result->point}}</td>

                                                  </tr>
                                                  </a>



                                                  @endforeach


                                          </table>


                                          @else


                                              <table cellspacing="0" width="100%" border="0" style="border-collapse: collapse;float: none; overflow: hidden; ">

                                                  <thead>

                                                  <th><div></div></th> <th colspan="3"><div style="float: left; width: auto;">Class:&nbsp;{{$classname}}</div> <div style="float: left; width: auto; margin-left: 20%">Section:&nbsp;{{$sectionname}}</div><div style="float: right; width: auto; margin-left: 2%" >Term:&nbsp;{{$term}}</div> <br><br><div style="float: left; width: auto;" >Subject:&nbsp;{{$subjectname}}</div><div style="float: right; width: auto; margin-left: 2%" >Course Teacher:&nbsp;<a target="_blank" href="<?php echo'profile_individual/'.$cteacher->idteacherinfo;?>"> {{$cteacher->teacher_name}}</a></div></th>

                                                  </tr>
                                                  </thead></table><br>

                                              <div class="wrap" style="width: 960px">
                                                  <table class="head">

                                                      <thead>
                                                      <tr>
                                                          <th style=" text-align: center;">Student Roll</th>
                                                          <th style=" text-align: center; width:200px;">Student Name</th>


                                                        
                                                              <th style=" text-align: center;">Regular Assesment</th>
                                                        
                                                              <th style=" text-align: center;">Class Test</th>
                                                         
                                                              <th style=" text-align: center;">CQ (Hall Test)</th>
                                                        

                                                      
                                                              <th style=" text-align: center;">Lab</th>
                                                        
                                                              <th style=" text-align: center;">MCQ</th>
                                                         
                                                              <th style=" text-align: center;">Total</th>
                                                        

                                                          <th style="text-align: center"> Grade</th>
                                                          <th style="text-align: center">Point</th>

                                                      </tr>
                                                      </thead>

                                                  </table>

                                                  <div class="inner_table">

                                                      <table>

                                                          <?php $sum=0; $count=0; $cgpa=0; $total=0;

                                                          // $grade = GradingTable::where('total','=',);
                                                          //$res = TStudentResult
                                                          ?>

                                                          @foreach($results as $result)
                                                              <?php 
                                                              $total_marks = $result->total;
                                                              $rclass = $result->class;
                                                              $rht=0; $rct=0; $rrt=0; $rlt=0; $rmcq=0;
                                                              if($term == "Half Yearly")
                                                              {
                                                                  if($result->h_ra != null) $ra_marks = $result->h_ra; else $ra_marks =0;
                                                                  if($result->h_ct != null) $ct_marks = $result->h_ct; else $ct_marks =0;
                                                                  if($result->h_ht != null) $ht_marks = $result->h_ht; else $ht_marks =0;
                                                                  if($result->h_lab != null) $lab_marks = $result->h_lab; else $lab_marks =0;
                                                                  if($result->h_mcq != null) $mcq_marks = $result->h_mcq; else $mcq_marks =0;
                                                                  if($result->h_total != null) $total = $result->h_total; else $total =0;     $point = $result->h_gp;
                                                                  $grade = $result->h_grade;

                                                              }

                                                              if($term == "Final")
                                                              {
                                                                  if($result->f_ra != null) $ra_marks = $result->f_ra; else $ra_marks =0;
                                                                  if($result->f_ct != null) $ct_marks = $result->f_ct; else $ct_marks =0;
                                                                  if($result->f_ht != null) $ht_marks = $result->f_ht; else $ht_marks =0;
                                                                  if($result->f_lab != null) $lab_marks = $result->f_lab; else $lab_marks =0;
                                                                  if($result->f_mcq != null) $mcq_marks = $result->f_mcq; else $mcq_marks =0;
                                                                  if($result->f_total != null) $total = $result->f_total; else $total =0;
                                                                  $point = $result->f_gp;
                                                                  $grade = $result->f_grade;

                                                              }
                                                              //$total_get_marks = ($rht + $rct + $rrt + $rlt + $rmcq);
                                                            /*  $grade = GradingTable::where('total','=',$total_marks)->where('highest_range', '>=', $total)->where('lowest_range', '<=', $total)->first();
                                                              //echo $result->sutdent_name." : ".$grade."--".$total_get_marks."------->";
                                                              $cls=$result->Class;
                                                              $gp=$grade->grade;
                                                              $gpa=$grade->gpa;

                                                              if($cls != "Nine" && $cls!="Ten" )
                                                              {
                                                                  if($total < ($total_marks/2))
                                                                  {
                                                                      $gpa="0.00";
                                                                      $gp="F";

                                                                  }

                                                              }

                                                              */

                                                              ?>

                                                              <tr ><?php $std = Studentinfo::where('registration_id', '=', $result->st_id)->first();  if (count($std)==0) //return $result->st_id; ?> 
                                                                  <td style=" text-align: center;">{{$result->st_roll}}</td>
                                                                  <td style=" text-align: center; width:200px;">{{$std->sutdent_name}}</td>


                                                                      <td align="center">{{$ra_marks}}</td>


                                                                      <td align="center">{{$ct_marks}}</td>


                                                                      <td align="center">{{$ht_marks}}</td>


                                                                      <td align="center">{{$lab_marks}}</td>



                                                                      <td align="center">{{$mcq_marks}}</td>




                                                                  <td style=" text-align: center;">{{$total}}</td>





                                                                  <td style=" text-align: center;">{{$grade}}</td>
                                                                  <td style=" text-align: center;">{{$point}}</td>

                                                              </tr>
                                                              </a>



                                                              @endforeach


                                                      </table>

                                                      @endif




                                                  </div>





                                                  <br/><br/>

                                                  @if($cls_val > 8)
                                                      {{Form::open(['url'=>'pdf'])}}
                                                      {{Form::hidden('classname',$classname)}}
                                                      {{Form::hidden('sectionname',$sectionname)}}
                                                      {{Form::hidden('subjectname',$subjectname)}}
                                                      {{Form::hidden('term',$term)}}
                                                      {{Form::hidden('year',$year2)}}
                                                      {{Form::hidden('tec',$cteacher->teacher_name)}}
                                                      {{Form::hidden('rt',$rt)}}
                                                      {{Form::hidden('ct',$ct)}}
                                                      {{Form::hidden('lt',$lt)}}
                                                      {{Form::hidden('ht',$ht)}}
                                                      {{Form::hidden('mt',$mcq)}}

                                                      <center>
                                                          <br>
                                                          <button type="submit" class="btn btn-info" id="cat2fwf" style="width:220px;" ><i class="icon-download-alt"></i> Download as PDF</button>
                                                      </center>
                                                      </form>

                                                      <br/><br/>

                                                      @elseif($cls_val < 9)

                                                      {{Form::open(['url'=>'pdfcls08'])}}
                                                      {{Form::hidden('classname',$classname)}}
                                                      {{Form::hidden('sectionname',$sectionname)}}
                                                      {{Form::hidden('subjectname',$subjectname)}}
                                                      {{Form::hidden('term',$term)}}
                                                      {{Form::hidden('year',$year2)}}
                                                      {{Form::hidden('tec',$cteacher->teacher_name)}}
                                                      {{Form::hidden('rt',$rt)}}
                                                      {{Form::hidden('ct',$ct)}}
                                                      {{Form::hidden('lt',$lt)}}
                                                      {{Form::hidden('ht',$ht)}}
                                                      {{Form::hidden('mt',$mcq)}}


                                                      </form>

                                                      <br/><br/>

                                                      <div class="row">
                                                          <div class="col-sm-12" align="middle">
                                                              <a href="{{URL::to('/result_management/mark_sheet_mahbub/'.$year2.'/'.$term.'/'.$classname.'/'.$sectionname.'/'.$subjectname.'/')}}"><button type="button" class="btn btn-primary">Download As PDF</button></a>
                                                          </div>
                                                      </div>
                                                      <br/><br/><br/><br/>

                                                  @endif


                                                  @if($editable!=null && $editable->approved_by=="0")
                                                      {{Form::open(['url'=>'approved'])}}
                                                      {{Form::hidden('idcourseteacher',$editable->idcourseteacher)}}
                                                      {{Form::hidden('term',$term)}}
                                                      {{Form::hidden('year2',$year2)}}
                                                      {{Form::hidden('idsubject',$idsubject)}}
                                                      {{Form::hidden('tclass',$classname)}}
                                                      {{Form::hidden('tsection',$sectionname)}}

                                                      <center>
                                                         <input type="submit" class="btn btn-info" style="width:220px;" value="Approve" />
                                                      </center>
                                                      {{Form::close()}}

                                                      {{Form::open(['url'=>'req_change'])}}
                                                      {{Form::hidden('idcourseteacher',$editable->idcourseteacher)}}
                                                      {{Form::hidden('term',$term)}}
                                                      {{Form::hidden('year2',$year2)}}
                                                      {{Form::hidden('idsubject',$idsubject)}}
                                                      {{Form::hidden('tclass',$classname)}}
                                                      {{Form::hidden('tsection',$sectionname)}}

                                                      <center>
                                                          <input type="submit" class="btn btn-info" style="width:220px;" value="Request To Change/Edit" />
                                                      </center>
                                                      {{Form::close()}}

                                                  @endif

                                                  {{--Auth::user()->user_id.$is_course_teacher.$is_submit.$course_idcourseteacher.$idsubject--}}

                                                  @if($is_course_teacher && $is_submit)
                                                      {{Form::open(['url'=>'submitted'])}}

                                                      {{Form::hidden('term',$term)}}
                                                      {{Form::hidden('year2',$year2)}}
                                                      {{Form::hidden('idsubject',$idsubject)}}
                                                      {{Form::hidden('tclass',$classname)}}
                                                      {{Form::hidden('tsection',$sectionname)}}

                                                      <center>
                                                        <input type="submit" class="btn btn-info" style="width:220px;" value="Submit" /> 
                                                      </center>
                                                      {{Form::close()}}
                                                  @endif
                                                  @endif


                                              </div>

                                      </div>
                                      @if (isset($shohag_msg)){{"<div class='widget-header' style='text-align:center'>".$shohag_msg."</div>"}} @endif

{{--
                                      @if 

($results == "[]"){{"<div class='widget-header' style='text-align:center'><font color=red>Marks not inserted yet.</font></div>"}}

 @endif

--}}


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
        $("#cat").on('change', function (e) {
            console.log(e);
//document.write('hello');
            var cat_id = e.target.value;
// document.write(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/ajax22?cat_id=' + cat_id, function (data) {
//console.log(data);
                $('#subject').empty();
                $.each(data, function (index, subcatObj) {
                    $('#subject').append('<option value="' + subcatObj.subject_name + '">' + subcatObj.subject_name + '</option>');
                })

            });
        });


    </script>
@stop