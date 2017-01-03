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
                            <a href="/fees_management/fees_configuration">Fees Configuration</a>
                        </li>
                        <li><a href="/fees_management/classwise_fees_configuration">Classwise Fees Configuration</a></li>
                        <li><a href="/fees_management/monthly_fees_configuration">Monthly Fees Configuration</a></li>
                        <li><a href="/fees_management/studentwise_fees_configuration">Studentwise Fees Configuration</a></li>
                    </ul>
                    <br>

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