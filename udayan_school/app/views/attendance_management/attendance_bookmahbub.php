<?php
ob_start();

$html = ob_get_clean();

$html = utf8_encode($html);

$link = mysqli_connect("10.34.46.6", "iteamsco_udayan", "ud@yan123", "iteamsco_udayan_db");

if($link === false){

    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$wi = "width=17px";

$wi1 = "width=18px";



$html ='<h2>UDAYAN UCHCHA MADHYAMIK BIDYALAYA</h2>
         <h4>Attendance of '.$month.'</h4>
         <h4>Class:'.$clsName.'</h4>
         <h4>Class:'.$secName.'</h4>
         <h4>Year: '.$year.'</h4>
         <p>H=Holiday; P=Present; A=Absent</p>';

$html .=' <style>
table {
    border: 1px solid black;
    border-collapse: collapse;



}
h2,h4{
    text-align: center;
}
p{
  text-align: center;
}


td {
   font-size: 70%;
}

</style>
<table border="1">


  <tr>
      <td colspan="34" style="text-align: center">Day</td>
  </tr>
  <tr>
    <td width=32px>Roll</td>
    <td width=96px>Name</td>
    <td '.$wi.'>1</td>
    <td '.$wi.'>2</td>
    <td '.$wi.'>3</td>
    <td '.$wi.'>4</td>
    <td '.$wi.'>5</td>
    <td '.$wi.'>6</td>
    <td '.$wi.'>7</td>
    <td '.$wi.'>8</td>
    <td '.$wi.'>9</td>
    <td '.$wi.'>10</td>
    <td '.$wi.'>11</td>
    <td '.$wi.'>12</td>
    <td '.$wi.'>13</td>
    <td '.$wi.'>14</td>
    <td '.$wi.'>15</td>
    <td '.$wi.'>16</td>
    <td '.$wi.'>17</td>
    <td '.$wi.'>18</td>
    <td '.$wi.'>19</td>
    <td '.$wi.'>20</td>
    <td '.$wi.'>21</td>
    <td '.$wi.'>22</td>
    <td '.$wi.'>23</td>
    <td '.$wi.'>24</td>
    <td '.$wi.'>25</td>
    <td '.$wi.'>26</td>
    <td '.$wi.'>27</td>
    <td '.$wi.'>28</td>
    <td '.$wi.'>29</td>
    <td '.$wi.'>30</td>
    <td '.$wi.'>31</td>
    <td '.$wi1.'>tot-ab</td>

</tr>
</table>';


/*$sql2 = "SELECT studentinfo.sutdent_name, studentinfo.student_roll
FROM studentinfo
LEFT JOIN attendance_classsection
ON studentinfo.registration_id=attendance_classsection.Student_id
Where attendance_classsection.Class_Section_Id ='$classsection' && attendance_classsection.idsubject = '$idsubject'
ORDER BY studentinfo.student_roll";

       $sql2 ="SELECT * FROM studentinfo
       LEFT JOIN attendance_classsection
       LEFT JOIN student_to_section_update
       ON attendance_classsection.Student_id = studentinfo.registration_id AND
       ON attendance_classsection.Student_id = student_to_section_update.student_idstudentinfo
       where attendance_classsection.Class_Section_Id ='$classsection' AND attendance_classsection.idsubject = '$idsubject'
       ORDER BY student_to_section_update.st_roll"; */

$sql2 = "SELECT ac.Student_id, si.sutdent_name, su.st_roll FROM attendance_classsection ac, studentinfo si, student_to_section_update su WHERE ac.Student_id = si.registration_id AND ac.Student_id = su.student_idstudentinfo AND ac.idsubject = '$idsubject' AND ac.Month = '$month' AND ac.Class_Section_Id = '$classsection' ORDER BY su.st_roll";




if($result = mysqli_query($link, $sql2)){

    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_array($result)){





            $name[]  = $row['sutdent_name'];
            $roll[] = $row['st_roll'];



        }}

}

//print_r($row);






$sql = " SELECT * FROM attendance where classsection_id='$classsection' && idsubject='$idsubject'";

if($result = mysqli_query($link, $sql)){

    if(mysqli_num_rows($result) > 0){



        while($row = mysqli_fetch_array($result)){


            $id[]  = $row["studentinfo_idstudentinfo"];

            if ($row['day01']=='a'){
                $day1[] = 'A';
            }else if($row['day01']=='p'){
                $day1[] ='P';

            }else
            {
                $day1[] ='H';
            }


            if ($row['day02']=='a'){
                $day2[] = 'A';
            }else if($row['day02']=='p'){
                $day2[] ='P';

            }else
            {
                $day2[] ='H';
            }


            if ($row['day03']=='a'){
                $day3[] = 'A';
            }else if($row['day03']=='p'){
                $day3[] ='P';

            }else
            {
                $day3[] ='H';
            }



            if ($row['day04']=='a'){
                $day4[] = 'A';
            }else if($row['day04']=='p'){
                $day4[] ='P';

            }else
            {
                $day4[] ='H';
            }




            if ($row['day05']=='a'){
                $day5[] = 'A';
            }else if($row['day05']=='p'){
                $day5[] ='P';

            }else
            {
                $day5[] ='H';
            }


            if ($row['day06']=='a'){
                $day6[] = 'A';
            }else if($row['day06']=='p'){
                $day6[] ='P';

            }else
            {
                $day6[] ='H';
            }



            if ($row['day07']=='a'){
                $day7[] = 'A';
            }else if($row['day07']=='p'){
                $day7[] ='P';

            }else
            {
                $day7[] ='H';
            }



            if ($row['day08']=='a'){
                $day8[] = 'A';
            }else if($row['day08']=='p'){
                $day8[] ='P';

            }else
            {
                $day8[] ='H';
            }



            if ($row['day09']=='a'){
                $day9[] = 'A';
            }else if($row['day09']=='p'){
                $day9[] ='P';

            }else
            {
                $day9[] ='H';
            }



            if ($row['day10']=='a'){
                $day10[] = 'A';
            }else if($row['day10']=='p'){
                $day10[] ='P';

            }else
            {
                $day10[] ='H';
            }



            if ($row['day11']=='a'){
                $day11[] = 'A';
            }else if($row['day11']=='p'){
                $day11[] ='P';

            }else
            {
                $day11[] ='H';
            }



            if ($row['day12']=='a'){
                $day12[] = 'A';
            }else if($row['day12']=='p'){
                $day12[] ='P';

            }else
            {
                $day12[] ='H';
            }



            if ($row['day13']=='a'){
                $day13[] = 'A';
            }else if($row['day13']=='p'){
                $day13[] ='P';

            }else
            {
                $day13[] ='H';
            }




            if ($row['day14']=='a'){
                $day14[] = 'A';
            }else if($row['day14']=='p'){
                $day14[] ='P';

            }else
            {
                $day14[] ='H';
            }



            if ($row['day15']=='a'){
                $day15[] = 'A';
            }else if($row['day15']=='p'){
                $day15[] ='P';

            }else
            {
                $day15[] ='H';
            }



            if ($row['day16']=='a'){
                $day16[] = 'A';
            }else if($row['day16']=='p'){
                $day16[] ='P';

            }else
            {
                $day16[] ='H';
            }



            if ($row['day17']=='a'){
                $day17[] = 'A';
            }else if($row['day17']=='p'){
                $day17[] ='P';

            }else
            {
                $day17[] ='H';
            }


            if ($row['day18']=='a'){
                $day18[] = 'A';
            }else if($row['day18']=='p'){
                $day18[] ='P';

            }else
            {
                $day18[] ='H';
            }


            if ($row['day19']=='a'){
                $day19[] = 'A';
            }else if($row['day19']=='p'){
                $day19[] ='P';

            }else
            {
                $day19[] ='H';
            }


            if ($row['day20']=='a'){
                $day20[] = 'A';
            }else if($row['day20']=='p'){
                $day20[] ='P';

            }else
            {
                $day20[] ='H';
            }


            if ($row['day21']=='a'){
                $day21[] = 'A';
            }else if($row['day21']=='p'){
                $day21[] ='P';

            }else
            {
                $day21[] ='H';
            }


            if ($row['day22']=='a'){
                $day22[] = 'A';
            }else if($row['day22']=='p'){
                $day22[] ='P';

            }else
            {
                $day22[] ='H';
            }


            if ($row['day23']=='a'){
                $day23[] = 'A';
            }else if($row['day23']=='p'){
                $day23[] ='P';

            }else
            {
                $day23[] ='H';
            }



            if ($row['day24']=='a'){
                $day24[] = 'A';
            }else if($row['day24']=='p'){
                $day24[] ='P';

            }else
            {
                $day24[] ='H';
            }




            if ($row['day25']=='a'){
                $day25[] = 'A';
            }else if($row['day25']=='p'){
                $day25[] ='P';

            }else
            {
                $day25[] ='H';
            }




            if ($row['day26']=='a'){
                $day26[] = 'A';
            }else if($row['day26']=='p'){
                $day26[] ='P';

            }else
            {
                $day26[] ='H';
            }



            if ($row['day27']=='a'){
                $day27[] = 'A';
            }else if($row['day27']=='p'){
                $day27[] ='P';

            }else
            {
                $day27[] ='H';
            }


            if ($row['day28']=='a'){
                $day28[] = 'A';
            }else if($row['day28']=='p'){
                $day28[] ='P';

            }else
            {
                $day28[] ='H';
            }




            if ($row['day29']=='a'){
                $day29[] = 'A';
            }else if($row['day29']=='p'){
                $day29[] ='P';

            }else
            {
                $day29[] ='H';
            }



            if ($row['day30']=='a'){
                $day30[] = 'A';
            }else if($row['day30']=='p'){
                $day30[] ='P';

            }else
            {
                $day30[] ='H';
            }



            if ($row['day31']=='a'){
                $day31[] = 'A';
            }else if($row['day31']=='p'){
                $day31[] ='P';

            }else
            {
                $day31[] ='H';
            }



        }}






    /*$counter = 0;
    $i=0;
    while($day19[$i]=='P')
    {
            $counter++;
    }
    */


    $total = count($roll);
//echo $total; return 0;

    $html.='<style>
table {
    border: 1px solid black;
    border-collapse: collapse;
    font-size: 100%;


}
td {
   font-size: 70%;
   text-align: center;
}
</style>

<table border="1">';

    for($i=0;$i<$total;$i++){

        $counter=0;

        if ($day1[$i]=='A'){

            $counter++;
        }

        if ($day2[$i]=='A'){

            $counter++;
        }

        if ($day3[$i]=='A'){

            $counter++;
        }

        if ($day4[$i]=='A'){

            $counter++;
        }

        if ($day5[$i]=='A'){

            $counter++;
        }

        if ($day6[$i]=='A'){

            $counter++;
        }

        if ($day7[$i]=='A'){

            $counter++;
        }

        if ($day8[$i]=='A'){

            $counter++;
        }

        if ($day9[$i]=='A'){

            $counter++;
        }

        if ($day10[$i]=='A'){

            $counter++;
        }

        if ($day11[$i]=='A'){

            $counter++;
        }

        if ($day12[$i]=='A'){

            $counter++;
        }

        if ($day13[$i]=='A'){

            $counter++;
        }

        if ($day14[$i]=='A'){

            $counter++;
        }

        if ($day15[$i]=='A'){

            $counter++;
        }

        if ($day16[$i]=='A'){

            $counter++;
        }

        if ($day17[$i]=='A'){

            $counter++;
        }

        if ($day18[$i]=='A'){

            $counter++;
        }

        if ($day19[$i]=='A'){

            $counter++;
        }

        if ($day20[$i]=='A'){

            $counter++;
        }

        if ($day21[$i]=='A'){

            $counter++;
        }

        if ($day22[$i]=='A'){

            $counter++;
        }

        if ($day23[$i]=='A'){

            $counter++;
        }

        if ($day24[$i]=='A'){

            $counter++;
        }

        if ($day25[$i]=='A'){

            $counter++;
        }

        if ($day26[$i]=='A'){

            $counter++;
        }

        if ($day27[$i]=='A'){

            $counter++;
        }

        if ($day28[$i]=='A'){

            $counter++;
        }

        if ($day29[$i]=='A'){

            $counter++;
        }

        if ($day30[$i]=='A'){

            $counter++;
        }

        if ($day31[$i]=='A'){

            $counter++;
        }




        $html .='
<tr>



    <td width=31px>'.$roll[$i].'</td>
    <td  width=95px>'.$name[$i].'</td>
    <td '.$wi.'>'.$day1[$i].'</td>
    <td '.$wi.'>'.$day2[$i].'</td>
    <td '.$wi.'>'.$day3[$i].'</td>
    <td '.$wi.'>'.$day4[$i].'</td>
    <td '.$wi.'>'.$day5[$i].'</td>
    <td '.$wi.'>'.$day6[$i].'</td>
    <td '.$wi.'>'.$day7[$i].'</td>
    <td '.$wi.'>'.$day8[$i].'</td>
    <td '.$wi.'>'.$day9[$i].'</td>
    <td '.$wi.'>'.$day10[$i].'</td>
    <td '.$wi.'>'.$day11[$i].'</td>
    <td '.$wi.'>'.$day12[$i].'</td>
    <td '.$wi.'>'.$day13[$i].'</td>
    <td '.$wi.'>'.$day14[$i].'</td>
    <td '.$wi.'>'.$day15[$i].'</td>
    <td '.$wi.'>'.$day16[$i].'</td>
    <td '.$wi.'>'.$day17[$i].'</td>
    <td '.$wi.'>'.$day18[$i].'</td>
    <td '.$wi.'>'.$day19[$i].'</td>
    <td '.$wi.'>'.$day20[$i].'</td>
    <td '.$wi.'>'.$day21[$i].'</td>
    <td '.$wi.'>'.$day22[$i].'</td>
    <td '.$wi.'>'.$day23[$i].'</td>
    <td '.$wi.'>'.$day24[$i].'</td>
    <td '.$wi.'>'.$day25[$i].'</td>
    <td '.$wi.'>'.$day26[$i].'</td>
    <td '.$wi.'>'.$day27[$i].'</td>
    <td '.$wi.'>'.$day28[$i].'</td>
    <td '.$wi.'>'.$day29[$i].'</td>
    <td '.$wi.'>'.$day30[$i].'</td>
    <td '.$wi.'>'.$day31[$i].'</td>
    <td style="width:30px">'.$counter.'</td>
</tr>
';





    }
    $html .='</table>';

}





include("mpdf60/mpdf.php");

$mpdf=new mPDF();

$mpdf->allow_charset_convertion=true;

$mpdf->charset_in = 'UTF-8';

$mpdf->writeHTML($html5);
$mpdf->writeHTML($html);




$mpdf->Output('Attendance','I');

exit();
?>
