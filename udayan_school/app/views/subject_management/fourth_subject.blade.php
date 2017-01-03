@extends('master.master')
@section('header')


@stop
@section('content')



    <?php
    $rasel = 8;
    include(app_path().'/views/nav_config/a_subject_management.php');
    ?>

                    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Assigning Fourth Subject </h3></strong></div>
                    <div id="stdregister_div"></div>


                    <div class="span11">

                        <div class="widget ">

                            <div class="widget-header">
                            </div>
                            <!-- /widget-header -->

                            <div class="widget-content">

                                {{Form::open(array('url'=>'/subject_management/fourth_subject', 'class'=>'form-inline')) }}

                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Select Class:</label>
                                            <?php
                                            $class = Addclass::orderBy('value','ASC')->groupBy('class_name')->get();  ?>
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

                                    <br>

                                    <div class="col-sm-2">
                                        <div class="form-group">

                                            <button type="submit" class="btn btn-info" id="cat2fwf" style="margin-top: 5px;"><i class="icon-search"></i> Search</button><br>
                                        </div>
                                    </div>
                                </div>

                                {{Form::close()}}
                            </div>

                            @if($class_data!=null && $class_data!="[]")
                             {{ Form::open(array('url'=>'/subject_management/assign_fs', 'class'=>'form-inline')) }}

                                <div class="widget-content">


                                    <table id="" class="display" border="1" cellspacing="0" width="100%">
                                        <thead style="background-color:orange">
                                        <tr>
                                            <th class="resource-name" style="text-align: center">Student Roll</th>
                                            <th class="resource-name" style="text-align: center">Student Name</th>
                                            <th class="resource-name" style="text-align: center">Class</th>
                                            <th class="resource-name" style="text-align: center">Section</th>

                                            <th class="resource-link" style="width:25% ;text-align: center">Select 4th Subject</th>

                                        </tr>
                                        </thead>

                                        <tbody style="background-color: cornsilk">


                                        @foreach($class_data as $sub)
 {{Form::hidden('idstudentinfo[]',$sub->std_reg_no)}}
                                            <tr>
                                                <td style="text-align: center">{{$sub->std_roll}} </td>
                                                <td style="text-align: center">{{$sub->std_name}} </td>
                                                <td style="text-align: center">{{$sub->std_class}} </td>
                                                <td style="text-align: center">{{$sub->std_section}} </td>

                                                <?php

                                        $clid = Addclass::where('section','=',$sub->std_section)->first();

                                            $fs = FourthSub::where('class_id','=',$clid->class_id)->where('type','=','F')->get()


                                                ?>


                                                <td style="text-align: center">


                                                    <?php

                                                  $bio = 7;
                                                  $math = 26;
                                                  $stat = 42;
                                                  $fin = 20;
 
                                                    //$sb = Subject::where('idsubject','=',$fs->idsubject)->first();
                                                    ?>
                                                

                                                    
                                         @foreach($fs as $f)
<?php $sb = Subject::where('idsubject','=',$f->idsubject)->pluck('subject_name'); ?>
                                         <input type="checkbox" name="fs[]" value="{{$f->idsubject}}"> {{$sb}}

                                         @endforeach
                                                
                                                </td>


                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
{{Form::hidden('clisd',$clsid)}}
{{ Form::hidden('yr',$year)}}




                                </div>
                                <br/>     <!-- /widget-content -->

                                <div class="col-sm-12"> <center><button type="submit" id="mybtn" class="btn btn-info center-block">Save</button></center></div>


                            @endif



                        </div>
{{Form::close()}}
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