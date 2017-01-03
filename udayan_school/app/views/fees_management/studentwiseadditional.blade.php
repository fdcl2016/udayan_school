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
                        <li>
                            <a href="{{ URL::to('/fees_management/fees_configuration')}}">Fees Configuration</a>
                        </li>
                        <li><a href="{{ URL::to('/fees_management/classwise_fees_configuration')}}">Classwise Fees Configuration</a></li>
                        <li><a href="{{ URL::to('/fees_management/monthly_fees_configuration')}}">Monthly Fees Configuration</a></li>
                        <li class="active"><a href="{{ URL::to('/fees_management/studentwise_fees_configuration')}}">Studentwise Fees Configuration</a></li>
                    </ul>
                    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Student Wise Additional Amount</h3></strong></div>
                    {{--<div id="stdregister_div"></div>--}}
  <div style="padding-left:3%;padding-right:3%;">
{{Form::open(array('url'=>'/studentwiseadditional','files' => true, 'class'=>'form-inline','name'=>'myForm',
'onsubmit'=>'return validateForm()')) }}

          
          
    
  <table    class="table">
  <tr class="success">
        <td><b>name: </b></td>
        <td><?php echo $user->sutdent_name;?></td>
        <td><b>section: </b></td>
        <td>shapla</td>
    </tr>
    <tr  class="success">
        <td><b>class: </b></td>
        <td>12</td>
        <td><b>Id: </b></td>
        <td><?php echo $user->registration_id;?></td>
    </tr>
    <tr class="success">
        <td ><b>Mobile: </b></td>
        <td ><?php echo $user->p_mobile;?></td>
        <td ><b>email: </b></td>
        <td ><?php echo $user->p_email;?></td>
      <input type="hidden" name="id" value= <?php echo $user->idstudentinfo;?> >  
    </tr>
  </table><br><br>

  

              

<table class="table">
   <tr class="success">
     <td style="text-align:right" colspan="4">
       <div class="form-group">
                  <label style="padding-right:30px;">Select Month:</label>
                <select name="month" id="month"  class="form-control" style="width:320px;" required>
                   <option>-&nbsp;Select Month&nbsp;-</option>
                   <option value="January">January</option>
                   <option value="February">February</option>
                   <option value="March">March</option>
                   <option value="April">April</option>
                   <option value="May">May</option>
                   <option value="June">June</option>
                   <option value="July">July</option>
                   <option value="August">August</option>
                   <option value="September">September</option>
                   <option value="October">October</option>
                   <option value="November">November</option>
                   <option value="December">December</option>
                </select>
              </div>
              <br><br>
     </td>
     <td colspan="2"></td>
   </tr>
   <tr class="success">
     <td style="width:5%"></td>
     <td style="width:45%">
       <h4 style="text-align:center">Additional Amount</h4>
     </td>
     <td class="verticalLine">
       <div >
       </div>
      </td>
     <td style="width:45%">
       <h4 style="text-align:center">Deducted Amount</h4>
     </td>
     <td style="width:5%"></td>
     </tr>
  <td style="width:5%"></td>
  <td style="width:45%">
  <div class="control-group col-sm-5">
                                    <label class="control-label" for="subject_name">Khat:</label>
                                    <div class="controls">
                                     <select id="additional_khat1" name="additional_khat1" class="form-control" style="width:150px">
                  <option>-&nbsp;Select Khat&nbsp;-</option>
                  @foreach($category as $cats)
                   <option value="{{$cats->fees_category_name}}">{{$cats->fees_category_name}}</option>
                   @endforeach
                
                </select></div> <!-- /controls -->
                                </div>

                                <div class="control-group col-sm-3">
                                    <label class="control-label" for="subject_name">Amount:</label>
                                    <div class="controls">
                                         <input id="amount1" type="text" name="additional_amount1"class="form-control" placeholder="Enter Amount" style="width:80px" required>
   </div> <!-- /controls -->
                                </div>

   <br>
       <img style="margin-left: 5px;width: 35px;height: 35px;" type="image" src="{{ URL::to('/image/addmore-button-png-hi.png')}}" onclick="muFunction()" alt="Add Another Class" required>
   
    <br><br>
     <label style="padding-right:10px;"> description:</label><br>
    <div class="form-group">
   
    <textarea  style="max-width:400px; min-width:270px; height:70px" class="form-control" type="text"  name="additional_desctiption1" cols="105%" rows="8"></textarea>
    </div><br><br>
    <label style="padding-right:10px;">Select a File:</label>
    <div class="form-group">
      <input  style="padding-left:13px;" type="file"  name="additional_file1" id="photo" onchange="getPreview('photo','uploadPhoto','none');"  class="upload"/>
    </div><br><br>
 <div id="demo"></div><br>

  </td>
  <td class="verticalLine">
    <div >
    </div>
  </td>
  <td style="width:45%;padding-left:20px;">
    <div class="control-group col-sm-5">
                                    <label class="control-label" for="subject_name">Khat:</label>
                                    <div class="controls">
                                       <select id="khat1" name="deducted_khat1" class="form-control" style="width:150px">
                  <option>-&nbsp;Select Khat&nbsp;-</option>
                  @foreach($category as $cats)
                   <option value="{{$cats->fees_category_name}}">{{$cats->fees_category_name}}</option>
                   @endforeach
                
                     
                </select> </div> <!-- /controls -->
                                </div>

                                <div class="control-group col-sm-3">
                                    <label class="control-label" for="subject_name">Amount:</label>
                                    <div class="controls">
                                         <input id="deducted_amount1" type="text" name="deducted_amount1"class="form-control" placeholder="Enter Amount" style="width:80px" required>
    </div> <!-- /controls -->
                                </div>
        <br>
       <img style="margin-left: 5px;width: 35px;height: 35px;" type="image" src="{{ URL::to('/image/addmore-button-png-hi.png')}}" onclick="muFunction1()" alt="Add Another Class" required>
      
    <br><br>
    <div class="form-group">
    <label style="padding-right:10px;"> description:</label><br>
    <textarea  style="max-width:400px; min-width:270px; height:70px" class="form-control" type="text"  name="deducted_desctiption1" cols="105%" rows="8"></textarea>
    </div><br><br>
    <label style="padding-right:10px;">Select a File:</label>
    <div class="form-group">
      <input  style="padding-left:13px;" type="file"  name="deducted_file1" id="photo" onchange="getPreview('photo','uploadPhoto','none');"  class="upload"/>
    </div>
    <br><br>

 <div id="demo1"></div><br><br>

  </td>
  <td style="width:5%"></td>
  </tr>
</table>
  <center>   <div class="control-group col-sm-12"><button type="submit" class="btn btn-primary" id="button"><i class="icon-save"></i> Save</button></div>
                               </center>
{{Form::close()}}
</div>



 <script type="text/javascript">
  var count=1;
  var count1=1;
 function muFunction(){
    count++;
    var text="";
    

    text +="<br><div class=\'control-group col-sm-5\'>";
    text +="<label class=\'control-label\' >Khat:</label>";
    text +="<div class=\'controls\'>";
    text +="<select id=\'khat1\' name=\'additional_khat"+count+"\' class=\'form-control\' style=\'width:125px\'>"
    text +="<option>-&nbsp;Select Khat&nbsp;-</option>";
    text +="@foreach($category as $cats)";
    text +="<option value=\'{{$cats->fees_category_name}}\'>{{$cats->fees_category_name}}</option>";
    text +="@endforeach";
    text +="</select>";
    text +="</div>";
    text +="</div>";

    text +="<div class=\'control-group col-sm-3\'>";
    text +="<label class=\'control-label\' >Amount:</label>";
    text +="<div class=\'controls\'>";
    text +="<input id=\'amount1\' type=\'text\' name=\'additional_amount"+count+"\'class=\'form-control\' placeholder=\'Enter Fees code\' style=\'width:80px\' required>"
    text +="</div>";
    text +="</div><br>";
    text +="<img style=\'margin-left: 5px;width: 35px;height: 35px;\' type=\'image\'"; 
    text +="src=\'../../image/addmore-button-png-hi.png\' onclick=\'muFunction()\'";
    text +="alt=\'Add Another Class\' required>";
    text +="<img style=\'margin-left: 5px;width: 35px;height: 35px;\' type=\'image\'"; 
    text +="src=\'../../image/remove.jpg\' onclick=\'removemore(this)\'"; 
    text +="alt=\'remove this class\' style=\'margin-left: 5px;\'/>";
    text +="<br><br>";
    text +="<div class=\'form-group\'>";
    text +="<label style=\'padding-right:10px;\'> description:</label>";
    text +="<textarea  style=\'max-width:400px; min-width:270px; height:70px\' class=\'form-control\' type=\'text\'  name=\'additional_desctiption"+count+"\' cols=\'105%\' rows=\'8\'></textarea>";
    text +="</div><br><br>";
    text +="<label style=\'padding-right:10px;\'>Select a File:</label>";
    text +="<div class=\'form-group\'>";
    text +="<input style=\'padding-left:13px;\'  type=\'file\'   name=\'additional_file"+count+"\' id=\'photo\' onchange=getPreview(\'photo\',\'uploadPhoto\',\'none\')  class=\'upload\'/>";
    text +="</div>";
    text +="<br><br>";  
    

    
 
    var div = document.createElement('div');
                div.innerHTML =text;
                document.getElementById('demo').appendChild(div);
 }

 function muFunction1(){
    count1++;
    var text="";
    text +="<div class=\'control-group col-sm-5\'>";
    text +="<label class=\'control-label\' >Khat:</label>";
    text +="<div class=\'controls\'>";
    text +="<select id=\'khat1\' name=\'deducted_khat"+count1+"\' class=\'form-control\' style=\'width:125px\'>"
    text +="<option>-&nbsp;Select Khat&nbsp;-</option>";
    text +="@foreach($category as $cats)";
    text +="<option value=\'{{$cats->fees_category_name}}\'>{{$cats->fees_category_name}}</option>";
    text +="@endforeach";
    text +="</select>"
    text +="</div>";
    text +="</div>";
    text +="<div class=\'control-group col-sm-3\'>";
    text +="<label class=\'control-label\' >Amount:</label>";
    text +="<div class=\'controls\'>";
    text +="<input id=\'amount1\' type=\'text\' name=\'deducted_amount"+count1+"\'class=\'form-control\' placeholder=\'Enter Fees code\' style=\'width:80px\' required>"
    text +="</div>";
    text +="</div><br>";
    text +="<img style=\'margin-left: 5px;width: 35px;height: 35px;\' type=\'image\'"; 
    text +="src=\'../../image/addmore-button-png-hi.png\' onclick=\'muFunction1()\'";
    text +="alt=\'Add Another Class\' required>";
    text +="</div>";
    text +="<img style=\'margin-left: 5px;width: 35px;height: 35px;\' type=\'image\'"; 
    text +="src=\'../../image/remove.jpg\' onclick=\'removemore1(this)\'"; 
    text +="alt=\'remove this class\' style=\'margin-left: 5px;\'/>"; 
    text +="<br><br>";
    text +="<div class=\'form-group\'>";
    text +="<label style=\'padding-right:10px\'> description:</label>";
    text +="<textarea  style=\'max-width:400px; min-width:170px; height:70px\' class=\'form-control\' type=\'text\'  name=\'deducted_desctiption"+count1+"\' cols=\'105%\' rows=\'8\'></textarea>";
    text +="</div><br><br>";
    text +="<label style=\'padding-right:10px;\'>Select a File:</label>";
    text +="<div class=\'form-group\'>";
    text +="<input  style=\'padding-left:13px;\' type=\'file\'   name=\'deducted_file"+count1+"\' id=\'photo\' onchange=getPreview(\'photo\',\'uploadPhoto\',\'none\')  class=\'upload\'/>";
    text +="</div>";
    text +="<br><br>";  
    

    
 
    var div = document.createElement('div');
                div.innerHTML =text;
                document.getElementById('demo1').appendChild(div);
 }

function removemore(div)
        {
            document.getElementById('demo').removeChild(div.parentNode);
            count--;
        }
function removemore1(div)
        {
            document.getElementById('demo1').removeChild(div.parentNode);
            count--;
        }

   </script>
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