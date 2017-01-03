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
                        <li class="active">
                            <a href="{{ URL::to('/student_management/addstudent')}}">Add Student</a>
                        </li>
                         <li ><a href="{{ URL::to('/info')}}">Edit Student</a></li>
                        <li  ><a href="{{ URL::to('/student_management/assign_student_to_class_section')}}">Assign Student To Section</a></li>
                        {{--<li><a href="{{ URL::to('/student_management/assign_student_to_section')}}">Student Promotion</a></li>--}}
                        
                    </ul>
                    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Student Admission</h3></strong></div>
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
                                    {{Form::open(['url'=>'/create_student','files'=>true,'onsubmit'=>'return Validate(this);' ])}}   
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
                                                               name="student_name" id="student_name" style=""
                                                               id="firstname">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" style="width:95%" name="student_id"
                                                           id="student_id"
                                                           readonly="" value="<?php echo $studentRegistrationId;?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Gender:</td>
                                                <td>Blood Group:</td>
                                                <td rowspan="5" align="center">
                                                    <img id="uploadPhoto" src="{{URL::asset('/image/maleandfemale.jpg')}}"
                                                         style="border-radius:20%; width: 120px; height: 130px; border:5px solid #CCC;">

                                                    <br><br>

                                                    <div class="fileUpload btn btn-primary" style="width: 50%;">
                                                        <span>Upload</span>
                                                        <input type="file" name="studentimagefile" id="photo"
                                                               onchange="getPreview('photo','uploadPhoto','none');"
                                                               class="upload"/>
                                                    </div>
                                                     <p id="errorimage1" style="color:red"></p>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td><select name="gender" id="gender" class="form-control"
                                                            style="width:95%;">
                                                        <option value="male">Select Gender
                                                        </option>
                                                        <option value="male">Male
                                                        </option>
                                                        <option value="female">Female
                                                        </option>
                                                        <option value="others">Others
                                                        </option>
                                                    </select>
                                                </td>
                                                <td><select class="form-control"
                                                            style="width:95%;" name="bloodGroup" id="bloodGroup"
                                                            required>
                                                        <option value="">Select Blood Group</option>
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
                                                        <option value="">Select Religion</option>
                                                        <option value="Islam">Islam</option>
                                                        <option value="Hindu">Hindu</option>
                                                        <option value="Buddhist">Buddhist</option>
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
                                                               onkeyup="phonenumber('<?php echo "mobile1"?>','<?php echo "button"?>','<?php echo "errorpremob"?>')">

                                                        <div><span><p id="errorpremob"
                                                                      style="color: red;float:left"></p></span></div>
                                                    </div>
                                                </td>
                                                <td colspan="3" valign="top">
                                                    <div class="controls">
                                                        <input type="text" class="span3" id="mobile2"
                                                               name="mobile2" style="width:95%"
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
                                                               name="email" style="width:98%">

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
                                                    <img id="uploadPhoto1" src="{{ URL::to('/image/male.jpg')}}"
                                                         style="border-radius:20%; width: 120px; height: 130px; border:5px solid #CCC;">

                                                </td>
                                                <td rowspan="4" align="center">
                                                    <img id="uploadPhoto2" src="{{ URL::to('/image/female.jpg')}}"
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
                                                    <p id="errorimage2" style="color:red"></p>
                                                </td>
                                                <td align="center">
                                                    <div class="fileUpload btn btn-primary" style="width: 43%;">
                                                        <span>Upload</span>
                                                        <input type="file" name="motherimagefile" id="photo2"
                                                               onchange="getPreview('photo2','uploadPhoto2','none');"
                                                               class="upload"/>
                                                    </div>
                                                    <p id="errorimage3" style="color:red"></p>
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
                                                               id="fatherName" style="width:95%">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="controls">
                                                        <input type="text" class="span2" name="motherName"
                                                               id="motherName" style="width:95%">
                                                    </div>
                                                </td>
                                            </tr>


                                            <tr>
                                                 <td>Father's Mobile:</td>
                                                <td>Mother's Mobile:</td>
                                            </tr>
                                      
                                            <tr>
                                                <td>
                                                    <div class="controls">
                                                       
                                                               <input type="text" class="span2" id="fathers_mobile"
                                                               name="fathers_mobile" style="width:95%"
onkeyup="phonenumber('<?php echo "fathers_mobile"?>','<?php echo "button"?>','<?php echo "errorpremobfather"?>')" >


                                                        <div><span><p id="errorpremobfather"
                                                                      style="color: red;float:left"></p></span></div>

                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="controls">
                                                               <input type="text" class="span2" id="mothers_mobile"
                                                               name="mothers_mobile" style="width:95%"
onkeyup="phonenumber('<?php echo "mothers_mobile"?>','<?php echo "button"?>','<?php echo "errorpremobmother"?>')">
                                       <div><span><p id="errorpremobmother" style="color: red;float:left"></p></span></div>
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
                                                               id="fatherOccupation" style="width:95%;">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="controls">
                                                        <input type="text" class="span2" name="motherOccupation"
                                                               id="motherOccupation" style="width:95%;">
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
                                                               name="fatherincome" style="width:95%">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="controls">
                                                        <input type="text" class="span2" id="motherincome"
                                                               name="motherincome" style="width:95%">
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
                                                                                  style="width:100%;"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>District</td>
                                                            <td>Thana</td>
                                                            <td>Union</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:17%;">

                                                                <select name="presentDistrict" id="presentDistrict"
                                                                        class="form-control" style="width:95%;">
                                                                    <option value="">Select District</option>
                                                                    @foreach($district as $cats)
                                                                        <option value="{{$cats->goname}}">{{$cats->goname}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td style="width:17%;">
                                                                <select name="presentThana" id="presentThana"
                                                                        class="form-control" style="width:95%;">
                                                                        <option>Select Thana</option>

                                                                </select>
                                                            </td>
                                                            <td style="width:17%;">

                                                                <div class="controls">
                                                                    

                                                                    <select class="span2" name="presentUnion"
                                                                           id="presentUnion" 
                                                                        class="form-control" style="width:95%;">

                                                                </select>

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
                                                                          style="width:100%;"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>District</td>
                                                            <td>Thana</td>
                                                            <td>Union</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:17%;">

                                                                <select name="parmanentDistrict" id="parmanentDistrict"
                                                                        class="form-control" style="width:95%;">
                                                                    <option value="">Select District</option>
                                                                    @foreach($district as $cats)
                                                                        <option value="{{$cats->goname}}">{{$cats->goname}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td style="width:17%;">
                                                                <select name="parmanentThana" id="parmanentThana"
                                                                        class="form-control" style="width:95%;">
                                                                        <option>Select Thana</option>

                                                                </select>
                                                            </td>
                                                            <td style="width:17%;">

                                                                <div class="controls">

                                                                    <select class="span2" name="parmanentUnion"
                                                                           id="parmanentUnion" 
                                                                        class="form-control" style="width:95%;">

                                                                </select>

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
                                            <button type="submit" class="btn btn-primary" id="button"><i class="icon-save"></i> Save</button>
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
    {{--{{ HTML::script('master/js/jquery.min.js') }}--}}
<script>
var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"]; 

function Validate(oForm) {

          var oInput = document.getElementById("photo");
       if (oInput.type == "file") {
            
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    document.getElementById("errorimage1").innerHTML = "Enter File type<br>" + _validFileExtensions.join(", ");

                   // alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }

         var oInput = document.getElementById("photo1");
       if (oInput.type == "file") {
            
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    document.getElementById("errorimage2").innerHTML = "Enter File type<br>" + _validFileExtensions.join(", ");

                   // alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }

        var oInput = document.getElementById("photo2");
       if (oInput.type == "file") {
            
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    document.getElementById("errorimage3").innerHTML = "Enter File type<br>" + _validFileExtensions.join(", ");

                   // alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }
      

  
    return true;
}
</script>



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


            var phoneno = /^(?=019|018|017|016|015|011)\d{11}$/;
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
            $.get('<?php echo Config::get('baseurl.url');?>/ajax?cat_id=' + cat_id, function (data) {

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
            $.get('<?php echo Config::get('baseurl.url');?>/ajaxshift?classname=' + cc + '&sectionname=' + sectionname, function (data) {
                console.log(data);

                $('#shift').empty();
                $.each(data, function (index, subcatObj) {
                    $('#shift').append('<option value="' + subcatObj.shift + '">' + subcatObj.shift + '</option>');
                })

            });
        });



    </script>
    <script>
        $("#presentDistrict").on('change', function (e) {
            console.log(e);
//document.write('hello');
            var cat_id = e.target.value;
// document.write(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/district?cat_id=' + cat_id, function (data) {
//console.log(data);
                $('#presentThana').empty();
                $.each(data, function (index, subcatObj) {
                    $('#presentThana').append('<option value="' + subcatObj.goname + '">' + subcatObj.goname + '</option>');
                })

            });
        });

        $("#parmanentDistrict").on('change', function (e) {
            console.log(e);
//document.write('hello');
            var cat_id = e.target.value;
 //document.write(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/district?cat_id=' + cat_id, function (data) {
//console.log(data);
 //document.write(data);
                $('#parmanentThana').empty();
                $.each(data, function (index, subcatObj) {
                    $('#parmanentThana').append('<option value="' + subcatObj.goname + '">' + subcatObj.goname + '</option>');
                })

            });
        });
    </script>
      <script>
        $("#presentThana").on('change', function (e) {
            console.log(e);
            var cat_id2 = e.target.value;
            $.get('<?php echo Config::get('baseurl.url');?>/thana?cat_id=' + cat_id2, function (data) {
                $('#presentUnion').empty();
                $.each(data, function (index, subcatObj) {
                    $('#presentUnion').append('<option value="' + subcatObj.goname + '">' + subcatObj.goname + '</option>');
                })

            });
        });

        $("#parmanentThana").on('change', function (e) {
            console.log(e);
            var cat_id3 = e.target.value;
            $.get('<?php echo Config::get('baseurl.url');?>/thana?cat_id=' + cat_id3, function (data) {
                $('#parmanentUnion').empty();
                $.each(data, function (index, subcatObj) {
                  //  alert(data);
                    $('#parmanentUnion').append('<option value="' + subcatObj.goname + '">' + subcatObj.goname + '</option>');
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