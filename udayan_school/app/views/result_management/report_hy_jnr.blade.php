<html>
<head>
</head>
<body>
<div style="margin-left: auto;margin-right: auto;width: 960px; ">
    <div style="width: 160px;float: left;margin-left: 12px;margin-top: 10px;">
        <?php

        $im = StudentInfo::where('idstudentinfo','=',$idstudent)->where('image','=','')->get();

        $imcnt = count($im);

        // if($imcnt!=0){

        ?>
        <img src="{{asset('/image/4d.gif')}}" width="110" height="70">


    </div>

    <div style="width: 750px;float: left;text-align: center;margin-top: 25px" >
        <h1 style="margin-left: -100px;color:#2b4167;font-family: Arial"><?php echo Config::get('schoolname.school');?></h1><p style="font-size: 22px;margin-left: -100px;color: #2b4167;font-weight: bold;font-family: Arial">
             University of Dhaka
        </p>

        <h3 style="margin-left: -100px;"><b>ACADEMIC TRANSCRIPT</b><hr style="width: 300px"></h3>
        @if($term=='Final')
        <h3 style="margin-left: -100px;"><b>Second Semester Examination</b></h3>
        @else
            <h3 style="margin-left: -100px;"><b>First Semester Examination</b></h3>
        @endif

    </div>

    <table width="100%" style="background-color: ">

    </table>
</div>
<div style="margin-left: auto;background-color: ;margin-right: auto;width: 960px;">

    <?php


    $s = StudentToSectionUpdate::where('student_idstudentinfo','=',$idstudent)->first();

    $ver = Addclass::where('class_name','=',$s->class)->first();

    $sn = Studentinfo::where('registration_id','=',$idstudent)->pluck('sutdent_name');

    ?>

    <div style="width: 160px;float: left;margin-left: 12px;margin-top: 30px;">
        <?php

        $im = StudentInfo::where('idstudentinfo','=',$idstudent)->where('image','=','')->get();

        $imcnt = count($im);

        if($imcnt!=0){

        ?>

        <img src="{{asset('/image/maleandfemale.jpg')}}" width="130" height="140">


        <?php
        }
        else{
        ?>

        <img src="{{asset('/uploads/'.$idstudent.'.PNG')}}" width="130" height="140">

        <?php }
        ?>

    </div>

    <div style="width: 600px;float: left;margin-left: 3px;margin-top: 25px">

        <table >

            <tr>

                <td><b>Name :</b> &nbsp;&nbsp;{{$sn}}</td>

            </tr>

            <tr height="20">

                <td><br/><b>Class :</b> &nbsp;&nbsp;&nbsp;{{$s->class}}&nbsp;&nbsp;&nbsp;<b>Section :</b> &nbsp;&nbsp;&nbsp;{{$s->section}}</td>

            </tr>
            <tr>

                <td><br/><b>Roll &nbsp;&nbsp;:</b>&nbsp;&nbsp; {{$s->st_roll}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Student ID :</b> &nbsp;&nbsp;{{$idstudent}}</td>

            </tr>
            <tr>

                <?php
                if($ver->value != -1){
                    $v = "BANGLA";
                }else{
                    $v = "ENGLISH";
                }

                ?>
                <td><br/><b>Version :</b> &nbsp;&nbsp;{{$v}}&nbsp;&nbsp;&nbsp;<b> Year :</b> &nbsp;&nbsp;&nbsp;{{$year}}&nbsp;&nbsp;&nbsp;<b>Term :</b> &nbsp;&nbsp;&nbsp;{{$term}}</td>

            </tr>


        </table>


    </div>

    <div style="width: 150px;float: left;margin-left: 5px;position:relative;margin-top: -45px;margin-bottom: 20px">
        <img src="{{asset('/image/grade.png')}}" width="190" height="220">
    </div>

    <br/><br/><br/>

    <h3 style="margin-top: 15px"><br/><br/><br/><br/>OBTAINED MARK<hr/></h3>


    <div style="width: 960px;float: left;margin-left: 12px;margin-top: 25px">

        <table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >

            <tr style="text-align: center;font-family: Arial">
                <th width="360px" >Subject Name</th>
                <th width="300px" style="" colspan="3">

                    <table style="border-collapse: collapse;text-align: center;letter-spacing: 1px;width: 100%;" border="1">
                        <tr>Marks (in Percentage)</tr>
                        <tr>

                            <td width="110px">Creative</td><td width="115px">MCQ</td><td width="110px">Practical</td>
                        </tr>



                    </table>
                </th>
                <th width="100px" style="">Total Marks</th>
                <th width="80" style="">Grade</th>
                <th width="100" style="">GPA</th>
            </tr>

            <?php $sum=0; $count=0; $cgpa=0;  $gp = 0;$fail = null;

         $fst = AssignFourthSub::where('st_id','=',$idstudent)->first();

            $tst = ConvertedMarks::where('st_id','=',$idstudent)
                    ->where('term','=',$term)
                    ->where('subjectid','!=',$fst->idsubject)
                    ->leftjoin('subject',"subject.idsubject",'=',  'converted_marks.subjectid','left')
                    ->orderBy('subject.priority','ASC')
                    ->get();

            $tst1 = ConvertedMarks::where('st_id','=',$idstudent)
                    ->where('term','=',$term)
                    ->where('subjectid','=',$fst->idsubject)
                    ->leftjoin('subject',"subject.idsubject",'=',  'converted_marks.subjectid','left')
                    ->orderBy('subject.priority','ASC')
                    ->get();

            ?>

            @foreach($tst as $r)
<?php
                    $sb = Subject::where('idsubject','=',$r->subjectid)->pluck('subject_name');

   ?>
                <tr style="text-align: center;font-family: Arial">

                    <td width="360px" style="text-align: left;font-weight: bold">&nbsp;&nbsp;{{$sb}}</td>



                        <td width="110px">{{$r->cq_conv}}</td><td width="107px">{{$r->mcq_conv}}</td><td width="110px">{{$r->practical}}</td>



                    <td width="80px" style="font-weight:bold">

                            {{$r->total}}
                        <?php

                        $sum = $sum + $r->total;

                        $count++;

                            if($r->grade == 'F'){
                                $fail = 1;
                            }
                            else{
                                $fail = 0;
                            }
                        ?>

                    </td>
                    <td width="100" style="text-align: left;font-weight:bold">


                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$r->grade}}
                       </td>
                    <td width="100" style="font-weight: bold">

                            {{$r->point}}
                        <?php

                        $gp = $gp + $r->point;
                        ?>

                     </td></td>
                </tr>

            @endforeach
            @foreach($tst1 as $r1)
                <?php
                $sb = Subject::where('idsubject','=',$r1->subjectid)->pluck('subject_name');

                ?>
                <tr style="text-align: center">

                    <td width="360px" style="text-align: left;font-family: Arial;font-weight: bold">&nbsp;&nbsp;{{$sb}}{{" (Fourth Subject)"}}</td>



                    <td width="110px">{{$r1->cq_conv}}</td><td width="107px">{{$r1->mcq_conv}}</td><td width="110px">{{$r1->practical}}</td>



                    <td width="80px" style="font-weight:bold">

                        {{$r1->total}}
                        <?php

                        $sum = $sum + $r1->total;
                        ?>


                    </td>
                    <td width="100" style="text-align: left;font-weight:bold;font-family: Arial;text-align: center">


                       {{$r1->grade}}

                    </td>
                    <td width="100" style="font-weight: bold">

                        <?php

                        $gpa = $r1->point -2 ;

                         if($gpa < 0)   {
                             $gpa = 0;
                         }
                        ?>
                        {{$gpa}}
                        <?php

                        $gp = $gp + $gpa;
                        ?>
                    </td></td>
                </tr>

            @endforeach


            <tr style="text-align: center">
                <td colspan="4" style="text-align: center;font-weight: bold"> Total Marks and Total Grade Point</td>

                <td >
                    <?php
                    $st_rank = RankModel::where('term','=',$term)->where('stid','=',$idstudent)->first();

                    ?>

                    <b style="font-size: 18px">{{$sum}}</b>

                </td>
                <td></td>
                <td>
                    <b>{{$gp}}</b>
                </td>
            </tr>



        </table>


    </div>

    <br/>
    <br/>


    <div style="width: 960px;float: left;margin-left: 12px;margin-top: 40px">




        <table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >

            <tr>
                <td>&nbsp;&nbsp;<b>Grade Point Average (GPA</b>)</td><td style="text-align: center"> <?php
                 //   $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$idstudent)->first();

                 //   if($st_rank->grade =='F'){

                //        echo "<b>0.0</b>";
                 //   }else{
                 //       echo"<b>" .$st_rank->cgpa."</b>" ;


                 //   }



                    ?></td><td style="text-align: center"><b>Merit Position</b></td><td colspan="2" style="text-align: center"><b>Attendance</b></td>

            </tr>

            <tr>
                <td>&nbsp;&nbsp;Letter Grade</td><td style="text-align: center">

                    @if($fail==0)
                        <b>{{sprintf('%.2f',($gp / $count))}}</b>
                    @else
                        <b>{{"0.0"}}</b>
                    @endif


                </td><td rowspan="2" style="text-align: center;font-size:24px"><b>{{$st_rank->rank}}</b></td><td style="text-align: left">&nbsp;Working Days</td><td style="text-align: center">N/A</td>

            </tr>

            <tr>
                <td>&nbsp;&nbsp;Total Marks</td><td style="text-align: center;font-weight: bold">{{$sum}}</td><td style="text-align: left">&nbsp;Attendance</td><td style="text-align: center">N/A</td>

            </tr>

        </table>

    </div>


    <div style="width: 960px;float: left;margin-left: 12px;margin-top: 40px">




        <table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >



            <tr style="border: 1px solid">
                <td style="padding: 10px;text-align: left">
                    <p style="margin-top: 1px;"> <b>Remarks :</b>  <?php

                    //    $st1_rank = StudentRank::where('term','=','half yearly')->where('student_id','=',$stid)->first();

                       if($st_rank->rank != '0')   {
                        echo "Try hard for better result !!";
                        }else{
                        echo "You are failed , work hard !!";
                        }
                        ?>
                    </p>
                </td>
            </tr>

        </table>

    </div>


</div>
<br/>
<div style="width: 960px;margin-left: 200px;margin-right: auto">

    <br/><br/>
    <table width="960px" style="">
        <tr>






            {{--<th width="200px"> <br/><br/><br/><br/>--}}
                {{--<hr style="width: 180px;"/>--}}
                {{--<p>Class Teacher's Signature</p></th>--}}

            {{--<th width="15px"></th>--}}

            {{--<th width="15px"></th>--}}

            {{--<th width="200px"> <br/><br/><br/><br/>--}}
                {{--<hr style="width: 180px;"/>--}}
                {{--<p>Parents/Guardian  Signature</p>--}}
            {{--</th>--}}

            {{--<th width="200px">--}}
                {{--<br/><br/><br/><br/>--}}
                {{--<hr style="width: 180px;"/>--}}
                {{--<p>Principal's Signature</p>--}}
            {{--</th>--}}

        </tr>





    </table>
    <br/>
    <table>

        <tr>
            <h5 style="text-align: center"> Powered By :&nbsp;&nbsp;Four D Communications Limited<br/></td>
            </h5></tr>

    </table>

</div>
<br/>
{{--{{Form::open(array('url'=>'/report'))}}--}}
{{--{{Form::hidden('sid',$idstudent)}}--}}
{{--{{Form::hidden('idclasssection',$idclasssection)}}--}}
{{--{{Form::hidden('term',$term)}}--}}
{{--{{Form::hidden('class_name',$classsection->class_name)}}--}}
{{--{{Form::hidden('section',$classsection->section)}}--}}
{{--{{Form::hidden('st_id',$stid)}}--}}
{{--{{Form::hidden('year',$year)}}--}}
{{--<center> <input type="submit" style="height: 40px;width: 320px;background-color: #0098d0" value="Download This Report Card"></center>--}}
{{--{{Form::close()}}--}}
</body>
</html>