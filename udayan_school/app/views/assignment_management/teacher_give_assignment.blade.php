@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Assignment Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">


                        <li class="active"><a href="{{ URL::to('/assignment_management/teacher_give_assignment')}}">Assignment</a></li>
                        <li class=""><a href="{{ URL::to('/assignment_management/view_assignment')}}">View Assignment</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Send Assignment</h3></strong></div><br/>

                        {{ Form::open(array('url'=>'classwiseassignment','class'=>'form-inline','files'=>true))}}
                        <div class="fdcl_content_profile">
                            <div class="widget-header">

                                @if (Session::has('errors'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success'); }}
                                    </div>
                                @endif
                            </div>
                            <div class="widget-content">


                                <div class="col-sm-5">
                                    <label class="control-label" for="subject_name">Select Class:</label>
                                    <div class="controls">
                                        <select name="cat" id="cat"  style="width:320px;">
                                            <option value="">Select Class</option>
                                       @foreach($class as $cl)
                                           <?php  

                                         //  $ac =Addclass::where('class_id','=',$cl->idclasssection)->first(); 

                                            ?>
                                                 <option value="{{$cl->class_name}}">{{$cl->class_name}}</option>
                                       @endforeach
                                        </select>
                                    </div> <!-- /controls -->
                                </div>

                                <div class="control-group col-sm-5">
                                    <label class="control-label" for="subject_name">Select Section:</label>
                                    <div class="controls">
                                        <select name="sub" id="sub"  style="width:320px" required>
                                            <option value="">Select Section</option>
                                        </select>
                                    </div> <!-- /controls -->
                                </div>

                                <div class="control-group col-sm-5">
                                    <div class="form-group">
                                        <label>Select Year:</label>
                                        <select name="yr"   class="form-control">

                                            <?php
                                            $ac = AcademicYear::all();
                                            ?>
                                            @foreach($ac as $a)
                                                <option value="{{$a->academic_year}}">{{$a->academic_year}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group col-sm-5">
                                    <label class="control-label" for="subject_name">Subject</label>
                                    <div class="controls">
                                        <!--  <input type="text" name="title" style="width:320px" required="required"> -->
                                        <select name="title" id="cat"  style="width:320px;">

                                            <?php
                                            $ct = Courseteacher::where('idteacherinfo','=',Auth::user()->user_id)->pluck('idsubject');

                                            $sb = Subject::where('idsubject','=',$ct)->get();

                                            ?>
                                            <option value="">Select Subject</option>
                                            @foreach($sb as $s)
                                                <option value="{{$s->subject_name}}">{{$s->subject_name}}</option>
                                            @endforeach
                                        </select>
                                    </div> <!-- /controls -->
                                </div>

                                <div class="control-group col-sm-10">
                                    <label class="control-label" for="subject_name">Topic</label>
                                    <div class="controls">
                                        <input type="text" style="width:790px" name="topic" />
                                    </div> <!-- /controls -->
                                </div>
                                <div class="control-group col-sm-10">
                                    <label class="control-label" for="subject_name">Task</label>
                                    <div class="controls">
                                        <textarea  style="width:790px;height:100px" name="description"></textarea>
                                    </div> <!-- /controls -->
                                </div>

                                <div class="control-group col-sm-6">
                                    <label class="control-label" for="filename">PDF/Photo</label>
                                    <div class="controls">
                                        <input type="file" class="span4" name="filename" value="" />
                                    </div> <!-- /controls -->
                                </div>

                                <div class="control-group col-sm-12">
                                    <label class="control-label" for="author">Authorised By</label>
                                    <div class="controls">
                                        <input type="text" class="span9" name="author" value="{{Auth::user()->username}}" readonly>
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