@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-user"></i>

                <h3>My Profile</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    @if($profile!=""&&Auth::user()->type=="admin")
                        <div class="fdcl_content_profile">
                            <div class="tab-content">

                                <div class="col-sm-12">
                                    <div class="col-sm-4"></div>
                                    <center><div class="span3" style="margin-left: auto;margin-right: auto">
                                            <h3>{{$profile->teacher_name}}</h3>
                                            <h4>{{$profile->personal_mobile}}</h4>
                                            <h4>{{$profile->email}}</h4>
                                        </div></center>
                                    @if($profile->image!=null)
                                        <div class="span2"><div class="span2"><img src="{{ URL::asset('/uploads/'.$profile->image)}}" class="fdcl_image_profile"></div></div>
                                    @else
                                        <div class="span2"><div class="span2"><img src="{{ URL::asset('uploads/maleandfemale.jpg')}}" class="fdcl_image_profile"></div></div>
                                    @endif
                                </div>
                            </div>
                            <br/><br/>
                            <div class="tab-content widget-content">
                                <div class="panel-heading fdcl_panel">Basic Information</div>
                                <div class="col-sm-10">
                                    <div class="span3"><b>Registration Number :</b> {{$profile->teacher_id}} </div>
                                </div>
                                     <div class="col-sm-10">
                                    <div class="span3"><b>Department :</b> {{$profile->department}} </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="span3"><b>Father's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b> {{$profile->father_name}}</div>
                                    <div class="span2"><b>Occupation :</b> {{$profile->fathers_occupation}}</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="span3"><b>Mother;s Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{$profile->mother_name}} </div>
                                    <div class="span2"><b>Occupation :</b> {{$profile->mothers_occupation}}</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="span3"><b>Date of Birth &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{$profile->dateofbirth}}</div>
                                    <div class="span2"><b>Religion :</b> {{$profile->religion}}</div>
                                    <div class="span2"><b>Gender :</b> {{$profile->gender}}</div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="span3"><b>Mobile 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{$profile->teacher_mobile1}}</div>
                                    <div class="span2"><b>Mobile 2 :</b> {{$profile->teacher_mobile1}}</div>
                                    <div class="span3"><b>Email :</b> {{$profile->email}}</div>
                                </div>
                            </div>
                            <br/><br/>
                            <div class="tab-content widget-content table-responsive">
                                <div class="panel-heading fdcl_panel">Address</div>
                                <table class="table-bordered" style="border-collapse: collapse" width="100%">
                                    <tr>
                                        <td colspan="8">
                                            <div class="panel fdcl_panel_sub ">Present Address</div>
                                            <div class=""><b>Address Line :</b> {{$profile->preaddress_line}} </div>
                                            <div class=""><b>District :</b> {{$profile->p_district}} </div>
                                            <div class=""><b>Thana :</b> {{$profile->p_thana}} </div>
                                            <div class=""><b>Union :</b> {{$profile->p_union}} </div>
                                        </td>
                                        <td colspan="8">
                                            <div class="panel fdcl_panel_sub ">Permanent Address</div>
                                            <div class=""><b>Address Line :</b> {{$profile->peraddress_line}} </div>
                                            <div class=""><b>District :</b> {{$profile->per_district}} </div>
                                            <div class=""><b>Thana :</b> {{$profile->per_thana}} </div>
                                            <div class=""><b>Union :</b> {{$profile->per_union}} </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    @endif

                    @if($profile!=""&&Auth::user()->type=="teacher")
                        <div class="fdcl_content_profile">
                            <div class="tab-content">

                                <div class="col-sm-12">
                                    <div class="col-sm-4"></div>
                                    <center><div class="span3" style="margin-left: auto;margin-right: auto">
                                            <h3>{{$profile->teacher_name}}</h3>
                                            <h4>{{$profile->personal_mobile}}</h4>
                                            <h4>{{$profile->email}}</h4>
                                        </div></center>
                                    @if($profile->image!=null)
                                        <div class="span2"><div class="span2"><img src="{{ URL::asset('/uploads/'.$profile->image)}}" class="fdcl_image_profile"></div></div>
                                    @else
                                        <div class="span2"><div class="span2"><img src="{{ URL::asset('uploads/maleandfemale.jpg')}}" class="fdcl_image_profile"></div></div>
                                    @endif
                                </div>
                            </div>
                            <br/><br/>
                            <div class="tab-content widget-content">
                                <div class="panel-heading fdcl_panel">Basic Information</div>
                                <div class="col-sm-10">
                                    <div class="span3"><b>Registration Number :</b> {{$profile->teacher_id}} </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="span3"><b>Father's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b> {{$profile->father_name}}</div>
                                    <div class="span2"><b>Occupation :</b> {{$profile->fathers_occupation}}</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="span3"><b>Mother;s Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{$profile->mother_name}} </div>
                                    <div class="span2"><b>Occupation :</b> {{$profile->mothers_occupation}}</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="span3"><b>Date of Birth &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{$profile->dateofbirth}}</div>
                                    <div class="span2"><b>Religion :</b> {{$profile->religion}}</div>
                                    <div class="span2"><b>Gender :</b> {{$profile->gender}}</div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="span3"><b>Mobile 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{$profile->teacher_mobile1}}</div>
                                    <div class="span2"><b>Mobile 2 :</b> {{$profile->teacher_mobile1}}</div>
                                    <div class="span3"><b>Email :</b> {{$profile->email}}</div>
                                </div>
                            </div>
                            <br/><br/>
                            <div class="tab-content widget-content table-responsive">
                                <div class="panel-heading fdcl_panel">Address</div>
                                <table class="table-bordered" style="border-collapse: collapse" width="100%">
                                    <tr>
                                        <td colspan="8">
                                            <div class="panel fdcl_panel_sub ">Present Address</div>
                                            <div class=""><b>Address Line :</b> {{$profile->preaddress_line}} </div>
                                            <div class=""><b>District :</b> {{$profile->p_district}} </div>
                                            <div class=""><b>Thana :</b> {{$profile->p_thana}} </div>
                                            <div class=""><b>Union :</b> {{$profile->p_union}} </div>
                                        </td>
                                        <td colspan="8">
                                            <div class="panel fdcl_panel_sub ">Permanent Address</div>
                                            <div class=""><b>Address Line :</b> {{$profile->peraddress_line}} </div>
                                            <div class=""><b>District :</b> {{$profile->per_district}} </div>
                                            <div class=""><b>Thana :</b> {{$profile->per_thana}} </div>
                                            <div class=""><b>Union :</b> {{$profile->per_union}} </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    @endif
                    
                       @if($profile!=""&&Auth::user()->type=="bank")
                            <div class="fdcl_content_profile">
                                <div class="tab-content">

                                    <div class="col-sm-12">
                                        <div class="col-sm-4"></div>
                                        <center><div class="span3" style="margin-left: auto;margin-right: auto">
                                                <h3>{{$profile->teacher_name}}</h3>
                                                <h4>{{$profile->personal_mobile}}</h4>
                                                <h4>{{$profile->email}}</h4>
                                            </div></center>
                                        @if($profile->image!=null)
                                            <div class="span2"><div class="span2"><img src="{{ URL::asset('/uploads/'.$profile->image)}}" class="fdcl_image_profile"></div></div>
                                        @else
                                            <div class="span2"><div class="span2"><img src="{{ URL::asset('uploads/maleandfemale.jpg')}}" class="fdcl_image_profile"></div></div>
                                        @endif
                                    </div>
                                </div>
                                <br/><br/>
                                <div class="tab-content widget-content">
                                    <div class="panel-heading fdcl_panel">Basic Information</div>
                                    <div class="col-sm-10">
                                        <div class="span3"><b>Registration Number :</b> {{$profile->teacher_id}} </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="span3"><b>Father's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b> {{$profile->father_name}}</div>
                                        <div class="span2"><b>Occupation :</b> {{$profile->fathers_occupation}}</div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="span3"><b>Mother;s Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{$profile->mother_name}} </div>
                                        <div class="span2"><b>Occupation :</b> {{$profile->mothers_occupation}}</div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="span3"><b>Date of Birth &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{$profile->date_of_birth}}</div>
                                        <div class="span2"><b>Religion :</b> {{$profile->religion}}</div>
                                        <div class="span2"><b>Gender :</b> {{$profile->gender}}</div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="span3"><b>Mobile 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{$profile->teacher_mobile1}}</div>
                                        <div class="span2"><b>Mobile 2 :</b> {{$profile->teacher_mobile1}}</div>
                                        <div class="span3"><b>Email :</b> {{$profile->email}}</div>
                                    </div>
                                </div>
                                <br/><br/>
                                <div class="tab-content widget-content table-responsive">
                                    <div class="panel-heading fdcl_panel">Address</div>
                                    <table class="table-bordered" style="border-collapse: collapse" width="100%">
                                        <tr>
                                            <td colspan="8">
                                                <div class="panel fdcl_panel_sub ">Present Address</div>
                                                <div class=""><b>Address Line :</b> {{$profile->preaddress_line}} </div>
                                                <div class=""><b>District :</b> {{$profile->p_district}} </div>
                                                <div class=""><b>Thana :</b> {{$profile->p_thana}} </div>
                                                <div class=""><b>Union :</b> {{$profile->p_union}} </div>
                                            </td>
                                            <td colspan="8">
                                                <div class="panel fdcl_panel_sub ">Permanent Address</div>
                                                <div class=""><b>Address Line :</b> {{$profile->peraddress_line}} </div>
                                                <div class=""><b>District :</b> {{$profile->per_district}} </div>
                                                <div class=""><b>Thana :</b> {{$profile->per_thana}} </div>
                                                <div class=""><b>Union :</b> {{$profile->per_union}} </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                        @endif


                    @if($profile!=""&&Auth::user()->type=="student")
                        <div class="fdcl_content_profile">
                            <div class="tab-content">

                                <div class="col-sm-12">
                                    <div class="col-sm-4"></div>
                                    <center><div class="span3" style="margin-left: auto;margin-right: auto">
                                            <h3>{{$profile->sutdent_name}}</h3>
                                            <h4>{{$profile->mobile1}}</h4>
                                            <h4>{{$profile->email}}</h4>
                                        </div></center>
                                    @if($profile->image!=null)
                                        <div class="span2"><div class="span2"><img src="{{ URL::asset('/uploads/'.$profile->image)}}" class="fdcl_image_profile"></div></div>
                                    @else
                                        <div class="span2"><div class="span2"><img src="{{ URL::asset('uploads/maleandfemale.jpg')}}" class="fdcl_image_profile"></div></div>
                                    @endif
                                </div>
                            </div>
                            <br/><br/>
                            <div class="tab-content widget-content">
                                <div class="panel-heading fdcl_panel">Basic Information</div>
                                <div class="col-sm-10">
                                    <div class="span3"><b>Registration Number :</b> {{$profile->registration_id}} </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="span3"><b>Father's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b> {{$profile->father_name}}</div>
                                    <div class="span2"><b>Occupation :</b> {{$profile->fathers_occupation}}</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="span3"><b>Mother;s Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{$profile->mother_name}} </div>
                                    <div class="span2"><b>Occupation :</b> {{$profile->mothers_occupation}}</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="span3"><b>Date of Birth &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{$profile->date_of_birth}}</div>
                                    <div class="span2"><b>Religion :</b> {{$profile->religion}}</div>
                                    <div class="span2"><b>Gender :</b> {{$profile->gender}}</div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="span3"><b>Mobile 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{$profile->teacher_mobile1}}</div>
                                    <div class="span2"><b>Mobile 2 :</b> {{$profile->mobile2}}</div>
                                    <div class="span3"><b>Email :</b> {{$profile->email}}</div>
                                </div>
                            </div>
                            <br/><br/>
                            <?php $classtosection = StudentToSectionUpdate::where('student_idstudentinfo','=',$profile->idstudentinfo)->orderBy('year','DESC')->get();?>
                            <div class="tab-content widget-content">
                                <div class="panel-heading fdcl_panel">Academic Information (Present)</div>
                                @foreach($classtosection as $ac)
                                    <div class="col-sm-12"><div class="span3 fdcl_panel-title fdcl_font_sub_title">{{$ac->year}}</div></div>
  <div class="col-sm-12"></div>
<br/>
                                    <div class="col-sm-12">
                                        <div class="span3"><b>Class :</b> {{$ac->class}}</div>
                                        <div class="span2"><b>Section :</b> {{$ac->section}}</div>
                                        <div class="span2"><b>Shift :</b> {{$ac->shift}}</div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="span3"><b>Session :</b> {{$ac->year}} </div>
                                        <div class="span2"><b>Result(Last Exam) :</b> {{$ac->resultCGPA}}</div>
                                    </div>
                                @endforeach
                            </div>
                            <br/><br/>
                            <div class="tab-content widget-content table-responsive">
                                <div class="panel-heading fdcl_panel">Address</div>
                                <table class="table-bordered" style="border-collapse: collapse" width="100%">
                                    <tr>
                                        <td colspan="8">
                                            <div class="panel fdcl_panel_sub ">Present Address</div>
                                            <div class=""><b>Address Line :</b> {{$profile->preaddressline}} </div>
                                            <div class=""><b>District :</b> {{$profile->p_district}} </div>
                                            <div class=""><b>Thana :</b> {{$profile->p_thana}} </div>
                                            <div class=""><b>Union :</b> {{$profile->p_union}} </div>
                                        </td>
                                        <td colspan="8">
                                            <div class="panel fdcl_panel_sub ">Permanent Address</div>
                                            <div class=""><b>Address Line :</b> {{$profile->peraddressline}} </div>
                                            <div class=""><b>District :</b> {{$profile->per_district}} </div>
                                            <div class=""><b>Thana :</b> {{$profile->per_thana}} </div>
                                            <div class=""><b>Union :</b> {{$profile->per_union}} </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    @endif
                </div>

            </div>
            <!-- /widget-content -->

        </div>
        <!-- /widget -->

    </div> <!-- /span8 -->

@stop
@section('content_footer')
@stop