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
                            <a href="{{ URL::to('/result_management/teacher_result_insert')}}">Insert Marks</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/view_marksheet')}}">Mark Sheet</a>
                        </li>
                        <li class="active">
                            <a href="{{ URL::to('/view_tabulationsheet')}}">Tabulation Sheet</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/submit_marks')}}">Subject Mark Submit</a>
                        </li>
                        <?php

                        $clt = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->first();

                        if(count($clt)>0){
                        ?>
                        <li>
                            <a href="{{ URL::to('/result_management/st_report_card2')}}">Student Report Card</a>
                        </li>

                        <?php } ?>
                        <!-- if class teacher show tab -->
                        <?php 
                          $class_teacher = ClassTeacher::where('idteacherinfo', Auth::user()->user_id)->first(); 
                        ?>
                        @if(!empty($class_teacher))
                        <li>
                          <a href="{{ URL::to('/result_management/custom_report') }}">Custom Report</a>
                        </li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Tabulation Sheet</h3></strong></div><br/>

                        <div class="widget-header"></div>
                        <div class="widget-content" >
                            {{Form::open(array('url'=>'/view_tabulationsheet', 'class'=>'form-inline')) }}
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Select Year:</label>
                                    <select name="year" id="year" class="form-control">
                                        <option value="">Select Year</option>
                                        <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();?>
                                        @foreach($academic_year as $years)
                                            <option value="{{$years->academic_year}}">{{$years->academic_year}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Select Term:</label>
                                    <select name="term" id="term" class="form-control">
                                        <option value="Half Yearly">Half Yearly</option>
                                        <option value="Final">Final</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Select Class & Section:</label>
                                    <select name="cat" id="cat" class="form-control" >

                                        <?php $idclass = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->get(); ?>
                                        @foreach($idclass as $cats)
                                            <?php $classname12 = Addclass::where('class_id','=',$cats->idclasssection)->first();?>
                                            <option value="{{$cats->idclasssection}}">{{$classname12->class_name}} {{$classname12->section}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-search"></i> Search</button><br>
                                </div>
                            </div>




                            {{Form::close()}}
                            <?php $std_no = count($students);  //$timereq1=0; //echo $stu_results;

                            $subname = ConvertedMarks::where('class_id',$idclasssection)
                                    ->leftjoin('subject', 'subject.idsubject', '=', 'converted_marks.subjectid')
                                    ->orderby('subject.priority', 'ASC')
                                    ->groupBy('converted_marks.subjectid')->get();


$total_student = count(StudentToSectionUpdate::where('section',$sectionname)->where('class',$classname)->where('year',$year)->get());

                            $st = StudentToSectionUpdate::where('section',$sectionname)->where('class',$classname)->where('year',$year)
                                    ->leftjoin('studentinfo', 'studentinfo.registration_id', '=', 'student_to_section_update.student_idstudentinfo')
                                    ->orderby('student_to_section_update.st_roll', 'ASC')->get();

                            ?>
                            <br>

                            
                            <div class="table-responsive" style="padding-left:1%;padding-right:1%">

                                @if(count($students) && count($stu_results))

<?php 







function is_pass($markconfiguration,$total,$type){

  $mark = $total;



 // $percent = 40;

// $mark_conf = MarksConfiguration::where('configuration_name',$markconfiguration)
//                                  ->where('configuration_type',$type)->pluck('total_marks');


         if($type== 'HT' && $markconfiguration!= 'config09car'){

          $m = 138;  
         } 

         elseif ($type== 'MT' && $markconfiguration== 'config09car') {
              # code...

                 $m = 65;

          } 
         elseif($type== 'MT' && $markconfiguration!= 'config09car'){

                $m = 82;

         }

          elseif ($type== 'LT') {
              # code...

                 $m = 45;

          }  

           

          else{

            $m = 45;
         }                    



 $percent = round(($m * 40)/100);

 //$pass_range= round(($mark * 40 ) / 100); // checking the pass for ht and mt

            if($mark < $percent)
            {
              return 0;

            }else{


                return 1;
            }

    
}

function gradecheck($total,$obtained_mark){



 // $mark = ceil($total);

      
    $gp = GradingTable::where('total', '=', $total)->where('highest_range', '>=', $obtained_mark)->where('lowest_range', '<=', $obtained_mark)->pluck('gpa');

    return $gp;
    
}



?>









                                    <br>
                                    <table cellspacing="0" width="100%" border="0" style="border-collapse: collapse">

                                        <thead>
                                        <tr>
                                            <th><div></div></th> <th colspan="5"><div style="float: left; width: 33%;">Class:&nbsp; {{$classname}}</div>
                                                <div style="display: inline-block; width: 25%;">Section:&nbsp;{{$sectionname}}</div><div style="display: inline-block; width: 25%;">Term:&nbsp;{{$term}}</div></th>


                                        </tr>
                                        </thead>
                                    </table>
                                    <br/>
                                    <div style="border:1px solid gray;width:1080px; height: 500px;  overflow-y:scroll;overflow-x:scroll;">
                                        <table border="1" cellspacing="0"  border="1" style="border-collapse: collapse">

                                            <tr>
                                                <th rowspan="2" style=" padding-left: 10px;padding-right:10px"><b>Roll</b></th>
                                                <th rowspan="2" style=" padding-left: 10px;"><b>Student Name</b></th>
                                                <?php $std_no = count($students); $sub_no = (count($stu_results))/$std_no;
                                                $cls_val = Addclass::where('class_id','=',$idclasssection)->pluck('value');
                                                $count_sub_no = $sub_no;

                                                $sb = ConvertedMarks::where('class_id',$idclasssection)->get();

                                                $num_st_fail = 0;

                                                $num_st_pass = 0;


                                                ?>

                                                @foreach($subname as $s)

                                                    <th style="text-align: center; padding-left: 10px;font-size: 14px">{{$s->subject_name}}</th>

                                                @endforeach
                                                <th style="text-align: center; padding-left: 10px;">Summary</th>
                                            </tr>

                                            <tr>
                                                @foreach($subname as $s)
                                                    <td>

                                                        <table border="0" style=" table-layout: fixed;width: 250px;" style="border-collapse: collapse">
                                                            <tr>



                                                                <td align="center" style=" border-right: 1px solid black;">Half Yearly</td>

                                                                <td align="center" style="border-right: 1px solid black; ">Final</td>


                                                                <td align="center" style=" border-left: 1px solid black;"><b>Grand Total</b></td>
                                                                <td align="center" style=" border-left: 1px solid black;"><b>Grade</b></td>
                                                                <td align="center" style=" border-left: 1px solid black; width: auto"><b>Point</b></td>

                                                            </tr>
                                                        </table>
                                                    </td>
                                                @endforeach
                                                <td>
                                                    <table border="0" style=" table-layout: fixed;width: 250px;" style="border-collapse: collapse">
                                                        <tr>


                                                            <td align="center" style=" border-left: 1px solid black;"><b>Total</b></td>
                                                            <td align="center" style=" border-left: 1px solid black;"><b>Grade</b></td>
                                                            <td align="center" style=" border-left: 1px solid black; width: auto"><b>GPA</b></td>
                                                            <td align="center" style=" border-left: 1px solid black; width: auto"><b>Status</b></td>
                                                            <td align="center" style=" border-left: 1px solid black; width: auto"><b>Merit</b></td>

                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <?php

                                            $count  = 0;  $sum_total = 0;
                                            $sum_grade = "";
                                            $is_fail  = 0;
                                            $fail_count = 0;

                                            $total_fail = 0;$total=0; $avg_gp = 0;//echo count($stu_results);   ?>
  
                                            @foreach($st as $s)

                                            <?php $count  = 0;  $sum_total = 0;$is_fail  = 0;
                                             $fail_count = 0;
                                         
                                            $sum_grade = "";
                                            $sum_point = 0;

                                             $fail_check=0;




                                    $half_yearly_total=0;
                                    $final_total = 0;
                                    $gttotal=0;
                                            ?>

                                            <tr>
                                                <td style=" padding-left: 10px;"><b>{{$s->st_roll}}</b></td>
                                                <td style=" padding-left: 10px; width: 100%"><b>{{$s->sutdent_name}}</b></td>






                                                @foreach($subname as $s1)
                                                    <?php



         $grand_total = 0;
         $cq_check =0;
         $mcq_check=0;



         $fail_sub_check=0;
       
         $lab_check=0;
         $subtot=0;                         

                                                    $re = ConvertedMarks::where('st_id',$s->student_idstudentinfo)->where('year',$year)
                                                            ->where('term',$term)
                                                            ->where('class_id',$idclasssection)
                                                            ->where('subjectid',$s1->idsubject)
                                                            ->first();


                                                    $re_hy = ConvertedMarks::where('st_id',$s->student_idstudentinfo)->where('year',$year)
                                                            ->where('term','Half Yearly')
                                                            ->where('class_id',$idclasssection)
                                                            ->where('subjectid',$s1->idsubject)
                                                            ->first();        

                                                    if(count($re))
                                                    {
                                                        $ct_cq = $re->cq_ct;
                                                        $ct_tot = $re->cq_total;
                                                        $ct_conv = $re->cq_conv;
                                                        $ct_mcq = $re->mcq_ct;
                                                        $ct_mtot = $re->mcq_total;
                                                        $ct_mcq_conv = $re->mcq_conv;
                                                        $prac= $re->practical;
                                                        $tot = $re->total;
                                                        $grade = $re->grade;
                                                        $gpa = $re->point;

                                                    }
                                                    else
                                                    {
                                                        $ct_cq = "NA";
                                                        $ct_tot = "NA";
                                                        $ct_conv = "NA";
                                                        $ct_mcq = "NA";
                                                        $ct_mtot = "NA";
                                                        $ct_mcq_conv = "NA";
                                                        $prac = "NA";
                                                        $grade = "NA";
                                                        $gpa = 0;
                                                        $tot = 0;

                                                    }


                                                    ?>


 <?php 

           $sum_total = $sum_total + $tot + $re_hy->total;



 $sb1 = Subtot::where('idsubject',$s1->idsubject)->where('class','NINE')->pluck('configuration_type');




    if($term =='Half Yearly')
        {

             $sb = Subtot::where('idsubject',$s1->idsubject)->where('class','NINE')->pluck('total');
                
                $subtot = $sb;

        }else{
     

         $sb = Subtot::where('idsubject',$s1->idsubject)->where('class','NINE')->pluck('gt_total');
                $subtot = $sb;

     }







$grand_total = $re_hy->total + $tot;

$half_yearly_total = $half_yearly_total + $re_hy->total;

$final_total = $final_total + $tot;

$gttotal = $gttotal + $grand_total;

    

// echo "---" .$sb1;

// return "check";


    if($sb1 == 'config09ban'){

 $mcq_check = is_pass($sb1,($re_hy->mcq_conv+$ct_mcq_conv),"MT");

     $cq_check = is_pass($sb1,($re_hy->cq_conv+$ct_conv),"HT");

     $lab_check =1;


    }elseif($sb1 == 'config09eng'){

  $cq_check = is_pass($sb1,($re_hy->cq_conv+ $ct_conv),"HT");

  $lab_check =1;
  $mcq_check=1;

    }

    elseif($sb1 == 'config09phy'){

  $cq_check = is_pass($sb1,($re_hy->cq_conv+$ct_conv),"HT");
   $mcq_check = is_pass($sb1,($re_hy->mcq_conv+$ct_mcq_conv),"MT");

     $lab_check = is_pass($sb1,($re_hy->practical+$prac),"LT");
        
    }


    elseif($sb1 == 'config09car'){

     $mcq_check = is_pass($sb1,($re_hy->mcq_conv+$ct_mcq_conv),"MT");

    
     $lab_check = is_pass($sb1,($re_hy->practical+$prac),"LT");

     $cq_check=1;

        
    }


     

    
  if((!($mcq_check)) || (!($cq_check)) || (!($lab_check)) ){

        $fail_sub_check =1;
        $fail_count++;

     }


//    if($s1->idsubject ==7){


//     echo "fail_sub_check --" .$fail_sub_check;

//     return "ghapla";
// }

   

     else{

    $gpa = gradecheck($subtot,$grand_total); // receive grade

      $fail_sub_check =0;
   // $fail_check= 0;


     }


//      if($s1->idsubject ==7){


//     echo "fail count -- ".$gpa . "-- ".$fail_sub_check;

//     return "ghapla";
// }



            $sum_total = $sum_total + $grand_total;

   
        $gp_avg = $gpa;


  if($fail_sub_check > 0){

        $gp_avg= 0;
       // $fail_count++;

       }


// if($s1->idsubject ==31){


//     echo "fail count -- ".$gp_avg;

//     return "ghapla";
// }




            if($gp_avg >= 5.00) {$total_grade = "A+"; $gp_avg ="5.00";}
            if($gp_avg <= 4.99 && $gp_avg >= 4.00) $total_grade = "A";
            if($gp_avg <= 3.99 && $gp_avg >= 3.50) $total_grade = "A-";
            if($gp_avg <= 3.49 && $gp_avg >= 3.00) $total_grade = "B";
            if($gp_avg <= 2.99 && $gp_avg >= 2.00) $total_grade = "C";
            if($gp_avg <= 1.99 && $gp_avg >= 1.00) $total_grade = "D";
            if($gp_avg <= 0.99 && $gp_avg >= 0.00) $total_grade = "F";



  $sum_point = $sum_point + $gp_avg;
                $count++;



// if($s1->idsubject ==7){


//     echo "fail count -- ".$fail_count;

//     return "ghapla";
// }




 ?>






                                                    <td >
                                                        <table border="0" style=" table-layout: fixed;width: 250px;height:50px" style="border-collapse:collapse ">
                                                            <tr>



                                                                <td align="center" style=" border-right: 1px solid black; width: 32px">{{$re_hy->total}} </td>

                                                                <td align="center" style="border-right: 1px solid black; width: 32px">{{$tot}}</td>

                                                                <td align="center" style=" width: 32px;border-right: 1px solid black;">{{($tot + $re_hy->total)}}
                                                                </td>

                                                  <td align="center" style=" width: 32px;border-right: 1px solid black;">{{($total_grade)}}
                                                                </td>                 

                                                                  <td align="center" style=" width: 32px;border-right: 1px solid black;">{{($gp_avg)}}
                                                                </td>




<?php 

           
     //   if($s->student_idstudentinfo=='2015908303' && $s1->idsubject== 10){


     //    echo $gp_avg. "<br/>".$fail_check."--sumpoint<br/>".$sum_point . " "."counter - ". $count;

     //    return "ghapla";
     // }


?>


                             

                                                            </tr>
                                                        </table>


                                                    </td>
                                                @endforeach

                                                <td >
                                                    <table border="0" style=" table-layout: fixed;width: 250px;height:50px" style="border-collapse:collapse ">
                                                        <tr>

                                                            <td align="center" style=" width: 32px"><b>{{$gttotal}}</b></td>

                                                          

<?php 




 if($fail_count > 0){

        $point_avg =0;
    }
    else{


   // if($idclasssection==56)$point_avg = sprintf('%.2f',( $sum_point/ ($count)));


   //  else 

        $point_avg = sprintf('%.2f',( $sum_point/ ($count)));

     }



    if($point_avg < 1){

        $point_avg =0;
    }




           if($point_avg >= 5.00) {$total_grade1 = "A+"; $point_avg ="5.00";}
            if($point_avg <= 4.99 && $point_avg >= 4.00) $total_grade1 = "A";
            if($point_avg <= 3.99 && $point_avg >= 3.50) $total_grade1 = "A-";
            if($point_avg <= 3.49 && $point_avg >= 3.00) $total_grade1 = "B";
            if($point_avg <= 2.99 && $point_avg >= 2.00) $total_grade1 = "C";
            if($point_avg <= 1.99 && $point_avg >= 1.00) $total_grade1 = "D";
            if($point_avg <= 0.99 && $point_avg >= 0.00) $total_grade1 = "F";

?>
    

@if($point_avg=='0' || $point_avg==0 || $fail_count >0)

<td align="center" style="border-left: 1px solid black; width: 32px"><b>F({{$fail_count}})</b></td>

@else
    <td align="center" style="border-left: 1px solid black; width: 32px"><b>

                                                                        {{$total_grade1}} </b></td>
    @endif     





@if($fail_count > 0)
<td align="center" style="border-left: 1px solid black; width: 32px;"><b>{{$point_avg}}</b></td>

@else
<td align="center" style="border-left: 1px solid black; width: 32px"><b>{{$point_avg}}</b></td>

@endif


@if($fail_count > 0)
 <td align="center" style="border-left: 1px solid black; width: 32px;color:red"><b>{{"Fail"}}</b></td>
@else

<td align="center" style="border-left: 1px solid black; width: 32px;color:green"><b>{{"Pass"}}</b></td>

@endif


  <td align="center" style="border-left: 1px solid black; width: 32px"><b>{{"NA"}}</b></td>



                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                       <?php 

                                            // $rnk = new RankModel();
                                            
                                            // $rnk->stid = $s->student_idstudentinfo;
                                            // $rnk->class = $classname;
                                            // $rnk->section = $sectionname;
                                            // $rnk->total = $gttotal;
                                            // $rnk->cgpa = $point_avg;
                                            // $rnk->term = 'Final';
                                            // $rnk->rank = '0';
                                            
                                            // $rnk->save();

                    //   break;
                                            
?>
                                            @endforeach

                                        </table>
                                    </div>

                                    <br/><br/>

                                    {{Form::open(['url'=>'pdf_tabulation_sheet_all_new'])}}

                                    {{Form::hidden('classname',$classname)}}
                                    {{Form::hidden('sectionname',$sectionname)}}
                                    {{Form::hidden('term',$term)}}
                                    {{Form::hidden('idclasssection',$idclasssection)}}
                                    {{Form::hidden('year',$year)}}

                                    <center><input type="submit" class="btn btn-info" style="width:220px;" value="Download as PDF"></center>
                                    {{Form::close()}}


                                @endif


                            </div>
                        </div>
                    </div><br>
                    @if(count($students) && count($stu_results))


                        <div style="width: 100%; text-align: center;font-weight: bold">{{ "Total Student: ".count($st).", Number of Failed Student: ".(count($st) - $num_st_pass).", Number of Passed Student: ".$num_st_pass;}}</div>



@endif
                </div> <?php

                $timereq2 = date("h")*3600 + date("i")*60 + date("s"); if(isset($timereq1)) echo "<br><center>Total Students : ".count($students).", Execution Time: ".($timereq2 - $timereq1)." Seconds</center>"; ?>
            </div>

        </div>
        <!-- /widget-content -->
        @if($stu_results == "[]" )<div class="widget-content" style="color: red; text-align: center; font-size: 16px">Result not prepared yet.</div>


        @endif
    </div>
    <!-- /widget -->

    <!-- /span8 -->

@stop
@section('content_footer')
    <script>
        $("#cat").on('change', function (e) {
            console.log(e);
            var cat_id = e.target.value;
            $.get('<?php echo Config::get('baseurl.url');?>/ajax5?cat_id=' + cat_id, function (data) {
                $('#sub').empty();
                $.each(data, function (index, subcatObj) {
                    $('#sub').append('<option value="' + subcatObj.section + '">' + subcatObj.section + '</option>');
                })

            });
        });


        i = 0;

    </script>
@stop