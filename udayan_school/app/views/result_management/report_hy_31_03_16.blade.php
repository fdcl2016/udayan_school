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
<p style="text-align: center; margin-top: 5px;background-color: #CCC0DA">ID: {{$idstudent}}</p>
      </div>
      <div style="width: 60px; height:80px; float: left;" >
          {{--<img src="{{asset('/image/male.jpg')}}" width="150" height="150">--}}
      </div>

      <div style="width: 550px;float: left;text-align: center" >
          <img src="{{asset('/image/4d.gif')}}" width="112px" height="68px">&nbsp<h2 ><?php echo Config::get('schoolname.school');?></h2>
          <h3>Progress Report</h3>
          
          <p ><b>Term :</b>  {{$term}}</p>

      </div>

    <br/>
    <table width="100%" style="background-color: #f7cbac">
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
<div style="margin-left: auto;margin-right: auto;width: 960px;">

    <?php


    $s = StudentToSectionUpdate::where('student_idstudentinfo','=',$idstudent)->first();

    $sn = Studentinfo::where('registration_id','=',$idstudent)->pluck('sutdent_name');

    ?>

<table>

    <tr>

        <td style="width: 560px;background-color: #d8e4bc;padding: 15px">
            <table style="text-align: center;border-collapse: collapse;background-color: #d8e4bc" border="1">

                <tr >
                    <td width="200px" >Name</td> <td  width="660px" style="letter-spacing: 3px;padding-left: 5px"><b>{{$sn}}</b></td>

                </tr>


                <tr>
                    <td width="200px" >Class</td> <td  width="660px" style="padding-left: 5px">{{$s->class}}</td>

                </tr>

                <tr>
                    <td width="200px" >Section</td> <td  width="660px" style="padding-left: 5px">{{$s->section}}</td>

                </tr>

                <tr>
                    <td width="200px" >Class Roll</td> <td  width="660px" style="padding-left: 5px" >{{$s->st_roll}}</td>

                </tr>

                <tr>
                    <td width="200px" >Student ID</td> <td  width="660px" style="padding-left: 5px" >{{$idstudent}}</td>

                </tr>


                <tr>
                    <td width="200px" >Session</td> <td  width="660px" style="padding-left: 5px">{{$s->year}}</td>

                </tr>

                <tr>
                    <td width="200px" >Version</td>
                    @if($s->class == 'SHISHU-EV')
                    <td  width="660px" style="padding-left: 5px">{{"ENGLISH"}}</td>
                    @else
                        <td  width="660px" style="padding-left: 5px">{{"BANGLA"}}</td>
                    @endif

                </tr>


            </table>


        </td>
        <td  style="width: 400px;background-color:#f2dcdb ;padding-left: 35px;padding-right: 10px">
            <table style="text-align: center;border-collapse: collapse;" border="1">

                <tr>
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
            <td style="width: 560px;background-color: #f2f2f2;padding: 10px">
                <table style="text-align: center;">
                    <thead>
                    <tr>
                        <th width="360" style="text-align: left;">Subject Name</th>
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
            <td  style="width: 400px;background-color: #e4dfec">
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
    <table width="960px" style="background-color: #b7dee8">
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