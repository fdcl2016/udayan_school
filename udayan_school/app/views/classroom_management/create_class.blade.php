@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>ClassRoom Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="{{ URL::to('/classroom_management/create_class')}}">Create Class</a>
                        </li>
                        <li><a href="{{ URL::to('/classroom_management/edit_class')}}">Edit Class</a></li>
                        <li><a href="{{ URL::to('/classroom_management/assign_teacher_to_section')}}">Assign Course Teacher</a></li>
                        <li><a href="{{ URL::to('/classroom_management/assign_class_teacher')}}">Assign Class Teacher</a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Create Class</h3></strong></div><br/>

                                {{ Form::open(array('url'=>'classroom_management/post_create_class', 'class'=>'form-horizontal')) }}
                                <fieldset>
                                <div class="control-group col-sm-5">
                                    <label class="control-label" for="subject_name">Class Name:</label>
                                    <div class="controls">
                                        <input type="text" class="span3" name="class_name" placeholder="Enter Class name" required>
                                    </div> <!-- /controls -->
                                </div>
                                <div class="control-group col-sm-5">
                                    <label class="control-label" for="subject_name">Section no:</label>
                                    <div class="controls">
                                        <input type="text" class="span3" name="section_amount" id="sec_no" placeholder="Enter Number of section" required>
                                    </div> <!-- /controls -->
                                </div>
                                <input  onclick="addmore();return false;" type="image" src="{{ URL::asset('/image/addmore-button-png-hi.png')}}" style="width: 35px;height: 35px;">
                                    <br/><br/><div id="addmore" class="fdcl_content_profile"> </div>
                                </fieldset>
                                {{Form::close()}}

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
        var count=2;
        var sec=0;
        var section_number_id=0;
        var section_number=0;
        var section_serial=0;


        function addmore()
        {
            counter=0;
            var no = document.getElementById("sec_no").value;

            text3 = "";
            text4="";
            var j;
            if(counter==0) {
                text4 = "<br/><br/><div class='col-sm-12'> <button type='submit' class='btn btn-primary' id='button'><i class='icon-save'></i> Save</button></div></div>";
                counter=20;
            }
            else
            {
                text4 = "";
            }
            for (j = 0; j <no; j++) {

                section_serial++;
                var sec=j+1;
                if(j==0) {
                    text3 += "<div class='widget-header' ></div> <div class='widget-content'><div class=\'control-group col-sm-5\'><label style=\'padding-right: 20px;\'>Section  name:</label><input class=\'form-control\'  placeholder=\'Enter Section Name\' id=\'go\' type=\'text\' name=\'section" + section_serial + "\' required></div>";
                    text3 += "<div class=\'control-group col-sm-5\'><label style=\'padding-right: 20px;\'>Shift:</label> <select  class=\'form-control\' name=\'shift" + section_serial + "\' required>";
                    text3 += "<option value=\'Morning\'>Morning</option>";
                    text3 += "<option value=\'Day\'>Day</option>";
                    text3 += "<option value=\'Evening\'>Evening</option>";
                    text3 += "</select></div><br><br>";

                }
                else {
                    text3 += "<div class=\'control-group col-sm-5\'><input class=\'form-control\'  placeholder=\'Enter Section Name\' id=\'go\' type=\'text\' name=\'section" + section_serial + "\' required></div>";
                    text3 += "<div class=\'control-group col-sm-5\'> <select class=\'form-control\' name=\'shift" + section_serial + "\' required>";
                    text3 += "<option value=\'Morning\'>Morning</option>";
                    text3 += "<option value=\'Day\'>Day</option>";
                    text3 += "<option value=\'Evening\'>Evening</option>";
                    text3 += "</select></div><br><br>";

                }



            }
            text3 +=text4;
            no=1;
            // var div = document.createElement('div');
            document.getElementById('addmore').innerHTML =text3;

            // no=1;
            // var div = document.createElement('div');
            // div.innerHTML =text3;
            // document.getElementById('addmore').appendChild(div);

        }

    </script>
@stop