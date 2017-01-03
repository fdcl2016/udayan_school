@extends('master.master')
@section('header')
@stop
@section('content')


    <?php
    $rasel = 1;
    include_once(app_path().'/views/nav_config/a_routine.php');
    ?>

    <div class="tab-content">
        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                        style="color:black">Create Routine</h3></strong></div><br/>
        <div class="fdcl_content_profile">
            <div class="widget-header">

                @if(Session::has('message'))

                    <h2 style="color:crimson ; font-weight: bold; text-align: center ">{{ Session::get('message') }}</h2>

                @endif
                <div class="widget-content">
                    {{ Form::open(array('url'=>'routine/create_routine', 'class'=>'form-inline')) }}
                    <div class="col-sm-12">
                        <div class="col-sm-3">
                            <label>Select Class:</label>
                            <select name="cat" id="cat" class="form-control">
                                <option value="">-&nbsp;Select Class&nbsp;-</option>
                                @foreach($class as $cats)
                                    <option value="{{$cats->class_name}}">{{$cats->class_name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-sm-3">
                            <label>Select Section:</label>
                            <select name="sub" id="sub" class="form-control" required>

                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Select Year:</label>
                            <select name="year" id="year" class="form-control" required>
                                <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();?>
                                @foreach($academic_year as $year)
                                    <option value="{{$year->academic_year}}">{{$year->academic_year}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-3">
                            <label>Select Shift:</label>
                            <select name="year1" id="year" class="form-control" >
                                <?php $academic_year = Shift::orderBy('shift', 'DESC')->get();?>
                                @foreach($academic_year as $year)
                                    <option value="{{$year->shift}}">{{$year->shift}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12"> <br/><br/></div>
                    <div class="col-sm-12">
                        <center>{{Form::submit('show',['class'=>'btn btn-info'])}}</center>
                    </div>
                    {{Form::close()}}



                </div>

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
//      document.write(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/ajax?cat_id=' +cat_id,function(data)
            {
//console.log(data);
                $('#sub').empty();
                $.each(data,function(index,subcatObj)
                {
                    $('#sub').append('<option value="'+subcatObj.section+'">'+subcatObj.section+'</option>');
                })

            });
        });
        i=0;

    </script>
@stop