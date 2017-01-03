@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Assignment Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">


                        <li class=""><a href="{{ URL::to('/assignment_management/teacher_give_assignment')}}">Assignment</a></li>
                        <li class="active"><a href="{{ URL::to('/assignment_management/view_assignment')}}">View Assignment</a></li>
                        

                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">View Assignment</h3></strong></div><br/>

                        <div class="span11">

                            <div class="widget ">

                                <div class="widget-header">
                                </div>
                                <!-- /widget-header -->

                                <div class="widget-content">

                                    {{Form::open(array('url'=>'view_assignment', 'class'=>'form-inline')) }}

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Select Year:</label>
                                                <?php
                                                $yr1 = AcademicYear::orderBy('academic_year','ASC')->get();  ?>
                                                <select name="yer"  class="form-control" >

                                                    <option value="">Select Year</option>
                                                    @foreach($yr1 as $year)
                                                        <option value="{{$year->academic_year}}">{{$year->academic_year}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="col-sm-2">
                                            <div class="form-group">

                                                <button type="submit" class="btn btn-info" id="cat2fwf" style="margin-top: 5px;"><i class="icon-search"></i> Search</button><br>
                                            </div>
                                        </div>
                                    </div>

                                    {{Form::close()}}
                                </div>

                                @if($yr!=null && $yr!="[]")
                                    <div class="widget-content">


                                        <table id="example" class="display" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th class="resource-name">Class</th>
                                                <th class="resource-name">Section</th>
                                                <th class="resource-name">Subject</th>
                                                <th class="resource-name">Assignment Topic</th>
                                                <th class="resource-name">Given By</th>
                                                <th class="resource-name">Given On</th>
                                               <!-- <th class="resource-link" style="width:11%"></th> -->

                                            </tr>
                                            </thead>

                                            <tbody>

                                        <?php
                                                $a = Assignment::where('year','=',$yr)->where('idteacherinfo','=',Auth::user()->user_id)->get();
                                               // $tech = Teacherinfo::where('idteacherinfo','=',$us)->pluck('')



                                        ?>
                                            @foreach($a as $sub)
                                                <tr>

                                                    <?php
                                                        $cl = Addclass::where('class_id','=',$sub->idclass)->first();

                                                    ?>

                                                    <td>{{$cl->class_name}} </td>
                                                    <td>{{$cl->section}} </td>
                                                    <td>{{$sub->assignment_subject}} </td>
                                                    <td>{{$sub->assignment_topic}} </td>
                                                    <td>{{Auth::user()->username}} </td>
                                                    <td>{{$sub->created_at}} </td>


                                                   

                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>



                                    </div>
                                    @endif

                                            <!-- /widget-content -->

                            </div>
                            <!-- /widget -->

                        </div>
                        <!-- /span8 -->


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

    {{ HTML::style('/media/css/jquery.dataTables.css') }}
    {{--{{ HTML::script('/media/js/jquery.js') }} --}}
    {{ HTML::script('/media/js/jquery.dataTables.js') }}

    <script type="text/javascript" language="javascript" class="init">


        $(document).ready( function() {
            $('#example').dataTable({
                "aaSorting": [[ 2, 'asc' ]],


            });
        });


    </script>
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