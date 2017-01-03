@extends('master.master')
@section('header')
    <style type="text/css">
        #left_div {
            float: left;
            width: 50%;
        }
        #right_div {
            float: right;
            width: 50%;
        }
        tr,td,table{
            height:40px;

        }
    </style>
@stop
@section('content')


    <?php
    $rasel = 3;
    include(app_path().'/views/nav_config/a_subject_management.php');
    ?>

    <div class="tab-content">
        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                        style="color:black">Assign Subject To Teacher</h3></strong></div><br/>
        {{Form::open(array('url'=>'subject_management/post_assign_subject_to_teacher','class'=>'form-horizontal','files'=>'true'))}}

        <div class="fdcl_content_profile">
            <div style=""><div>
                    <div style="float: left;margin-left: 10%;">{{Form::label('Teacher Name')}}</div>
                    <div style="float: left;margin-left: 10%;padding-left: 10%">{{Form::label('Subject Name')}}</div>

                </div><br/><br/>
                <div>
                    <div style="float: left;">
                        <?php $teacher = TeacherInfo::lists('teacher_name','idteacherinfo');?>
                        {{ Form::select('teacher_name[]', $teacher,null,array('class'=>'form-control','style'=>'width:200px;float:left;'))}}
                    </div>

                    <div style="float: left;margin-left: 10%;">
                        <?php $subject = Subject::lists('subject_name','idsubject');?>
                        {{ Form::select('subject_name[]', $subject,null,array('class'=>'form-control','id'=>'country_id','onchange'=>'autocomplet()','style'=>'width:200px;float:left;'))}}
                        <ul id="country_list_id"></ul>
                    </div>

                    <?php $date =  date("Y"); ?>
                    {{ Form::hidden('date[]',$date)}}
                </div>
                <img style="margin-left: 5px;width: 35px;height: 35px;" type="image" src="{{ URL::asset('/image/addmore-button-png-hi.png')}}" onclick="addClass()" alt="Add Another Class" required>

                <div><br/></div>
                <div id="addclass"></div> </div>
            <br/>
            <div class="control-group col-sm-12">
                <div class="controls">
                    <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Save</button>
                </div>
            </div>
            {{Form::close()}}

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
    <script type="text/javascript">
        var i=1;
        function addClass()
        {
            if(i<=30)
            {
                i++;

                var div = document.createElement('div');
                div.innerHTML = '<div> <div style="float: left;"><?php $teacher = TeacherInfo::lists('teacher_name','idteacherinfo');?>'+
                        '{{ Form::select('teacher_name[]', $teacher,null,array('class'=>'form-control','style'=>'width:200px;float:left;'))}}'+
                        '</div> <div style="float: left;margin-left: 10%;"><?php $subject = Subject::lists('subject_name','idsubject');?>'+
                        '{{ Form::select('subject_name[]', $subject,null,array('class'=>'form-control','style'=>'width:200px;float:left;'))}}'+
                        '<?php $date =  date("Y"); ?>{{ Form::hidden('date[]',$date)}} </div> </div>'+
                        '<img style="margin-left: 5px;width: 35px;height: 35px;" type="image" src="../image/addmore-button-png-hi.png" onclick="addClass()" alt="Add Another Class" required>'+
                        '<img style="margin-left: 5px;width: 35px;height: 35px;" type="image" src="../image/remove.jpg" onclick="removemore(this)" alt="remove this class" style="margin-left: 5px;"/><div><br/></div>';
                document.getElementById('addclass').appendChild(div);
            }
        }
        function removemore(div)
        {
            document.getElementById('addclass').removeChild(div.parentNode);
            i--;
        }
    </script>
@stop