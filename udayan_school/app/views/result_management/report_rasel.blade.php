<html>
<head>
</head>
<body>
<div style="margin-left: auto;margin-right: auto;width: 960px;background-color: aquamarine">
    <div style="width: 160px;float: left;margin-top: 20px;">
        <img src="{{asset('/image/4d.gif')}}" width="100" height="100">
    </div>
    <div style="width: 800px;float: left;">
        <h2 style="margin-left: 200px;"><?php echo Config::get('schoolname.school');?></h2>
        <h3 style="border: 1px dashed;margin-left: 240px;width: 150px;padding-left: 10px;">Progress Report</h3>
        <p style="margin-left: 230px;"><b>Academic Year :</b>  {{$year}}</p>
        <p style="margin-left: 250px;"><b>Term Name :</b> {{$term}}</p>
    </div>

    <br/>      <br/>      <br/>      <br/>      <br/> <br/>         <br/><br/> <br/>      <br/>
    <table style="background-color: darkgray">
        <tr>
            <td width="200px"><b>Roll :</b> {{$st_roll}}</td>
            <td width="340px"><b>Name :</b> {{$student_name}}</td>
            <td width="200px"><b>Class :</b>  {{$classsection->class_name}}</td>
            <td width="200px"><b>Section :</b> {{$classsection->section}}</td>
        </tr>
    </table>
</div>
<br/>
<div style="margin-left: auto;margin-right: auto;width: 960px;">
    {{--<table>--}}
    {{--<tr>--}}

    {{--@foreach($grade as $g)--}}
    {{--<td>{{$g->configuration_type}}</td>--}}
    {{--@endforeach--}}

    {{--</tr>--}}
    {{--</table>--}}

    <table>
        <tr>

            <td style="width: 560px;background-color: bisque">
                <table>
                    <thead>
                    <tr>
                        <th width="200" style="text-align: left;">Subject Name</th>
                        <th width="100" >Full Marks</th>
                        <th width="100">Marks Obtained</th>
                        <th width="100">Grade</th>
                        <th width="100">Grade Point</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sum=0; $count=0; $cgpa=0; ?>
                    @foreach($result as $r)

                        <?php $total_marks = $r->Total;

                        $total_get_marks = (($r->HT_Marks) + ($r->CT_Marks)+ ($r->RT_Marks)+ ($r->LT_Marks)+ ($r->MCQ_Marks));
                        $g = GradingTable::where('total','=',$total_marks)->where('highest_range', '>=', $total_get_marks)->where('lowest_range', '<=', $total_get_marks)->first();
                        ?>
                        <tr>


                            <td style="border: 1px solid;font-size:14px;">{{$r->subject_name}}</td>
                            <td style="border: 1px solid;font-size:14px;text-align: center">{{$r->Total}}</td>

                            <td style="border: 1px solid;font-size:14px;text-align: center">{{ $total_get_marks}}</td>

                            <?php $sum=$total_get_marks+$sum; ?>

                            <td style="border: 1px solid;font-size:14px;text-align: center">{{$g->grade}}</td>

                            <td style="border: 1px solid;font-size:14px;text-align: center">{{$g->gpa}}</td>



                            <?php $cgpa= $cgpa+$g->gpa; $count++;?>
                        </tr>



                    </tbody>
                    @endforeach
                    <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><b>Total :<?php

                                $total = StudentRank::where('student_id','=',$idstudent)->first();

                                echo $total->total_mark;

                                ?></b></td>
                        <td></td>


                        <td><b>GPA :<?php

                                $gpa = StudentRank::where('student_id','=',$idstudent)->first();

                                echo $gpa->cgpa;

                                ?></b></td>
                    </tr>
                    <tr>
                        <td></td>

                        <?php $percent = $total_marks * $count; ?>

                        <td><?php //echo sprintf("%.2f",($sum * 100)/ $percent). "%" ?> </td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>


            </td>
            <td  style="width: 400px;background-color: beige">
                <table width="300px;">
                    <thead>
                    <tr>
                        <th width="50px;"></th>
                        <th width="200px;"></th>
                        <th width="10px;"></th>
                        <th width="90px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                        <td>Rank</td>
                        <td>:</td>
                        <td style="border: 1px solid; text-align: center">
                            <?php

                            $rank = StudentRank::where('student_id','=',$idstudent)->first();

                            echo $rank->rank;

                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Grade</td>
                        <td>:</td>
                        <td style="border: 1px solid; text-align: center">
                            <?php

                            $grade = StudentRank::where('student_id','=',$idstudent)->first();

                            echo $grade->grade;

                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Total No. of Student</td>
                        <td>:</td>

                        <td style="border: 1px solid; text-align: center">
                            <?php

                            $st_count = StudentRank::where('class','=',$classsection->class_name)->where('section','=',$classsection->section)->get();
                            echo count($st_count);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>School Days</td>
                        <td>:</td>
                        <td style="border: 1px solid; text-align: center">N/A</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>About</td>
                        <td>:</td>
                        <td style="border: 1px solid; text-align: center">N/A</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Late</td>
                        <td>:</td>
                        <td style="border: 1px solid; text-align: center">N/A</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <td></td>
                    <td colspan="3" rowspan="15" style="border: 1px solid;vertical-align:top;height:100px;">
                        <h3 style="margin-top: 1px;">Remarks</h3>

                    </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</div>
<div style="width: 960px;margin-left: auto;margin-right: auto;background-color: honeydew">
    <table width="100%" style="text-align: center;">
        <thead>
        <tr>
            <th width="360px" style="text-align: left;"><br/><br/>Best of Luck! !! !!!! !!!</th>
            <th width="200px">
                <br/><br/><br/><br/>
                <hr style="width: 150px;"/>
                <p>Headmaster Signature</p>
            </th>
            <th width="200px">
                <br/><br/><br/><br/>
                <hr style="width: 150px;"/>
                <p>Guardian Signature</p>
            </th>
            <th width="200px"> <br/><br/><br/><br/>
                <hr style="width: 150px;"/>
                <p>Class Teacher Signature</p></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="4"><br/>Powered By : Four D Communications Limited, 2015<br/></td>
        </tr>
        </tbody>
        <tbody>
    </table>

</div>
<br/><br/><br/><br/><br/>
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