<html>
<head>
</head>
<body>
<div style="margin-left: auto;margin-right: auto;width: 960px;background-color: ">
    <div style="width: 160px;float: left;margin-left: 12px;margin-top: 10px;">
        <?php

        $im = StudentInfo::where('idstudentinfo','=',$idstudent)->where('image','=','')->get();

        $imcnt = count($im);

       // if($imcnt!=0){

        ?>
        <img src="{{asset('/image/4d.gif')}}" width="100" height="80">


    </div>
    <div style="width: 60px; height:80px; float: left;" >
        {{--<img src="{{asset('/image/male.jpg')}}" width="150" height="150">--}}
    </div>

    <div style="width: 550px;float: left;text-align: center" >
        <h2 ><?php echo Config::get('schoolname.school');?></h2><p>
           3/3 ,  Fuller Road, Dhaka University Campus
        </p>
        <br/>
           <h3><b>ACADEMIC TRANSCRIPT</b><hr style="width: 300px"></h3>


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

                <tr style="text-align: center">
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

                <?php $sum=0; $count=0; $cgpa=0;  $gp = 0;

                $tst = TStudentResult::where('st_id','=',$idstudent)
                        ->leftjoin('subject',"subject.subject_name",'=',  't_st_result.subject','left')
                        ->orderBy('subject.priority','ASC')
                        ->get();
                ?>

                @foreach($tst as $r)

                    <tr style="text-align: center">
                        <td width="360px" style="text-align: left">&nbsp;&nbsp;{{$r->subject}}</td>


                            @if($term=='Half Yearly')


                                    <td width="110px">{{$r->h_ht}}</td><td width="107px">{{$r->h_mcq}}</td><td width="110px">{{$r->h_lab}}</td>
                            @else
                            <td>{{$r->gt_ht}}</td><td>{{$r->gt_mcq}}</td><td>{{$r->gt_lab}}</td>

                            @endif


                        <td width="80px" style="font-weight:bold">

                            @if($term=='Half Yearly')
                                {{$r->h_total}}
                            @else
                            {{$r->gt_total}}
                            @endif

                        </td>
                        <td width="100" style="text-align: left;font-weight:bold">

                            @if($term=='Half Yearly')
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$r->h_grade}}
                            @else
                                {{$r->gt_grade}}
                            @endif</td>
                        <td width="100" style="font-weight: bold">
                            @if($term=='Half Yearly')
                                &nbsp;&nbsp;{{$r->h_gp}}
                                <?php


                                    $gp = $gp + $r->h_gp;

                                ?>
                            @else
                                {{$r->gt_gp}}
                            @endif</td></td>
                    </tr>

                @endforeach

                <tr style="text-align: center">
                    <td colspan="4" style="text-align: center;font-weight: bold"> Total Marks and Total Grade Point</td>

                    <td >
                        <?php
                        $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$idstudent)->first();

                        ?>

                        <b>{{$st_rank->total_mark}}</b>

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
                        $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$idstudent)->first();

                        if($st_rank->grade =='F'){

                            echo "<b>0.0</b>";
                        }else{
                            echo"<b>" .$st_rank->cgpa."</b>" ;
                        }

                        ?></td><td style="text-align: center"><b>Merit Position</b></td><td colspan="2" style="text-align: center"><b>Attendance</b></td>

                </tr>

                <tr>
                    <td>&nbsp;&nbsp;Letter Grade</td><td style="text-align: center"><b>{{$st_rank->grade}}</b></td><td rowspan="2" style="text-align: center;font-size:24px"><b>{{$st_rank->rank}}</b></td><td style="text-align: left">&nbsp;Working Days</td><td style="text-align: center">N/A</td>

                </tr>

                <tr>
                    <td>&nbsp;&nbsp;Total Marks</td><td style="text-align: center;font-weight: bold">{{$st_rank->total_mark}}</td><td style="text-align: left">&nbsp;Attendance</td><td style="text-align: center">N/A</td>

                </tr>

             </table>

        </div>


        <div style="width: 960px;float: left;margin-left: 12px;margin-top: 40px">




            <table style="border-collapse: collapse;letter-spacing: 1px;width: 100%;" border="1" >



                <tr style="border: 1px solid">
                    <td style="padding: 10px;text-align: left">
                    <p style="margin-top: 1px;"> <b>Remarks :</b>  <?php

                        $st1_rank = StudentRank::where('term','=','half yearly')->where('student_id','=',$stid)->first();
                        echo $st1_rank->comment;
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


         

            

            <th width="200px"> <br/><br/><br/><br/>
                <hr style="width: 180px;"/>
                <p>Class Teacher's Signature</p></th>

                <th width="15px"></th>

            <th width="15px"></th>

            <th width="200px"> <br/><br/><br/><br/>
                <hr style="width: 180px;"/>
                <p>Parents/Guardian  Signature</p>
            </th>

               <th width="200px">
                <br/><br/><br/><br/>
                <hr style="width: 180px;"/>
                <p>Principal's Signature</p>
            </th>

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
{{Form::open(array('url'=>'/report'))}}
{{Form::hidden('sid',$idstudent)}}
{{Form::hidden('idclasssection',$idclasssection)}}
{{Form::hidden('term',$term)}}
{{Form::hidden('class_name',$classsection->class_name)}}
{{Form::hidden('section',$classsection->section)}}
{{Form::hidden('st_id',$stid)}}
{{Form::hidden('year',$year)}}
<center> <input type="submit" style="height: 40px;width: 320px;background-color: #0098d0" value="Download This Report Card"></center>
{{Form::close()}}
</body>
</html>