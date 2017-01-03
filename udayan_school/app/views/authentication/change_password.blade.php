@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Authentication Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Change Password</h3></strong></div><br/>

                        {{Form::open(array('url'=>'post_change_password','class'=>'form-horizontal','files'=>'true'))}}
                        <fieldset>

                            <div class="control-group col-sm-12">
                                <label class="control-label" for="old_password">Old Password</label>
                                <div class="controls">
                                    <input type="password" class="span9" name="old_password" id="oldpassword" placeholder="old password" onkeyup="checkPassword()"  required>
                                </div> <!-- /controls -->
                                <div><span class="spansohel"><p id="erroroldpassword" style="color: red;"></p></span></div>
                            </div> <!-- /control-group -->

                            <div class="control-group col-sm-12">
                                <label class="control-label" for="new_password">New Password</label>
                                <div class="controls">
                                    <input type="password" class="span9" name="new_password" id="newpassword" placeholder="new password" onkeyup="checkPassword()" required>
                                </div> <!-- /controls -->
                                <div><span class="spansohel"><p id="errornewpassword" style="color: red;"></p></span></div>
                            </div> <!-- /control-group -->
                            <div class="control-group col-sm-12">
                                <label class="control-label" for="confirm_new_password">Confirm New Password</label>
                                <div class="controls">
                                    <input type="password" class="span9" name="confirm_new_password" id="confirmnewPassword" onkeyup="checkPassword()" placeholder="confirm new password" required>

                                </div> <!-- /controls -->
                                <div><span class="spansohel"><p id="errorconfirmpassword" style="color: red;"></p></span></div>
                            </div> <!-- /control-group -->

                            <br /><br />
                            <div class="control-group col-sm-12">
                                <div class="controls">
                                    <button type="submit" id="button" class="btn btn-primary"><i class="icon-save"></i> Save</button>
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
    <style>
        .spansohel{
            color: red;
            font-size: 20px;
        }
    </style>
        <script>

//            $("#oldpassword").on('keyup',function (e) {
////                console.log(e);
//                var oldpassword = e.target.value;
//                $.get('/ajaxpass?password=' + oldpassword,function(data) {
////                    console.log(data);
//                            $('#erroroldpassword').empty();
//
//                            if (data == 'false') {
//                                document.getElementById('erroroldpassword').innerHTML = 'Password not correct';
//                                document.getElementById('button').disabled = true;
//                            }
//                            else
//                            {
//                                document.getElementById('erroroldpassword').innerHTML = null;
//                            }
//                        }
//
//                )
//
//                });

            function checkPassword()
            {

                var newPassword = document.getElementById('newpassword').value;
                document.getElementById('errorconfirmpassword').innerHTML = null;
                var confirmnewPassword = document.getElementById('confirmnewPassword').value;
                var oldpassword = document.getElementById('oldpassword').value;

                $.get('/ajaxpass?password=' + oldpassword,function(data) {
//                    console.log(data);
                            $('#erroroldpassword').empty();

                            if (data == 'false') {
                                document.getElementById('erroroldpassword').innerHTML = 'Password not correct';
                                document.getElementById('button').disabled = true;
                            }
                            else
                            {
                                document.getElementById('erroroldpassword').innerHTML = null;
                            }
                        }

                )

                if (newPassword.length < 6 && newPassword==oldpassword) {
                    document.getElementById('errornewpassword').innerHTML = "Password need at least 6 characters and New password can not match with old Password";
                    document.getElementById('button').disabled = true;
                }
                else if(newPassword.length >= 6 && newPassword==oldpassword){
                    document.getElementById('errornewpassword').innerHTML = "New password can not match with old Password";
                    document.getElementById('button').disabled = true;
                }

                else if (newPassword.length < 6 && newPassword!=oldpassword && newPassword!="") {
                    document.getElementById('errornewpassword').innerHTML = "Password need at least 6 characters";
                    document.getElementById('button').disabled = true;
                }
                else{
                    document.getElementById('errornewpassword').innerHTML = null;
                }

                if (confirmnewPassword == newPassword && newPassword!=oldpassword && newPassword.length >= 6) {
                    document.getElementById('confirmnewPassword').style.border = '1px solid #ccc';
                    document.getElementById('button').disabled = false;
                }
                else if (confirmnewPassword != newPassword && newPassword!=oldpassword) {
                    document.getElementById('confirmnewPassword').style.border = '1px solid red';
                    document.getElementById('errorconfirmpassword').innerHTML = "Password Mismatch";
                    document.getElementById('button').disabled = true;
                }

                else if(confirmnewPassword == newPassword  && newPassword==oldpassword)
                {
                    document.getElementById('errornewpassword').innerHTML = "New password can not match with old Password";
                }
                else {

                    if (confirmnewPassword != "" && confirmnewPassword != null) {
                        document.getElementById('confirmnewPassword').style.border = '1px solid red';
                        document.getElementById('errorconfirmpassword').innerHTML = "Password Mismatch";
                    }
                    document.getElementById('button').disabled = true;
                }
            }
        </script>
@stop