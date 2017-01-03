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

                        <li class="active"><a href="{{ URL::to('student_management/listeditstudent/viewstudent/'.$student->registration_id)}}">Student Profile</a></li>
                    </ul>
                    {{--<div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3--}}
                    {{--style="color:black">Student Profile</h3></strong></div>--}}
                    <div class="alert alert-info" style="border-left: 5px solid #33D685;">
                        <strong>
                            <h3>
                                Students Profile
                            </h3>
                        </strong>
                    </div>
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

                                    <div class="widget-content">

                                        <table width="100%">
                                            <tr>
                                                <td rowspan="5" align="center"><img id="uploadPhoto" src="{{ URL::to('/uploads/'.$student->image)}}" style="border-radius:20%; width: 120px; height: 130px; border:5px solid #CCC;"></td>
                                            </tr>

                                            <tr>
                                                <td>Reg. Id: {{$student->registration_id}}</td>
                                            </tr>
                                            <tr>
                                                <td>Name: {{$student->sutdent_name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Gender: {{$student->gender}}</td>
                                                <td>Blood Group: {{$student->blood_group}}</td>
                                            </tr>
                                            <tr>
                                                <td>Date of Birth: {{$student->date_of_birth}}</td>
                                                <td>Religion: {{$student->religion}}</td>
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
                                                <td>Mobile 1*(Primary): {{$student->mobile1}}</td>
                                                <td>Mobile 2 (Optional): {{$student->mobile2}}</td>
                                            </tr>
                                            <tr>
                                                <td>Email: {{$student->email}}</td>
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
                                                    <img id="uploadPhoto1" src="{{ URL::to('/uploads/'.$student->fathers_image)}}"
                                                         style="border-radius:20%; width: 120px; height: 130px; border:5px solid #CCC;">

                                                </td>

                                                <td rowspan="4" align="center">
                                                    <img id="uploadPhoto2" src="{{ URL::to('/uploads/'.$student->mothers_image)}}"
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

                                            <tr><td><br></td></tr>

                                            <tr>
                                                <td>Father's Name: {{$student->father_name}}</td>
                                                <td>Mother's Name: {{$student->mother_name}}</td>
                                            </tr>




                                            <tr>
                                                <td>Father's Mobile: {{$student->fathers_mobile}}</td>
                                                <td>Mother's Mobile: {{$student->mothers_mobile}}</td>
                                            </tr>

                                            <tr>
                                                <td>Occupation: {{$student->fathers_occupation}}</td>
                                                <td>Occupation: {{$student->mothers_occupation}}</td>
                                            </tr>



                                            <tr>
                                                <td>Yearly Income: {{$student->fathers_income}}</td>
                                                <td>Yearly Income: {{$student->mothers_income}}</td>
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

                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%">
                                                        <tr>
                                                            <td colspan="4"><b>{{$student->preaddressline}}, {{$student->p_union}}, {{$student->p_thana}}, {{$student->p_district}}</b></td>
                                                        </tr>

                                                    </table>
                                                </td>

                                                <td>
                                                    <table width="100%">
                                                        <tr>
                                                            <td colspan="4"><b>{{$student->peraddressline}}, {{$student->per_union}}, {{$student->per_thana}}, {{$student->per_district}}</b></td>
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


        //         $("#presentDistrict").on('change', function (e) {
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
    </script>
    <script>
        //         $("#presentDistrict").on('change', function (e) {
        //             console.log(e);
        // //document.write('hello');
        //             var cat_id = e.target.value;
        // // document.write(cat_id);
        //             $.get('/district?cat_id=' + cat_id, function (data) {
        // //console.log(data);
        //                 $('#presentThana').empty();
        //                 $.each(data, function (index, subcatObj) {
        //                     $('#presentThana').append('<option value="' + subcatObj.goname + '">' + subcatObj.goname + '</option>');
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
        //                     $('#parmanentThana').append('<option value="' + subcatObj.goname + '">' + subcatObj.goname + '</option>');
        //                 })

        //             });
        //         });
        //     </script>
    //     <script>
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