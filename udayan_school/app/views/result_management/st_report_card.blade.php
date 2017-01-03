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
                       <li class="active">
                         <a href="{{ URL::to('/result_management/st_report_card')}}">Student Report Card</a>
                       </li>
                        <li>
                            <a href="{{ URL::to('/result_management/admin_custom_report') }}">Custom Report</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                                           <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                                           style="color:black">Search Report Card</h3></strong></div><br/>

                                           {{ Form::open(array('url'=>'result_management/st_report_card', 'class'=>'form-horizontal')) }}
                                           <fieldset>
                                               <div class="control-group col-sm-5">
                                                   <label class="control-label">Select Year:</label>
                                                   <div class="controls">
                                                   <select name="year" id="year" class="form-control" required>
                                                       <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();?>
                                                       @foreach($academic_year as $year)
                                                           <option value="{{$year->academic_year}}">{{$year->academic_year}}</option>
                                                       @endforeach
                                                   </select>
                                                           </div>
                                               </div>

                                               <div class="control-group col-sm-5">
                                                   <label class="control-label" for="class_name">Select Term:</label>
                                                   <div class="controls">
                                                   <select name="term" id="term" class="form-control" required>
                                                       <option value="Half Yearly">Half Yearly</option>
                                                                                         <option value="Final">Final</option>
                                        <option value="first term">first term</option>
                                        <option value="second term">second term</option>
                                                   </select>
                                                   </div>
                                               </div>
                                               <div class="control-group col-sm-2"></div>
                                               <div class="control-group col-sm-5">
                                                   <label  class="control-label" for="class_name">Select Class:</label>
                                                   <div class="controls">
                                                   <select name="cat" id="cat" class="form-control" >
                                                       <option value="">-&nbsp;Select Class&nbsp;-</option>
                                                       @foreach($class as $cats)
                                                           <option value="{{$cats->class_name}}">{{$cats->class_name}}</option>
                                                       @endforeach
                                                   </select>
                                                   </div>
                                               </div>

                                               <div class="control-group col-sm-5">
                                                   <label  class="control-label" for="section_name">Select Section:</label>
                                                   <div class="controls">
                                                   <select name="sub" id="sub" class="form-control" >

                                                   </select>
                                                   </div>
                                               </div>

                                               <div class="control-group col-sm-12"> <div class="control-group col-sm-2"></div>   OR </div>

                                               <div class="control-group col-sm-5">
                                                   <label  class="control-label" for="student_id">Student ID:</label>
                                                   <div class="controls">
                                                       <input type="text" name="student_id">
                                                   </div>
                                               </div>
                                               <div class="control-group col-sm-5">
                                               <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-search"></i> Search</button>
                                               </div>
                                           </fieldset>



                                           {{Form::close()}}

                                       @if($students!="[]"&&$students!=null)
                                           <div class="fdcl_content_profile">
                                               <table id="example12" class="display" cellspacing="0" width="100%">
                                                   <thead>
                                                   <tr>
<th class="resource-name">Roll No.</th>
                                                       <th class="resource-name">Student Name</th>
                                                       <th class="resource-name">Class Name</th>
                                                       <th class="resource-name">Section Name</th>
                                                       <th class="resource-link" style="width:11%"></th>

                                                   </tr>
                                                   </thead>

                                                   <tbody>
                                                   @foreach($students as $sub)
                                                       <tr>
                                                       <?php 

$stname = Studentinfo::where('registration_id','=',$sub->st_id)->first();

$strol = StudentToSectionUpdate::where('student_idstudentinfo','=',$sub->st_id)->pluck('st_roll');

?>
<td>{{$strol}}</td>
                                                           <td>{{$stname->sutdent_name}} </td>
                                                           <?php  $classess = Addclass::where('class_id','=',$sub->idclasssection)->first(); ?>
                                                           @if($classess!="")
                                                           <td>{{$classess->class_name}} </td>
                                                           <td>{{$classess->section}} </td>
                                                           @else
                                                               <td></td>
                                                           <td></td>
                                                           @endif
                                                           <td><a href="{{ URL::to('/report12/'.$sub->st_id.'/'.$year12.'/'.$term12.'/'.$sub->idclasssection)}}" ><span><i class="icon-edit"></i></span></a></td>
                                                       </tr>

                                                   @endforeach
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
                       <!-- /widget-content -->

                       </div>
                       <!-- /widget -->

                       </div> <!-- /span8 -->

                   @stop
                   @section('content_footer')
                       <script>
                           $("#cat").on('change',function (e) {
                               console.log(e);

                               var cat_id = e.target.value;
                               cc = cat_id;
                               $.get('<?php echo Config::get('baseurl.url');?>/ajax?cat_id=' +cat_id,function(data)
                               {

                                   $('#sub').empty();
                   //                $('#sub').append('<option value="all">All Section</option>')
                                   $.each(data,function(index,subcatObj)
                                   {
                                       $('#sub').append('<option value="'+subcatObj.section+'">'+subcatObj.section+'</option>');
                                   })

                               });
                           });

                       </script>

                       {{ HTML::style('/media/css/jquery.dataTables.css') }}
                       {{--{{ HTML::script('/media/js/jquery.js') }}--}}
                       {{ HTML::script('/media/js/jquery.dataTables.js') }}

                       <script type="text/javascript" language="javascript" class="init">


                           $(document).ready(function() {
                               $('#example').dataTable( {
                                   "aoColumns": [
                                       { "orderSequence": [ "asc","desc" ] },
                                       { "orderSequence": [ "asc","desc" ] },
                                       { "orderSequence": [ "asc","desc" ] },
                                       null
                                   ]
                               } );
                           } );


                       </script>
                   @stop