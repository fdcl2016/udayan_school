@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Fees Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="{{ URL::to('/fees_management/student_fees_payslip_monthwise_view')}}">PaySlip MonthWise View</a>
                        </li>
                    </ul>
                   <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Pay Slip</h3></strong></div>
                    <div id="stdregister_div"></div>
                
             <div class="span11">            
                
                <div class="widget ">
                    
                    <div class="widget-header">
                    </div> <!-- /widget-header -->
                    
                    <div class="widget-content">
                        
         <div style="height:100%;">
   
               <div >
                   <div style=" margin-left: 10%; margin-right: 10%; ">
                   <br>
                    <table border="0" style="margin:10px;">
                    <tbody>
                    <tr>
                    <td></td>
                      <td style=" padding-left: 180px;"><img type="image" src="{{ URL::to('/image/4d.gif')}}"
                                                     style="height: 50px;width: 80px;"></td>
                      <td style=" padding-left: 40px;"><h2><?php echo Config::get('schoolname.school');?></h2></td>
                    </tr>
                    </tbody>
                    </table>
                    <br>

                 

                        <?php
                           $sub = FeesPayslip::where('payslip_number','=',$payslip_number)->first();
                           $current_user = Studentinfo::where('idstudentinfo','=',Auth::user()->email)->first();
                      
                       if ($sub==null) {
                            $payslip=new FeesPayslip;
                            $payslip->idstudentinfo=$current_user->idstudentinfo;
                            $payslip->month=$month;
                            $a=$payslip_number;
                            $payslip->payslip_number=$a;
                            $number=$payslip_number;
                            $payslip->save();
                          }
                         
                           else {

                            $number=$sub->payslip_number;
                        } 
                   ?>

                    </div>

                     <table border="0" width="100%" style="border-collapse: collapse" style="margin:10px;">
                    <tbody>

                   
                    <tr>
                      <td valign="top">
                    <table border="0" width="100%">
                    <tbody>

                    <tr>
                    <td valign="top">
                     <table>
                       <tr> 
                       <td rowspan="5" valign="top" style=" padding-right:25px;"><img type="image" src="{{ URL::to('/uploads/'.$student_info->image)}}" style="height: 67px;width: 55px;"></td>
                       <td><b>Payslip Number:</b> {{$payslip_number}}</td>

                        
                       </tr>
                       <tr> <td><b>Student Name:</b> {{$student_info->sutdent_name}}</td></tr>
                         <tr> 
                          <td><b><b>Roll:</b> {{$student_info->student_roll}} </b></td>
                          </tr>
                          <tr>
                           <td><b>Class:</b> {{$academic_info->class}}&nbsp;&nbsp;<b>Section: </b>{{$academic_info->section}}</td>
                           </tr>
                           <tr>
                            <td><b>Month:</b> {{$month}}&nbsp;&nbsp; <b>Year:</b> {{$current_year}}</td>

                      </tr>
                      <tr>


                                            </tr>
                     </table>

                    </td>
                    


                    <td style=" padding-left: 0px;">
                     <table border="0" width="100%">
                     <tr><td>Basic Fees: </td><td>.....................</td><td align="right">{{$basics}} Tk.</td></tr>
                     <tr><td>Additional Fees: </td><td>.....................</td><td align="right">{{$addiamount}} Tk.</td></tr>
                     <tr><td>Deducted Fees: </td><td>.....................</td><td align="right">{{$deducamount}} Tk.</td></tr>
                     <tr><td align="center" colspan="3"><HR></td></tr>
                     <tr><td>Total:</td><td colspan="2" align="right">{{$total_amount}} Tk.</td></tr>
                     <tr><td><div style="height:20px"></div></td></tr>
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
                     


                    <br>
                        {{Form::open(['url'=>'payslip'])}}

                        {{Form::hidden('basics',$basics)}}
                        {{Form::hidden('total_amount',$total_amount)}}
                        {{Form::hidden('addiamount',$addiamount)}}
                        {{Form::hidden('deducamount',$deducamount)}}
                        {{Form::hidden('payslip_number',$payslip_number)}}
                        {{Form::hidden('month',$month)}}
                        {{Form::hidden('current_year',$current_year)}}

                         <center><input type="submit" class="btn btn-info" style="width:220px;" value="Download as PDF"></center>
                         {{Form::close()}}
                    </div>
  </div>
                        
                        
                    </div> <!-- /widget-content -->
                        
                </div> <!-- /widget -->
                
            </div> <!-- /span8 -->  


      
                </div>
            </div>

        </div>
    </div>

    </div>
    <!-- /widget-content -->

    </div>
    <!-- /widget -->

    </div> <!-- /span8 -->

@stop
@section('content_footer')
@stop
