@extends('master.master')
@section('header')
@stop
@section('content')


    <?php
    $rasel = 1;
    include_once(app_path().'/views/nav_config/a_email_and_sms_management.php');
    ?>


    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Send Email</h3></strong></div><br/>
                    {{ Form::open(array('url'=>'email_and_sms_management/email', 'class'=>'form-inline')) }}
                        <div class="fdcl_content_profile">
                        <div class="widget-header"></div>
                        <div class="widget-content">
                        <div class="form-group">
                            <input name="subject" id="subject" placeholder="Subject" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <select name="recipient" id="recipient" class="form-control" required>
                                <option value=""> Select recipient</option>
                                @if($class!=null)
                                    @foreach($class as $c)
                                        <option value="{{$c->class_name}}">{{$c->class_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="message" id="message" class="form-control" style="height: 150px;" placeholder="Leave your message here" required></textarea>
                        </div>
                    <br/>
                   <button type="submit" class="btn btn-info"><i class="icon-forward"></i> Send</button>
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
@stop