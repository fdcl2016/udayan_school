@extends('master.master')
@section('header')
@stop
@section('content')


    <?php
    $rasel = 4;
    include_once(app_path().'/views/nav_config/a_fees_management.php');
    ?>



    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Student Wise Fees Configuration</h3></strong></div>
    <div class="span11">            
                
                <div class="widget ">
                    
                    <div class="widget-header">
                    </div> <!-- /widget-header -->
                    
                    <div class="widget-content">
                        
                        {{Form::open(array('url'=>'/testfee', 'class'=>'form-inline')) }}

                                <div class="control-group col-sm-2">
                                    <label class="control-label" for="subject_name">Select Class:</label>
                                    <div class="controls">
                                    <select name="cat" id="cat" class="form-control" style="width:150px;">
                                      <option value="">-&nbsp;Select Class&nbsp;-</option>
                                    @foreach($class as $cats)
                                      <option value="{{$cats->class_name}}">{{$cats->class_name}}</option>
                                    @endforeach
                                       </select>
                                     </div> <!-- /controls -->
                                </div>

                                <div class="control-group col-sm-2">
                                    <label class="control-label" for="subject_name">Select Section:</label>
                                    <div class="controls">
                                       <select name="sub" id="sub" style="width:150px;" class="form-control">
                                       </select>
                                    </div> <!-- /controls -->
                                </div>
                            <br>
                             <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-search"></i> Search</button><br>
    
         <br>
        <h4>OR</h4>

        {{Form::close()}}

        {{Form::open(array('url'=>'/testfee1', 'class'=>'form-inline')) }}
        
                                <div class="control-group col-sm-2">
                                    <div class="controls">
                                      <label class="control-label" for="subject_name">Registration Id:</label>  
                                    </div> <!-- /controls -->
                                </div>
                                <div class="control-group col-sm-2">
                                    <div class="controls">
                                        <input id="student_id" type="text" name="student_id" class="form-control" style="width:150px">
                                    </div> <!-- /controls -->
                                </div>
       

         <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-search"></i> Search</button><br><br>

        <br>
        {{Form::close()}}
                        
                        
                    </div> <!-- /widget-content -->
                        
                </div> <!-- /widget -->
                
            </div> <!-- /span8 -->
        





    @if($student!=null)

        <div class="table-responsive"style="padding-left:15%;padding-right:15%">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="resource-name">Student Name</th>
                    <th class="resource-link" style="width:11%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($student as $st)
                    <?php  $studentinfo1 = Studentinfo::where('idstudentinfo', '=', $st->student_idstudentinfo)->first(); ?>
                    <tr>
                        <td>{{$studentinfo1->sutdent_name}}</td>
                        <td><a href="{{ URL::to('/studentwiseadditional/'.$studentinfo1->idstudentinfo)}}"
                               class="btn btn-primary">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif



    @if($studentinfo!=null)
        <div class="table-responsive" style="padding-left:15%;padding-right:15%">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="resource-name">Student Name</th>
                    <th class="resource-link" style="width:11%"></th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td>{{$studentinfo->sutdent_name}}</td>
                    <td><a href="{{ URL::to('/studentwiseadditional/'.$studentinfo->idstudentinfo)}}" target="_blank"
                           class="btn btn-primary">Edit</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    @endif
    <br><br>




    </div>






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
    <script>
        $("#cat2").on('click', function (e) {
//console.log(e);

            var cat_id = document.getElementById('tiffin_duration').value;
            //= e.target.value;
// document.write(cat_id);
//alert(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/ajax4?cat_id=' + cat_id, function (data) {
                $('#sub1').empty();
                $.each(data, function (index, subcatObj) {
//$('#sub1').append('<tr><td style="border:0;width: 300px;"><h3>'+subcatObj.sutdent_name+'&nbsp;&nbsp;&nbsp;&nbsp;</h3></td><td style="border:0;width: 100px;text-align:right"><h3><a href="./studentwiseadditional/'+subcatObj.idstudentinfo+'" target="_blank"><i class="fa fa-pencil-square-o fa-2x"></i></a></h3></td></tr>');
                })

            });
        });


        i = 0;

    </script>
    <script>
        $("#cat").on('change', function (e) {
            console.log(e);
//document.write('hello');
            var cat_id = e.target.value;
// document.write(cat_id);
            $.get('<?php echo Config::get('baseurl.url');?>/ajax5?cat_id=' + cat_id, function (data) {
//console.log(data);
                $('#sub').empty();
                $.each(data, function (index, subcatObj) {
                    $('#sub').append('<option value="' + subcatObj.section + '">' + subcatObj.section + '</option>');
                })

            });
        });


        i = 0;

    </script>

    <script>
        $("#cat3").on('click', function (e) {
//console.log(e);

            var cat_id = document.getElementById('cat').value;
            var sub_id = document.getElementById('sub').value;

            $.get('<?php echo Config::get('baseurl.url');?>/ajax6?cat1_id=' + cat_id + '&sub_id=' + sub_id, function (data) {

                $('#sub1').empty();
                $.each(data, function (index, subcatObj) {
//$('#sub1').append('<tr><td style="border:0;width: 300px;"><h3>Student Id: '+subcatObj.studentinfo_idstudentinfo+'&nbsp;&nbsp;&nbsp;&nbsp;</h3></td><td style="border:0;width: 100px;text-align:right"><h3><a href="./studentwiseadditional/'+subcatObj.studentinfo_idstudentinfo+'"target="_blank"><i class="fa fa-pencil-square-o fa-2x"></i></a></h3></td></tr>');
                })

            });
        });


        i = 0;

    </script>
@stop