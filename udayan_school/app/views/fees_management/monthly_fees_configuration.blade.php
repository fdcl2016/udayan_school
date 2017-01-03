@extends('master.master')
@section('header')
@stop
@section('content')


    <?php
    $rasel = 3;
    include_once(app_path().'/views/nav_config/a_fees_management.php');
    ?>



    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Month Wise Fees Configuration</h3></strong></div>
                    <div id="stdregister_div"></div>
 
                  
 
{{Form::open(array('url'=>'/monthwiseadditionalamount', 'class'=>'form-inline','name'=>'myForm',
'onsubmit'=>'return validateForm()')) }}
<div class="span11">            
                
                <div class="widget ">
                    
                    <div class="widget-header">
                    </div> <!-- /widget-header -->
                    
                    <div class="widget-content">
                        
                        <fieldset>

 <div class="control-group col-sm-4">
  <label class="control-label" for="subject_name">Select Class:</label>
  <div class="controls">
   <select name="class_name" id="class_name" class="form-control" style="width:320px">
     <option>-&nbsp;Select Class&nbsp;-</option>
     @foreach($class as $cats)
     <option value="{{$cats->class_name}}">{{$cats->class_name}}</option>
     @endforeach
 </select>
</div> <!-- /controls -->
</div>

<div class="control-group col-sm-3">
  <label class="control-label" for="subject_name">Select Month:</label>
  <div class="controls">
   <select name="month" id="month" class="form-control" style="width:160px;">
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
  </div> <!-- /controls -->
</div>

  </fieldset>
  <fieldset>             


              <br><br>
              <div class="control-group col-sm-4">
  <label class="control-label" for="subject_name">Khat:</label>
  <div class="controls">
              <select id="khat1" name="khat1" class="form-control" style="width:320px">
                     <option>-&nbsp;Select Khat&nbsp;-</option>
                     @foreach($category as $cats)
                     <option value="{{$cats->fees_category_name}}">{{$cats->fees_category_name}}</option>
                     @endforeach
                
                     
                </select>
  </div> <!-- /controls -->
</div>
<div class="control-group col-sm-3">
  <label class="control-label" for="subject_name">Amount:</label>
  <div class="controls">
               <input id="amount1" type="text" name="amount1"class="form-control" placeholder="Enter amount" style="width:160px" required>
    
  </div> <!-- /controls -->
</div>

<div class="form-group">
<br>
       <img style="width: 35px;height: 35px;" type="image" src="{{ URL::asset('/image/addmore-button-png-hi.png')}}" onclick="muFunction()" alt="Add Another Class" required>
        
    </div>
 <div id="demo"></div>
     <div style="margin-left:28%">
        <button type="submit" class="btn btn-primary" id="button"><i class="icon-save"></i> Save</button>
    </div>


</fieldset>
                        
                        
                    </div> <!-- /widget-content -->
                        
                </div> <!-- /widget -->
                
            </div> <!-- /span8 -->
                        
                        
                    </div> <!-- /widget-content -->
                        
                </div> <!-- /widget -->
                
            </div> <!-- /span8 -->
                        
 
{{Form::close()}}





 <script type="text/javascript">
  var count=1;
 function muFunction(){
    count++;
    var text="";
    
    text +="<div class=\'control-group col-sm-4\'>";
    text +="<div class=\'controls\'>";
    text +="<select id=\'khat1\' name=\'khat"+count+"\' class=\'form-control\' style=\'width:320px\'><option> -Select Khat- </option>";
    text +="@foreach($category as $cats)"
    text +="<option value=\'{{$cats->fees_category_name}}\'>{{$cats->fees_category_name}}</option>";
    text +="@endforeach";
    text +="</select>";
    text +="</div>";
    text +="</div>";
    text +="<div class=\'control-group col-sm-3\'>";
    text +="<div class=\'controls\'>";
    text +="<input id=\'amount1\' type=\'text\' name=\'amount"+count+"\'class=\'form-control\' placeholder=\'Enter amount\' style=\'width:160px\' required>"
    text +="</div>";
    text +="</div>";

    text +="<img style=\'width: 35px;height: 35px;\' type=\'image\'"; 
    text +="src=\'../image/addmore-button-png-hi.png\' onclick=\'muFunction()\'";
    text +="alt=\'Add Another Class\' required>";
    text +="<img style=\'margin-left: 5px;width: 35px;height: 35px;\' type=\'image\'"; 
    text +="src=\'../image/remove.jpg\' onclick=\'removemore(this)\'"; 
    text +="alt=\'remove this class\' style=\'margin-left: 5px;\'/><br><br>";
    

    
 
    var div = document.createElement('div');
                div.innerHTML =text;
                document.getElementById('demo').appendChild(div);
 }

function removemore(div)
        {
            document.getElementById('demo').removeChild(div.parentNode);
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