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
    $rasel = 4;
    include(app_path().'/views/nav_config/a_subject_management.php');
    ?>



    <div class="tab-content">
        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                        style="color:black">Assign Subject To Class</h3></strong></div><br/>
        {{ Form::open(array('url'=>'subject_management/saveSubjectToClass')) }}
        <div class="fdcl_content_profile">
            <div>
                <div style="float: left;width: 20%">Class Name</div>
                <div style="float: left;width: 50%;" data-role="input-control">
                    <select type="text" name="class_name" class="form-control" required>
                        @foreach($classess as $cs)
                            <option value="{{$cs->class_name}}">{{$cs->class_name}}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div><br/><br/><br/></div>
            <div>
                <div style="float: left;width: 20%">Subject Name</div>
                <div style="float: left;width: 20%;"  data-role="input-control">
                    <select type="text" name="subject_name[]" class="form-control" required>
                        @foreach($subject as $s)
                            <option value="{{$s->idsubject}}">{{$s->subject_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div style="float: left;width: 20%;margin-left: 5%;">Configuration Name</div>
                <div style="float: left;width: 20%;"data-role="input-control">
                    <select type="text" name="conf_name[]"  class="form-control"  required>
                        @foreach($marks as $s)
                            <option value="{{$s->configuration_name}}">{{$s->configuration_name}}</option>
                        @endforeach
                    </select>
                </div>
                <img style="margin-left: 5px;width: 35px;height: 35px;" type="image" src="{{ URL::asset('/image/addmore-button-png-hi.png')}}" onclick="addClass()" alt="Add Another Class" required>
            </div>
            <div><br/></div>
            <div id="addclass"></div>
            <div class="control-group col-sm-12">
                <div class="controls">
                    <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Save</button>
                </div>
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
                div.innerHTML = '<div> <div style="float: left;width: 20%">Subject Name</div> <div style="float: left;width: 20%;"  data-role="input-control">'+
                        '<select type="text" name="subject_name[]" class="form-control" required> @foreach($subject as $s) <option value="{{$s->idsubject}}">{{$s->subject_name}}</option>@endforeach</select> </div>'+
                        '<div style="float: left;width: 20%;margin-left: 5%;">Configuration Name</div> <div style="float: left;width: 20%;" data-role="input-control">'+
                        '<select type="text" name="conf_name[]" class="form-control" required>@foreach($marks as $s) <option value="{{$s->configuration_name}}">{{$s->configuration_name}}</option>@endforeach</select></div></div>'+
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