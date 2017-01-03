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
            $rasel = 1;
    include(app_path().'/views/nav_config/a_subject_management.php');
    ?>

    <div class="tab-content">
        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                        style="color:black">Create Subject</h3></strong></div><br/>
        {{Form::open(array('url'=>'subject_management/post_create_subject','class'=>'form-horizontal','files'=>'true'))}}
        <fieldset>

            <div class="control-group col-sm-8">
                <label class="control-label" for="subject_name">Subject Name</label>
                <div class="controls">
                    <input type="text" class="span6" name="subject_name[]" required>
                </div> <!-- /controls -->
            </div> <!-- /control-group -->
            <img style="width: 35px;height: 35px;" type="image" src="{{ URL::asset('/image/addmore-button-png-hi.png')}}" onclick="addClass()" alt="Add Another Class">
            <br/><br/><div id="addclass"></div>
            <br /><br />
            <div class="control-group col-sm-12">
                <div class="controls">
                    <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Save</button>
                </div>

            </div>
        </fieldset>

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
                div.innerHTML = '<div class="control-group col-sm-8"> <label class="control-label" for="subject_name">Subject Name</label>'+
                        '<div class="controls"> <input type="text" class="span6" name="subject_name[]" required></div> </div>' +
                        '<img style="width: 35px;height: 35px;" type="image" src="../image/addmore-button-png-hi.png" onclick="addClass()" alt="Add Another Class">'+
                        '<img style="margin-left: 5px;width: 35px;height: 35px;" type="image" src="../image/remove.jpg" onclick="removemore(this)" alt="remove this class" style="margin-left: 5px;"/><br/><br/>';
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