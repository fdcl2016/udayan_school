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

                          <li class="">
                            <a href="{{ URL::to('/result_management/student_result')}}">View Marks</a>
                        </li>

                        <li class="active">
                            <a href="{{ URL::to('/result_management/student_report_card')}}">View Report</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Search Report Card</h3></strong></div><br/>

                         <?php
                                $st_sess = Auth::user()->email;
                                //echo $st_sess;
                         $sts = StudentToSection::where('student_idstudentinfo', '=', $st_sess)->get();
                         foreach($sts as $s)
                         {
                            $years= $s->year;
                            $cls= $s->class;
                            $secs= $s->section;
                                         } ?>



                        {{ Form::open(array('url'=>'result_management/student_report_card', 'class'=>'form-horizontal')) }}


<!--
                        <fieldset>

                            <div class="control-group col-sm-5">
                                <label class="control-label">Select Year:</label>
                                <div class="controls">
                                    <input name="year" id="year" class="form-control" value="<?php echo $years; ?>" readonly />

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

                                    <input name="cat" id="cat" readonly value="<?php echo $cls; ?>" class="form-control" />


                                </div>
                            </div>


                            <div class="control-group col-sm-5">
                                <label  class="control-label" for="section_name">Select Section:</label>
                                <div class="controls">
                                <input name="sub" id="sub" class="form-control" value="<?php echo $secs; ?>" readonly />

                                </div>
                            </div>


                            <div class="control-group col-sm-3">
                            <Center>


                            <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-search"></i> Search</button>
                            

-->

</Center>
                            </div>




                        </fieldset>

                            <Center>

                               <br/><br/>
 <h3 style="color:red;text-align:center"> Online report card will be provided from next week </h3>


</Center>



                        {{Form::close()}}

                    @if($students!="[]"&&$students!=null && $pub > 0)
                        <div class="fdcl_content_profile">
                            <table border="1" cellspacing="0" width="100%" style="text-align: center">
                                <thead >
                                <tr>

                                    <th class="resource-name" style="text-align: center">Student Name</th>
                                    <th class="resource-name" style="text-align: center">Class Name</th>
                                    <th class="resource-name" style="text-align: center">Section Name</th>
                                    <th class="resource-link" style="width:11%; text-align: center">Action</th>

                                </tr>
                                </thead>

                                <tbody>
                               @foreach($students as $sub)


                                    <tr>

                                        <td>{{Auth::user()->username}} </td>
                                        <?php  $classess = Addclass::where('class_id','=',$sub->idclasssection)->first(); ?>
                                        @if($classess!="")
                                        <td>{{$classess->class_name}} </td>
                                        <td>{{$classess->section}} </td>
                                        @else
                                            <td></td>
                                        <td></td>
                                        @endif
                                    <td style="font-weight:bold"><a href="{{ URL::to('st_reportcard_management/getfile/'.Auth::user()->email.'/'.$year12.'/'.$term12)}}" >Click here</a></td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                            </div>
                    </div>


                     @endif
                          @if($students=="[]"&& $students==null || $pub < 1)
                    <div class="widget-header" style="text-align: center; color: red"></div>
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