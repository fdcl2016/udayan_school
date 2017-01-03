@extends('master.master')
@section('header')
@stop
@section('content')


    <?php
    $rasel = 3;
    include_once(app_path().'/views/nav_config/a_email_and_sms_management.php');
    ?>

    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Send Message</h3></strong></div><br/>
        
            {{ Form::open(array('url'=>'/classwisemessage', 'class'=>'form-inline')) }}
         <div class="fdcl_content_profile">
                            <div class="widget-header" style="text-align: center">
                             @if(isset($shohag_msg))
                            <strong>{{$shohag_msg}}</strong>
                        @endif
                            </div>
                            <div class="widget-content">

                               <div class="control-group col-sm-5">
                                    <label class="control-label" for="subject_name">Select Class:</label>
                                    <div class="controls">
                                         <select name="cat" id="cat"  style="width:320px;">
                                             <option value="">Select Class</option>
                                                 @foreach($class as $cats)
                                                    <option value="{{$cats->class_name}}">{{$cats->class_name}}</option>
                                                 @endforeach
                                         </select>
                                    </div> <!-- /controls -->
                                </div>

                                <div class="control-group col-sm-5">
                                    <label class="control-label" for="subject_name">Select Section:</label>
                                    <div class="controls">
                                       <select name="sub" id="sub"  style="width:320px" required>

                                      </select>                                   
                                       </div> <!-- /controls -->
                                </div>

                                <div class="control-group col-sm-10">
                                    <label class="control-label" for="subject_name">Subject</label>
                                    <div class="controls">
                                        <input type="text" name="title" style="width:320px" required="required">
                                    </div> <!-- /controls -->
                                </div>

                                <div class="control-group col-sm-10">
                                    <label class="control-label" for="subject_name">Message</label>
                                    <div class="controls">
                                         <textarea  style="width:790px;height:100px" name="description"></textarea>
                                    </div> <!-- /controls -->
                                </div>

                   
                </div>
                <br/>
                  <button type="submit" class="btn btn-info"><i class="icon-forward"></i> Send</button>
                </div>
                
                  </div>
                </div>
            </form>
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
        $("#cat").on('change',function (e) {
            console.log(e);
//document.write('hello');
            var cat_id = e.target.value;
// document.write(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/ajax?cat_id=' +cat_id,function(data)
            {
//console.log(data);
                $('#sub').empty();
                $.each(data,function(index,subcatObj)
                {
                    $('#sub').append('<option value="'+subcatObj.section+'">'+subcatObj.section+'</option>');
                })

            });
        });
     </script>
@stop