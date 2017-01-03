<?php //function makePDF($id){
    include("mpdf/mpdf.php");
    include 'connect.php';
    $link = mysqli_connect("localhost", "root", "", "mahbub");

    if($link === false){

        die("ERROR: Could not connect. " . mysqli_connect_error());
    }


   //$id = '160216043';
    $sql = " SELECT * FROM appinfo where ref_number='$id' ";

    if($result = mysqli_query($link, $sql)){

        if(mysqli_num_rows($result) > 0){

            while($row = mysqli_fetch_array($result)){

                $id = $row['ref_number'];
                $nam  = $row['name'];
                $desig  = $row['designation'];
                $dept  = $row['dept'];
                $contact = $row['ph_no'];
                $email = $row['email'];
                $type  = $row['type'];
                $uni = $row['university'];

                $ssc_inst = $row['ssc_inst'];
                $ssc_year= $row['ssc_year'];
                $ssc_gpa = $row['ssc_gpa'];

                $hsc_inst = $row['hsc_inst'];
                $hsc_year= $row['hsc_year'];
                $hsc_gpa = $row['hsc_gpa'];

                $bsc_inst = $row['bsc_inst'];
                $bsc_year= $row['bsc_year'];
                $bsc_gpa = $row['bsc_gpa'];

                $msc_inst = $row['msc_inst'];
                $msc_year= $row['msc_year'];
                $msc_gpa = $row['msc_gpa'];

                $mphil_inst = $row['mphil_inst'];
                $mphil_year= $row['mphil_year'];
                $mphil_gpa = $row['mphil_gpa'];


                $phd_inst = $row['phd_inst'];
                $phd_year= $row['phd_year'];
                $phd_gpa = $row['phd_gpa'];

                $post_inst = $row['post_inst'];
                $post_year= $row['post_year'];
                $post_gpa = $row['post_gpa'];

                $sanog_year = $row['sanog_year'];
                $sanog_venue = $row['sanog_venue'];
                $sanog_role = $row['sanog_role'];

                $bdnog_year = $row['bdnog_year'];
                $bdnog_venue = $row['bdnog_venue'];
                $bdnog_role = $row['bdnog_role'];

                $apnic_year = $row['apnic_year'];
                $apnic_venue = $row['apnic_venue'];
                $apnic_role = $row['apnic_role'];

                $apaiv_year = $row['apaiv_year'];
                $apaiv_venue = $row['apaiv_venue'];
                $apaiv_role = $row['apaiv_role'];

                $tfin_year = $row['tfin_year'];
                $tfin_venue = $row['tfin_venue'];
                $tfin_role = $row['tfin_role'];

                $ans1 = $row['q1'];
                $imgloc = $row['upload_url'];
                //$ans3 = $row['ans3'];
                //$ans4 = $row['ans4'];


            }

        }

    }




    $mpdf=new mPDF();
    $mpdf->AddPage();


    $fileName = "UnivApplications/" . $id . ".pdf";
	
$mpdf->ignore_invalid_utf8 = true;

$baseX=45;
$baseY=10;
$mpdf->SetLineWidth(0.1);
$mpdf->SetFillColor(126,192,238);
$mpdf->RoundedRect(10,01,7.5*25.4, 1.0*25.4, 1.5, "DF");
$mpdf->SetXY(0*25.4, 0.8*25.4);
$mpdf->Image("bdrenlogo.jpg",20,03,0.75*25.4,0.85*25.4,".jpg");
$mpdf->SetFont("Times","B",14);
//$mpdf->SetTextColor(255,255,255);
$mpdf->WriteText($baseX, $baseY, "Bangladesh Research and Education Network Trust");
$mpdf->SetFont("Times","B",12);
$mpdf->WriteText($baseX+30, $baseY+7, "Fellowship Application Form");

// PERSONAL INFORMATION (1ST - STEP)

$mpdf->SetLineWidth(0.1);
$mpdf->SetFillColor(200,200,25);
$mpdf->RoundedRect(10,28,7.5*25.4, 2.5*25.4, 1.5, "DF");

$mpdf->SetFont("Times","B",11);
$mpdf->WriteText($baseX+30, $baseY+25, "Personal Information");
$mpdf->WriteText($baseX+30, $baseY+27, "-----------------------------");
$mpdf->WriteText($baseX-30, $baseY+34, "Name of Applicant:");

$mpdf->WriteText($baseX-30, $baseY+41, "Designation:");

$mpdf->WriteText($baseX-30, $baseY+48, "Department:");

$mpdf->WriteText($baseX-30, $baseY+55, "University:");

$mpdf->SetFont("Times","",10);
$mpdf->WriteText($baseX+15, $baseY+34, $nam);
$mpdf->WriteText($baseX+15, $baseY+41, $desig);
$mpdf->WriteText($baseX+15, $baseY+48, $dept);
$mpdf->WriteText($baseX+15, $baseY+55, $uni);



// PROFESSIONAL INFORMATION ( 2ND - STEP )

//$mpdf->SetLineWidth(0.1);
//$mpdf->SetFillColor(255,200,255);
//$mpdf->RoundedRect(10,80.5,7.5*25.4, 4.7*25.4, 1.5, "DF");
$mpdf->SetFont("Times","B",11);
//$mpdf->WriteText($baseX+30, $baseY+75, "Professional Information ");
//$mpdf->WriteText($baseX+30, $baseY+77, "---------------------------------- ");
$mpdf->SetFont("Times","B",11);
$baseY=72;
$mpdf->WriteText($baseX-30, $baseY+1, "Contact No:");
$mpdf->WriteText($baseX-30, $baseY+9, "Email ");
//$mpdf->WriteText($baseX-30, $baseY+17, "Date of joining:");
//$mpdf->WriteText($baseX-30, $baseY+30, "Job responsibilities:");

//<pagebreak />

$mpdf->SetFont("Times","",11);
$mpdf->WriteText($baseX+15, $baseY+1, $contact);
$mpdf->WriteText($baseX+15, $baseY+9, $email);
//$mpdf->WriteText($baseX+15, $baseY+17,$join);
//$mpdf->WriteText($baseX+20, $baseY+25,$res);


//$mpdf->SetFillColor(100,200,255);
//$mpdf->RoundedRect(10,133,7.5*25.4, 2.67*25.4, 1.5, "DF");
//$mpdf->SetFont("Times","B",11);
//$mpdf->WriteText($baseX+30, 138, "Educational Information");
//$mpdf->WriteText($baseX+30, 140, "---------------------------------");


$baseX=03;
$baseY=100;
$mpdf->SetFont("Times","B",11);



/***************** CERTIFICATE *************************/

$mpdf->SetFillColor(100,230,105);
$mpdf->RoundedRect(10,93,7.5*25.4, 4*25.4, 1.5, "DF");
$mpdf->SetFont("Times","B",11);
$mpdf->WriteText($baseX+75, 100, "Educational Information");
$mpdf->WriteText($baseX+75, 102, "---------------------------------");


$baseX=45;
$baseY=195;

// PERSONAL INFORMATION (1ST - STEP)

$mpdf->SetLineWidth(0.1);
$mpdf->SetFillColor(255,200,20);
$mpdf->RoundedRect(10,198,7.5*25.4, 3.0*25.4, 1.5, "DF");
$mpdf->SetFont("Times","B",12);
$mpdf->WriteText($baseX+35, $baseY+13, "Conference Attended");
$mpdf->WriteText($baseX+35, $baseY+16, "----------------------------------");


$baseX=05;
$baseY=300;
//$mpdf->SetFont("Times","B",11);

$mpdf->SetFont("Times","",9);
$mpdf->SetTextColor(192,192,192);
$mpdf->WriteText($baseX+20, 284, "Fellowship application must be submitted through BdREN website at: fellowshipapplication.bdren.net.bd ");
$mpdf->WriteText($baseX+175, 288, "Page - 1");

/*********************** TRAINING ************************/


// ***************************** EDUCATION *************************************
$baseX=05;
$baseY=180;

   // $html = '<table style="margin-top:395px"><textarea class="longInput" cols="90" rows="12">' . $res .'</textarea></table>';

  
/*

  $i=0;
    mysql_select_db("bdrendb");
    //$id = $_SESSION['bdren_user_session_resume_id'];
    // echo "**************$id";
    $statement = "SELECT * FROM user_education where userid = '$id'";
    //$statement->execute();
    $result = mysqli_query($link, $statement);



    while($row = mysqli_fetch_array($result))
    {
        $i++;

        $html .= '<tr style="padding:15px">

            <td style="text-align:center ; font-size:13px" width="100px">' .  $i. '</td>
            <td style="text-align:center; text-transform:uppercase; font-size:11px" width="200px">' .$row['examname'] .'</td>

            <td style="text-align:center;text-transform:uppercase; font-size:11px" widtext-transform:uppercaseth="250px">' . $row['board'] . '</td>

            <td style="text-align:center;text-transform:uppercase; font-size:11px" width="200px">' . $row['result'] .
            '</td>



      </tr>';



    }
   // $html .= '</table>';
*/

    $baseX=30;
    $baseY=150;
    $mpdf->SetFont("Times","B",11);
    $mpdf-> WriteHTML($html);

// *************************************** CERTIFICATE ************************************

    $html1 = '<table class="table table-striped table-bordered" style="margin-top:350px ; font-size:18px" border="1">

    
	    <tr>
              <th style="text-align:center" width="100px"><b>Exam</b></th>
              <th style="text-align:center" width="300px"><b>Board / University</b></th>
              <th style="text-align:center" width="150px"><b>Passing year</b></th>

              <th style="text-align:center" width="100px"><b>Result</b></th>
    </tr>';

    //$id = $_SESSION['bdren_user_session_resume_id'];
    // echo "**************$id";
    //$statement->execute();



            $html1 .= '<tr style="padding:15px">

			
			
            <td style="text-align:center; " width="100px">SSC/Equivalent</td>
            <td style="text-align:center;text-transform:uppercase;">' .$ssc_inst.'</td>

            <td style="text-align:center;text-transform:uppercase; " >' .$ssc_year. '</td>

            <td style="text-align:center;text-transform:uppercase;" >' .$ssc_gpa.
                '</td>

      </tr>
      <tr style="padding:15px">
            <td style="text-align:center; " width="100px">HSC/Equivalent</td>
            <td style="text-align:center;text-transform:uppercase;">' .$hsc_inst.'</td>

            <td style="text-align:center;text-transform:uppercase; " >' .$hsc_year. '</td>

            <td style="text-align:center;text-transform:uppercase;" >' .$hsc_gpa.
                '</td>
      </tr>
      <tr style="padding:15px">
            <td style="text-align:center; " width="100px">Bachelor</td>
            <td style="text-align:center;text-transform:uppercase;">' .$bsc_inst.'</td>

            <td style="text-align:center;text-transform:uppercase; " >' .$bsc_year. '</td>

            <td style="text-align:center;text-transform:uppercase;" >' .$bsc_gpa.
                '</td>
      </tr>
      <tr style="padding:15px">
            <td style="text-align:center; " width="100px">Masters</td>
            <td style="text-align:center;text-transform:uppercase;">' .$msc_inst.'</td>

            <td style="text-align:center;text-transform:uppercase; " >' .$msc_year. '</td>

            <td style="text-align:center;text-transform:uppercase;" >' .$msc_gpa.
                '</td>
      </tr>
      <tr style="padding:15px">
            <td style="text-align:center; " width="100px">MPhil</td>
            <td style="text-align:center;text-transform:uppercase;">' .$mphil_inst.'</td>

            <td style="text-align:center;text-transform:uppercase; " >' .$mphil_year. '</td>

            <td style="text-align:center;text-transform:uppercase;" >' .$mphil_gpa.
                '</td>
      </tr>
       <tr style="padding:15px">
            <td style="text-align:center; " width="100px">PhD</td>
            <td style="text-align:center;text-transform:uppercase;">' .$phd_inst.'</td>

            <td style="text-align:center;text-transform:uppercase; " >' .$phd_year. '</td>

            <td style="text-align:center;text-transform:uppercase;" >' .$phd_gpa.
                '</td>
      </tr>
<tr style="padding:15px">
            <td style="text-align:center; " width="100px">Post Doc</td>
            <td style="text-align:center;text-transform:uppercase;">' .$post_inst.'</td>

            <td style="text-align:center;text-transform:uppercase; " >' .$post_year. '</td>

            <td style="text-align:center;text-transform:uppercase;" >' .$post_gpa.
                '</td>
      </tr>

      ';





    $html1 .= '</table>';


    $baseX=30;
    $baseY=110;
    $mpdf->SetFont("Times","B",11);
    $mpdf-> WriteHTML($html1);


$mpdf->SetFont("Times","B",11);

$html2 = '<table class="table table-striped table-bordered" style="margin-top:190px; margin-left:25px" border="1">

    <tr>
              <th style="text-align:center" style="font-weight:bold; font-size:16px" width="100px"><b>Name</b></th>
              <th style="text-align:center" style="font-weight:bold; font-size:16px" width="200px"><b>Year</b></th>
              <th style="text-align:center" style="font-weight:bold; font-size:16px" width="250px"><b>Venue</b></th>
              <th style="text-align:center" style="font-weight:bold; font-size:16px" width="200px"><b>Role</b></th>

    </tr>';


    $html2 .= '<tr style="padding:15px">

            <td style="text-align:center; font-size:20px" width="100px">SANOG</td>
            <td style="text-align:center;text-transform:uppercase; font-size:15px" width="150px">'.$sanog_year.'</td>

            <td style="text-align:center;text-transform:uppercase ; font-size:15px" width="200px">'.$sanog_venue.'</td>

            <td style="text-align:center; text-transform:uppercase; font-size:15px" width="150px">'.$sanog_role.'</td>


      </tr>';

$html2 .= '<tr style="padding:15px">

            <td style="text-align:center; font-size:20px" width="100px">BDNOG</td>
            <td style="text-align:center;text-transform:uppercase; font-size:15px" width="150px">'.$bdnog_year.'</td>

            <td style="text-align:center;text-transform:uppercase ; font-size:15px" width="200px">'.$bdnog_venue.'</td>

            <td style="text-align:center; text-transform:uppercase; font-size:15px" width="150px">'.$bdnog_role.'</td>


      </tr>';
$html2 .= '<tr style="padding:15px">

            <td style="text-align:center; font-size:20px" width="100px">APNIC</td>
            <td style="text-align:center;text-transform:uppercase; font-size:15px" width="150px">'.$apnic_year.'</td>

            <td style="text-align:center;text-transform:uppercase ; font-size:15px" width="200px">'.$apnic_venue.'</td>

            <td style="text-align:center; text-transform:uppercase; font-size:15px" width="150px">'.$apnic_role.'</td>


      </tr>';
$html2 .= '<tr style="padding:15px">

            <td style="text-align:center; font-size:20px" width="100px">APAIV</td>
            <td style="text-align:center;text-transform:uppercase; font-size:15px" width="150px">'.$apaiv_year.'</td>

            <td style="text-align:center;text-transform:uppercase ; font-size:15px" width="200px">'.$apaiv_venue.'</td>

            <td style="text-align:center; text-transform:uppercase; font-size:15px" width="150px">'.$apaiv_role.'</td>


      </tr>';
$html2 .= '<tr style="padding:15px">

            <td style="text-align:center; font-size:20px" width="100px">TFIN</td>
            <td style="text-align:center;text-transform:uppercase; font-size:15px" width="150px">'.$tfin_year.'</td>

            <td style="text-align:center;text-transform:uppercase ; font-size:15px" width="200px">'.$tfin_venue.'</td>

            <td style="text-align:center; text-transform:uppercase; font-size:15px" width="150px">'.$tfin_role.'</td>


      </tr>';

$html2 .= '</table>';


$mpdf->SetFont("Times","B",11);
$mpdf-> WriteHTML($html2);


/**************************** PAGE - 2 *************************************/





$mpdf->AddPage();

$baseX=45;
$baseY=10;
$mpdf->SetLineWidth(0.1);
$mpdf->SetFillColor(126,192,238);
$mpdf->RoundedRect(10,01,7.5*25.4, 1.0*25.4, 1.5, "DF");
$mpdf->SetXY(0*25.4, 0.8*25.4);
$mpdf->Image("bdrenlogo.jpg",20,03,0.75*25.4,0.85*25.4,".jpg");
$mpdf->SetFont("Times","B",14);
$mpdf->SetTextColor(0,0,0);
$mpdf->WriteText($baseX, $baseY, "Bangladesh Research and Education Network Trust");
$mpdf->SetFont("Times","B",12);
$mpdf->WriteText($baseX+30, $baseY+7, "Fellowship Application Form");









$baseX=45;
$baseY=33;


$mpdf->SetLineWidth(0.1);
$mpdf->SetFillColor(192,192,192);
$mpdf->RoundedRect(10,28,7.5*25.4, 10*25.4, 1.5, "DF");
$mpdf->SetFont("Times","B",11);
$mpdf->WriteText($baseX+35, $baseY+0, "Question Answer");
$mpdf->WriteText($baseX+35, $baseY+2, "----------------------");

$mpdf->WriteText($baseX-33, $baseY+12, " # Provide a brief description on how your job responsibility relates to campus network ");
$mpdf->WriteText($baseX-33, $baseY+18, "  ");
$mpdf->WriteText($baseX-33, $baseY+24, " ");
$mpdf->WriteText($baseX-33, $baseY+30, " ");
$mpdf->WriteText($baseX-33, $baseY+30, " ");


//$mpdf->WriteText($baseX-30, $baseY+9, "Number of Internet users at you university (approximation) : ");
//$mpdf->WriteText($baseX+40, $baseY+16, "Network ");

//$mpdf->SetFont("Times","",9);
//$mpdf->WriteText($baseX+100, $baseY+9, $nouser);


//$mpdf->WriteText($baseX+10, $baseY+22, "Personal Information");




/*

$mpdf->SetLineWidth(0.1);
$mpdf->SetFillColor(192,192,192);
$mpdf->RoundedRect(10,185,7.5*25.4, 3.8*25.4, 1.5, "DF");
$mpdf->SetFont("Times","B",11);
$mpdf->WriteText($baseX+35, $baseY+89, "Network Information");
$mpdf->WriteText($baseX+35, $baseY+91, "-------------------------------");
$mpdf->WriteText($baseX-33, $baseY+97, " Number of Internet users at you university (approximation):");
$mpdf->WriteText($baseX+93, $baseY+97, $nouser);
$mpdf->WriteText($baseX+50, $baseY+114, "Network");
*/
$mpdf->SetFont("Times","",9);
$mpdf->SetTextColor(192,192,192);
$mpdf->WriteText($baseX-20, 290, "Fellowship application must be submitted through BdREN website at: fellowshipapplication.bdren.net.bd ");

$mpdf->WriteText($baseX+145, 294, "Page - 2");







// ***************************** TRAINING  ****************************









// ***************************** NETWORK  ****************************
/*
$html4 = '<table class="table table-striped table-bordered" style="margin-top:360px; margin-left:25px" border="1"><tr>
              <th style="text-align:center" style="font-weight:bold; font-size:22px" width="100px"><b>SL</b></th>  
              <th style="text-align:center" style="font-weight:bold; font-size:22px" width="260px"><b>Training Title</b></th>
              <th style="text-align:center" style="font-weight:bold; font-size:22px" width="250px"><b>Training Provider</b></th>
			  <th style="text-align:center" style="font-weight:bold; font-size:22px" width="250px"><b>Host Organizer</b></th>
			  <th style="text-align:center" style="font-weight:bold; font-size:22px" width="250px"><b>Duration</b></th>
              
             
    </tr>';

	
	$i4=0;
mysql_select_db("bdrendb");
//$id = $_SESSION['bdren_user_session_resume_id'];
// echo "**************$id";
$statement4 = "SELECT * FROM user_training where userid = '$id'";
//$statement->execute();
$result4 = mysqli_query($link, $statement4);



while($row4 = mysqli_fetch_array($result4))
{
    $i4++;

    $html4 .= '<tr style="padding:15px">
            
            <td style="text-align:center; font-size:12px" width="100px">' .  $i4. '</td>
            <td style="text-align:center;text-transform:uppercase; font-size:16px">' .$row4['title'] .'</td>
			<td style="text-align:center;text-transform:uppercase; font-size:16px">' .$row4['provider'] .'</td>
			<td style="text-align:center;text-transform:uppercase; font-size:16px">' .$row4['host'] .'</td>
			<td style="text-align:center;text-transform:uppercase; font-size:16px">' .$row4['duration'] .'</td>
          
   

            
           
            
      </tr>';



}
$html4 .= '</table>';
	

*/
$baseX=0;
$baseY=-30;

//$mpdf->WriteHTML($html4);





$html6 = '<table style="margin-top:180px"><textarea style="color: #000000"  class="longInput" cols="90" rows="16">'.$ans1.'</textarea></table>';


$baseX=30;
$baseY=100;
$mpdf->SetFillColor(192,192,192);
$stylesheet = file_get_contents('mpdf.css'); // external css
$mpdf->WriteHTML($stylesheet,1);
$mpdf->SetFont("Times","B",11);
$mpdf-> WriteHTML($html6);




    /************************** OTHER INFORMATION ********************************/

/*


$html4 = '<table class="table table-striped table-bordered" style="margin-top:410px; margin-left:25px" border="1"><tr>
              <th style="text-align:center" style="font-weight:bold; font-size:14px" width="100px"><b>SL</b></th>  
              <th style="text-align:center" style="font-weight:bold; font-size:14px" width="260px"><b>Name of the Service Provider</b></th>
              <th style="text-align:center" style="font-weight:bold; font-size:14px" width="250px"><b>Procured Bandwidth (in Mbps)</b></th>
              
             
    </tr>';



	$i4=0;
mysql_select_db("bdrendb");
//$id = $_SESSION['bdren_user_session_resume_id'];
// echo "**************$id";
$statement4 = "SELECT * FROM user_network where id = '$id'";
//$statement->execute();
$result4 = mysqli_query($link, $statement4);



while($row4 = mysqli_fetch_array($result4))
{
    $i4++;

    $html4 .= '<tr style="padding:15px">
            
            <td style="text-align:center; font-size:12px" width="100px">' .  $i4. '</td>
            <td style="text-align:center;text-transform:uppercase; font-size:12px">' .$row4['nsp'] .'</td>
          
            <td style="text-align:center; font-size:12px">' . $row4['bandwidth'] . '</td>

            
           
            
      </tr>';



}
$html4 .= '</table>';
	
*/
if($imgloc != "N/A") {
$htmlimg="<br><b>Your Payslip</b>";

    $baseX=30;
   // $baseY=400;
    $mpdf->SetFillColor(192,192,192);
    // external css

    $mpdf->SetFont("Times","B",12);
    $mpdf-> WriteHTML($htmlimg);
$mpdf->Image("images/payslip/".$imgloc,16,160,6.50*25.4,4.50*25.4,".jpg"); }
$baseX=0;
$baseY=-30;

$mpdf->WriteHTML($html4);


    /******************************** PAGE - 3 ************************************/

/*

$mpdf->AddPage();

$baseX=45;
$baseY=10;
$mpdf->SetLineWidth(0.1);
//$mpdf->SetFillColor(126,192,238);
$mpdf->RoundedRect(10,03,7.5*25.4, 1.0*25.4, 1.5, "DF");
$mpdf->SetXY(0*25.4, 0.8*25.4);
$mpdf->Image("bdrenlogo.jpg",20,03,0.75*25.4,0.85*25.4,".jpg");
$mpdf->SetFont("Times","B",14);
$mpdf->SetTextColor(0,0,0);
$mpdf->WriteText($baseX, $baseY, "Bangladesh Research and Education Network Trust");
$mpdf->SetFont("Times","B",12);
$mpdf->WriteText($baseX+30, $baseY+7, "Fellowship Application Form");



$mpdf->SetLineWidth(0.1);
$mpdf->SetFillColor(192,192,192);
$mpdf->RoundedRect(10,2,7.5*25.4, 11.0*25.4, 1.5, "DF");

$mpdf->SetFont("Times","B",11);
$mpdf->WriteText($baseX+35, $baseY-2, "Other Information");
$mpdf->WriteText($baseX+35, $baseY+1, "-------------------------");

$mpdf->WriteText($baseX-33, $baseY+10, " # Provide a brief description on how your job responsibility relates to campus network ");

$mpdf->WriteText($baseX-33, $baseY+93, " # Describe the security methods & policies you follow to protect your campus network ");

//$mpdf->WriteText($baseX-33, $baseY+98, "measures need to be followed for mitigating network congestion. ");

$mpdf->WriteText($baseX-30, $baseY+185, "# What are the possible reasons of congestion at your campus network and what measures  ");

$mpdf->WriteText($baseX-33, $baseY+189, "need to be followed for mitigating network congestion.") ;

//$mpdf->WriteText($baseX-33, $baseY+202, "# Describe your ideas on how BdREN can supplement to introduce innovative services  ") ;
//$mpdf->WriteText($baseX-33, $baseY+208, " in your campus network.") ;

$mpdf->SetFont("Times","",9);
$mpdf->SetTextColor(192,192,192);
$mpdf->WriteText($baseX-20, $baseY+279, "Fellowship application must be submitted through BdREN website at: fellowshipapplication.bdren.net.bd ");

$mpdf->WriteText($baseX+145, $baseY+281, "Page - 3");




$html5 = '<table style="margin-top:-2px"><textarea style="background-color: lightyellow" class="" cols="90" rows="16">' . $jobres .'</textarea></table>';


$baseX=30;
$baseY=50;

$mpdf->SetFont("Times","B",11);
$mpdf-> WriteHTML($html5);






$html6 = '<table style="margin-top:58px"><textarea class="longInput" cols="90" rows="16">' . $sec .'</textarea></table>';


$baseX=30;
$baseY=80;

$mpdf->SetFont("Times","B",11);
$mpdf-> WriteHTML($html6);


$html6 = '<table style="margin-top:65px"><textarea class="longInput" cols="90" rows="16">' . $conges .'</textarea></table>';

$baseX=30;
$baseY=120;

$mpdf->SetFont("Times","B",11);
$mpdf-> WriteHTML($html6);

//$html7 = '<table style="margin-top:75px"><textarea class="longInput" cols="90" rows="13">' . $idea .'</textarea></table>';

//$baseX=30;
//$baseY=160;

//$mpdf->SetFont("Times","B",11);
//$mpdf-> WriteHTML($html7);

//$mpdf->WriteHTML($html5);




    /******************************** PAGE - 4 ************************************/



//$mpdf->AddPage();

/*
$baseX=45;
$baseY=10;
$mpdf->SetLineWidth(0.1);
//$mpdf->SetFillColor(126,192,238);
$mpdf->RoundedRect(10,03,7.5*25.4, 1.0*25.4, 1.5, "DF");
$mpdf->SetXY(0*25.4, 0.8*25.4);
$mpdf->Image("bdrenlogo.jpg",20,03,0.75*25.4,0.85*25.4,".jpg");
$mpdf->SetFont("Times","B",14);
$mpdf->SetTextColor(0,0,0);
$mpdf->WriteText($baseX, $baseY, "Bangladesh Research and Education Network Trust");
$mpdf->SetFont("Times","B",12);
$mpdf->WriteText($baseX+30, $baseY+7, "Fellowship Application Form");



$mpdf->SetLineWidth(0.1);
$mpdf->SetFillColor(192,192,192);
$mpdf->RoundedRect(10,2,7.5*25.4, 11.0*25.4, 1.5, "DF");*/
/*
$mpdf->SetFont("Times","B",11);
$mpdf->WriteText($baseX+35, $baseY-2, "Other Information");
$mpdf->WriteText($baseX+35, $baseY+1, "-------------------------");

$mpdf->WriteText($baseX-33, $baseY+10, "# What software tools you use for monitoring, troubleshooting and performance ");

$mpdf->WriteText($baseX-33, $baseY+14, "measurement of your network. Enumerate five main advantages of each tool.");

$mpdf->WriteText($baseX-33, $baseY+104, "# Describe your ideas on how BdREN can supplement to introduce innovative services ");
$mpdf->WriteText($baseX-33, $baseY+108, " in your campus network .");


$mpdf->SetFont("Times","",9);
$mpdf->SetTextColor(192,192,192);
$mpdf->WriteText($baseX-20, $baseY+279, "Fellowship application must be submitted through BdREN website at: fellowshipapplication.bdren.net.bd ");

$mpdf->WriteText($baseX+145, $baseY+281, "Page - 4");




$html8 = '<table style="margin-top:4px"><textarea class="longInput" cols="90" rows="16">' . $soft .'</textarea></table>';


$baseX=30;
$baseY=50;

$mpdf->SetFont("Times","B",11);
$mpdf-> WriteHTML($html8);



*/

$html9 = '';


$baseX=30;
$baseY=200;

$mpdf->SetFont("Times","B",11);
$mpdf-> WriteHTML($html9);
$mpdf->output($fileName, "F");
//$mpdf->output();


//}
?>

