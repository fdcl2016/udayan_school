<?php

ini_set('max_execution_time', 300);

ini_set('memory_limit', '-1');


function is_pass($markconfiguration,$total,$type){

  $mark = $total;

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



// $stu_results=TStudentResult::where('class', '=', $class)
//         ->where('section','=',$section)
//         ->where('academic_year','=',$year)
//         ->orderby('st_id', 'ASC')->orderby('subject', 'ASC')->get();


$st = StudentToSectionUpdate::where('section',$section)->where('year',$year)
        ->leftjoin('studentinfo', 'studentinfo.registration_id', '=', 'student_to_section_update.student_idstudentinfo')
        ->orderby('student_to_section_update.st_roll', 'ASC')->get();



$res = ConvertedMarks::where('year',$year)
        
        ->where('term',$term)
        ->leftjoin('subject', 'subject.idsubject', '=', 'converted_marks.subjectid')
        ->orderby('subject.priority', 'ASC')->get();



$subname = ConvertedMarks::where('class_id',$idclasssection)->where('year',$year)->where('term',$term)
        ->leftjoin('subject', 'subject.idsubject', '=', 'converted_marks.subjectid')
        ->orderby('subject.priority', 'ASC')
        ->groupBy('converted_marks.subjectid')->get();


$std_no = count($st);




$html = '<html>

<body>






   <div class="table-responsive" style="padding-left:1%;padding-right:1%">';
if(count($students)){

    $html.='<br>
      <div style="margin-left: auto;margin-right: auto;width: 960px;background-color: ">



    <div style="width:auto;float: left;text-align: center;margin-right:90px;margin-top:20px" >
        <p style="font-size: 22px;margin-top:20px;font-weight: bold;color:#000066"><img style="margin-top:-40px"  src="../public/image/4d.gif"width="80" height="50" >&nbsp;<span style="font-size: 28px">'. Config::get('schoolname.school') .'</span><br/><span style="text-align:center">University Of Dhaka</span></p>
          <p style="font-size:18px" >
<b style="text-align:center"><u>TABULATION SHEET OF CLASS '.$class."(".$section.")". '</u></b>
        </p>
 <h4><b>'.$term.' Exam&nbsp;-'."2016".'</b></h4>


    </div>


</div>
                                        <br/>
                                        <div>
                                        <table border="1" cellspacing="0"  border="1" style="border-collapse: collapse">

                                            <tr>
                                                <th rowspan="2" style=" padding-left: 10px;padding-right:10px;font-size: 26px;width:100px"><b>Roll</b></th>
                                                <th  rowspan="2"  style=" padding-left: 10px;font-size: 26px;width: 600px"><b>Student Name</b></th>';


  //  $std_no = count($students); $sub_no = (count($stu_results))/$std_no;
    $cls_val = Addclass::where('class_id','=',$idclasssection)->pluck('value');
 //   $count_sub_no = $sub_no;


    foreach($subname as $s){

        $html.='<th style="text-align: center; padding-left: 10px;font-size: 26px">'.$s->subject_name.'</th>';

    }
    $html.='<th style="text-align: center; padding-left: 10px;font-size: 26px">Summary</th>
                                            </tr>';

}
$html.='


 <tr>';
foreach($subname as $s){

    $fail_sub_check =0;

    $html.='<td>

 <table   border="1" cellspacing="1" table-layout: fixed;width: 620px style="border-collapse: collapse;">
                            <tr style="text-align: center; width:100%;">MCQ</tr>

                            <tr>
                                <td style="text-align: center;font-size: 26px;width:100px">Half Yearly</td>
                               <td style="text-align: center;font-size: 26px;width:100px">Final</td>
                                <td align="center" style="text-align: center;font-size: 26px;width:100px"><b>Grand Total</b></td><td align="center" style="text-align: center;font-size: 26px;width:100px "><b>Grade</b></td><td align="center" style="text-align: center;font-size: 26px;width:100px "><b>GPA</b></td>
                            </tr>

                        </table>
</td>';

}

$html.=' <td>
    <table border="1" style=" table-layout: fixed;width: 250px;" style="border-collapse: collapse">
        <tr>


            <td align="center" style=" border-left: 1px solid black;font-size: 26px;width: 150px"><b>Half Yearly Total</b></td>

            <td align="center" style=" border-left: 1px solid black;font-size: 26px;width: 150px"><b>Final Total</b></td>


            <td align="center" style=" border-left: 1px solid black;font-size: 26px;width: 150px"><b>Grand Total</b></td>
            <td align="center" style=" border-left: 1px solid black;font-size: 26px;width: 150px"><b>Grade</b></td>
            <td align="center" style=" border-left: 1px solid black; font-size: 26px;width: 150px"><b>GPA</b></td>
            <td align="center" style=" border-left: 1px solid black; font-size: 26px;width: 150px"><b>Status</b></td>
            <td align="center" style=" border-left: 1px solid black; font-size: 26px;width: 150px"><b>Merit</b></td>

        </tr>
    </table>
</td>
</tr>';

$total = 0;
$avg_gp = 0;
$count = 0;
$fail_count = 0;
$num_st_fail=0;
foreach($st as $s ){

    $is_fail = 0;
    $fail_count=0;
    $sum_point =0;
    $sum_total=0;
    $count=0;
    $fourth_fail=0;

     $fail_check=0;

    $half_yearly_total=0;
    $final_total = 0;
    $gttotal=0;
   

    $html.='<tr><td style="text-align: center;font-size: 26px;width:100px">'.$s->st_roll.'</td><td style="font-size: 26px;width: 600px">'.$s->sutdent_name.'</td>';

    foreach($subname as $s1){

         $grand_total = 0;
         $cq_check =0;
         $mcq_check=0;

         $fail_sub_check =0;
        
         $lab_check=0;
         $subtot=0;

  $re_hy = ConvertedMarks::where('st_id',$s->student_idstudentinfo)->where('year',$year)
                ->where('term','Half Yearly')
                ->where('class_id',$idclasssection)
                ->where('subjectid',$s1->idsubject)
                ->first();


        $re = ConvertedMarks::where('st_id',$s->student_idstudentinfo)->where('year',$year)
                ->where('term',$term)
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
            $ct_cq = "0";
            $ct_tot = "0";
            $ct_conv = "0";
            $ct_mcq = "0";
            $ct_mtot = "0";
            $ct_mcq_conv = "0";
            $prac = "0";
            $grade = "0";
            $gpa = 0;
            $tot = 0;

        }


 $sb1 = Subtot::where('idsubject',$s1->idsubject)->where('class','NINE')->pluck('configuration_type');

    if($term =='Half Yearly')
        {

             $sb = Subtot::where('idsubject',$s1->idsubject)->where('class','NINE')->pluck('total');
                
                $subtot = $sb;

        }else{
     

         $sb = Subtot::where('idsubject',$s1->idsubject)->where('class','NINE')->pluck('gt_total');
                $subtot = $sb;

     }

 //$rnk = RankModel::where('stid',$s->student_idstudentinfo)->where('term',$term)->where('year',$year)->first();   


    $rnk = RankModel::where('stid',$s->student_idstudentinfo)->where('year',$year)->where('term',$term)->pluck('rank');

                if(!$rnk || $rnk=="" || $rnk==[]){
                  
                  $rnk = "N/A";

                }else{

                  $rnk = $rnk;
                }


$grand_total = $re_hy->total + $tot;

        $html.='<td>

<table   border="1" cellspacing="1"  style="border-collapse: collapse;">
                            <tr style="text-align: center; width:100%;">MCQ</tr>

                            <tr>
                                <td style="text-align: center;font-size: 26px;width:100px">'.$re_hy->total.'<td style="text-align: center;font-size: 26px;width:100px">'.$tot.'</td>
      <td align="center" style="text-align: center;font-size: 26px;width:100px"><b>'.$grand_total.'</b></td>';

$grand_total = $re_hy->total + $tot;

$half_yearly_total = $half_yearly_total + $re_hy->total;

$final_total = $final_total + $tot;

$gttotal = $gttotal + $grand_total;


$mc = $re_hy->mcq_conv+$ct_mcq_conv;


    

      if($sb1 == 'config09ban'){

      $mcq_check = is_pass($sb1,$mc,"MT");


     //   if($s1->idsubject == 4){

     //       echo  "mcq_check : " .$mcq_check ."<br/> marks : ".$mc;

     // return "ghapla";
     // }

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


     //     if($s1->idsubject == 4){

     //       echo  "mcq_check : " .$mcq_check . "cq_check : ".$cq_check. "lab_check : ".$lab_check .  "fail_flag". $fail_sub_check;

     // return "ghapla";
     // }

   
  



     else{

    $gpa = gradecheck($subtot,$grand_total); // receive grade

      $fail_sub_check =0;



   // $fail_check= 0;


     }





      $sum_total = $sum_total + $grand_total;

       // if($fail_check!= 0 || $fail_check!= '0' )
       //     { 

       //      $gp_avg = 0.0;
       //      $fail_count++;

       //  }
    $gp_avg = $gpa;


  if($fail_sub_check > 0){

        $gp_avg= 0;
       // $fail_count++;

       }

            if($gp_avg >= 5.00) {$total_grade = "A+"; $gp_avg ="5.00";}
            if($gp_avg <= 4.99 && $gp_avg >= 4.00) $total_grade = "A";
            if($gp_avg <= 3.99 && $gp_avg >= 3.50) $total_grade = "A-";
            if($gp_avg <= 3.49 && $gp_avg >= 3.00) $total_grade = "B";
            if($gp_avg <= 2.99 && $gp_avg >= 2.00) $total_grade = "C";
            if($gp_avg <= 1.99 && $gp_avg >= 1.00) $total_grade = "D";
            if($gp_avg <= 0.99 && $gp_avg >= 0.00) $total_grade = "F";



       // if($s1->idsubject=='4'){

       //      echo "subtot--"." ". $subtot. " <br/>grand_total ".$grand_total."<br/>gpa- ".$gp_avg."<br/>fail_flag - ". $fail_check;

       //      return "ghapla";

       //  }





                $sum_point = $sum_point + $gp_avg;
                $count++;


              

                    $html.='<td align="center" style="text-align: center;font-size: 26px;width:100px"><b>'.$total_grade.'</b></td>';
                    $html.='<td align="center" style="text-align: center;font-size: 26px;width:100px;"><b>'.$gp_avg.'</b></td>';

//}
         //   }


        $html.='</tr>

                        </table>
</td>';




}
    $html.='<td><table border="1" style="width: 150px;border-collapse: collapse;font-size: 26px;text-align: center"><tr><td style="width: 150px">'.$half_yearly_total.'</td><td style="width: 150px">'.$final_total.'</td><td style="width: 150px">'.$gttotal.'</td>';

        $grdpoint= "";



 
 if($fail_count > 0){

        $point_avg =0;
    }
    else{



        $point_avg = sprintf('%.2f',( $sum_point/ ($count)));

     }



    if($point_avg < 1){

        $point_avg =0;
    }


    if($point_avg >= 5.00) {$total_grade_final = "A+"; $point_avg ="5.00";}
    if($point_avg <= 4.99 && $point_avg >= 4.00) $total_grade_final = "A";
    if($point_avg <= 3.99 && $point_avg >= 3.50) $total_grade_final = "A-";
    if($point_avg <= 3.49 && $point_avg >= 3.00) $total_grade_final = "B";
    if($point_avg <= 2.99 && $point_avg >= 2.00) $total_grade_final = "C";
    if($point_avg <= 1.99 && $point_avg >= 1.00) $total_grade_final = "D";
    if($point_avg <= 0.99 && $point_avg >= 0.00) $total_grade_final = "F";






        if($fail_count > 0 || $point_avg=='0' || $point_avg==0){

            $num_st_fail ++;

        $html.='<td style="font-size: 28px;width: 150px;text-align: center;color:red">F('.($fail_count).')</td>';
        }

  

        else{


            $html.='<td style="font-size: 26px;width: 150px;text-align: center">'.$total_grade_final.'</td>';
         }




    $html.='<td style="font-size: 28px;width: 150px;text-align: center">'.$point_avg.'</td>';



   if($fail_count > 0){ 

$html.='<td style="font-size: 26px;width: 150px;text-align: center;color:red">Fail</td>';

}else{


$html.='<td style="font-size: 26px;width: 150px;text-align: center;color:green">Pass</td>';
}

$html.='<td style="font-size: 26px;width: 150px;text-align: center">'.$rnk.'</td>

    ';

    $html.='</tr></table></td></tr>';


   //break;


}






$class_teacher_name = Auth::user()->username;


$html.='</table>
                                        </div>

                                        <br/><br/>



              

                                


                                         <div style="position: relative; margin: auto; top: 0; right: 0; bottom: 0; left: 0; width: 850px;">
                                            <br/>                                            
                                            <table style="table-layout: fixed; width: 100%;" >
                                                <tr>
                                                    <td width="50px">
                                                        <img src="./image/grade_.png" height="70px"/>
                                                    </td>
                                                    <td width="133px" style="text-align: center; font-size: 10px">
                                                        <b>Teacher\'s signs
                                                        </td>
                                                <td style="border: 1px solid;">
                                                    
                                                    </td>
                                                    <td width="133px" style="text-align: center; font-size: 10px">
                                                        <b>Class Teacher\'s Signature:
                                                    </td>
                                                    <td width="133px" style="text-align: center; font-size: 10px">
                                                        <br/>
                                                        <br/>
                                                        <hr/>
                                                        Class Teacher
                                                        <br/>
                                                        '.$class_teacher_name.'
                                                        </td>
                                                    <td width="133px" style="text-align: center; font-size: 10px">
                                                        <b>Principal\'s Signature: 
                                                    </td>
                                                    <td width="133px" style="text-align: center; font-size: 10px">
                                                        <img src="./image/ps.jpg" width="80px" height="20px"/>
                                                        <hr/>
                                                        Principal Signature
                                                        <br/>
                                                        Dr. Umme Salema Begum
                                                    </td> 
                                                </tr>
                                            </table>
                                            </div>
                                        </body></html>


                                        </body></html>';



//}


include("mpdf60/mpdf.php");


$mpdf=new mPDF('c','A1-L');
$mpdf->AddPage();

$mpdf->SetFont('Times New Roman',"B",10);
//$mpdf->SetXY(0*10.4, 0.8*15.4);
//$mpdf->SetTextColor(255,240,255);


$mpdf->allow_charset_convertion=true;

$mpdf->charset_in = 'UTF-8';

$mpdf->writeHTML($html);


$mpdf->Output($class.'_'.$section.'.pdf', "I");


exit();
?>