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
                        <li class="active">
                                                                      <a href="{{ URL::to('/result_management/st_report_card2')}}">Student Report Card</a>
                                           </li>

                    </ul>
                    <div class="tab-content">
                                           <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                                           style="color:black">Search Report Card</h3></strong></div><br/>

                                           {{ Form::open(array('url'=>'result_management/st_report_card2', 'class'=>'form-horizontal')) }}
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
                                                           <option value="{{$cats->class_name}}">{{$cats->class_name}} {{$cats->section}}</option>
                                                       @endforeach
                                                   </select>
                                                   </div>
                                               </div>

                                             

                                               <div class="control-group col-sm-5">
                                               <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-search"></i> Search</button>
                                               </div>
                                           </fieldset>



                                           {{Form::close()}}


                                       @if($students!="[]"&&$students!=null)

                            <div class="control-group col-sm-3">      </div>        <div class="control-group col-sm-3">
{{--                          
  <a href="{{ URL::to('/pdfall/'.$term12)}}" >
         <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-download"></i> Download All</button>
                            </a>
--}}

   <form action="{{ URL::to('reportcard_management/getfile/'.$sec)}}">
         <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-download"></i> Download All Student Report Card</button>
  </form>


</div>

                            <div class="fdcl_content_profile">
                                               <table id="example12" class="display" cellspacing="0" width="100%">
                                                   <thead>

                                                   </thead>

                                                   <tbody>


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