<?php

class FeesController extends \BaseController {

    public function feesconfiguration()
    {
        return View::make('fees_management.fees_configuration');
    }

    public function feesconfiguration2()
    {
        //return Input::all();


        for ($i=1; $i <=1000; $i++) {
            $feesconfiguration=new FeesConfiguration;
            $check_null=Input::get('fees_category' . $i);
            if($check_null!=null){
                $feesconfiguration->fees_category_name=Input::get('fees_category' . $i);
                $feesconfiguration->fees_category_code=Input::get('fees_code' . $i);
                $feesconfiguration->save();
            }

        }
        return Redirect::to('fees_management/fees_configuration');
    }


    public function classwiseconfiguration()
    {
        $category = FeesConfiguration::groupby('fees_category_name')->get();
        $class = Addclass::groupby('class_name')->orderBy('value','ASC')->get();
        return View::make('fees_management.classwise_fees_configuration')->with('class', $class)->with('category', $category);
    }

    public function classwiseconfiguration2()
    {
        //return Input::all();
        $feesclasswise=new FeesClasswise;
        $classname=Input::get('class_name');
        $section_name1=Input::get('sub');
        for ($i=1; $i <=1000; $i++) {
            $feesclasswise=new FeesClasswise;

            $khat=Input::get('khat' . $i);
            if($khat!=null&&$classname!=null){
                $feesclasswise->class_name=$classname;
                $feesclasswise->section_name=$section_name1;
                $feesclasswise->fees_category_name=Input::get('khat' . $i);
                $feesclasswise->fees_amount=Input::get('amount' . $i);
                $feesclasswise->save();
            }

        }
        return Redirect::to('fees_management/classwise_fees_configuration');
    }

    public function monthwiseadditionalamount()
    {
        $category = FeesConfiguration::groupby('fees_category_name')->get();
        $class = Addclass::groupby('class_name')->orderBy('value','ASC')->get();
        return View::make('fees_management.monthly_fees_configuration')->with('class', $class)->with('category', $category);

    }
    public function monthwiseadditionalamount2()
    {
        //return Input::all();

        $feesadditional=new FeesAdditionalMonthwise;
        $classname=Input::get('class_name');
        $month=Input::get('month');
        for ($i=1; $i <=1000; $i++) {
            $feesadditional=new FeesAdditionalMonthwise;

            $khat=Input::get('khat' . $i);
            if($khat!=null){
                $feesadditional->class_name=$classname;
                $feesadditional->month=$month;
                $feesadditional->fees_category_name=Input::get('khat' . $i);
                $feesadditional->amount=Input::get('amount' . $i);
                $feesadditional->save();
            }

        }
        return Redirect::to('fees_management/monthly_fees_configuration');
    }
    public function studentwiseadditional($id)
    {
        $category = FeesConfiguration::groupby('fees_category_name')->get();
        $class = Addclass::groupby('class_name')->orderBy('value','ASC')->get();
        $user = Studentinfo::where('idstudentinfo', '=', $id)->first();
        return View::make('fees_management.studentwiseadditional')->with('class', $class)->with('category', $category)->with('user', $user);

    }
    public function studentwiseadditional2()
    {
        //return Input::all();

        $feesadditional=new StudentwiseAdditionalMonthlyAmount;
        $id=Input::get('id');
        $month=Input::get('month');
        for ($i=1; $i <=1000; $i++) {
            $feesadditional=new StudentwiseAdditionalMonthlyAmount;
            $feesadditional->idstudentinfo=$id;
            $feesadditional->month=$month;
            $feesadditional->additional_amount_category=Input::get('additional_khat' . $i);
            $feesadditional->additional_amount=Input::get('additional_amount' . $i);
            $feesadditional->additional_amount_desc=Input::get('additional_desctiption' . $i);
            $feesadditional->deducted_amount_category=Input::get('deducted_khat' . $i);
            $feesadditional->deducted_amount=Input::get('deducted_amount' . $i);
            $feesadditional->deducted_amount_desc=Input::get('deducted_desctiption' . $i);
            $check_category=Input::get('additional_khat' . $i);
            $check_category1=Input::get('deducted_khat' . $i);



            $image = Input::file('additional_file' . $i);
            $destination = 'uploads/';

            if ($image != null) {

                $filename = Str::lower(
                    pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                    . '-'. uniqid(). '.'. $image->getClientOriginalExtension()
                );
                $image->move($destination, $filename);
                $feesadditional->additional_amount_file = $filename;
            }

            $image1 = Input::file('deducted_file' . $i);
            $destination = 'uploads/';

            if ($image1 != null) {
                $filename1 = Str::lower(
                    pathinfo($image1->getClientOriginalName(), PATHINFO_FILENAME)
                    . '-'. uniqid(). '.'. $image1->getClientOriginalExtension()
                );
                $image1->move($destination, $filename1);
                $feesadditional->deducted_amount_file = $filename1;
            }

            if ($check_category!=null || $check_category1!=null) {
                $feesadditional->save();
            }


        }

        return Redirect::back();
    }
    public function linkstudentwiseadditionalamount()
    {
        $classname = Session::get('class');
        $sectionsname = Session::get('section');
        $student_id = Session::get('student_id');

        //$sub = Studentinfo::where('idstudentinfo','=',$student_id)->get();
        $class = Addclass::groupby('class_name')->orderBy('value','ASC')->get();

        if ($classname != null && $sectionsname != null) {
            $student = StudentToSectionUpdate::where('class', '=', $classname)->where('section', '=', $sectionsname)->get();
            return View::make('fees_management.studentwise_fees_configuration')->with('class', $class)->with('student', $student)->with('studentinfo', null);
        } else if ($student_id != null) {
            $sub = Studentinfo::where('registration_id', '=', $student_id)->first();
            return View::make('fees_management.studentwise_fees_configuration')->with('class', $class)->with('studentinfo', $sub)->with('student', null);
        } else {
            return View::make('fees_management.studentwise_fees_configuration')->with('class', $class)->with('student', null)->with('studentinfo', null);
        }
    }

    public function banker_payslip_search()
    {
        // return Input::all();
        $payslip_id = Input::get('payslip_number');
        return Redirect::to('home/banker_payslip')->with('payslip_id',$payslip_id);
    }

  public function payslip($month , $month_number)
    {

       $currentuser = User::find(Auth::user()->id);
    $idstudent_info = $currentuser->user_id;
   
     $academic_info =Studentinfo::where('idstudentinfo','=',Auth::user()->email)->pluck('registration_id');

if ($academic_info!=null || $academic_info!="" ) {



$current_year=date('Y');
$current_month=$month_number;
$current_day=date("d");


$arrayOfLastUpdateStudentRegistrationId = str_split($academic_info);
$arrayOfCurrentYear = str_split($current_year);
$arrayOfCurrentMonth = str_split($current_month);


$arrayOfCurrentMonth=integerParse(2 , $arrayOfCurrentMonth);
$arrayOfCurrentYearInteger=integerParse(4 , $arrayOfCurrentYear);
$arrayOfLastUpdateStudentRegistrationIdInteger=integerParse(count($arrayOfLastUpdateStudentRegistrationId) , $arrayOfLastUpdateStudentRegistrationId);

$firstTwoDisite=$arrayOfCurrentYearInteger[0]+$arrayOfCurrentYearInteger[1]+$arrayOfCurrentYearInteger[2];
$firstTwoDisite=$firstTwoDisite . $arrayOfCurrentYearInteger[3];
$monthSum=$arrayOfCurrentMonth[0]+$arrayOfCurrentMonth[1];
$lastFourDisiteSumOfRegistrationId=$arrayOfLastUpdateStudentRegistrationIdInteger[6]+$arrayOfLastUpdateStudentRegistrationIdInteger[7]+$arrayOfLastUpdateStudentRegistrationIdInteger[8]+$arrayOfLastUpdateStudentRegistrationIdInteger[9];

$thirdDisite = actualDisitMode($lastFourDisiteSumOfRegistrationId , $monthSum);

$fourthandFifthDisite=$current_day;
$sixthandSeventhDisite=$arrayOfLastUpdateStudentRegistrationIdInteger[6] . $arrayOfLastUpdateStudentRegistrationIdInteger[7];

$eighthDisit = actualDisitMode($monthSum , $thirdDisite);

$ninethandTenthDisite=$arrayOfLastUpdateStudentRegistrationIdInteger[8] . $arrayOfLastUpdateStudentRegistrationIdInteger[9];
$elevelthandTwelvethDisite=$current_month;

$payslipNumber=$firstTwoDisite . $thirdDisite . $fourthandFifthDisite . $sixthandSeventhDisite . $eighthDisit . $ninethandTenthDisite . $elevelthandTwelvethDisite;

}


        $id=Auth::user()->email;
        $academic_info = StudentToSectionUpdate::where('student_idstudentinfo','=',$id)->first();
        $class_name1 = $academic_info->class;

        $basic=FeesClasswise::where('class_name','=',$class_name1)->get();
        $monthwise=FeesAdditionalMonthwise::where('class_name','=',$class_name1)->where('month','=',$month)->get();
        $additional=StudentwiseAdditionalMonthlyAmount::where('idstudentinfo','=',$id)->where('month','=',$month)->get();
        //return $additional;
        $total_amount=0;
        $addiamount=0;
        $deducamount=0;
        $basics=0;
        if ($monthwise!="[]") {
           foreach($monthwise as $month_amount){ 
                $total_amount+=$month_amount->amount;
                $basics+=$month_amount->amount;              }
        }
         if ($basic!="[]") {
          foreach($basic as $basic_amount){ 
              $total_amount+=$basic_amount->fees_amount;
              $basics+=$basic_amount->fees_amount;
           } 
        }
         if ($additional!="[]") {
           foreach($additional as $additional_amount){ 
              $addiamount=$additional_amount->additional_amount;  
              $total_amount+=$additional_amount->additional_amount;
            }

         foreach($additional as $deducted_amount){ 
            $deducamount=$deducted_amount->deducted_amount;
            $total_amount-=$deducted_amount->deducted_amount;
          }
        }
         


         


        $student_info = Studentinfo::where('idstudentinfo','=',$id)->first();
        return View::make('fees_management.student_payslip')
            ->with('basics',$basics)
            ->with('total_amount',$total_amount)
            ->with('addiamount',$addiamount)
            ->with('deducamount',$deducamount)
            ->with('academic_info',$academic_info)
            ->with('payslip_number',$payslipNumber)
            ->with('month',$month)
            ->with('current_year',$current_year)
            ->with('student_info',$student_info);
    }


    public function banker_payslip()
    {
        $payslip_id = Session::get('payslip_id');
        //return $payslip_id;
        $class = FeesPayslip::where('payslip_number','=',$payslip_id)->first();
        if ($class!=null) {



            $id=$class->idstudentinfo;
            $month=$class->month;
            //return $month;
            $academic_info = StudentToSectionUpdate::where('student_idstudentinfo','=',$id)->first();
            $class_name1 = $academic_info->class;
            //return $class_name1;

            $basic=FeesClasswise::where('class_name','=',$class_name1)->get();
            // return $basic;
            $monthwise=FeesAdditionalMonthwise::where('class_name','=',$class_name1)->where('month','=',$month)->get();

            $additional=StudentwiseAdditionalMonthlyAmount::where('idstudentinfo','=',$id)->where('month','=',$month)->get();
            //return $additional;
            // //return $additional;
            $student_info = Studentinfo::where('idstudentinfo','=',$id)->first();
            //return $student_info;
            return View::make('fees_management.bank_payment')->with('basic',$basic)
                ->with('monthwise',$monthwise)
                ->with('additional',$additional)
                ->with('month',$month)
                ->with('academic_info',$academic_info)
                ->with('payslip_number',$payslip_id)
                ->with('student_info',$student_info);
            // if($classname!=null&&$sectionsname!=null) {
            //$student = Studentacademicinfo::where('class','=',$classname)->where('section','=',$sectionsname)->get();
            //return View::make('fees.bank_payment')->with('class', $class);//->with('student',$student)->with('studentinfo',null);
        }

        else {
            return View::make('fees_management.bank_payment')->with('basic',null)
                ->with('monthwise',null)
                ->with('additional',null)
                ->with('month',null)
                ->with('academic_info',null)
                ->with('payslip_number',null)
                ->with('student_info',null); }
    }
    public function pay_slip_monthwise_view()
    {
        return View::make('fees_management.student_fees_oayslip_monthwise_view');
    }
    public function paid()
    {
        $payslip_id = Input::get('payslip');

//return Input::all();
        FeesPayslip::where('payslip_number', $payslip_id)->update(array(
            'payment_status'=>Input::get('check_payment')
        ));
        return Redirect::back();
    }

    public function payslip_pdf()
{
     $id=Auth::user()->email;
    $academic_info = StudentToSectionUpdate::where('student_idstudentinfo','=',$id)->first();
    $student_info = Studentinfo::where('idstudentinfo','=',$id)->first();
    $total_amount = Input::get('total_amount');
    $addiamount = Input::get('addiamount');
    $deducamount = Input::get('deducamount');
    $payslip_number = Input::get('payslip_number');
    
    $month = Input::get('month');
    $current_year = Input::get('current_year');
    $basics = Input::get('basics');

    $user=Studentinfo::where('idstudentinfo', Auth::user()->email)->first();
    
    $html ='  <!DOCTYPE html>
              <html>
              <head>
              
              </head>
              <body>
             
                     <div style=" margin-left: 20%; margin-right: 10%;">
                    <table border="0">
                    <tbody>
                    <tr>
                      <td><img type="image" src="image/4d.gif" 
                                                     style="height: 50px;width: 80px;"></td>
                      <td style=" padding-left: 20px;"><h4>'.Config::get('schoolname.school').'<h4></td>
                    </tr>
                    </tbody>
                    </table>
                    <br>

                    

                    </div>
                    <table border="1" width="100%" style="border-collapse: collapse">
                    <tbody>

                     <tr><td align="center" >Bank Copy</td></tr>
                    <tr>
                      <td valign="top">
                    <table border="0" width="100%">
                    <tbody>

                    <tr>
                    <td valign="top">
                     <table>
                       <tr> 
                       <td rowspan="5" valign="top" style=" padding-right:10px;"><img type="image" src="uploads/'.$user->image. '" style="height: 60px;width: 50px;"></td>

                        <td><b>Payslip Number:</b> '.$payslip_number.'</td>
                       </tr>
                       <tr> <td><b>Student Name: </b>' .$student_info->sutdent_name. '</td></tr>
                         <tr> 
                          <td><b><b>Roll: </b>' .$student_info->student_roll. '</td>
                          </tr>
                          <tr>
                           <td><b>Class: </b>' .$academic_info->class. '&nbsp;&nbsp;<b>Section:</b>' .$academic_info->section. '</td>
                           </tr>
                           <tr>
                            <td><b>Month: </b> ' .$month. '&nbsp;&nbsp; <b>Year:</b>' .$current_year. '</td>

                      </tr>
                     </table>

                    </td>
                    


                    <td >
                    <table border="0" width="100%">
                     <tr><td>Basic Fees: </td><td>.....................</td><td align="right">' .$basics. ' Tk.</td></tr>
                     <tr><td>Additional Fees: </td><td>.....................</td><td align="right">' .$addiamount. 'Tk.</td></tr>
                     <tr><td>Deducted Fees: </td><td>.....................</td><td align="right">' .$deducamount. 'Tk.</td></tr>
                     <tr><td align="center" colspan="3"><HR></td></tr>
                     <tr><td>Total: </td><td colspan="2" align="right">' .$total_amount. 'Tk.</td></tr>
                     <tr><td><div style="height:40px"></div></td></tr>
                     <tr><td style="text-decoration: overline;">Sign(bank)</td><td colspan="2" align="right" style="text-decoration: overline;">Sign(student)</td></tr>
                     </table>
                     </td>
                    </tr>
                   
                    </tbody>
                    </table>

                      </td>
                    </tr>
                    </tbody>
                    </table>

                    <br><HR>
                     <div style=" margin-left: 20%; margin-right: 10%;">
                    <table border="0">
                    <tbody>
                    <tr>
                      <td><img type="image" src="image/4d.gif" 
                                                     style="height: 50px;width: 80px;"></td>
                      <td style=" padding-left: 40px;"><h4>'.Config::get('schoolname.school').'<h4></td>
                    </tr>
                    </tbody>
                    </table>
                    <br>

                    

                    </div>

                     <table border="1" width="100%" style="border-collapse: collapse">
                    <tbody>

                     <tr><td align="center" >School Copy</td></tr>
                    <tr>
                      <td valign="top">
                    <table border="0" width="100%">
                    <tbody>

                    <tr>
                    <td valign="top">
                     <table>
                          <tr>
                       <td rowspan="5" valign="top" style=" padding-right:10px;"><img type="image" src="uploads/'.$user->image. '" style="height: 60px;width: 50px;"></td>

                        <td><b>Payslip Number:</b> '.$payslip_number.'</td>
                       </tr>
                       <tr> <td><b>Student Name: </b>' .$student_info->sutdent_name. '</td></tr>
                         <tr> 
                          <td><b><b>Roll: </b>' .$student_info->student_roll. '</td>
                          </tr>
                          <tr>
                           <td><b>Class: </b>' .$academic_info->class. '&nbsp;&nbsp;<b>Section:</b>' .$academic_info->section. '</td>
                           </tr>
                           <tr>
                            <td><b>Month: </b> ' .$month. '&nbsp;&nbsp; <b>Year:</b>' .$current_year. '</td>

                      </tr>
                     </table>

                    </td>
                    


                    <td >
                    <table border="0" width="100%">
                     <tr><td>Basic Fees: </td><td>.....................</td><td align="right">' .$basics. ' Tk.</td></tr>
                     <tr><td>Additional Fees: </td><td>.....................</td><td align="right">' .$addiamount. 'Tk.</td></tr>
                     <tr><td>Deducted Fees: </td><td>.....................</td><td align="right">' .$deducamount. 'Tk.</td></tr>
                     <tr><td align="center" colspan="3"><HR></td></tr>
                     <tr><td>Total: </td><td colspan="2" align="right">' .$total_amount. 'Tk.</td></tr>
                     <tr><td><div style="height:40px"></div></td></tr>
                     <tr><td style="text-decoration: overline;">Sign(bank)</td><td colspan="2" align="right" style="text-decoration: overline;">Sign(student)</td></tr>
                     </table>
                     </td>
                    </tr>
                   
                    </tbody>
                    </table>

                      </td>
                    </tr>
                    </tbody>
                    </table>
                    <br><HR>
                     <div style=" margin-left: 20%; margin-right: 10%;">
                    <table border="0">
                    <tbody>
                    <tr>
                      <td><img type="image" src="image/4d.gif" 
                                                     style="height: 50px;width: 80px;"></td>
                      <td style=" padding-left: 20px;"><h4>'.Config::get('schoolname.school').'<h4></td>
                    </tr>
                    </tbody>
                    </table>
                    <br>

                    

                    </div>

                     <table border="1" width="100%" style="border-collapse: collapse">
                    <tbody>

                     <tr><td align="center" >Student Copy</td></tr>
                    <tr>
                      <td valign="top">
                    <table border="0" width="100%">
                    <tbody>

                    <tr>
                    <td valign="top">
                     <table>
                      <tr>
                       <td rowspan="5" valign="top" style=" padding-right:10px;"><img type="image" src="uploads/'.$user->image. '" style="height: 60px;width: 50px;"></td>

                        <td><b>Payslip Number:</b> '.$payslip_number.'</td>
                       </tr>
                       <tr> <td><b>Student Name: </b>' .$student_info->sutdent_name. '</td></tr>
                         <tr> 
                          <td><b><b>Roll: </b>' .$student_info->student_roll. '</td>
                          </tr>
                          <tr>
                           <td><b>Class: </b>' .$academic_info->class. '&nbsp;&nbsp;<b>Section:</b>' .$academic_info->section. '</td>
                           </tr>
                           <tr>
                            <td><b>Month: </b> ' .$month. '&nbsp;&nbsp; <b>Year:</b>' .$current_year. '</td>

                      </tr>
                     </table>

                    </td>
                    


                    <td >
                    <table border="0" width="100%">
                     <tr><td>Basic Fees: </td><td>.....................</td><td align="right">' .$basics. ' Tk.</td></tr>
                     <tr><td>Additional Fees: </td><td>.....................</td><td align="right">' .$addiamount. 'Tk.</td></tr>
                     <tr><td>Deducted Fees: </td><td>.....................</td><td align="right">' .$deducamount. 'Tk.</td></tr>
                     <tr><td align="center" colspan="3"><HR></td></tr>
                     <tr><td>Total:</td><td colspan="2" align="right">' .$total_amount. 'Tk.</td></tr>
                     <tr><td><div style="height:40px"></div></td></tr>
                     <tr><td style="text-decoration: overline;">Sign(bank)</td><td colspan="2" align="right" style="text-decoration: overline;">Sign(student)</td></tr>
                     </table>
                     </td>
                    </tr>
                   
                    </tbody>
                    </table>

                      </td>
                    </tr>
                   



                   

  ';

   $html .= '</tbody></table><center><div style="position: relative;">

            <p style="position: fixed; bottom: 20px; width:100%; text-align: left">Powered By: Foud D Communications 
            </p>
        
        </div></center></body></html>';

    //$html = '<img type="image" src="public/uploads/'.$user->image. '" style="height: 50px;width: 80px;">';
     return PDF::load($html, 'A4', 'portrait')->download('payment_' .$month. '_' .$current_year);
}
}