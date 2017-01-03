@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">
            <?php
                if(isset($msg)) {
                    echo $msg;
                }
            ?>
            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Result Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                      <li class="active">
                            <a href="{{ URL::to('/result_management/teacher_result_insert')}}">Insert Marks</a>
                        </li>
                        <li>
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

                        <!-- if class teacher show tab -->
                        <?php 
                          $class_teacher = ClassTeacher::where('idteacherinfo', Auth::user()->user_id)->first(); 
                        ?>
                        @if(!empty($class_teacher))
                        <li>
                          <a href="{{ URL::to('/result_management/custom_report') }}">Custom Report</a>
                        </li>
                        @endif

                    </ul>
                    <div class="tab-content">

<!--
<font color=red><strong>Insert Marks is temporarily unavailable. This will be available after 9.00 PM tonight. Thank you.</strong></font><br>- iTEAMS Support Team.<br>

-->

<!--
<font color=red><strong>Attention! Please select year "2015-2016" while inserting marks for class <i>twelve</i>.</strong></font><br/><br/>- iTEAMS Support Team.<br/><br/>
                        -->


 <center><font color=red><strong> (i) Attention! Please check the term and year before inserting marks </br></br>(ii)  Please hit generate marksheet button after completing all types of marks </br></br>(iii) Please select year "2015-2016" while inserting marks for class <i>twelve</i>.<br/>
.</strong></font><br/><br/>- iTEAMS Support Team.<br/><br/></center>





 <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Marks Insert</br></h3></strong></div><br/>

                        {{ Form::open(array('url'=>'result_management/teacher_result_insert', 'class'=>'form-inline')) }}






 <div class="control-group col-sm-3">
                            <label>Select Year:</label>

                            <select name="year" id="year" class="form-control" required>
                                <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();?>
                                @foreach($academic_year as $year1)
                                    <option value="{{$year1->academic_year}}">{{$year1->academic_year}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="control-group col-sm-3">
                            <label>Select Term:</label>

                            <select name="term" id="term" class="form-control" required>
                                <option value="Half Yearly">Half yearly</option>
                                <option value="Final">Final</option>
                             <!--  <option value="Half Yearly">First Term</option>
                                <option value="Final">Second Term</option> -->

                            </select>

                        </div>
                        <div class="col-sm-3"> <div class="form-group">
                                <label>Select Class & Section:</label>
                                <select name="cat" id="cat" class="form-control">
                                    <option value="">.....</option>
                                    @foreach($courseteacher as $cats)
                                        <?php $class = Addclass::where('class_id','=',$cats->idclasssection)->first();

                                        ?>
                                        <option value="{{$class->class_id}}">{{$class->class_name}} {{$class->section}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Select Subject:</label>
                                <select name="sub" id="sub" class="form-control" required>

                                </select>
                            </div>
                        </div>




 <div class="col-sm-12">
   <div class="col-sm-3">
     <div class="col-sm-6">
       <input type="submit" class="btn btn-info"value="insert mark">
     </div>
     @if(isset($classnm))

       <div class="col-sm-6">
         <!-- $subject == idcourseteacher of courseteach table -->

           

         <a href="{{ URL::to('/result_management/prepare_marksheet/'.$term.'/'.$year.'/'.$classnm.'/'.$clssec.'/'.$subject.'/') }}" ><button type="button" class="btn btn-info">Generate Marksheet</button></a>


       </div>
     @endif
   </div>
 </div>




                        {{Form::close()}}
<br><br>
                        @if($course!=null&&$subject!=null&&$year!=null)
                        <br>

<?php

      $crsub = CourseTeacher::where('idcourseteacher',$subject)->first();
      $class_num = Addclass::where('class_id', $crsub->idclasssection)->pluck('value');

                                                $su =$crsub->idsubject;

         $subname = Subject::where('idsubject',$su)->pluck('subject_name');

 ?>

                            <div id="addclass"><br>
                           <center> <div>
                            </div></center>
                                <div class="table-responsive" style="padding-left:15%;padding-right:15%"><br>
                               <b>Class : {{$classnm}} &nbsp;&nbsp;&nbsp;
                               Section : {{$clssec}} &nbsp;&nbsp;&nbsp;
                               Subject : {{$subname}} &nbsp;&nbsp;&nbsp;
                               Term : {{$term}}&nbsp;&nbsp;&nbsp;
Year: {{$year}}</b><br>
                                  <br>  <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th class="resource-name">Exam Name</th>
                                            <th class="resource-link" style="width:11%">Edit</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $rt = "RT";
                                        $ht = "HT";
                                        $ct = "CT";
                                        $lt = "LT";
                                        $mt = "MT";


                        $crs = CourseTeacher::where('idcourseteacher',$subject)->first();

                                                $subject =$crs->idsubject;


                                                //echo $subject; return 0;

                                        $sub_to_class = SubjectToClass::where('idsubject','=',$subject)->where('class','=',$classnm)->first();



//echo $classnm;

//return 0;



                                        $reg_ass = MarksConfiguration::where('configuration_name','=',$sub_to_class->markconfiguration_name)->where('configuration_type','=',$rt)->first();
                                        $hall_te = MarksConfiguration::where('configuration_name','=',$sub_to_class->markconfiguration_name)->where('configuration_type','=',$ht)->first();
                                        $class_te = MarksConfiguration::where('configuration_name','=',$sub_to_class->markconfiguration_name)->where('configuration_type','=',$ct)->first();
                                        $lab_te = MarksConfiguration::where('configuration_name','=',$sub_to_class->markconfiguration_name)->where('configuration_type','=',$lt)->first();
                                        $mcq_te = MarksConfiguration::where('configuration_name','=',$sub_to_class->markconfiguration_name)->where('configuration_type','=',$mt)->first();
                                       ?>





                                       @if(count($reg_ass) && !(($class_num == 5 || $class_num == 8 || $class_num == 10) && (strtolower($term) == 'final')))
                                            <tr>
                                                <td>Regular Assessment</td>
                                                <td>

                                                @if($countedit==0)
                                                    <a href="{{URL::to('/regular_assesment/'.$course.'/'.$rt.'/'.$subject.'/'.$year.'/'.$term.'/'.$clssec.'/'.$crs->idcourseteacher.'/')}}" target="_blank" class="btn btn-primary"><span><i class="icon-edit"></i></span>
                                                    </a>
                                                @else {{"Submitted"}}
                                                @endif
                                                </td>
                                            </tr>
                                        @endif
                                        @if(count($class_te) && !(($class_num == 5 || $class_num == 8 || $class_num == 10) && (strtolower($term) == 'final')))
                                            <tr>
                                                <td>Class Test</td>
                                                <td>
                                                @if($countedit==0)
                                                    <a href="{{URL::to('/regular_assesment/'.$course.'/'.$ct.'/'.$subject.'/'.$year.'/'.$term.'/'.$clssec.'/'.$crs->idcourseteacher.'/')}}" target="_blank" class="btn btn-primary"><span><i class="icon-edit"></i></span>
                                                    </a>
                                                 @else {{"Submitted"}}
                                                 @endif
                                                </td>
                                            </tr>
                                        @endif
                                        @if(count($hall_te))
                                            <tr>
                                                <td>Hall Test</td>
                                                <td>
                                                @if($countedit==0)
                                                    <a href="{{URL::to('/regular_assesment/'.$course.'/'.$ht.'/'.$subject.'/'.$year.'/'.$term.'/'.$clssec.'/'.$crs->idcourseteacher.'/')}}" target="_blank" class="btn btn-primary"><span><i class="icon-edit"></i></span>
                                                    </a>
                                                    @else {{"Submitted"}}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif





                                        @if(count($lab_te))
                                            <tr>
                                                <td>Lab Test</td>
                                                <td>
                                                @if($countedit==0)
                                                    <a  href="{{URL::to('/regular_assesment/'.$course.'/'.$lt.'/'.$subject.'/'.$year.'/'.$term.'/'.$clssec.'/'.$crs->idcourseteacher.'/')}}" target="_blank" class="btn btn-primary"><span><i class="icon-edit"></i></span>
                                                    </a>
                                                    @else {{"Submitted"}}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                        @if(count($mcq_te))
                                            <tr>
                                                <td>MCQ test</td>
                                                <td>
                                                @if($countedit==0)
                                                    <a href="{{URL::to('/regular_assesment/'.$course.'/'.$mt.'/'.$subject.'/'.$year.'/'.$term.'/'.$clssec.'/'.$crs->idcourseteacher.'/')}}" target="_blank" class="btn btn-primary"><span><i class="icon-edit"></i></span>
                                                    </a>
                                                    @else {{"Submitted"}}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
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
    <script>
        $("#cat").on('change',function (e) {
            console.log(e);
            //document.write('hello');
            var cat_id = e.target.value;
            data = cat_id;
            // document.write(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/ajaxresult?cat_id=' +cat_id,function(data)
            {
                //console.log(data);
                $('#sub').empty();
                $.each(data,function(index,subcatObj)
                {
                    $('#sub').append('<option value="'+subcatObj.idcourseteacher+'">'+subcatObj.subject_name+'</option>');
                })

            });
        });

        function myFunction()
        {
            var div= document.createElement('div');
            var rt = "RT";
            var ht = "HT";
            var ct = "CT";
            var lt = "LT";
            var mt = "MT";
            div.innerHTML = '<div class="table-responsive" style="padding-left:15%;padding-right:15%">'+
            '<table class="table table-bordered table-striped"> <thead> <tr> <th class="resource-name">Exam Name</th>'+
            '<th class="resource-link" style="width:11%">Edit</th> </tr></thead>'+
            '<tbody> <tr> <td>Regular Assessment</td> <td><a href="/regular_assesment/'+data+'/'+rt+'/" target="_blank" class="btn btn-primary"><span><img src="/image/edit.svg" style="height:20px;width: 50px;"></span></a></td></tr>'+
            '<tr> <td>Class Test</td> <td><a href="/regular_assesment/'+data+'/'+ct+'/" target="_blank" class="btn btn-primary"><span><img src="/image/edit.svg" style="height:20px;width: 50px;"></span></a></td></tr>'+
            '<tr> <td>Hall Test</td> <td><a href="/regular_assesment/'+data+'/'+ht+'/" target="_blank" class="btn btn-primary"><span><img src="/image/edit.svg" style="height:20px;width: 50px;"></span></a></td></tr>'+
            '<tr> <td>Lab Test</td> <td><a href="/regular_assesment/'+data+'/'+lt+'/" target="_blank" class="btn btn-primary"><span><img src="/image/edit.svg" style="height:20px;width: 50px;"></span></a></td></tr>'+
            '<tr> <td>MCQ test</td> <td><a href="/regular_assesment/'+data+'/'+mt+'/" target="_blank" class="btn btn-primary"><span><img src="/image/edit.svg" style="height:20px;width: 50px;"></span></a></td></tr>'+
            '</tbody> </table> </div>';
            document.getElementById('addclass').appendChild(div);
        }

    </script>
@stop
