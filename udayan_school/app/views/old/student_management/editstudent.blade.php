@extends('master.master')
@section('header')

@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>

                <h3>Student Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li>
                            <a href="/student_management/addstudent">Add Student</a>
                        </li>
                        <li class="active"><a href="/student_management/listeditstudent">Edit Student</a></li>
                        <li><a href="/student_management/assign_student_to_section">Assign Student To Section</a></li>
                    </ul>
                    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Edit Student</h3></strong></div>
                    <div id="stdregister_div"></div>
                    <div class="tab-content">

                        <div class="row">

                            <br>

                            <div class="span6">
                                <div class="widget">
                                    <div class="widget-header">

                                        <h3>
                                            Student Details</h3>
                                    </div>
                                    <!-- /widget-header -->
                                    {{ Form::open(array('url'=>'/edit_student', 'class'=>'form-signup','files' => true)) }}
                                    {{Form::hidden('id',$student->idstudentinfo)}}
                                    <div class="widget-content">
                                        <table width="100%">
                                            <tr>
                                                <td colspan="2">Name:</td>
                                                <td>Reg. Id:</td>
                                            </tr>
                                            <tr>

                                                <td colspan="2">
                                                    <div class="controls">
                                                        <input class="span3" type="text" style="width:95%;"
                                                               name="student_name" id="student_name"
                                                               value="{{$student->father_name}}" style=""
                                                               id="firstname">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" style="width:95%" name="student_id"
                                                           id="student_id"
                                                           readonly="" value="<?php echo $student->registration_id;?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Gender:</td>
                                                <td>Blood Group:</td>
                                                <td rowspan="5" align="center">
                                                    <img id="uploadPhoto" src="/uploads/{{$student->image}}"
                                                         style="border-radius:20%; width: 120px; height: 130px; border:5px solid #CCC;">

                                                    <br><br>

                                                    <div class="fileUpload btn btn-primary" style="width: 50%;">
                                                        <span>Upload</span>
                                                        <input type="file" name="studentimagefile" id="photo"
                                                               onchange="getPreview('photo','uploadPhoto','none');"
                                                               class="upload"/>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td><select name="gender" id="gender" class="form-control"
                                                            style="width:95%;">
                                                        <option value="<?php echo $student->gender ?>"><?php echo $student->gender ?>
                                                        </option>
                                                        <option value="Male">Male
                                                        </option>
                                                        <option value="Female">Female
                                                        </option>
                                                        <option value="Others">Others
                                                        </option>
                                                    </select>
                                                </td>
                                                <td><select class="form-control"
                                                            style="width:95%;" name="bloodGroup" id="bloodGroup"
                                                            required>
                                                        <option value="{{$student->blood_group}}">{{$student->blood_group}}</option>
                                                        <option value="AB+">AB+</option>
                                                        <option value="AB-">AB-</option>
                                                        <option value="A+">A+</option>
                                                        <option value="A-">A-</option>
                                                        <option value="B+">B+</option>
                                                        <option value="B-">B-</option>
                                                        <option value="O+">O+</option>
                                                        <option value="O-">O-</option>
                                                    </select>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Date of Birth:</td>
                                                <td colspan="2">Religion:</td>
                                            </tr>
                                            <tr>

                                                <td>
                                                    <input type="text" class="span2" id="popupDatepicker"
                                                           name="studentdateofbirth" style="width:95%">
                                                </td>
                                                <td><select class="form-control"
                                                            style="width:95%;" name="religion" id="religion">
                                                        <option value="{{$student->religion}}">{{$student->religion}}</option>
                                                        <option value="Islam">Islam</option>
                                                        <option value="Hindu">Hindu</option>
                                                        <option value="Budhist">Budhist</option>
                                                        <option value="Christian">Christian</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </td>

                                            </tr>


                                        </table>
                                    </div>


                                    <!-- /widget-content -->
                                </div>
                                <!-- /widget -->
                                <div class="widget">
                                    <div class="widget-header">

                                        <h3>
                                            Contact Information</h3>
                                    </div>
                                    <!-- /widget-header -->
                                    <div class="widget-content">
                                        <table width="100%">


                                            <tr>
                                                <td colspan="3">Mobile 1*:</td>
                                                <td colspan="3">Mobile 2:</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" valign="top">
                                                    <div class="controls">
                                                        <input type="text" class="span3" id="mobile1"
                                                               name="mobile1" style="width:95%"
                                                               value="{{$student->mobile1}}"
                                                               onkeyup="phonenumber('<?php echo "mobile1"?>','<?php echo "button"?>','<?php echo "errorpremob"?>')">

                                                        <div><span><p id="errorpremob"
                                                                      style="color: red;float:left"></p></span></div>
                                                    </div>
                                                </td>
                                                <td colspan="3" valign="top">
                                                    <div class="controls">
                                                        <input type="text" class="span3" id="mobile2"
                                                               name="mobile2" style="width:95%"
                                                               value="{{$student->mobile2}}"
                                                               onkeyup="phonenumber('<?php echo "mobile2"?>','<?php echo "button"?>','<?php echo "errorpremob1"?>')">

                                                        <div><span><p id="errorpremob1"
                                                                      style="color: red;float:left"></p></span></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">Email:</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="controls">
                                                        <input type="text" class="span6" id="txtEmail"
                                                               onkeyup="checkEmail()"
                                                               name="email" style="width:98%"
                                                               value="{{$student->email}}">

                                                        <div><span><p id="erroremail" style="color: red;"></p></span>
                                                        </div>

                                                    </div>

                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!-- /widget-content -->
                                </div>
                                <!-- /widget -->

                            </div>
                            <!-- /span6 -->
                            <div class="span5">
                                <div class="widget">
                                    <div class="widget-header">

                                        <h3>
                                            Guardian Details</h3>
                                    </div>
                                    <!-- /widget-header -->
                                    <div class="widget-content">
                                        <table width="100%">
                                            <tr>
                                                <td rowspan="4" align="center">
                                                    <img id="uploadPhoto1" src="/uploads/{{$student->fathers_image}}"
                                                         style="border-radius:20%; width: 120px; height: 130px; border:5px solid #CCC;">

                                                </td>
                                                <td rowspan="4" align="center">
                                                    <img id="uploadPhoto2" src="/uploads/{{$student->mothers_image}}"
                                                         style="border-radius:20%; width: 120px; height: 130px; border:5px solid #CCC;">

                                                </td>
                                            </tr>
                                            <tr></tr>
                                            <tr></tr>
                                            <tr></tr>
                                            <tr></tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td align="center">
                                                    <div class="fileUpload btn btn-primary" style="width: 43%;">
                                                        <span>Upload</span>
                                                        <input type="file" name="fatherimagefile" id="photo1"
                                                               onchange="getPreview('photo1','uploadPhoto1','none');"
                                                               class="upload"/>
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="fileUpload btn btn-primary" style="width: 43%;">
                                                        <span>Upload</span>
                                                        <input type="file" name="motherimagefile" id="photo2"
                                                               onchange="getPreview('photo2','uploadPhoto2','none');"
                                                               class="upload"/>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Father's Name:</td>
                                                <td>Mother's Name:</td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="controls">
                                                        <input type="text" class="span2" name="fatherName"
                                                               id="fatherName" style="width:95%"
                                                               value="{{$student->father_name}}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="controls">
                                                        <input type="text" class="span2" name="motherName"
                                                               id="motherName" style="width:95%"
                                                               value="{{$student->father_name}}">
                                                    </div>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>Date of Birth:</td>
                                                <td>Date of Birth:</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="controls">
                                                        <input type="text" class="span2" id="popupDatepicker2"
                                                               name="fatherdateofbirth" style="width:95%"
                                                               value="{{$student->fathers_dateofbirth}}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="controls">
                                                        <input type="text" class="span2" id="popupDatepicker3"
                                                               name="motherdateofbirth" style="width:95%"
                                                               value="{{$student->mothers_dateofbirth}}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Occupation:</td>
                                                <td>Occupation:</td>
                                            </tr>


                                            <tr>

                                                <td>
                                                    <div class="controls">
                                                        <input type="text" class="span2" name="fatherOccupation"
                                                               id="fatherOccupation" style="width:95%;"
                                                               value="{{$student->fathers_occupation}}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="controls">
                                                        <input type="text" class="span2" name="motherOccupation"
                                                               id="motherOccupation" style="width:95%;"
                                                               value="{{$student->mothers_occupation}}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Yearly Income:</td>
                                                <td>Yearly Income:</td>
                                            </tr>
                                            <tr>

                                                <td>
                                                    <div class="controls">
                                                        <input type="text" class="span2" id="fatherincome"
                                                               name="fatherincome" style="width:95%"
                                                               value="{{$student->mothers_income}}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="controls">
                                                        <input type="text" class="span2" id="motherincome"
                                                               name="motherincome" style="width:95%"
                                                               value="{{$student->fathers_income}}">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!-- /widget-content -->
                                </div>
                                <!-- /widget -->

                                <!-- /widget -->
                            </div>
                            <!-- /span6 -->
                        </div>
                        <!-- /row -->
                        <div class="row">

                            <div class="span11" style="margin-left:25px">

                                <div class="widget ">

                                    <div class="widget-header">

                                        <h3>Mailing Address </h3>
                                    </div>
                                    <!-- /widget-header -->

                                    <div class="widget-content">


                                        <table width="100%">
                                            <tr>
                                                <th><h3>Present Address</h3></th>
                                                <th><h3>Permanent Address</h3></th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <input type="checkbox" id="same_address"
                                                           onchange="sameAdress();"/> &nbsp;&nbsp;Same as
                                                    present address
                                                    <input type="hidden" value="0" name="same_address_flag"
                                                           id="same_address_flag">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%">
                                                        <tr>
                                                            <td colspan="3"><b>Address Line: </b></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">
                                                                        <textarea class="form-control" rows="5"
                                                                                  id="preaddressline"
                                                                                  name="preaddressline"
                                                                                  style="width:95%;">{{$student->preaddressline}}</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>District</td>
                                                            <td>Thana</td>
                                                            <td>Union</td>
                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <select name="presentDistrict" id="presentDistrict"
                                                                        class="form-control" style="width:95%;">
                                                                    <option value="{{$student->p_district}}">{{$student->p_district}}</option>
                                                                    @foreach($district as $cats)
                                                                        <option value="{{$cats->name}}">{{$cats->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select name="presentThana" id="presentThana"
                                                                        class="form-control" style="width:95%;">

                                                                </select>
                                                            </td>
                                                            <td>

                                                                <div class="controls">
                                                                    <input type="text" class="span2" name="presentUnion"
                                                                           id="presentUnion" id="mobile"
                                                                           name="mobile" style="width:90%"
                                                                           value="{{$student->p_union}}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>

                                                <td>
                                                    <table width="100%">
                                                        <tr>
                                                            <td colspan="3"><b>Address Line: </b></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">
                                                                <textarea class="form-control" rows="5"
                                                                          id="peraddressline"
                                                                          name="peraddressline"
                                                                          style="width:95%;">{{$student->peraddressline}}</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>District</td>
                                                            <td>Thana</td>
                                                            <td>Union</td>
                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <select name="parmanentDistrict" id="parmanentDistrict"
                                                                        class="form-control" style="width:95%;">
                                                                    <option value="{{$student->per_district}}">{{$student->per_district}}</option>
                                                                    @foreach($district as $cats)
                                                                        <option value="{{$cats->name}}">{{$cats->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select name="parmanentThana" id="parmanentThana"
                                                                        class="form-control" style="width:95%;">

                                                                </select>
                                                            </td>
                                                            <td>

                                                                <div class="controls">
                                                                    <input type="text" name="parmanentUnion"
                                                                           id="parmanentUnion" id="mobile"
                                                                           name="mobile" style="width:90%"
                                                                           value="{{$student->per_union}}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>


                                            </tr>
                                        </table>


                                        <br>
                                        <center>
                                            <button type="submit" class="btn btn-primary" id="button">Save</button>
                                        </center>

                                        {{Form::close()}}
                                    </div>
                                    <!-- /widget-content -->

                                </div>
                                <!-- /widget -->

                            </div>
                            <!-- /span8 -->


                        </div>
                        <!-- /row -->


                    </div>
                    <!-- /container -->
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

        function checkEmail() {


            var email = document.getElementById('txtEmail');
            var emailValue = document.getElementById('txtEmail').value;

            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if (emailValue == null || emailValue == "" || emailValue == "  " || emailValue == "   " || emailValue == "    " || emailValue == "     ") {

                document.getElementById("txtEmail").style.border = '1px solid #ccc';
                document.getElementById("button").disabled = false;
                document.getElementById("erroremail").innerHTML = null;
            }
            else if (!filter.test(email.value)) {

                document.getElementById("button").disabled = true;
                document.getElementById("txtEmail").style.border = '1px solid red';
                document.getElementById("erroremail").innerHTML = "Is Not a Email";

            } else {
                document.getElementById("txtEmail").style.border = '1px solid #ccc';
                document.getElementById("button").disabled = false;
                document.getElementById("erroremail").innerHTML = null;
            }
        }


        function phonenumber(id, button, errorId) {
            var inputtxt = "";

            var inputtxt = document.getElementById(id).value;


            var phoneno = /^(?=019|018|017|016)\d{11}$/;
            if (inputtxt == null || inputtxt == "" || inputtxt == "  " || inputtxt == "   " || inputtxt == "    " || inputtxt == "     ") {

                document.getElementById(id).style.border = '1px solid #ccc';
                document.getElementById(button).disabled = false;
                document.getElementById(errorId).innerHTML = null;
            }
            else if (inputtxt.match(phoneno)) {
                document.getElementById(id).style.border = '1px solid #ccc';
                document.getElementById(button).disabled = false;
                document.getElementById(errorId).innerHTML = null;
            }
            else {
                document.getElementById(id).style.border = '1px solid red';
                document.getElementById(button).disabled = true;
                document.getElementById(errorId).innerHTML = "Is Not a Mobile Number";
            }
        }


        $("#cat").on('change', function (e) {
            console.log(e);

            var cat_id = e.target.value;
            cc = cat_id;
            $.get('/ajax?cat_id=' + cat_id, function (data) {

                $('#sub').empty();
                $('#sub').append('<option>-&nbsp;Select Section&nbsp;-</option>');
                $.each(data, function (index, subcatObj) {
                    $('#sub').append('<option value="' + subcatObj.section + '">' + subcatObj.section + '</option>');
                })

            });
        });
        $("#sub").on('change', function (e) {
            console.log(e);

            var sectionname = e.target.value;
            $.get('/ajaxshift?classname=' + cc + '&sectionname=' + sectionname, function (data) {
                console.log(data);

                $('#shift').empty();
                $.each(data, function (index, subcatObj) {
                    $('#shift').append('<option value="' + subcatObj.shift + '">' + subcatObj.shift + '</option>');
                })

            });
        });


        $("#presentDistrict").on('change', function (e) {
            console.log(e);
//document.write('hello');
            var cat_id = e.target.value;
// document.write(cat_id);
            $.get('/district?cat_id=' + cat_id, function (data) {
//console.log(data);
                $('#presentThana').empty();
                $.each(data, function (index, subcatObj) {
                    $('#presentThana').append('<option value="' + subcatObj.name + '">' + subcatObj.name + '</option>');
                })

            });
        });
    </script>
    <script>
        $("#parmanentDistrict").on('change', function (e) {
            console.log(e);
//document.write('hello');
            var cat_id = e.target.value;
// document.write(cat_id);
            $.get('/district?cat_id=' + cat_id, function (data) {
//console.log(data);
                $('#parmanentThana').empty();
                $.each(data, function (index, subcatObj) {
                    $('#parmanentThana').append('<option value="' + subcatObj.name + '">' + subcatObj.name + '</option>');
                })

            });
        });
    </script>

    <script type="text/javascript">

        function sameAdress() {

            if (document.getElementById("same_address").checked == true) {
                //flag
                document.getElementById('same_address_flag').value = '1';

                //document.getElementById('parmanentVillage').value = document.getElementById('presentVillage').value;
                document.getElementById('peraddressline').disabled = true;

                //document.getElementById('parmanentRoad').value = document.getElementById('presentRoad').value;
                document.getElementById('parmanentDistrict').disabled = true;

                //document.getElementById('parmanentDistrict').value = document.getElementById('presentDistrict').value;
                document.getElementById('parmanentThana').disabled = true;

                // document.getElementById('parmanentThana').value = document.getElementById('presentThana').value;
                document.getElementById('parmanentUnion').disabled = true;


            }

            if (document.getElementById("same_address").checked == false) {
                //flag
                document.getElementById('same_address_flag').value = '0';

                document.getElementById('peraddressline').disabled = false;
                document.getElementById('parmanentDistrict').disabled = false;
                document.getElementById('parmanentThana').disabled = false;
                document.getElementById('parmanentUnion').disabled = false;

            }

        }

        function getPreview(objectName, previewNameViewer, fileNameViewer) {

            if (fileNameViewer != "none" || fileNameViewer != 'none' || fileNameViewer !== "none" || fileNameViewer !== 'none') {
                //send name
                var name = document.getElementById(objectName).files[0].name;
                if (name != null || name != "" || name != '' || name !== "" || name !== '') {
                    document.getElementById(fileNameViewer).value = name;
                } else {
                    notify('Select a photo', 'warning', '1', '1');
                }
                ;

            }


            // get selected file element
            var oFile = document.getElementById(objectName).files[0];

            // get preview element
            var oImage = document.getElementById(previewNameViewer);

            // prepare HTML5 FileReader
            var oReader = new FileReader();
            oReader.onload = function (e) {

                // e.target.result contains the DataURL which we will use as a source of the image
                oImage.src = e.target.result;

            };

            // read selected file as DataURL
            oReader.readAsDataURL(oFile);


        }

    </script>






    <style type="text/css">

        .fileUpload {
            position: relative;
            overflow: hidden;
            /*margin: 10px;*/
        }

        .fileUpload input.upload {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
    </style>

    <link href="{{ URL::asset('date/jquery.datepick.css')}}" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ URL::asset('date/jquery.plugin.js')}}"></script>
    <script src="{{ URL::asset('date/jquery.datepick.js')}}"></script>
    <script>
        $(function() {
            $('#popupDatepicker').datepick();
        });
        $(function() {
            $('#popupDatepicker2').datepick();
        });

        $(function() {
            $('#popupDatepicker3').datepick();
        });
    </script>
@stop