<html>
<head>
</head>
<body>
<div style="margin-left: auto;margin-right: auto;width: 960px;background-color: #deeaf6">
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
<p style="text-align: center; margin-top: 5px;">ID: {{$idstudent}}</p>
      </div>
      <div style="width: 60px; height:80px; float: left;" >
          {{--<img src="{{asset('/image/male.jpg')}}" width="150" height="150">--}}
      </div>

      <div style="width: 550px;float: left;text-align: center" >
          <img src="{{asset('/image/4d.gif')}}" width="112px" height="68px">&nbsp<h2 ><?php echo Config::get('schoolname.school');?></h2>
          <h3>Progress Report</h3>
          <p ><b>Academic Year :</b>  {{$year}}</p>
          <p ><b>Term :</b>  {{$term}}</p>

      </div>

    <br/>
    <table style="background-color: #f7cbac">
        <tr>
            <td width="200px"><b>Roll :</b> 

<?php


$sr = StudentToSectionUpdate::where('student_idstudentinfo','=',$idstudent)->pluck('st_roll');
 ?>
{{$sr}}

</td>
            <td width="340px"><b>Name :</b> {{$student_name}}</td>
            <td width="200px"><b>Class :</b>  {{$classsection->class_name}}</td>
            <td width="200px"><b>Section :</b> {{$classsection->section}}</td>
        </tr>
    </table>
</div>
<div style="margin-left: auto;margin-right: auto;width: 960px;">


    <table>
        <tr>
            <td style="width: 560px;background-color: #dbdbdb">
                <table style="text-align: center;">
                    <thead>
                    <tr>
                        <th width="300" style="text-align: left;">Subject Name</th>
                        <th width="100">Total Marks</th>
                        <th width="100">Obtain Marks</th>
                        <th width="100">Grade</th>
                        <th width="100">GPA</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sum=0; $count=0; $cgpa=0;

                    $tst = TStudentResult::where('st_id','=',$stid)->get();
                    ?>
                    @foreach($tst as $r)



                                <tr>
                                    <td style="text-align: left;border:1px solid">{{$r->subject}}</td>
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

                    <tfoot>
                    <tr>
                        <td></td>
                        <td>Total :<?//php echo $sum?></td>
                        <td><b>{{$sum}}</b></td>
                        <td>GPA :</td>
                        <td><b>
<?php
                         $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$stid)->first();

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
                        <td style="border: 1px solid;text-align: center">

                         <?php
                         $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$stid)->first();

                         echo $st_rank->rank;

                          ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Grade</td>
                        <td>:</td>
                        <td style="border: 1px solid;text-align: center">

                          <?php
                               $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$stid)->first();

                               echo $st_rank->grade;

                                ?>

                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Student No.</td>
                        <td>:</td>
                        <td style="border: 1px solid;text-align: center">{{$std_no}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Days Attended</td>
                        <td>:</td>
                        <td style="border: 1px solid;text-align: center">N/A</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Merit Position</td>
                        <td>:</td>
                        <td style="border: 1px solid;text-align: center">  <?php
                         $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$stid)->first();

                        echo $st_rank->counter_position;

                        ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <td></td>

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
        <br/>

        <th width="360px" style="text-align: left;"><br/><br/>

                                    <h3 style="margin-top: 1px;"> Remarks :  <?php

                                 $st1_rank = StudentRank::where('term','=','half yearly')->where('student_id','=',$stid)->first();
                                 echo $st1_rank->comment;
                               ?></h3></th>

            </td>

            <th width="200px">
                <br/><br/><br/><br/>
                <hr style="width: 150px;"/>
                <p>Headmaster Signature</p>
            </th>

            <th width="200px"> <br/><br/><br/><br/>
                <hr style="width: 150px;"/>
                <p>Class Teacher Signature</p></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="4"><br/>Powered By :  <img src="{{asset('/image/fdcl.gif')}}" width="24px" height="24px" align="top">&nbsp;&nbsp;Four D Communications Limited, 2015<br/></td>
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
{{Form::hidden('class_name',$classsection->class_name)}}
{{Form::hidden('section',$classsection->section)}}
{{Form::hidden('st_id',$stid)}}
{{Form::hidden('year',$year)}}
<center> <input type="submit" style="height: 40px;width: 320px;background-color: #0098d0" value="Download This Report Card"></center>
{{Form::close()}}
</body>
</html>