<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Alegreya+SC' rel='stylesheet' type='text/css'>
</head>
<body>
<div style="margin-left: auto;margin-right: auto;width: 95%;background-color: #deeaf6">

    <div style="width: 160px;float: left; margin-left: 25px; margin-top: 25px;">

  <?php
   
$im = StudentInfo::where('idstudentinfo','=',$idstudent)->where('image','=','')->get();

$imcnt = count($im);

if($imcnt!=0){

?>
<img src="{{asset('/image/male.jpg')}}" width="150" height="150">
<?php
}
else{
?>

          <img src="{{asset('/uploads/'.$idstudent.'.PNG')}}" width="150" height="150">

<?php }
?>
        <p style="text-align: center; margin-top: 5px;">ID: {{$idstudent}}</p>
    </div>
    <div style="width: 80px; height:80px; float: left;" >
        {{--<img src="{{asset('/image/male.jpg')}}" width="150" height="150">--}}
    </div>

    <div style="width: 600px;float: left;text-align: center" >
        <img src="{{asset('/image/4d.gif')}}" width="112px" height="70px">&nbsp<h2><?php echo Config::get('schoolname.school');?></h2>
        <h3>Progress Report</h3>
        <p ><b>Academic Year :</b>  {{$year}}</p>

    </div>

    @if($classsection->class_name=="Nine" || $classsection->class_name=="Ten")
        <table width="350px" height="100px" style="text-align: center;float: right; margin-right: 25px; margin-top: 15px;" border="1">

            <thead>

            <tr style="font-weight: bold">

                <td> Range</td>
                <td>Grades</td>
                <td> Grade Point</td>

            </tr>
            </thead>

            <tbody>

            <tr>
                <td>80% and above</td>
                <td>A+</td>
                <td>5.00</td>
            </tr>
            <tr>
                <td>70%-79%</td>
                <td>A</td>
                <td>4.00</td>
            </tr>
            <tr>

                <td>60%-69%</td>
                <td>A-</td>
                <td>3.50</td>
            </tr>
            <tr>

                <td>50%-59%</td>
                <td>B</td>
                <td>3.00</td>
            </tr>
            <tr>

                <td>40%-49%</td>
                <td>C</td>
                <td>2.00</td>
            </tr>
            <tr>

                <td>33%-39%</td>
                <td>D</td>
                <td>1.00</td>
            </tr>
            <tr>

                <td>Below 33%</td>
                <td>F</td>
                <td>0.00</td>
            </tr>
            </tbody>

        </table>
    @else
        <table width="350px" height="100px" style="text-align: center;float: right; margin-right: 25px; margin-top: 35px;" border="1">

            <thead>

            <tr style="font-weight: bold">

                <td> Range</td>
                <td>Grades</td>
                <td> Grade Point</td>

            </tr>
            </thead>

            <tbody>

            <tr>
                <td>80% and above</td>
                <td>A+</td>
                <td>5.00</td>
            </tr>
            <tr>
                <td>70%-79%</td>
                <td>A</td>
                <td>4.00</td>
            </tr>
            <tr>

                <td>60%-69%</td>
                <td>A-</td>
                <td>3.50</td>
            </tr>
            <tr>

                <td>50%-59%</td>
                <td>B</td>
                <td>3.00</td>
            </tr>
            <tr>

                <td>Below 50%</td>
                <td>F</td>
                <td>0.00</td>
            </tr>
            </tbody>

        </table>
    @endif



    <br/>      <br/>      <br/>      <br/>      <br/> <br/>         <br/><br/> <br/>      <br/>
    <table width="100%" style="background-color: #f7cbac;">
        <tr>
            <td width="200px"><b>Roll :</b> {{$st_roll}}</td>
            <td width="340px"><b>Name :</b> {{$student_name}}</td>
            <td width="200px"><b>Class :</b>  {{$classsection->class_name}}</td>
            <td width="200px"><b>Section :</b> {{$classsection->section}}</td>
        </tr>
    </table>
</div>
<div style="margin-left: auto;margin-right: auto;width:95%;">

    <?php
    $fail=null;
    ?>
    <table>
        <tr>
            <td style="width: 30% ;background-color: #acb9ca; border: 1px solid;">
                <h3 style="padding-top: 40px;"> List Of Subjects</h3>
                <table>

                    <tbody>

                    <?php $sum=0; $count=0; $cgpa=0; ?>
                    <?php ?>
                    <tr>

                        <th width="100" style="font-size: 13px">Subjects</th>
                        <th width="100" style="font-size: 13px">Total Marks</th>


                    </tr>
                    @foreach($tst as $r)


                        <tr width="450">

                            <td style="border:1px solid ;font-size: 15px;font-weight: bold" width="550">{{$r->subject}}</td>
                            <td style="border:1px solid;text-align: center ;font-size: 15px;font-weight: bold" width="150">{{$r->total}}</td>

                            <?php $count++; ?>
                        </tr>




                    </tbody>

                    @endforeach
                    <tfoot>
                    <tr>
                        <td></td>
                        <td></td>


                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr><td></td><td></td></tr>
                    <tr><td> <b>Total:</b></td>
                        <td> </td>
                        <td></td>

                    </tr>
                    </tfoot>
                </table>


            </td>







            <td style="width:24%; border: 1px solid; background-color: #bdd6ee">
                <h2 style="text-align: center">Half Yearly<br>Examination</h2>
                <table>
                    <thead>
                    <tr>

                        {{--<th width="100" style="font-size: 13px">Full Marks</th>--}}
                        <th width="100" style="font-size: 13px">Obtained Marks</th>
                        <th width="100" style="font-size: 13px">Grade</th>
                        <th width="100" style="font-size: 13px">Grade Point</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $tst = TStudentResult::where('st_id','=',$stid)->get();

                    ?>
                    @foreach($tst as $r)


                        <tr>

                            {{--<td style="border: 1px solid;font-size:14px; text-align:center;">{{$r->total}}</td>--}}
                            <td style="border: 1px solid;font-size:14px; text-align:center;">{{ $r->h_total}}</td>

                            @if($r->h_grade == 'F')
                                <td style="border: 1px solid;font-size:15px; text-align:center; color:darkred;">{{$r->h_grade}}</td>
                                <td style="border: 1px solid;font-size:15px; text-align:center; color:darkred;">{{sprintf("%.2f",$r->h_gp)}}</td>
                            @else

                                <td style="border: 1px solid;font-size:15px; text-align:center;">{{$r->h_grade}}</td>
                                <td style="border: 1px solid;font-size:15px; text-align:center;">{{sprintf("%.2f",$r->h_gp)}}</td>

                            @endif


                        </tr>





                    </tbody>
                    @endforeach
                    <tfoot>
                    <tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
                    <tr>



                        <?php
                        $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$stid)->first();
                        ?>  <td style="font-size:15px; text-align: center"><b>
                                {{ $st_rank->total_mark;}}
                            </b></td>
                        <td style="font-size:15px; text-align: center"><b>GPA :</b></td>
                        <td style="font-size:15px; text-align: center"><b>
                                <?php
                                $rasel=sprintf("%.2f",$st_rank->cgpa);
                                if($st_rank->cgpa==0)
                                {

                                echo "<font color='darkred'>$rasel</font>";
                                }

                                else
                                {
                                echo $rasel;
                                }
                                ?>
                            </b></td>

                    </tr>

                    </tfoot>
                </table>
            </td>

            <?php $total =0; $cg=0; ?>

            @if($term=='Final')
                <td style="width: 24%; border: 1px solid; background-color: #dbdbdb">
                    <h2 style="text-align: center">Final Year<br>Examination</h2>
                    <table>
                        <thead>
                        <tr>

                            {{--<th width="100" style="font-size: 13px">Full Marks</th>--}}
                            <th width="100" style="font-size: 13px">Obtained Marks</th>
                            <th width="100" style="font-size: 13px">Grade</th>
                            <th width="100" style="font-size: 13px">Grade Point</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $tst = TStudentResult::where('st_id','=',$stid)->get();

                        ?>
                        @foreach($tst as $r)


                            <tr>

                                {{--<td style="border: 1px solid;font-size:14px; text-align:center;">{{$r->total}}</td>--}}
                                <td style="border: 1px solid;font-size:14px; text-align:center;">{{ $r->f_total}}</td>


                                @if($r->f_grade == 'F')
                                    <td style="border: 1px solid;font-size:15px; text-align:center; color:darkred;">{{$r->f_grade}}</td>
                                    <?php

                                    if($r->f_grade=="F")
                                    {
                                    $fail=1;
                                    }

                                    ?>
                                    <td style="border: 1px solid;font-size:15px; text-align:center; color:darkred;">{{sprintf("%.2f",$r->f_gp)}}</td>
                                @else

                                    <td style="border: 1px solid;font-size:15px; text-align:center;">{{$r->f_grade}}</td>
                                    <td style="border: 1px solid;font-size:15px; text-align:center;">{{sprintf("%.2f",$r->f_gp)}}</td>

                                @endif
                                <?php $total = $total + $r->f_total;

                                $cg = $cg + $r->f_gp;

                                ?>


                            </tr>





                        </tbody>
                        @endforeach
                        <tfoot>
                        <tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
                        <tr>



                            <td style="font-size:15px; text-align: center"><b>
                                    {{ $total}}
                                </b></td>
                            <td style="font-size:15px; text-align: center"><b>GPA :</b></td>
                            <td style="font-size:15px; text-align: center"><b>
                                    <?php

                                    if($fail==1)
                                    {
                                    echo "<font color='darkred'>0.00</font>";
                                    }
                                    else
                                    {
                                    $f_gp = sprintf("%.2f",($cg/$count));

                                    echo sprintf("%.2f",$f_gp);
                                    }

                                    ?>
                                </b></td>

                        </tr>

                        </tfoot>
                    </table>
                </td>

            @else
                <td style="width: 30%; border: 1px solid; background-color: #abb9d3">
                    <h3 style="text-align: center; color: darkred;">Final Result not published Yet</h3>
                </td>
            @endif

            @if($term=='Final')
                <td style="width: 24%; border: 1px solid; background-color: #ffe599">
                    <h2 style="text-align: center">Grand<br>Total</h2>
                    <table>
                        <thead>
                        <tr>


                            {{--<th width="100" style="font-size: 13px">Full Marks</th>--}}
                            <th width="400" style="font-size: 13px">Obtained Marks</th>
                            <th width="400" style="font-size: 13px">Grade</th>
                            <th width="400" style="font-size: 13px">Grade Point</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $tst = TStudentResult::where('st_id','=',$stid)->get();

                        ?>
                        @foreach($tst as $r)


                            <tr>


                                {{--<td style="border: 1px solid;font-size:14px; text-align:center;">{{ $r->total}}</td>--}}

                                <td style="border: 1px solid;font-size:14px; text-align:center;" width="250px">{{ ceil(($r->gt_total)/2)}}</td>


                                @if($r->gt_grade == 'F')
                                    <td style="border: 1px solid;font-size:15px; text-align:center; color:darkred;">{{$r->gt_grade}}</td>
                                    <td style="border: 1px solid;font-size:15px; text-align:center; color:darkred;">{{sprintf("%.2f",$r->gt_gp)}}</td>
                                @else

                                    <td style="border: 1px solid;font-size:15px; text-align:center;">{{$r->gt_grade}}</td>
                                    <td style="border: 1px solid;font-size:15px; text-align:center;">{{sprintf("%.2f",$r->gt_gp)}}</td>

                                @endif


                            </tr>





                        </tbody>
                        @endforeach
                        <tfoot>
                        <tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
                        <tr>


                            {{--<td style="font-size:13px; text-align: center"><b>Total:</b></td>--}}
                            <?php

                            $st_rank = StudentRank::where('term','=','Final')->where('student_id','=',$stid)->first();
                            ?>  <td style="font-size:15px; text-align: center"><b>
                                    {{ $st_rank->total_mark}}
                                </b></td>
                            <td style="font-size:15px; text-align: center"><b>GPA :</b></td>
                            <td style="font-size:15px; text-align: center"><b>
                                    <?php
                                    $rasel=sprintf("%.2f",$st_rank->cgpa);
                                    if($st_rank->cgpa==0)
                                    {

                                    echo "<font color='darkred'>$rasel</font>";
                                    }

                                    else
                                    {
                                    echo $rasel;
                                    }
                                    ?>
                                </b></td>
                        </tr>

                        </tfoot>
                    </table>
                </td>


            @else
                <td style="width: 30%; border: 1px solid; background-color: #abb9d3">
                    <h3 style="text-align: center; color: darkred;">Grand Total not published Yet</h3>
                </td>
            @endif


            <table width="100%" style="background-color: #fbe4d9">
                <tr>
                    <td style="width: 580px">
                        <h2 style="margin-left: 160px;">Summary</h2>
                        <table style=" margin-left: 25px; " border="1">
                            <thead>
                            <tr>
                                <th width="200px;"> </th>
                                <th width="70px;"> Half Yearly </th>
                                <th width="70px;"> Final</th>

                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>Rank</td>

                                @if($term == 'Half Yearly')
                                    <td style="text-align: center">
                                        <?php
                                        $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$stid)->first();

                                        echo $st_rank->rank;

                                        ?></td>

                                    <td style="text-align: center"> N/A</td>

                                @else

                                    <td style="text-align: center">
                                        <?php
                                        $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$stid)->first();

                                        echo $st_rank->rank;

                                        ?></td>

                                    <td style="text-align: center">  <?php
                                        $st_rank = StudentRank::where('term','=','Final')->where('student_id','=',$stid)->first();

                                        echo $st_rank->rank;

                                        ?></td>
                                @endif


                            </tr>

                            <tr>
                                <td>Grade</td>

                                @if($term == 'Half Yearly')
                                    <td style="text-align: center">

                                        <?php
                                        $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$stid)->first();

                                        echo $st_rank->grade;

                                        ?>

                                    </td>


                                    <td style="text-align: center" >N/A</td>

                                @else
                                    <td style="text-align: center">

                                        <?php
                                        $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$stid)->first();

                                        echo $st_rank->grade;

                                        ?>

                                    </td>


                                    <td style="text-align: center">
                                        <?php
                                        $st_rank = StudentRank::where('term','=','Final')->where('student_id','=',$stid)->first();

                                        echo $st_rank->grade;

                                        ?>

                                    </td>

                                @endif

                            </tr>

                            <tr>
                                <td>Total No. Of Student</td>
                                @if($term == 'Half Yearly')
                                    <td style="text-align: center"> {{$std_no}}</td>
                                    <td style="text-align: center">N/A</td>
                                @else
                                    <td style="text-align: center"> {{$std_no}}</td>
                                    <td style="text-align: center"> {{$std_no}}</td>

                                @endif
                            </tr>
                            <tr>

                                <td>Days Attended</td>
                                <td style="text-align: center">N/A</td>
                                <td style="text-align: center">N/A</td>
                            </tr>

                            <tr>

                                <td>Student Merit Position</td>
                                @if($term == 'Half Yearly')
                                    <td style="text-align: center">


                                        <?php
                                        $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$stid)->first();

                                        echo $st_rank->counter_position;

                                        ?>
                                    </td>
                                    <td style="text-align: center">N/A </td>

                                @else
                                    <td style="text-align: center">


                                        <?php
                                        $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$stid)->first();

                                        echo $st_rank->counter_position;

                                        ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php
                                        $st_rank = StudentRank::where('term','=','Final')->where('student_id','=',$stid)->first();

                                        echo $st_rank->counter_position;

                                        ?>

                                    </td>
                                @endif
                            </tr>





                            </tbody>

                            <tfoot>

                            </tfoot>
                        </table>
                    </td>

                    @if($term == 'Half Yearly')

                        <td style="width: 580px; border-left-style: ridge;">
                            <h2 style="margin-left: 160px; margin-top: -100px;">Remarks</h2>
                            <table width="100%" style="text-align: center;">
                                <tr>
                                    <?php
                                    $st1_rank = StudentRank::where('term','=','half yearly')->where('student_id','=',$stid)->first();
                                    ?>
                                    <br>
                                    @if($st1_rank->pass_type=='pass')
                                        <td style="font-size: 20px; font-style: italic; font-family: 'Alegreya SC', serif; color: darkgreen;">
                                    @else
                                        <td style="font-size: 20px; font-style: italic; font-family: 'Alegreya SC', serif; color: darkred;">
                                            @endif
                                            <b>{{$st1_rank->comment}}</b>
                                        </td>

                                </tr>
                            </table>
                        </td>


                    @else


                        <td style="width: 580px; border-left-style: ridge;">
                            <h2 style="margin-left: 160px; margin-top: -100px;">Remarks</h2>
                            <table width="100%" style="text-align: center;">
                                <tr>
                                    <?php

                                    $st_rank1 = StudentRank::where('term','=','final')->where('student_id','=',$stid)->first();
                                    ?>
                                    <br>
                                    @if($st_rank1->pass_type=='pass')
                                        <td style="font-size: 20px; font-style: italic; font-family: 'Alegreya SC', serif;  color: darkgreen;">
                                    @else
                                        <td style="font-size: 20px; font-style: italic; font-family: 'Alegreya SC', serif; color: darkred;">
                                            @endif

                                            <b>{{$st_rank1->comment}}</b>

                                        </td>

                                </tr>
                            </table>
                        </td>
                    @endif

                    <td style="width: 580px; border-left-style: ridge;"><br/>
                        <h2 style="text-align: center; margin-top: -25px;">Signatures</h2>

                        <table width="100%" style="text-align: center;">

                            <thead>
                            <tr>
                                <th width="50px">
                                    <br/><br/><br/>
                                    <img src="{{asset('/image/sign.png')}}" width="150" height="40">
                                    <hr style="width: 150px;"/>
                                    <p>Principle Signature</p>
                                </th>


                                <th width="150px"> <br/><br/><br/><br/><br/>
                                    <hr style="width: 150px;"/>
                                    <p>Class Teacher Signature</p>
                                </th>
                            </tr>
                            </thead>

                        </table>

                    </td>



                </tr>
            </table>


        <tr>
            <td>
                <table width="100%" style="background-color: #deeaf6;">
                    <tr>
                        <td>

                            <h4 style="text-align: center;color: #007fdb; padding-top: 20px;">Powered By :&nbsp;&nbsp;<img src="{{asset('/image/fdcl.gif')}}" alt="Four D Communications Limited" width="24px" height="24px" align="top" >&nbsp;&nbsp;
                                {{ HTML::link('http://fourdbd.com', 'Four D Communications Limited', array('target' => '_blank', 'style'=>'text-decoration: none; color: #007fdb;'))}}
                            </h4>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</div>








{{Form::open(array('url'=>'/report'))}}
{{Form::hidden('sid',$idstudent)}}
{{Form::hidden('idclasssection',$idclasssection)}}
{{Form::hidden('term',$term)}}
{{Form::hidden('year',$year)}}
        <!--
<center> <input type="submit" style="height: 40px;width: 320px;background-color: #0098d0" value="Download This Report Card"></center>
-->
{{Form::close()}}
</body>
</html>