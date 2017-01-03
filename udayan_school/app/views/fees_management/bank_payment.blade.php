@extends('master.master')
@section('header')
<style type="text/css">
   #left_div {
    float: left;
    width: 50%;
  }
  #right_div {
   float: right;
   width: 50%;
  }
  </style>
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
                        
                        <li class="active"><a href="{{ URL::to('banker_payslip')}}">Classwise Fees Configuration</a></li>
                      </ul>
                    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Bank Payment</h3></strong></div>
                    <div id="stdregister_div"></div>


<div class="span11">            
                
                <div class="widget ">
                    
                    <div class="widget-header">
                    </div> <!-- /widget-header -->
                    
                    <div class="widget-content">
                        
                        {{Form::open(array('url'=>'/banker_payslip_search', 'class'=>'form-inline')) }}
  <center>
   <div class="form-group">
    <label style="padding-right:25px;"> Payslip_Id:</label>
    <input id="payslip_number" type="text" name="payslip_number"class="form-control" style="width:320px">
  </div>

  <input type="submit" value="search" id="cat2fwf" class="btn btn-info" style="width:70px"><br><br>
  </center>
  <br>
{{Form::close()}}
  <?php if ($basic!=null) {?>
  {{Form::open(array('url'=>'/paid', 'class'=>'form-inline')) }}

  <input type="hidden" name="payslip" value=<?php echo $payslip_number?>>
  

  <div style="padding-left:25%;">
    <div style="width:600px;height:100%;background-color:#F0E0B2">
      <div  style="width:100%;height:10px;"></div>
      <?php 
      $payslip=FeesPayslip::where('payslip_number','=',$payslip_number)->first();
      ?> 
        <p style="float:right;padding-right:5%;">{{$payslip->payment_status}}&nbsp&nbsp<input  type="checkbox" name="check_payment" value="paid"></p>
      <div  style="width:100%;height:30px;"></div>
      <h3 style="text-align:center"> Pay Slip</h3>
      <div  style="width:100%;height:40px;"></div>

      <div style="padding-left:5%;padding-right:5%">
       <div style="width:100%">

        <div style="width:100%;padding-left:15%;">

          <div id="left_div" style="width:48%">
           <p>Name: {{$student_info->sutdent_name}}</p>
         </div>

         <div id="right_div"style="width:52%">
          <p><b>Payslip Number: <?php echo $payslip_number?></b></p>
        </div>
      </div>
      <div id="left_div" style="padding-left:15%;">
        <p>Class: {{$academic_info->class}}</p>
        <p>Shift: {{$academic_info->shift}}</p>
      </div>
      <div id="right_div"style="padding-left:6%;">
        <p>Section: {{$academic_info->section}}</p>
        <p>Month:{{$month}}</p>
      </div>
    </div>
    <p>----------------------------------------------------------------------------------------</p>
    
    <?php $total_amount=0;?>

    <div style="width:100%; ">
     <div style="width:100%;">
       <div style="width:100%;">
        <p><b>Basic</b></p>
      </div>
      <div style="">
        <div id="left_div" style="width:90%;padding-left:7%;">
          @foreach($basic as $basic_amount_name)
          <p>{{$basic_amount_name->fees_category_name}}</p>
          @endforeach
        </div>
        <div id="right_div" style="width:10%;padding-right:7%;">
         @foreach($basic as $basic_amount)
         <p>{{$basic_amount->fees_amount}}</p>
         <?php $total_amount+=$basic_amount->fees_amount;?>
         @endforeach
       </div>
     </div>
   </div>
   <div style="width:100%;">
     <div style="width:100%;">
      <p><b>Monthly</b></p>
    </div>
    <div style="">
      <div id="left_div" style="width:90%;padding-left:7%;">
       @foreach($monthwise as $month_amount_name)
       <p>{{$month_amount_name->fees_category_name}}</p>
       @endforeach
     </div>
     <div id="right_div" style="width:10%;padding-right:7%;">
       @foreach($monthwise as $month_amount)
       <p>{{$month_amount->amount}}</p>
       <?php $total_amount+=$month_amount->amount;?>
       @endforeach
     </div>
   </div>
  </div>
  <div style="width:100%;">
   <div style="width:100%;">
    <p><b>Additional Fee</b></p>
  </div>
  <div style="">
    <div id="left_div" style="width:90%;padding-left:7%;">
      @foreach($additional as $additional_amount_name)
      <p>{{$additional_amount_name->additional_amount_category}}</p>
      @endforeach
    </div>
    <div id="right_div" style="width:10%;padding-right:7%;">
     @foreach($additional as $additional_amount)
     <p>{{$additional_amount->additional_amount}}</p>
     <?php $total_amount+=$additional_amount->additional_amount;?>
     @endforeach
   </div>
  </div>
  </div>
  <div style="width:100%;">
   <div style="width:100%;">
    <p><b>Deducted Fee</b></p>
  </div>
  <div style="">
    <div id="left_div" style="width:90%;padding-left:7%;">
      @foreach($additional as $deducted_amount_name)
      <p>{{$deducted_amount_name->deducted_amount_category}}</p>
      @endforeach
    </div>
    <div id="right_div" style="width:10%;padding-right:7%;">
     @foreach($additional as $deducted_amount)
     <p>{{$deducted_amount->deducted_amount}}</p>
     <?php $total_amount-=$deducted_amount->deducted_amount;?>
     @endforeach
   </div>
  </div>
  </div>
  <div style="width:100%;">

   <div style="">
    <div id="left_div" style="width:90%;padding-left:7%;background-color: black">
     <p style="color:white"><b>Total</b></p>

   </div>
   <div id="right_div" style="width:10%;padding-right:7%;background-color: black">
     <p style="color:white"><b>{{$total_amount}}</b></p>

   </div>
  </div>
  </div>

  </div>

  <div  style="width:100%;height:100px;"></div><br><br>
  <center>
    <button type="submit" class="btn btn-success"><b>Save</b></button>
      </center>
  </div><br>
   </center>
  <div>
  </div>
  </div>

  <div  style="width:100%;height:70px;"></div>
  </div>
  </div>
  </div>
  <?php }?>
  {{Form::close()}}
                        
                        
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