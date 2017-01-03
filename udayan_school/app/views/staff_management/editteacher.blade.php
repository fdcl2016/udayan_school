@extends('master.master')
@section('header')
  {{ HTML::script('master/js/jquery.min.js') }}

 
@stop
@section('content')
    <div class="span12"> 

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Staff Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li >
                            <a href="{{ URL::to('/staff_management/addteacher')}}">Add Teacher</a>
                        </li>
                        <li class="active"><a href="{{ URL::to('/staff_management/listeditteacher')}}">Edit Teacher</a></li>
                    </ul>
                    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><h3
                                    style="color:black">Edit Teacher</h3></div>
                    <div id="stdregister_div"></div>
                  <div class="span6">
                                        <div class="widget">
                                            <div class="widget-header">

                                                <h3>
                                                    Personal Details</h3>
                                            </div>
{{Form::open(['url'=>'editteacher','files'=>true,'onsubmit'=>'return Validate(this);' ])}}
                                              {{Form::hidden('id',$teacher->idteacherinfo)}}
                                            <!-- /widget-header -->
                                            <div class="widget-content">
                                          
                                                <table width="100%">
                                                    <tr>
                                                        <td colspan="2">Name:</td>
                                                        <td rowspan="6" align="center">
                                                            <img id="uploadPhoto" src="{{ URL::to('/uploads/'.$teacher->image)}}"
                                                                 style="border-radius:20%; width: 120px; height: 130px; border:5px solid #CCC;">

                                                            <br><br>

                                                            <div class="fileUpload btn btn-primary" style="width: 50%;">
                                                                <span>Upload</span>
                                                                <input type="file" name="imagefile" id="photo"
                                                                       onchange="getPreview('photo','uploadPhoto','none');"
                                                                       class="upload"/>
                                                            </div>
<p id="errorimage" style="color:red"></p>
                                                        </td>

                                                    </tr>
                                                    <tr>

                                                        <td colspan="2">
                                                            <input class="span3" value="{{$teacher->teacher_name}}" name="teachername" type="text" style="width:95%;"
                                                                   id="name">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gender:</td>
                                                        <td>Blood Group:</td>
                                                    </tr>
                                                    <tr>

                                                        <td><select name="gender" id="gender" class="form-control"
                                                                    style="width:95%;">
                                                                <option value="{{$teacher->gender}}">{{$teacher->gender}}</option>
                                                        <option value="Male">Male
                                                        </option>
                                                        <option value="Female">Female
                                                        </option>
                                                        <option value="Others">Others
                                                        </option>
                                                            </select>
                                                        </td>
                                                        <td><select name="blood_group" id="blood_group" class="form-control"
                                                                    style="width:95%;">
                                                                <option value="{{$teacher->blood_group}}">{{$teacher->blood_group}}</option>
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
                                                        <td>Religion:</td>

                                                    </tr>

                                                    <tr>

                                                        <td>
                                                           
                                                                <input type="text" class="span2" id="popupDatepicker"
                                                           name="dateofbirth" value="{{$teacher->dateofbirth}}" style="width:95%">
                                                          
                                                        </td>
                                                        <td><select name="religion" id="religion" class="form-control"
                                                                    style="width:95%;">
                                                                <option value="{{$teacher->religion}}">{{$teacher->religion}}</option>
                                                        <option value="Islam">Islam</option>
                                                        <option value="Hindu">Hindu</option>
                                                        <option value="Budhist">Budhist</option>
                                                        <option value="Christian">Christian</option>
                                                        <option value="Others">Others</option>
                                                            </select>
                                                        </td>


                                                    </tr>
                                                    <tr>
                                                        <td>Marital Status:</td>

                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><select name="marraige" id="marraige" class="form-control"
                                                                                style="width:97%;">
                                                                <option value="{{$teacher->maraital_status}}">{{$teacher->maraital_status}}</option>
                                                                <option value="married"> Married</option>
                                                                <option value="unmarried"> Unmarried</option>
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
                                                    Parent Information</h3>
                                            </div>
                                            <!-- /widget-header -->
                                            <div class="widget-content">
                                                <table width="100%">


                                                    <tr>
                                                        <td>Father's Name:</td>
                                                        <td>Mother's Name:</td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="controls">
                                                                <input type="text" value="{{$teacher->father_name}}" class="span2" id="fathers_name"
                                                                       name="fathers_name" style="width:95%">
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="controls">
                                                                <input type="text"  value="{{$teacher->mother_name}}" class="span2" id="mothers_name"
                                                                       name="mothers_name" style="width:95%">
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
                                                                <input type="text" value="{{$teacher->fathers_occupation}}" class="span2" id="fathers_occupation"
                                                                       name="fathers_occupation" style="width:95%;">
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="controls">
                                                                <input type="text" value="{{$teacher->mothers_occupation}}" class="span2" id="mothers_occupation"
                                                                       name="mothers_occupation" style="width:95%;">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mobile:</td>
                                                        <td>Mobile:</td>
                                                    </tr>
                                                    <tr>

                                                        <td valign="top">
                                                            <div class="controls">
                                                             <input type="text" class="span2" id="fathers_mobile"
                                                               name="fathers_mobile" style="width:95%"
                                                               value="{{$teacher->fathers_mobile}}"
                                                               onkeyup="phonenumber('<?php echo "fathers_mobile"?>','<?php echo "button"?>','<?php echo "errorpremob1"?>')">

                                                        <div><span><p id="errorpremob1"
                                                                      style="color: red;float:left"></p></span></div>
                                                    </div>
                                                        </td>

                                                        <td valign="top">
                                                            <div class="controls">
                                                             <input type="text" class="span2" id="mothers_mobile"
                                                               name="mothers_mobile" style="width:95%"
                                                               value="{{$teacher->mothers_mobile}}"
                                                               onkeyup="phonenumber('<?php echo "mothers_mobile"?>','<?php echo "button"?>','<?php echo "errorpremob2"?>')">

                                                        <div><span><p id="errorpremob2"
                                                                      style="color: red;float:left"></p></span></div>    </div>
                                                        </td>

                                                    </tr>
                                                </table>
                                            </div>
                                            <!-- /widget-content -->
                                        </div>


                                    </div>
                                    <!-- /span6 -->
                                    <div class="span5">
                                        <div class="widget">
                                            <div class="widget-header">

                                                <h3>
                                                    Employement Details</h3>
                                            </div>
                                            <!-- /widget-header -->
                                            <div class="widget-content">
                                                <table width="100%">

                                                    <tr>
                                                        <td align="left">
                                                            Employee Number:
                                                        </td>
                                                        <td align="left">
                                                            <input type="text" style="width:95%" id="registration_id"
                                                                name="registration_id"   readonly="" value="{{$teacher->teacher_id}}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Teacher Initial:</td>
                                                        <td>Joining Date:</td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="controls">
                                                                <input type="text" class="span2" id="teacher_initial"
                                                                       name="teacher_initial" value="{{$teacher->teacher_initial}}" style="width:88%">
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <input type="text" class="span3" value="{{$teacher->joining_date}}" id="popupDatepicker2"
                                                                       name="joining_date" style="width:95%">
                                                        </td>
                                                    </tr>


                                                    <tr>

                                                        <td colspan="2">Designation:</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <select name="designation" id="designation" class="form-control"
                                                                    style="width:95%;">
                                                                <option value="{{$teacher->designation}}">{{$teacher->designation}}</option>
                                                                <option value="Headmaster">Headmaster</option>
                                                                <option value="Asstt. Headmaster">Asstt. Headmaster</option>
                                                                <option value="Asstt. Teacher">Asstt. Teacher</option>
                                                                <option value="Lecturer">Lecturer</option>
                                                            </select>
                                                        </td>


                                                    </tr>
                                                    <tr>

                                                        <td colspan="2">Department:</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <select name="department" id="department" class="form-control"
                                                                    style="width:95%;">
                                                                 <option value="{{$teacher->department}}">{{$teacher->department}}</option>   
                                                                    @foreach($departments as $department)
                                                                <option value="{{$department->department_name}}">{{$department->department_name}}</option>
                                                                    @endforeach
                                                            </select>
                                                        </td>


                                                    </tr>
                                                      <tr>
                                                        <td colspan="2">Subject:</td>
                                                         <?php 
                                                                $words = explode(",", $teacher->subject);
                                                                //echo $teacher->subject;
                                                                 $spaces=array();
                                                                 $others=array();
                                                                 foreach($words as $word)
                                                                 {
                                                                   if($word==' ')
                                                                   {
                                                                   array_push($spaces,$word);
                                                                 }
                                                                 else
                                                                 {
                                                                     array_push($others,$word);
                                                                 }
                                                             } // echo $words;
                                                             $i=0;
                                                             

                                                            ?>

                                                    </tr>


                                                    <tr>

                                                        <td colspan="2">
                                                            <div id="rcorners2"style="width:95%;height:95%;border:1px solid #cccccc;margin-bottom:10px">
                                                                <?php $subjects= Subject::select('subject_name')->get()?>


                                                                <?php $i=1;?>
                                                                <?php $j=1; $max = sizeof($words );?>
                                                                @foreach($subjects as $subject)
                                                                     <?php $j=1; ?>

                                                                      @foreach($words as $word)
                                                                        
                                                                        <?php if($subject->subject_name==$word){?>
                                                                          <input type="checkbox" checked name="<?php echo "subject" . $i++;?>"  value="{{$subject->subject_name}}"/>
                                                                        <?php break; }
                                                                               else if($j==$max) {
                                                                            ?>
                                                                                <input type="checkbox"  name="<?php echo "subject" . $i++;?>"  value="{{$subject->subject_name}}"/>
                                                                        <?php }?>
                                                                        <?php $j=$j+1;?>
                                                                       @endforeach
                                                                     
                                                                    {{$subject->subject_name}}
                                                                @endforeach


                                                            </div>
                                                        </td>


                                                    </tr>

                                                    <tr>
                                                        <td>Salary:</td>
                                                        <td>CV:</td>
                                                    </tr>
                                                    <tr>

                                                        <td>
                                                            <div class="controls">
                                                                <input type="text" value="{{$teacher->teacher_salary}}" class="span2" id="salary"
                                                                       name="salary" style="width:88%">
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <input id="uploadFile" name="cv" placeholder="Choose File"
                                                                   disabled="disabled" style="width:60%"/>

                                                            <div class="fileUpload btn btn-primary"
                                                                 style="margin-bottom:9px">
                                                                <span>Upload CV</span>
                                                                <input id="uploadBtn" type="file" class="upload"/>
                                                            </div>
                                                        </td>
                                                    </tr>
<tr><td></td> <td><p id="errorcv" style="color:red"></p></td></tr>
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
                                                               value="{{$teacher->teacher_mobile1}}"
                                                               onkeyup="phonenumber('<?php echo "mobile1"?>','<?php echo "button"?>','<?php echo "mob1"?>')">

                                                        <div><span><p id="mob1"
                                                                      style="color: red;float:left"></p></span></div>    </div>

                                                        </td>
                                                        <td colspan="3" valign="top">
                                                            <div class="controls">
                                                             <input type="text" class="span3" id="mobile2"
                                                               name="mobile2" style="width:95%"
                                                               value="{{$teacher->teacher_mobile2}}"
                                                               onkeyup="phonenumber('<?php echo "mobile2"?>','<?php echo "button"?>','<?php echo "mob2"?>')">

                                                        <div><span><p id="mob2"
                                                                      style="color: red;float:left"></p></span></div>    </div>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6">Email:</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" valign="top">
                                                            <div class="controls">
                                                        <input type="text" class="span6" id="txtEmail"
                                                               onkeyup="checkEmail()"
                                                               name="email" style="width:98%"
                                                               value="{{$teacher->email}}">

                                                        <div><span><p id="erroremail" style="color: red;"></p></span>
                                                        </div>

                                                    </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <!-- /widget -->
                                        </div>
                                        <!-- /widget -->

                                        <!-- /span6 -->
                                    </div>
                                    <!-- /row -->


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
                                                                                      value=""
                                                                                      style="width:95%;">{{$teacher->preaddress_line}}</textarea>
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
                                                                    <option value="{{$teacher->p_district}}">{{$teacher->p_district}}</option>
                                                                    @foreach($district as $cats)
                                                                        <option value="{{$cats->goname}}">{{$cats->goname}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select name="presentThana" id="presentThana"
                                                                        class="form-control"   style="width:95%;">
<option value="{{$teacher->p_thana}}">{{$teacher->p_thana}}</option>
                                                                </select>
                                                            </td>
                                                            <td>

                                                                <div class="controls">

                                                                           <select class="span2" name="presentUnion"
                                                                           id="presentUnion" 
                                                                        class="form-control" style="width:95%;">
                                                                          <option value="{{$teacher->p_union}}">{{$teacher->p_union}}</option>
                                                               

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
                                                                                      id="paraddressline"
                                                                                      name="paraddressline"
                                                                                      style="width:95%;">{{$teacher->peraddress_line}}</textarea>
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
                                                                    <option value="{{$teacher->per_district}}">{{$teacher->per_district}}</option>
                                                                    @foreach($district as $cats)
                                                                        <option value="{{$cats->goname}}">{{$cats->goname}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select name="parmanentThana" id="parmanentThana"
                                                                        class="form-control" style="width:95%;">
<option value="{{$teacher->per_thana}}">{{$teacher->per_thana}}</option>
                                                               
                                                                </select>
                                                            </td>
                                                            <td>

                                                                <div class="controls">

                                                                           <select class="span2" name="parmanentUnion"
                                                                           id="parmanentUnion" 
                                                                        class="form-control" style="width:95%;">
                                                                          <option value="{{$teacher->per_union}}">{{$teacher->per_union}}</option>
                                                               

                                                                </select>
                                                                </div>
                                                            </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>


                                                        </tr>
                                                    </table>


                                                </div>
                                                <!-- /widget-content -->

                                            </div>
                                            <!-- /widget -->

                                        
                                                    <center>
                                                      <button type="submit" class="btn btn-primary" id="button"><i class="icon-save"></i> Save</button>
                                                    </center>
                                               {{Form::close()}}
                                               

                                            </div>
                                            <!-- /widget -->


                                    </div>
                                    <!-- /row -->
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
var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"]; 
var _validFileExtensions_cv = [".pdf"]

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
                    document.getElementById("errorimage").innerHTML = "Is Not a image<br> Enter File type<br>" + _validFileExtensions.join(", ");

                   // alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }

         var oInput = document.getElementById("uploadBtn");

        if (oInput.type == "file") {
          
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions_cv.length; j++) {
                    var sCurExtension = _validFileExtensions_cv[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    document.getElementById("errorcv").innerHTML = "Enter File type " + _validFileExtensions_cv.join(", ");

                   // alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }
  //  }
  
    return true;
}
</script>

<script type="text/javascript">
    

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
</script>
<script>   
//      $("#presentDistrict").on('change', function (e) {
//             console.log(e);
// //document.write('hello');
//             var cat_id = e.target.value;
// // document.write(cat_id);
//             $.get('/district?cat_id=' + cat_id, function (data) {
// //console.log(data);
//                 $('#presentThana').empty();
//                 $.each(data, function (index, subcatObj) {
//                     $('#presentThana').append('<option value="' + subcatObj.name + '">' + subcatObj.name + '</option>');
//                 })

//             });
//         });
     
//         $("#parmanentDistrict").on('change', function (e) {
//             console.log(e);
// //document.write('hello');
//             var cat_id = e.target.value;
// // document.write(cat_id);
//             $.get('/district?cat_id=' + cat_id, function (data) {
// //console.log(data);
//                 $('#parmanentThana').empty();
//                 $.each(data, function (index, subcatObj) {
//                     $('#parmanentThana').append('<option value="' + subcatObj.name + '">' + subcatObj.name + '</option>');
//                 })

//             });
//         });
    </script>

    <script type="text/javascript">

        document.getElementById("uploadBtn").onchange = function () {
            document.getElementById("uploadFile").value = this.value;
        }

        function sameAdress() {

        
            if (document.getElementById("same_address").checked == true) {
                //flag
                document.getElementById('same_address_flag').value = '1';

                //document.getElementById('parmanentVillage').value = document.getElementById('presentVillage').value;
                document.getElementById('paraddressline').disabled = true;

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

                document.getElementById('paraddressline').disabled = false;
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
// document.write(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/district?cat_id=' + cat_id, function (data) {
//console.log(data);
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
//document.write('hello');
            var cat_id2 = e.target.value;
 //document.write(cat_id2);
            $.get('<?php echo Config::get('baseurl.url');?>/thana?cat_id=' + cat_id2, function (data) {
console.log(data);
                $('#presentUnion').empty();
                $.each(data, function (index, subcatObj) {
                    //  alert(data);
                    $('#presentUnion').append('<option value="' + subcatObj.goname + '">' + subcatObj.goname + '</option>');
                })

            });
        });

        $("#parmanentThana").on('change', function (e) {
            console.log(e);
//document.write('hello');
            var cat_id3 = e.target.value;
 //document.write(cat_id3);
            $.get('<?php echo Config::get('baseurl.url');?>/thana?cat_id=' + cat_id3, function (data) {
//console.log(data);
                $('#parmanentUnion').empty();
                $.each(data, function (index, subcatObj) {
                  //  alert(data);
                    $('#parmanentUnion').append('<option value="' + subcatObj.goname + '">' + subcatObj.goname + '</option>');
                })

            });
        });
    </script>



    <style type="text/css">
        #rcorners2 {
            border-radius: 2px;
            border: 1px solid black;
            padding: 20px;

        }

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
</script>

@stop