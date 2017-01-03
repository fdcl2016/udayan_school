@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Result Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                         <li>
                            <a href="{{ URL::to('/tabulationsheet')}}">Tabulation Sheet</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/tabulationsheet_all')}}">Tabulation Sheet All</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/result_management/search_report_card')}}">Search Report Card</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Report Card</h3></strong></div><br/>

                            <div class="widget-header"></div>
                            <div class="widget-content" style="background: url('images/4d.gif') no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
                               <div class="col-sm-12">
                                   <div class="col-sm-2"><img src="{{ URL::asset('image/4d.gif')}}" height="50px;" width="50px;"></div>
                                   <div class="col-sm-2"></div>
                                   <div class="col-sm-8"><h2 style="margin-left: 25px;"><?php echo Config::get('schoolname.school');?></h2></div>
                               </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-5">
                                    </div>
                                   <center><div class="col-sm-2" style="background-color: #BEE9EA">
                                        <p style="font-size: 15px">Progress Report</p>
                                        <p style="font-size: 10px"><b>Scholastic Year </b>: {{AcademicYear::orderBy('academic_year','DESC')->first()->academic_year;}}</p>
                                           <p style="font-size: 10px"><b>Term </b>: Final</p>
                                    </div></center>
                                    <div class="col-sm-5">
                                    </div>
                                </div>
                                <div class="col-sm-12"><br/><br/></div>
                                <hr style="border: 1px solid;"/>
                                <div class="col-sm-12">
                                    <div class="col-sm-2"><b>Roll </b>: 117</div>
                                    <div class="col-sm-4"><b>Student Name </b>: {{$student_name}}</div>
                                    @if($classsection!="")
                                    <div class="col-sm-2"><b>Class </b>: {{$classsection->class}}</div>
                                    <div class="col-sm-2"><b>Section </b>: {{$classsection->section}}</div>
                                    <div class="col-sm-2"><b>Shift </b>: {{$classsection->shift}}</div>
                                        @endif
                                </div>
                                <hr style="border: 1px solid;"/>

                                <div class="col-sm-12"><br/><br/></div>
                                <div class="col-sm-12">
                                    <div class="col-sm-8">
                                        <table class="table table-bordered" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Mark</th>
                                                <th>Grade</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($result as $r)
                                            <tr>
                                                <td width="50%">{{$r->subject_name}}</td>
                                                <td>{{$r->HT_Marks}}</td>
                                                <td>4.75</td>
                                            </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Total</th>
                                                <th>723</th>
                                                <th>4.35</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="col-sm-4" style="border: 1px solid">
                                        <div class="col-sm-12" style="text-align: center"><h4>Remarks</h4></div>
                                        <div class="col-sm-12"></div>
                                        <div class="col-sm-12"></div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-6">______________</div>
                                            <div class="col-sm-6">______________</div>
                                            <div class="col-sm-6">Guardian</div>
                                            <div class="col-sm-6">Class Teacher</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12"><br/><br/></div>
                          <center><div class="col-sm-12">
                                    {{Form::open(array('url'=>'report_card'))}}
                                  {{Form::hidden('student_name',$student_name)}}
                                  {{Form::hidden('classsection',$classsection)}}
                                  {{Form::hidden('result',$result)}}
                                    {{Form::submit('download')}}
                                    {{Form::close()}}
                                </div>
                          </center>
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