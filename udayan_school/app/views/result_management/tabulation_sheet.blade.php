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
                            <a href="{{ URL::to('/tabulationsheet')}}">Mark Sheet</a>
                        </li>
 <li>
                            <a href="{{ URL::to('/onesubject_tabulationsheet')}}">Subject wise Tabulation Sheet</a>
                        </li>
<li>
                            <a href="{{ URL::to('/studentwise_tabulationsheet')}}">Student wise Tabulation Sheet</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/tabulationsheet_all')}}">Tabulation Sheet</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/final_tabulationsheet')}}">Final Tabulation Sheet</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/grace_management')}}">Grace Management</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/result_management/search_report_card')}}">Submission History</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/result_management/publish_result')}}">Publish Result</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/result_management/st_report_card')}}">Student Report Card</a>
                        </li>
                        <li>
                          <a href="{{ URL::to('/result_management/admin_custom_report') }}">Custom Report</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Mark Sheet</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
                            <div class="widget-header"></div>
                            <div class="widget-content">
                                {{Form::open(array('url'=>'/tabulationsheet', 'class'=>'form-inline')) }}
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Select Year: </label>
                                    <select name="year" id="year" class="form-control">
                                        <option value="">Select Year </option>
                                        <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();?>
                                        @foreach($academic_year as $year)
                                            <option value="{{$year->academic_year}}">{{$year->academic_year}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                    </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Select Term:</label>
                                    <select name="term" id="term" class="form-control">
                                        <option value="Half Yearly">Half Yearly</option>
                                        <option value="Final">Final</option>
                                        <option value="first term">first term</option>
                                        <option value="second term">second term</option>
                                    </select>
                                </div>
                                    </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Select Class:</label>
                                    <select name="cat" id="cat" class="form-control" >
                                        <option value="">Select Class</option>
                                        @foreach($class as $cats)
                                            <option value="{{$cats->class_name}}">{{$cats->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                    <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Select Section:</label>
                                    <select name="sub" id="sub"  class="form-control">

                                    </select>
                                </div>
                                    </div>
                                        <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Select Subject:</label>
                                    <select name="subject" id="subject" class="form-control" >
                                        <option value="">Select Subject</option>
                                       
                                    </select>
                                </div>
                                        </div>
                                <div class="col-sm-10">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-search"></i> Search</button><br>
                                </div>
                                </div>

                                {{Form::close()}}

                                <div class="col-sm-10"> <br><br><br> </div>
                                <div class="table-responsive" style="padding-left:10%;padding-right:10%">
                                    @if($results!=null && $results!="[]")

                                        <table cellspacing="0" width="100%" border="0" style="border-collapse: collapse;float: none; overflow: hidden; ">

                                            <thead>

                                                <th><div></div></th> <th colspan="3"><div style="float: left; width: auto;">Class:&nbsp;{{$classname}}</div> <div style="float: left; width: auto; margin-left: 20%">Section:&nbsp;{{$sectionname}}</div><div style="float: right; width: auto; margin-left: 2%" >Term:&nbsp;{{$term}}</div> <br><br><div style="float: left; width: auto;" >Subject:&nbsp;{{$subjectname}}</div><div style="float: right; width: auto; margin-left: 2%" >Course Teacher:&nbsp;<a target="_blank" href="<?php echo'profile_individual/'.$cteacher->idteacherinfo;?>"> {{$cteacher->teacher_name}}</a></div>

  <?php $tech = $cteacher->teacher_name; ?>
</th>

                                            </tr>
                                            </thead></table><br>

                                  <div class="wrap" style="width: 760px">
                                        <table class="head">

                                        <thead>
                                            <tr>
                                                <th style=" text-align: center;">Student Roll</th>
                                                <th style=" text-align: center; width:200px;">Student Name</th>

                                                
                                                @if($rt==1)
                                                    <th style=" text-align: center;">Regular Assesment</th>
                                                @endif
                                                @if($ct==1)
                                                    <th style=" text-align: center;">Class Test</th>
                                                @endif
                                                @if($lt==1)
                                                    <th style=" text-align: center;">Lab</th>
                                                @endif
                                                @if($mcq==1)
                                                    <th style=" text-align: center;">MCQ</th>
                                                @endif
                                                @if($ht==1)
                                                    <th style=" text-align: center;">Hall Test</th>
                                                @endif


                                                @if($ht==1)
                                                    <th style=" text-align: center;">Total</th>
                                                @endif

                                                <th style="text-align: center"> Grade</th>
                                                <th style="text-align: center"> Point</th>

                                            </tr>
                                        </thead>

                                            </table>

                                            <div class="inner_table">

                                                <table>

                                           <?php $sum=0; $count=0; $cgpa=0; $total=0;

                                               // $grade = GradingTable::where('total','=',);
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
                                                        if($result->h_total != null) $total = $result->h_total; else $total =0;
                                                        $point = $result->h_gp;
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
                                            $grade = GradingTable::where('total','=',$total_marks)->where('highest_range', '>=', $total)->where('lowest_range', '<=', $total)->first();
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

                                             ?>

                                                <tr ><?php $std = Studentinfo::where('idstudentinfo', '=', $result->st_id)->first(); ?>
                                                    <td style=" text-align: center;">{{$std->student_roll}}</td>
                                                    <td style="  width:200px;">{{$std->sutdent_name}}</td>
                                                   
                                                    @if($rt==1)
                                                        <td align="center">{{$ra_marks}}</td>

                                                    @endif
                                                    @if($ct==1)
                                                        <td align="center">{{$ct_marks}}</td>

                                                    @endif
                                                    @if($lt==1)
                                                        <td align="center">{{$lab_marks}}</td>

                                                    @endif
                                                    @if($mcq==1)
                                                        <td align="center">{{$mcq_marks}}</td>

                                                    @endif
                                                   @if($ht==1)
                                                        <td align="center">{{$ht_marks}}</td>

                                                    @endif
                                                    @if($ht==1)
                                                        <td style=" text-align: center;">{{$total}}</td>

                                                    @endif

                                                    <?php //$sum=$total_get_marks+$sum ?>


                                                    <td style=" text-align: center;">{{$gp}}</td>
                                                    <td style=" text-align: center;">{{$gpa}}</td>

                                                </tr>
                                                </a>



                                            @endforeach


                                        </table>
                                   </div></div>
                                        <br/><br/>
                                        {{Form::open(['url'=>'pdf'])}}
                                        {{Form::hidden('classname',$classname)}}
                                        {{Form::hidden('sectionname',$sectionname)}}
                                        {{Form::hidden('subjectname',$subjectname)}}
                                        {{Form::hidden('term',$term)}}
                                        {{Form::hidden('year',$year2)}}
                                        {{Form::hidden('tec',$tech)}}
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
                                 
                                    @endif

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
    <script>
        $("#cat").on('change', function (e) {
            console.log(e);
//document.write('hello');
            var cat_id = e.target.value;
// document.write(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/ajax5?cat_id=' + cat_id, function (data) {
//console.log(data);
                $('#sub').empty();
                $('#sub').append('<option value="">Select Section</option>');
                $.each(data, function (index, subcatObj) {
                    $('#sub').append('<option value="' + subcatObj.section + '">' + subcatObj.section + '</option>');
                })

            });
        });

             $("#sub").on('change', function (e) {
            console.log(e);
//document.write('hello');
            var section = e.target.value;
            var classs=document.getElementById('cat').value;
//document.write(section);
             $.get('<?php echo Config::get('baseurl.url');?>/classsectionsubjectss?section=' + section, 'classs='+classs, function (data) {

                $('#subject').empty();
                $.each(data, function (index, subcatObj) {

                    $('#subject').append('<option value="' + subcatObj.subject_name + '">' + subcatObj.subject_name + '</option>');
                })

            });
        });


        i = 0;

    </script>
@stop