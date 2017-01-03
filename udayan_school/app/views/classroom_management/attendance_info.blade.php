@extends('master.master')
@section('header')
@stop
@section('content')

            <?php
            $rasel = 3;
            include_once(app_path().'/views/nav_config/a_classroom_management.php');
            ?>
                    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Attendance Book</h3></strong></div>
                    <div id="stdregister_div"></div>


                            </div> <!-- /widget-header -->

                            <div class="widget-content">

                                {{Form::open(array('url'=>'classroom_management/attendance_info', 'class'=>'form-inline')) }}
                           <?php

                                $class = Addclass::groupby('class_name')->orderBy('value','ASC')->get();
                                ?>

                                <fieldset>

                                    <div class="control-group col-sm-4">
                                        <label for="class_name">Select Class:</label>
                                        <select name="cat" id="cat" onchange="abc();" class="form-control">
                                            <option value="">-&nbsp;Select Class&nbsp;-</option>
                                            @foreach($class as $cats)
                                                <option value="{{$cats->class_name}}">{{$cats->class_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="control-group col-sm-4">
                                        <label for="section_name">Select Section:</label>

                                        <select name="sub" id="sub" class="form-control" required>

                                        </select>

                                    </div>
                          <?php
                                        $sb = SubjectToClass::where('class','=','ELEVEN ')->orwhere('class','=','TWELVE')->get();



                                    ?>
                                    <div class="control-group col-sm-4" id="subj">
                                        <label for="section_name">Select Subject:</label>

                                        <select name="subj"  class="form-control" id="sub1">
                                        @foreach($sb as $s)

                                            <?php $subj = Subject::where('idsubject','=',$s->idsubject)->first(); ?>
                                                <option value="{{$subj->idsubject}}">{{$subj->subject_name}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="control-group col-sm-12"><br/></div>
                                    <div class="control-group col-sm-12">
                                        <center>
                                            <input type="submit" class="btn btn-info"  value="Take Attendance">

                                        </center>
                                    </div>
                                </fieldset>


                               <!-- /span8 -->


                   <!-- /widget-content -->

                    {{Form::close()}}


                    <!-- /span8 -->

            @if($student!=null)
                {{ Form::open(array('url'=>'classroom_management/attendance_info2', 'class'=>'form-inline')) }}

                <div class="col-sm-12">

                    <b>Class : </b> {{ $class_name }} &nbsp;&nbsp;<b>Section :</b> {{ $section }}


                </div>

                <div class="col-sm-12">
                    <br/><br/>
                    <div>Today's Date</div>
                    <div class="input-control">
                        <input type="text" id="popupDatepicker" name="date" placeholder="pick a date" required>
                    </div>
                </div>
                <div class="col-sm-12"><br/><br/></div><br>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="resource-name">Student Roll</th>
                        <th class="resource-name">Student Name</th>
                        <th class="resource-name" style="width: 10px;">Attendance</th>

                    </tr>
                    </thead>
                    <tbody>
                    {{Form::hidden('section',$section)}}
                    {{Form::hidden('class',$class_name)}}
                    {{Form::hidden('subject',$subject)}}

                    <?php $count=0;?>
                    @foreach ($student as $mark)
                        {{Form::hidden('idstudentinfo[]',$mark->student_idstudentinfo)}}
                        <?php $st = Studentinfo::where('idstudentinfo','=',$mark->student_idstudentinfo)->first();

                        $roll = StudentToSectionUpdate::where('student_idstudentinfo','=',$mark->student_idstudentinfo)->orderBy('st_roll')->pluck('st_roll');
                        ?>
                        <tr>
                            <td>{{$roll}}</td>
                            <td>{{$st->sutdent_name}}</td>
                            <td style="width: 10px;"><input type="checkbox" name="day{{$count++}}" value="1" style="width: 30px;height: 30px;" checked></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                </div>
                <div class="col-sm-12"> <center><button type="submit" id="mybtn" class="btn btn-info center-block">Save</button></center></div>


                @endif
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

            </div> <!-- /widget -->

            </div>



    </div>
    <!-- /widget -->

    </div> <!-- /span8 -->

@stop
@section('content_footer')

<script type="text/javascript">

    window.onload = function() {


        document.getElementById('subj').style.display = 'none';

    };

    function abc(){
        var e = document.getElementById("cat");
        var strUser = e.value;

        if (strUser == 'ELEVEN' || strUser == 'TWELVE') {
            document.getElementById('subj').style.display = 'block';
        }else{
            document.getElementById('subj').style.display = 'none';
        }

    }
    </script>

    <script>



        $("#cat").on('change',function (e) {
            console.log(e);
//document.write('hello');
            var cat_id = e.target.value;
// document.write(cat_id);
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
    </script>

<link href="{{ URL::asset('date/jquery.datepick.css')}}" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{ URL::asset('date/jquery.plugin.js')}}"></script>
<script src="{{ URL::asset('date/jquery.datepick.js')}}"></script>
<script>
    $(function() {
        $('#popupDatepicker').datepick();
    });
</script>
@stop