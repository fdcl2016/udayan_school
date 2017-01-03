<html>
<head>
</head>
<body>
<div style="margin-left: auto;margin-right: auto;width: 960px;background-color: #fefff1">
    <div style="width: 160px;float: left;margin-left: 12px;margin-top: 30px;">
        <?php

        $im = StudentInfo::where('idstudentinfo','=',$idstudent)->where('image','=','')->get();

        $imcnt = count($im);

        if($imcnt!=0){

        ?>
        <img src="{{asset('/image/maleandfemale.jpg')}}" width="150" height="150">
        <?php
        }
        else{
        ?>

        <img src="{{asset('/uploads/'.$idstudent.'.PNG')}}" width="150" height="150">

        <?php }
        ?>
        <p style="text-align: center; margin-top: 5px;background-color: #CCC0DA">ID: {{$idstudent}}</p>
    </div>
    <div style="width: 60px; height:80px; float: left;" >
        {{--<img src="{{asset('/image/male.jpg')}}" width="150" height="150">--}}
    </div>

    <div style="width: 550px;float: left;text-align: center" >
        <img src="{{asset('/image/4d.gif')}}" width="112px" height="68px">&nbsp<h2 ><?php echo Config::get('schoolname.school');?></h2>
        <h2>Progress Report</h2>

        <h3><b>Term :</b>  {{$term}}</h3>

    </div>

    <br/>
    <table width="100%" style="background-color: #fefff1">
        <tr>
            <td width="200px">

                <?php


                $sr = StudentToSectionUpdate::where('student_idstudentinfo','=',$idstudent)->pluck('st_roll');
                ?>


            </td>
            <td width="340px"></td>
            <td width="200px"></td>
            <td width="200px"></td>
        </tr>
    </table>
</div>
<div style="margin-left: auto;background-color: #fefff1;margin-right: auto;width: 960px;">

    <?php


    $s = StudentToSectionUpdate::where('student_idstudentinfo','=',$idstudent)->first();

    $sn = Studentinfo::where('registration_id','=',$idstudent)->pluck('sutdent_name');

    ?>

    <table>

        <tr>

            <td style="width: 560px;background-color: #fefff1;padding: 5px">
                <table style="background-color:#fefff1;border-collapse: collapse;letter-spacing: 3px;" border="1">
                    <tr >
                        <td width="250px"><h3>&nbsp;Name</h3></td> <td  width="660px" style="">&nbsp;{{$sn}}</td>

                    </tr>


                    <tr>
                        <td width="250px"><h3>&nbsp;Class</h3></td> <td  width="660px" style="">&nbsp;{{$s->class}}</td>

                    </tr>

                    <tr>
                        <td width="250px"><h3>&nbsp;Section</h3></td> <td  width="660px" style="">&nbsp;{{$s->section}}</td>

                    </tr>

                    <tr>
                        <td width="250px"><h3>&nbsp;Class Roll</h3></td> <td  width="660px" style="" >&nbsp;{{$s->st_roll}}</td>

                    </tr>

                    <tr>
                        <td width="250px"><h3>&nbsp;Student ID</h3></td> <td  width="660px" style="" >&nbsp;{{$idstudent}}</td>

                    </tr>


                    <tr>
                        <td width="250px"><h3>&nbsp;Session</h3></td> <td  width="660px" style="">&nbsp;{{$s->year}}</td>

                    </tr>

                    <tr>
                        <td width="250px" ><h3>&nbsp;Version</h3></td>
                        @if($s->class == 'SHISHU-EV')
                            <td  width="660px" style="">&nbsp;{{"ENGLISH"}}</td>
                        @else
                            <td  width="660px" style="">&nbsp;{{"BANGLA"}}</td>
                        @endif

                    </tr>

                    <tr>
                        <td width="250px"><h3>&nbsp;Shift</h3></td> <td  width="660px" style="">&nbsp;{{$s->shift}}</td>

                    </tr>


                </table>


            </td>


            <td  style="width: 400px;background-color:#fefff1 ;padding-left: 35px;padding-right: 10px">
                <table style="text-align: center;background-color:#fefff1;" border="1">

                    <tr style="background-color:#0d6895;color: white;font-weight: bold">
                        <th width="100px">Grade Interval</th><th width="100px">Letter Grade</th><th width="100px">Grade Point</th>
                    </tr>


                    <tr>
                        <td width="200px" >80-100</td> <td width="200px" >A+</td><td width="180px" >5</td>

                    </tr>
                    <tr>
                        <td width="200px" >70-79</td>  <td width="200px" >A</td> <td width="180px" >4</td>

                    </tr>
                    <tr>
                        <td width="200px" >60-69</td>   <td width="200px" >A-</td> <td width="180px" >3.5</td>

                    </tr>
                    <tr>
                        <td width="200px" >50-59</td><td width="200px" >B</td> <td width="180px" >3</td>

                    </tr>
                    <tr>
                        <td width="200px" >40-49</td> <td width="200px" >C</td>  <td width="180px" >2</td>

                    </tr>
                    <tr>
                        <td width="200px" >33-39</td> <td width="200px" >D</td><td width="180px" >1</td>

                    </tr>
                    <tr>
                        <td width="200px" >00-32</td><td width="200px" >F</td> <td width="180px" >0</td>

                    </tr>


                </table>
            </td>


        </tr>


        <tr>
            <td style="width: 740px;padding: 3px">
                <table style="text-align: center;background-color: #fefff1;padding: 5px">
                    <thead>
                    <tr>
                        <th width="420px" style="text-align: center;border:1px solid;padding: 10px">Subject Name</th>
                        <th width="167" style="border:1px solid">Total Marks</th>
                        <th width="220" style="border:1px solid">Obtain Marks</th>
                        <th width="120" style="border:1px solid">Grade</th>
                        <th width="120" style="border:1px solid">GPA</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sum=0; $count=0; $cgpa=0;

                    $tst = TStudentResult::where('st_id','=',$stid)->get();
                    ?>
                    @foreach($tst as $r)



                        <tr>
                            <td style="text-align: left;border:1px solid"><h4 style="padding: 1px">&nbsp;{{$r->subject}}</h4></td>
                            <td style="border: 1px solid;">{{ $r->total}}</td>
                            <td style="border: 1px solid;">{{ $r->h_total}}</td>

                            <?php

                            $sum = $sum + $r->h_total;
                            $cgpa = $cgpa + $r->h_gp;

                            $count++;

                            ?>


                            <td style="border: 1px solid;">{{$r->h_grade}}</td>


                            <td style="border: 1px solid;">{{$r->h_gp}}</td>


                        </tr>




                    </tbody>

                    @endforeach

                    <tfoot style="border: 1px solid;">
                    <tr >
                        <td style="border: 1px solid;padding: 4px"></td>
                        <td style="border: 1px solid;padding: 8px">Total :<?//php echo $sum?></td>
                        <td style="border: 1px solid"><b>{{$sum}}</b></td>
                        <td style="border: 1px solid">GPA :</td>
                        <td style="border: 1px solid"><b>
                                <?php

                                $stdno =  count(StudentToSectionUpdate::where('student_idstudentinfo','=',$idstudent)->get());

                                $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$idstudent)->first();

                                if($st_rank->grade =='F'){

                                echo "0.0";
                                }else{
                                echo $st_rank->cgpa ;
                                }

                                ?></b></td>
                    </tr>
                    <tr>
                        <td></td>

                        <td></td>
                    </tr>
                    </tfoot>
                </table>


            </td>
            <td  style="width: 380px;padding-left: 10px">
                <table style="">
                    <tr>
                        <td></td>

                        <td width="100px" style="border: 1px solid;padding: 10px;font-size:16px;font-weight:bold" ><p>&nbsp;&nbsp;Rank</p></td> <td width="150px"  style="border: 1px solid;text-align: center;font-size:18px"><p>{{$st_rank->rank}}</p> </td>
                    </tr>
                    <tr>

                        <td></td>
                        <td width="200px" style="border: 1px solid;padding: 10px;font-size:16px;font-weight:bold"><p>&nbsp;&nbsp;Grade</p></td> <td width="200px"  style="border: 1px solid;text-align: center;font-size:18px"><p>{{$st_rank->grade}}</p></td>
                    </tr>
                    <tr>

                        <td></td>
                        <td width="200px" style="border: 1px solid;padding: 10px;font-size:16px;font-weight:bold" ><p>&nbsp;No. Of Student</p></td> <td width="200px"  style="border: 1px solid;text-align: center;font-size:18px"><p>{{$stdno}}</p></td>
                    </tr>
                    <tr>

                        <td></td>
                        <td width="200px" style="border: 1px solid;padding: 10px;font-size:16px;font-weight:bold"><p>&nbsp;Days Attended</p></td> <td width="200px"  style="border: 1px solid;text-align: center;font-size:18px"><p>N/A</p></td>
                    </tr>
                    <tr>

                        <td></td>
                        <td width="200px" style="border: 1px solid;padding: 10px;font-size:16px;font-weight:bold"><p>&nbsp;&nbsp;Merit</p></td> <td width="200px"  style="border: 1px solid;text-align: center;font-size:18px"><p>{{$st_rank->counter_position}}</p></td><td></td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</div>
<div style="width: 960px;margin-left: auto;margin-right: auto;background-color: #fefff1">
    <table width="100%" style="text-align: center;">
        <thead>
        <tr width="100%">
            <br/>

            <th width="" style="text-align: left;padding: 20px;border:1px solid"><br/><br/>

                <h4 style="margin-top: 1px;"> Remarks :  <?php

                    $st1_rank = StudentRank::where('term','=','half yearly')->where('student_id','=',$stid)->first();
                    echo $st1_rank->comment;
                    ?></h4></th>

            </td>


        </tr>

        </thead>
        <tbody>

        <tr>


        </tr>

        </tbody>
        <tbody>
    </table>
    <br/><br/>
    <table width="960px" style="background-color: #fefff1">
        <tr>


            <th width="200px">
                <br/><br/><br/><br/>
                <hr style="width: 180px;"/>
                <p>Principal's Signature</p>
            </th>

            <th width="15px"></th>

            <th width="200px"> <br/><br/><br/><br/>
                <hr style="width: 180px;"/>
                <p>Class Teacher's Signature</p></th>

            <th width="15px"></th>

            <th width="200px"> <br/><br/><br/><br/>
                <hr style="width: 180px;"/>
                <p>Parents/Guardian  Signature</p></th>

        </tr>





    </table>
    <table>

        <tr>
            <h6 style="text-align: center"> Powered By :  <img src="{{asset('/image/fdcl.gif')}}" width="24px" height="24px" align="top">&nbsp;&nbsp;Four D Communications Limited, 2015<br/></td>
            </h6></tr>

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