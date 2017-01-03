@extends('master.master')
@section('header')
@stop
@section('content')


    <?php
    $rasel = 2;
    include_once(app_path().'/views/nav_config/a_email_and_sms_management.php');
    ?>

    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Send SMS</h3></strong></div><br/>
                        {{ Form::open(array('url'=>'/sms_service', 'class'=>'form-inline','files'=>true)) }}
                        <div class="fdcl_content_profile">
                            <div class="widget-header" style="text-align: center"><strong>@if(isset($shohag_msg)) {{$shohag_msg}} @endif </strong></div>
                            <div class="widget-content">

                                <div class="form-group">
                                    <select name="recipient" id="recipient" class="form-control">
                                        <option value=""> Select recipient</option>
                                        @if($class!=null)
                                            @foreach($class as $c)
                                                <option value="{{$c->class_name}}">{{$c->class_name}}</option>
                                            @endforeach
                                        @endif
                                        <option value="teacher">All Teacher</option>
                                    </select>
                                </div>
                                <div>or</div><br/>
                                <div class="form-group">
                                    <input name="mobile" id="mobile" placeholder="01XXXXXXXXX" class="form-control" onkeyup="phonenumber('<?php echo "mobile"?>','<?php echo "button"?>','<?php echo "errorpremob"?>')" >

                                    <div><span><p id="errorpremob"
                                                  style="color: red;float:left"></p></span></div>
                                </div>

                                <div>or</div><br/>
                                <div class="form-group">
                                    <input name="file"  type="file">

                                    <div><span><p id="errorpremob"
                                                  style="color: red;float:left"></p></span></div>
                                </div>
                                <div class="form-group">
                                    <textarea name="message" id="message" class="form-control" style="height: 150px;" placeholder="Leave your message here within 150 letters" required></textarea>
                                    <p id="myLetterCount"></p>
                                </div>
                                <br/>
                               <button type="submit" class="btn btn-info" id="button"><i class="icon-forward"></i> Send</button>
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
    <script>
        function phonenumber(id, button, errorId) {
            var inputtxt = "";

            var inputtxt = document.getElementById(id).value;


            var phoneno = /^(?=019|018|017|016|015)\d{11}$/;
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

        var content;
        $('textarea').on('keyup', function(){
            var letters = $(this).val().length;
            $('#myLetterCount').text(150-letters+" letters left");
            // limit message
            if(letters>=150){
                $(this).val(content);
                alert('no more than 150 letters, please!');
            } else {
                content = $(this).val();
            }
        });
    </script>
@stop