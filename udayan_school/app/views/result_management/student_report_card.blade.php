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
                            $student_id = Auth::user()->email;
                            //echo $student_id;
                            $student_info = StudentToSectionUpdate::where('student_idstudentinfo', '=', $student_id)->get();
                            foreach($student_info as $s)
                            {
                                $years= $s->year;
                                $class= $s->class;
                                $section= $s->section;
                            } 
                        ?>



                        {{ Form::open(array('url'=>'result_management/student_report_card', 'class'=>'form-horizontal')) }}
                        <fieldset>

                            <div class="control-group col-sm-5">
                                <label class="control-label">Select Year:</label>
                                <div class="controls">
                                    <input name="year" id="year" class="form-control" value="<?php echo $years; ?>" readonly/>
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

                                    <input name="class" id="cat" value="<?php echo $class; ?>" class="form-control" readonly/>


                                </div>
                            </div>


                            <div class="control-group col-sm-5">
                                <label  class="control-label" for="section_name">Select Section:</label>
                                <div class="controls">
                                <input name="section" id="sub" class="form-control" value="<?php echo $section; ?>" readonly/>

                                </div>
                            </div>

                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <div class="control-group col-sm-12">
                                <Center>
                                    <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-download"></i> View Report</button>
                                </Center>
                            </div>
                        </fieldset>



                        {{Form::close()}}

                    <div class="widget-header" style="text-align: center; color: red">
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