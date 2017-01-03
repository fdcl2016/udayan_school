@extends('master.master')
@section('header')
@stop
@section('content')
    <div class="span12">

        <div class="widget ">

            <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Assignment Management</h3>
            </div>
            <div class="widget-content">
                <div class="tabbable">

                    <div class="tab-content">
                        <div class="alert alert-info" style="border-left: 5px solid #33D685;"><strong><h3
                                        style="color:black">My Assignment</h3></strong></div><br/>




                        <div id="messages"></div>

                            <div class="table-responsive" style="padding-left:10%;padding-right:10%">
                                <table id="example" class="display" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th> Topic </th>

                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($message as $mess)

                                        <?php



                                        $str =$mess->assignment_topic;
                                        $str1=" ";

                                        if ($str!=null) {
                                            $arr2 = str_split($str, 5);
                                            if (sizeof($arr2)>2) {


                                                $arr1="..........";

                                                for ($i=0; $i<8; $i++) {
                                                    $str1=$str1 . $arr2[$i];

                                                }
                                                $str1=$str1 . $arr1;
                                            }else{
                                                $str1=$str;
                                            }

                                        }



                                        ?>



                                        <tr >

                                                <td ><b><a style="" href="{{ URL::to('assignment/'.$mess->idassignment)}}">{{$mess->assignment_subject}}</a> </b></td>
                                                <td ><p><a style="" href="{{ URL::to('assignment/'.$mess->idassignment)}}">{{$str1}}</a> </p></td>

                                                <td ><i style='width:25px;height:20px;' class='fa fa-calendar'></i>{{$mess->created_at}}</td>

                                        </tr>
                                        </a>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>



                        <br>
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
    {{ HTML::script('/media/js/jquery.js') }}
    {{ HTML::script('/media/js/jquery.dataTables.js') }}

    <script src="asset/js/addscript.js"></script>
    <script type="text/javascript" language="javascript" class="init">


        $(document).ready(function() {
            $('#example').dataTable( {
                "aoColumns": [
                    { "orderSequence": [ "desc","asc" ] },
                    { "orderSequence": [ "desc", "asc" ] },
                    { "orderSequence": [ "desc", "asc" ] },

                ]
            } );
        } );



        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.document.location = $(this).data("href");
            });
        });

    </script>
@stop