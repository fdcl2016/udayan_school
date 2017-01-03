@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>ClassRoom Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li>
                            <a href="{{ URL::to('/classroom_management/create_class')}}">Create Class</a>
                        </li>
                        <li class="active"><a href="{{ URL::to('/classroom_management/edit_class')}}">Edit Class</a></li>
                        <li><a href="{{ URL::to('/classroom_management/assign_teacher_to_section')}}">Assign Course Teacher</a></li>
                        <li><a href="{{ URL::to('/classroom_management/assign_class_teacher')}}">Assign Class Teacher</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Edit Class</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
                                    <div class="widget-header">Update Class And Section</div>
                                    <div class="widget-content">
                                        {{ Form::open(array('url'=>'classroom_management/editable_class', 'class'=>'form-horizontal')) }}
                                        <?php $class = Addclass::where('class_id','=',$classe_id)->first();
                                        $class_name=$class->class_name;
                                        $count=0;
                                        $sections = Addclass::where('class_name','=',$class_name)->get();
                                        ?>

                                                <div class="control-group col-sm-12">
                                                    <label  style="" >Class Name:</label>
                                                    <input type="text" value="<?php echo $class_name ?>" name="class_name" class="col-sm-10"  required>
                                                </div>
                                                <br><br>
                                                <input type="hidden" name="previous_class_name" value="<?php echo $class_name?>">
                                                <input type="hidden" name="id" value=<?php echo $classe_id?>>


                                                @foreach($sections as $section)
                                                    <?php $count++?>

                                                            <div class="control-group col-sm-5">
                                                                <label style="padding-right: 20px;">Section  name:</label>
                                                                <input class="form-control"  id="go" value="<?php echo $section->section ?>" type="text"  name='section<?=$count?>' required="">
                                                            </div>
                                                            <div class="control-group col-sm-5">
                                                                <label style="padding-right: 20px;">Shift:</label>
                                                                <select class="form-control" name='shift<?=$count?>' required>
                                                                    <option value='<?php echo $section->shift ?>'><?php echo $section->shift ?></option>
                                                                    @if($section->shift!='Morning')
                                                                        <option value='Morning'>Morning</option>
                                                                    @endif
                                                                    @if($section->shift!='Day')
                                                                        <option value='Day'>Day</option>
                                                                    @endif
                                                                    @if($section->shift!='Evening')
                                                                        <option value='Evening'>Evening</option>
                                                                    @endif
                                                                </select>
                                                            </div><br><br>

                                                @endforeach

                                        <div class="control-group col-sm-12"><button type="submit" class="btn btn-primary" id="button"><i class="icon-save"></i> Save</button></div>
                                    </div>
                                        {{Form::close()}}


                        </div>
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
</div>
@stop
@section('content_footer')
@stop