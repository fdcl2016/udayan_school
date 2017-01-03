@extends('master.master')
@section('header')
@stop
@section('content')


    <?php
    $rasel = 1;
    include_once(app_path().'/views/nav_config/a_fees_management.php');
    ?>



    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                    style="color:black">Fees Configuration</h3></strong></div>
    <div class="fdcl_content_profile">
        {{Form::open(array('url'=>'/feesconfiguration', 'class'=>'form-horizontal','name'=>'myForm',
        'onsubmit'=>'return validateForm()')) }}





        <fieldset>

            <div class="control-group col-sm-5">
                <label class="control-label" for="subject_name">Fees Category:</label>
                <div class="controls">
                    <input id="fees_category1" type="text" name="fees_category1" placeholder="Enter Fees Category" class="form-control" style="width:160px" required>
                </div> <!-- /controls -->
            </div>

            <div class="control-group col-sm-5">
                <label class="control-label" for="subject_name">Fees Code:</label>
                <div class="controls">
                    <input id="fees_code1" type="text" name="fees_code1"class="form-control" placeholder="Enter Fees Code" style="width:160px" required>
                </div> <!-- /controls -->
            </div>


            <img style="width: 35px;height: 35px;" type="image" src="{{ URL::asset('/image/addmore-button-png-hi.png')}}" onclick="muFunction()" alt="Add Another Class" required>


            <div id="demo"></div><br>
            <div style="margin-left:38%">
                <button type="submit" class="btn btn-primary" id="button"><i class="icon-save"></i> Save</button>
            </div>

        </fieldset>
        {{Form::close()}}
    </div>




    <script type="text/javascript">
        var count=1;
        function muFunction(){
            count++;
            var text="";


            text +="<br><div class=\'control-group col-sm-5\'>";
            text +="<label class=\'control-label\' >Fees Category:</label>";
            text +="<div class=\'controls\'>";
            text +="<input id=\'fees_category"+count+"\' type=\'text\' name=\'fees_category"+count+"\'";
            text +="placeholder=\'Enter Fees category\' class=\'form-control\' style=\'width:160px\' required>";
            text +="</div>";
            text +="</div>";
            text +="<div class=\'control-group col-sm-5\'>";
            text +="<label class=\'control-label\'> Fees Code:</label>";
            text +="<div class=\'controls\'>";
            text +="<input id=\'fees_code"+count+"\' type=\'text\' name=\'fees_code"+count+"\'";
            text +="class=\'form-control\'";
            text +="placeholder=\'Enter Fees Code\' style=\'width:160px\' required>";
            text +="</div>";
            text +="</div>";
            text +="<img style=\'width: 35px;height: 35px;\' type=\'image\'";
            text +="src=\'../image/addmore-button-png-hi.png\' onclick=\'muFunction()\'";
            text +="alt=\'Add Another Class\' required>";
            text +="<img style=\'margin-left: 5px;width: 35px;height: 35px;\' type=\'image\'";
            text +="src=\'../image/remove.jpg\' onclick=\'removemore(this)\'";
            text +="alt=\'remove this class\' style=\'margin-left: 5px;\'/>";




            var div = document.createElement('div');
            div.innerHTML =text;
            document.getElementById('demo').appendChild(div);
        }

        function removemore(div)
        {
            document.getElementById('demo').removeChild(div.parentNode);
            count--;
        }

    </script>


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
@stop