@extends('master.master')
@section('header')
@stop
@section('content')


    <?php
    $rasel = 4;
    include_once(app_path().'/views/nav_config/a_routine.php');
    ?>

    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">Configure List</h3></strong></div><br/>
                        <div class="fdcl_content_profile">
@if($lists!=null&&$lists!="[]")

                              <div class="table-responsive">
                                      <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>#</th>
                                            <th>Class</th>
                                            <th>Section</th>
                                            <th>Year</th>
                                            <th>Shift</th>
                                            <th>Routine Status</th>

                                          </tr>
                                        </thead>
                                        <?php $cls_sec = Addclass::orderBy('value','ASC')->get(); ?>
                                        <tbody id="myTable">
                                <?php $i=1; ?>
                                          @foreach($cls_sec as $cl)
                                          <tr>

                                            <td>{{$i}}</td>
                                            <td>{{$cl->class_name}}</td>
                                            <td>{{$cl->section}}</td>
                                            <td>{{"2015-2016"}}</td>
                                            <?php

                                             $shft = RoutineView::where('class','=',$cl->class_name)->where('section','=',$cl->section)->first();
                                             $c = count($shft);

                                             ?>

                                             @if($c !=0)
                                            <td width="100px">{{$shft->shift}}</td>
                                            <td><h4 style="color:#ff0000;font-weight: bold">Already Created</h4><a href="{{ URL::to('/routine/edit_config/' .$shft->config_id)}}"><span>Edit</span></a></td>
                                            @else
                                            <td>{{"Not Available"}}</td>
                                            <td><a href="{{ URL::to('/routine/create_routine')}}">Create Routine</a></td>
                                            @endif



                                          </tr>
                                          <?php $i++; ?>
                                          @endforeach

                                        </tbody>
                                      </table>
                                    </div><br/>
                                    <div class="col-md-6 text-center">
                                          <ul class="pagination pagination-lg pager" id="myPager"></ul>
                                          </div>
                            @endif
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
                    {"orderSequence": ["asc", "desc"]},
                    null
                ]
            });
        });

  $.fn.pageMe = function(opts){
      var $this = this,
          defaults = {
              perPage: 10,
              showPrevNext: false,
              hidePageNumbers: false
          },
          settings = $.extend(defaults, opts);

      var listElement = $this;
      var perPage = settings.perPage;
      var children = listElement.children();
      var pager = $('.pager');

      if (typeof settings.childSelector!="undefined") {
          children = listElement.find(settings.childSelector);
      }

      if (typeof settings.pagerSelector!="undefined") {
          pager = $(settings.pagerSelector);
      }

      var numItems = children.size();
      var numPages = Math.ceil(numItems/perPage);

      pager.data("curr",0);

      if (settings.showPrevNext){
          $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
      }

      var curr = 0;
      while(numPages > curr && (settings.hidePageNumbers==false)){
          $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
          curr++;
      }

      if (settings.showPrevNext){
          $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
      }

      pager.find('.page_link:first').addClass('active');
      pager.find('.prev_link').hide();
      if (numPages<=1) {
          pager.find('.next_link').hide();
      }
    	pager.children().eq(1).addClass("active");

      children.hide();
      children.slice(0, perPage).show();

      pager.find('li .page_link').click(function(){
          var clickedPage = $(this).html().valueOf()-1;
          goTo(clickedPage,perPage);
          return false;
      });
      pager.find('li .prev_link').click(function(){
          previous();
          return false;
      });
      pager.find('li .next_link').click(function(){
          next();
          return false;
      });

      function previous(){
          var goToPage = parseInt(pager.data("curr")) - 1;
          goTo(goToPage);
      }

      function next(){
          goToPage = parseInt(pager.data("curr")) + 1;
          goTo(goToPage);
      }

      function goTo(page){
          var startAt = page * perPage,
              endOn = startAt + perPage;

          children.css('display','none').slice(startAt, endOn).show();

          if (page>=1) {
              pager.find('.prev_link').show();
          }
          else {
              pager.find('.prev_link').hide();
          }

          if (page<(numPages-1)) {
              pager.find('.next_link').show();
          }
          else {
              pager.find('.next_link').hide();
          }

          pager.data("curr",page);
        	pager.children().removeClass("active");
          pager.children().eq(page+1).addClass("active");

      }
  };

  $(document).ready(function(){

    $('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:4});

  });


    </script>
@stop