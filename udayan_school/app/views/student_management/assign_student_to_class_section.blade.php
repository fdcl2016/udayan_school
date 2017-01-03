@extends('master.master')
@section('header')


@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>

                <h3>Student Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li>
                            <a href="{{ URL::to('/student_management/addstudent')}}">Add Student</a>
                        </li>
                        <li><a href="{{ URL::to('/info')}}">Edit Student</a></li>
                        <li  class="active"><a href="{{ URL::to('/student_management/assign_student_to_class_section')}}">Assign Student To Section</a></li>
                        {{--<li><a href="{{ URL::to('/student_management/assign_student_to_section')}}">Student Promotion</a></li>--}}
                        
                    </ul>
                    <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                    style="color:black">Assign Student To Section</h3></strong></div>
                    <div id="stdregister_div"></div>

                      {{Form::open(array('url'=>'studentsearch', 'class'=>'form-inline')) }}
        
                                <div class="control-group col-sm-2">
                                    <div class="controls">
                                      <label class="control-label" for="subject_name">Academic Year:</label>  
                                    </div> <!-- /controls -->
                                </div>
                                <div class="control-group col-sm-2">
                                    <select name="year" id="year" class="form-control" required>
                                        <?php $academic_year = AcademicYear::orderBy('idacademic_year', 'DESC')->get();?>
                                       @foreach($academic_year as $year)
                                                <option value="{{$year->academic_year}}">{{$year->academic_year}}</option>
                                           @endforeach
                                    </select>
                                </div>
       

                              <button type="submit" class="btn btn-info" id="cat2fwf"><i class="icon-search"></i> Search</button><br><br>

                              <br>
                        {{Form::close()}}
                        
                   @if($studentInfos!=null)
                   {{Form::open(array('url'=>'assign_studentto_class', 'class'=>'form-inline')) }}
                     <div class="span11">

                        <div class="widget ">

                            <div class="widget-header">
                            </div>
                            <!-- /widget-header -->

                            <div class="widget-content">


                                <table id="example" class="display" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="resource-name">Registration Id</th>
                                        <th class="resource-name">Student Name</th>
                                        <th class="resource-name">Class</th>
                                        <th class="resource-name">Section</th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php $i=0;?>
                                    @foreach($studentInfos as $sub)
                                        <tr>
                                            <td>{{$sub->registration_id}} </td>
                                            <td>{{$sub->sutdent_name}} </td>
                                            <td>
                                            <?php $i=$i+1;?>
                                            {{Form::hidden('student_id[]',$sub->idstudentinfo)}}
                                            {{Form::hidden('count',$i)}}
                                            <?php $ids="cat" . $i;?>
                                            <?php $idsub="sub" . $i;?>
                                            <?php $classname="class" . $i;?>
                                            <?php $sectionname="section" . $i;?>
                                             <select onchange="ch('<?php echo $ids;?>','<?php echo $idsub;?>')" name="class[]" id="<?php echo $ids;?>" class="form-control">
                                                <option value="">-&nbsp;Select Class&nbsp;-</option>
                                                @foreach($class as $cats)
                                                <option value="{{$cats->class_name}}">{{$cats->class_name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                          <select name="section[]"  id="<?php echo $idsub;?>"class="form-control" required>

                                          </select>
                                      </td>


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>


                            </div>
                            <!-- /widget-content -->

                        </div>
                        <!-- /widget -->
                        <center>
                            <button type="submit" class="btn btn-primary" id="button"><i class="icon-save"></i> Save</button>
                        </center>
                        {{Form::close()}}
                    </div>
                    <!-- /span8 -->

                   @endif

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

 {{ HTML::style('/media/css/jquery.dataTables.css') }}
       {{--{{ HTML::script('/media/js/jquery.js') }} --}}
    {{ HTML::script('/media/js/jquery.dataTables.js') }}

    <script type="text/javascript" language="javascript" class="init">


        $(document).ready(function () {
            $('#example').dataTable({
                "aoColumns": [
                    {"orderSequence": ["asc", "desc"]},
                    {"orderSequence": ["desc", "asc"]},
                    {"orderSequence": ["desc", "asc", "asc"]},
                    {"orderSequence": ["asc", "desc"]}
                ]
            });
        });


    </script>

     <script>
//         $("#cat").on('change',function (e) {
//             console.log(e);
//             //document.write('hello');
//             var cat_id = e.target.value;
// //      document.write(cat_id);
//             $.get('/ajax?cat_id=' +cat_id,function(data)
//             {
// //console.log(data);
//                 $('#sub').empty();
//                 $.each(data,function(index,subcatObj)
//                 {
//                     $('#sub').append('<option value="'+subcatObj.section+'">'+subcatObj.section+'</option>');
//                 })

//             });
//         });
//         i=0;


    function ch(id,subid) {
       
//document.write(subid);
            var cat_id = document.getElementById(id).value;
 //document.write(cat_id);
 var section="#"+subid;

            $.get('<?php echo Config::get('baseurl.url');?>/ajaxchange?cat_id=' + cat_id, function (data) {
//console.log(data);
                $(section).empty();
                $.each(data, function (index, subcatObj) {
                    $(section).append('<option value="' + subcatObj.section + '">' + subcatObj.section + '</option>');
                })

            });
        }

    </script>
@stop