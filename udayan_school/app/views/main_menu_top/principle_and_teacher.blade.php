@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Principal & Teachers</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <div class="tab-content">
                        <div class="panel-heading fdcl_panel">Principal</div>
                        <div class="fdcl_content_profile">
                            <center>
                                @if($headmaster!=""&&$headmaster!=null)
                                    <div class="col-sm-12">
                                        <div class="col-sm-4"></div>
                                        <div class="span3">
                                            @if($headmaster->image!=null)
                                                <img src="{{ URL::asset('uploads/'.$headmaster->image)}}" class="fdcl_image_profile_dir">
                                            @else
                                                <img src="{{ URL::asset('uploads/head.jpg')}}" class="fdcl_image_profile_dir">
                                            @endif
                                            <a href="{{ URL::to('profile_individual/'.$headmaster->idteacherinfo)}}"><h4>{{$headmaster->teacher_name}}</h4></a>
                                            <p>{{$headmaster->designation}}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($asstheadmaster!="[]")

                                    @foreach($asstheadmaster as $ast)

                                        <div class="col-sm-3">
                                            @if($ast->image!=null)
                                                <img src="{{ URL::asset('uploads/'.$ast->image)}}" class="fdcl_image_profile_dir">
                                            @else
                                                <img src="{{ URL::asset('uploads/maleandfemale.jpg')}}" class="fdcl_image_profile_dir">
                                            @endif

                                            <a href="{{ URL::to('profile_individual/'.$ast->idteacherinfo)}}"><h6>{{$ast->teacher_name}}</h6></a>

                                            <p> {{$ast->designation}}</p>
                                        </div>
                                    @endforeach
                                @endif
                            </center>
                        </div>
                    </div>

                    <br/>
                    @if($department!="[]")

                        @foreach($department as $dept)

                            <div class="tab-content">
                                <div class="panel-heading fdcl_panel">{{$dept->department_name}}</div>
                                <div class="fdcl_content_profile">
                                    <?php $teacherinfo = TeacherInfo::where('department','=',$dept->department_name)->orderBy('priority')->get();?>
                                    <center>
                                        @if($teacherinfo!="[]")
                                            @foreach($teacherinfo as $info)
                                                <div class="col-sm-3">
                                                    @if($info->image!=null)
                                                        <img src="{{ URL::asset('uploads/'.$info->image)}}" class="fdcl_image_profile_dir">
                                                    @else
                                                        <img src="{{ URL::asset('uploads/maleandfemale.jpg')}}" class="fdcl_image_profile_dir">
                                                    @endif
                                                    <a href="{{ URL::to('profile_individual/'.$info->idteacherinfo)}}"><h6>{{$info->teacher_name}}</h6></a>

                                                    <p>{{$info->designation}}</p>
                                                </div>
                                            @endforeach
                                        @endif
                                    </center>

                                </div>
                            </div>

                            <br/>
                        @endforeach
                    @endif


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