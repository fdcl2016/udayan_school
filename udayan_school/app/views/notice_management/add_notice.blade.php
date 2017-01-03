@extends('master.master')
@section('header')
@stop
@section('content')


    <?php
    $rasel = 1;
    include_once(app_path().'/views/nav_config/a_notice.php');
    ?>


    <div class="tab-content">
        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                        style="color:black">Add Notice</h3></strong></div><br/>

        {{Form::open(array('url'=>'postnotice','class'=>'form-horizontal','files'=>'true'))}}
        <fieldset>

            <div class="control-group col-sm-4">
                <label class="control-label" for="title">Title</label>
                <div class="controls">
                    <input type="text" class="span3" name="title" placeholder="title" required>
                </div> <!-- /controls -->
            </div> <!-- /control-group -->


            <div class="control-group col-sm-3">
                <label class="control-label" for="refNo">Ref No.</label>
                <div class="controls">
                    <input type="text" class="span2" name="refNo" placeholder="Ref No">
                </div> <!-- /controls -->
            </div> <!-- /control-group -->


            <div class="control-group col-sm-4">
                <label class="control-label" for="date">Date</label>
                <div class="controls">
                    <input type="text" class="span2" name="date" id="popupDatepicker" placeholder="pick a date" required>
                </div> <!-- /controls -->
            </div> <!-- /control-group -->


            <div class="control-group col-sm-12">
                <label class="control-label" for="short_description">Short Description</label>
                <div class="controls">
                    <input type="text" class="span9" name="short_description" placeholder="short description" required>
                </div> <!-- /controls -->
            </div> <!-- /control-group -->

            <div class="control-group col-sm-12">
                <label class="control-label" for="description">Description</label>
                <div class="controls">
                    <textarea type="text" class="span9 fdcl_textarea_height" name="description" placeholder="Give a description" required></textarea>
                </div> <!-- /controls -->
            </div> <!-- /control-group -->

            <div class="control-group col-sm-6">
                <label class="control-label" for="filename">PDF/Photo</label>
                <div class="controls">
                    <input type="file" class="span4" name="filename" value="john.donga@egrappler.com">
                </div> <!-- /controls -->
            </div> <!-- /control-group -->


<div class="control-group col-sm-12"></div>



            <div class="control-group col-sm-6">
                <label class="control-label" for="author">Authorised By</label>
                <div class="controls">
                    <input type="text" class="span4" name="author" value="{{"Udayan Authority"}}">
                </div> <!-- /controls -->
            </div>

            <div class="control-group col-sm-5">
                <label class="control-label" for="usertype">Viewers</label>
                <div class="controls">
                    <select name="utype"  class="form-control" required>
                    <option value="">-&nbsp;Select User Type&nbsp;-</option>
                  
                        <option value="Public">{{"Public"}}</option>
                        <option value="Teachers">{{"Teachers"}}</option>
                        <option value="Students">{{"Students"}}</option>
                    
                </select>
                </div> <!-- /controls -->
            </div>


 <!-- /control-group -->
            <br /><br />
            <div class="control-group col-sm-12">
                <div class="controls">
                    <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Save</button>
                </div>

            </div>
        </fieldset>

        {{Form::close()}}
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
    <link href="{{ URL::asset('date/jquery.datepick.css')}}" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ URL::asset('date/jquery.plugin.js')}}"></script>
    <script src="{{ URL::asset('date/jquery.datepick.js')}}"></script>
    <script>
        $(function() {
            $('#popupDatepicker').datepick();
        });
    </script>
@stop