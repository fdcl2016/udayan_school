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
                        <li class="active">
                            <a href="{{ URL::to('/grace_management')}}">Grace Management</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Mark Details</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
                            <br><br>
                            <?php $id = $result->st_id; $stu = Studentinfo::where('idstudentinfo','=',$id)->first(); ?>
                            <div class="widget-header" style="text-align: center"><b>Name :</b> {{$stu->sutdent_name}} &nbsp; <b>Roll :</b> {{$stu->student_roll}} &nbsp; <b>Term :</b> Final</div>
                            <div class="widget-content">
                        <div class="table-responsive" style="padding-left:3%;padding-right:3%">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="resource-name" style="text-align: center">Subject Name</th>
                                    <th class="resource-link" style="text-align: center">Marks</th>
                                    <th class="resource-link" style="text-align: center">Grade</th>
                                    <th class="resource-link" style="text-align: center">Deviation</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($results as $rslt)
                                <?php $rtm=0; $ctm=0; $htm=0; $ltm=0; $mcqm=0; $tmm=0; $dev=0;

                                $total = $rslt->total;
/*
                                if(isset($rslt->RT_Marks)) $rtm=$rslt->RT_Marks; else $rtm= 0;
                                if(isset($rslt->CT_Marks))$ctm = $rslt->CT_Marks; else $ctm= 0;
                                if(isset($rslt->HT_Marks)) $htm = $rslt->HT_Marks; else $htm= 0;
                                if(isset($rslt->LT_Marks)) $ltm = $rslt->LT_Marks; else $ltm= 0;
                                if(isset($rslt->MCQ_Marks)) $mcqm = $rslt->MCQ_Marks; else $mcqm = 0; */
                                $tmm = $rslt->gt_total; // $rtm + $ctm +$htm +$ltm +$mcqm;
                                $tmm = ceil($tmm/2);
                                $grade= GradingTable::where('total','=', $total)->where('highest_range', '>=', $tmm )->where('lowest_range', '<=', $tmm )->first();

                                 $gl= $grade->grade;
                                 if($gl== "F") $dev= ($grade->highest_range - $tmm)+1;
                                 if($result->class != "Nine" && $result->class != "Ten")
                                 {
                                    if($tmm < ($total/2))
                                    {
                                      $gl="F";
                                      $dev= (($total/2) - $tmm);

                                    }
                                 }
                                 ?>

                                @if($gl=="F")

                                <tr style="color: #ff0000">
                                @else <tr>
                                @endif
                                    <td style="text-align: center">{{$rslt->subject}}</td>
                                    <td style="text-align: center">{{$tmm}}</td>
                                    <td style="text-align: center">{{$gl}}</td>
                                     <td style="text-align: center">{{$dev}}</td>
                                </tr>

                                @endforeach

                                </tbody>
                            </table>
                            @if($st_rank->pass_type == "fail")
                            {{Form::open(['url'=>'spc_grant'])}}



                            {{Form::hidden('student_id',$id)}}
                            {{Form::hidden('year',$year)}}
                            <center>Comment : <input name="comment" type="text" />
                            <button type="submit" class="btn btn-info">Promote Student</button> </center>
                            {{Form::close()}}
                           @else <center><br><div style="color: green; font-size: 16px; font: tahoma ">{{"This student has been promoted."}} </div></center><br>@endif

                        </div>
                      </div>
                    </div>
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