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
                        
                        
                        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="resource-name">Class Name</th>
              <th class="resource-link" style="width:11%">Status</th>
              <th class="resource-link" style="width:11%"></th>
            </tr>
          </thead>
          <tbody>
       <?php
             $months = array("January", "February", "March","April","May","June","July","August","September","October","November","December");
             $monthsnumber = array("01", "02", "03","04","05","06","07","08","09","10","11","12");

           for($i=0;$i<=11;$i++){
            ?> 
            <tr style="height:0px;">
              <td><?php echo $months[$i]?></td>
              
              <td>
                 <?php $current_month=$months[$i];
                 $id = Auth::user()->id;
                 $currentuser = User::find($id);
                 $idstudent_info = $currentuser->user_id;
                    $payslip=FeesPayslip::where('month','=',$current_month)
                                         ->where('idstudentinfo','=', $idstudent_info)->first();
                    if ($payslip!=null) {
                      if ($payslip->payment_status!='unpaid') {
                        echo "Paid";
                      } else {
                        echo "unpaid";
                      }
                    } else {
                      echo "unpaid";
                    }
                    
                    
                    
                 ?>
          
              </td>
              <td><a href="{{ URL::to('/payslip/'.$months[$i].'/'.$monthsnumber[$i])}}" class="btn btn-primary">View Payslip</a></td>
            </tr>
          
          <?php }?>
          </tbody>
        </table>
     
                        
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