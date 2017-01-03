<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>School Management System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link href="{{ URL::asset('master/css/bootstrap.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('master/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('master/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
		  rel="stylesheet">
	<link rel="shortcut icon" type="image/gif" href="{{URL::asset('image/4d.gif')}}"/>
	<link href="{{ URL::asset('master/css/font-awesome.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('master/css/style.css')}}" rel="stylesheet">
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link href="{{ URL::asset('fdcl/fdcl.min.css')}}" rel="stylesheet">
	@yield('header')
</head>
<body>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
						class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href=""> <img src="{{URL::asset('image/4d.gif')}}" height="25 px" width="30 px" /> &nbsp; <?php echo Config::get('schoolname.school');?></a>
			<div class="nav-collapse">
				<ul class="nav pull-right">
					<?php

					$s = Auth::user()->id;
					$st = Auth::user()->user_id;
					$type = Auth::user()->type;
					if($type=="student"){?>


					<li class="dropdown" >
						<a  style="text-decoration: none;color:#5A0000" class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="icon-globe"></i>  <b class="caret"></b>
						</a>
						<ul class="dropdown-menu dropdown-messages">
							<li>
								<a href="#">
									<div>
										<strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
									</div>
									<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
								</a>
							</li>


						</ul></li>
					<?php
					$messages = FlagMessage::where('idstudentinfo','=',Auth::user()->email)->orderBy('idmessage','desc')->get();
					$count=FlagMessage::where('idstudentinfo','=',Auth::user()->email)->where('flag','=','unseen')->orderBy('idmessage','desc')->count();

					?>
					@if($messages!=null)
						<li class="dropdown">
							<a style="text-decoration: none;"  class="dropdown-toggle" data-toggle="dropdown" href="#" >
								@if($count!=0)  <i style="color:red; font-size: 120%;">{{$count}}</i>
								@endif
								<i class="icon-envelope"></i>
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu dropdown-messages" style="left: auto; right:0 ;overflow: auto;min-height:100px;max-height:310px;">
								@foreach($messages as $mess)

									<?php $message = MessageCL::where('idmessage','=',$mess->idmessage)->first();?>
									<?php
									if($message!=null){
									$str =$message->message_description;
									$str1=" ";

									if ($str!=null) {
										$arr2 = str_split($str, 5);
										if (sizeof($arr2)>27) {


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

									@if($mess->flag=="unseen")

										<li>
											<a href="{{ URL::to('/message/'.$message->idmessage.'/'.$mess->flag)}}">
												<div>
													<strong>{{$message->message_subject}}</strong>
                                    <span style="float:right">
                                        <em>{{$message->created_at}}</em>
                                    </span>
												</div>
												<br>
												<div>{{$str1}}</div>
											</a>
										</li>
										<li class="divider"></li>
									@endif

									<?php }?>

								@endforeach
								@if($count < 1)

									<li class="text-center">
										No New Messages
									</li>
								@endif
								<li style="margin-top:20px;background-color: #d9edf7 ">
									<a class="text-center" href="{{URL::to('/showmessage')}}">
										<strong>Read All Messages</strong>
										<i class="fa fa-angle-right"></i>
									</a>
								</li>
							</ul>

						</li>
						@endif

						<?php }?>

								<!-- <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
									class="icon-comment"></i> Notification </a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
									class="icon-envelope"></i> Message </a></li> -->


						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
										class="icon-user"></i> {{Auth::user()->username}}<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{ URL::to('/profile')}}"><i class="icon-user-md"></i> Profile</a></li>
								<li><a href="{{ URL::to('/change_password')}}"><i class="icon-lock"></i> Change Password</a></li>
								<li><a href="{{ URL::to('/logout')}}"><i class="icon-off"></i> Logout</a></li>
							</ul>
						</li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
		<!-- /container -->
	</div>
	<!-- /navbar-inner -->
</div>
<!-- /navbar -->
<div class="subnavbar">
	<div class="subnavbar-inner">
		<div class="container">
			<ul class="mainnav">
				@if(Auth::user()->type=='admin')
					<li class="{{Request::is('home/*')?'active':''}}"><a href="{{ URL::to('/home/adminhome')}}"><i class="icon-home"></i><span>Home</span> </a> </li>
					<li class="{{Request::is('routine/*')?'active':''}}"><a href="{{ URL::to('/routine/create_routine')}}"><i class="icon-time"></i><span>Routine</span> </a> </li>
					<li class="{{Request::is('result_management/*')?'active':''}}"><a href="{{ URL::to('/tabulationsheet')}}"><i class="icon-check"></i><span>Result</span> </a></li>
					<li class="{{Request::is('notice_management/*')?'active':''}}"><a href="{{ URL::to('/notice_management/add_notice')}}"><i class="icon-info"></i><span>Notice</span> </a> </li>
					<li class="{{Request::is('teacher/')?'active':''}}"><a href=""><i class="icon-book"></i><span>Booklist</span> </a> </li>
					<li class="{{Request::is('principle_and_teacher')?'active':''}}"><a href="{{ URL::to('/principle_and_teacher')}}"> <i class="icon-info-sign"></i><span>Principal & Teachers</span></a></li>
				@endif

				@if(Auth::user()->type=='student')
					<li class="{{Request::is('home/*')?'active':''}}"><a href="{{ URL::to('/home/studenthome')}}"><i class="icon-home"></i><span>Home</span> </a> </li>
					<li class="{{Request::is('routine/*')?'active':''}}"><a href="{{ URL::to('/routine/student_routine')}}"><i class="icon-time"></i><span>Routine</span> </a> </li>
					<li class="{{Request::is('result_management/*')?'active':''}}"><a href="{{ URL::to('/result_management/student_result')}}"><i class="icon-check"></i><span>Result</span> </a></li>

                            <li class="{{Request::is('notice_management/*')?'active':''}}"><a href="{{ URL::to('/notice_management/show_notice_all')}}"><i class="icon-info"></i><span>Notice</span> </a></li>
					
					<li class="{{Request::is('teacher/')?'active':''}}"><a href="{{ URL::to('/book')}}"><i class="icon-book"></i><span>Booklist</span> </a> </li>
					<li class="{{Request::is('principle_and_teacher')?'active':''}}"><a href="{{ URL::to('/principle_and_teacher')}}"> <i class="icon-info-sign"></i><span>Principal & Teachers</span></a></li>
				@endif

				@if(Auth::user()->type=='teacher')
					<li class="{{Request::is('home/*')?'active':''}}"><a href="{{ URL::to('/home/teacherhome')}}"><i class="icon-home"></i><span>Home</span> </a> </li>
					<li class="{{Request::is('routine/*')?'active':''}}"><a href="{{ URL::to('/routine/teacher_routine')}}"><i class="icon-time"></i><span>Routine</span> </a> </li>
					<li class="{{Request::is('result_management/*')?'active':''}}"><a href="{{ URL::to('/result_management/teacher_result_insert')}}"><i class="icon-check"></i><span>Result</span> </a></li>
					
					<li class="{{Request::is('teacher/')?'active':''}}"><a href="{{ URL::to('/book')}}"><i class="icon-book"></i><span>Booklist</span> </a> </li>
					<li class="{{Request::is('principle_and_teacher')?'active':''}}"><a href="{{ URL::to('/principle_and_teacher')}}"> <i class="icon-info-sign"></i><span>Principal & Teachers</span></a></li>
				@endif

				@if(Auth::user()->type=='bank')
					<li class="{{Request::is('home/*')?'active':''}}"><a href="{{ URL::to('/home/banker_payslip')}}"><i class="icon-home"></i><span>Home</span> </a> </li>
				@endif
			</ul>
		</div>
		<!-- /container -->
	</div>
	<!-- /subnavbar-inner -->
</div>
<div class="container">
	@if(Session::has('success'))
		<div class="alert-success">
			<h2>{{ Session::get('success') }}</h2>
		</div>
		<br/>
	@endif
	@if(Session::has('error'))
		<div class="alert-danger">
			<h2>{{ Session::get('error') }}</h2>
		</div>
		<br/>
	@endif
</div>
<!-- /subnavbar -->
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				@yield('content')
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /main-inner -->
</div>

<div class="footer">
	<div class="footer-inner">
		<div class="container">
			<div class="row">
				<div class="span12">Powered By : <a href="http://www.fourdbd.com" target="_blank">Four D Communications Limited</a>. Copyright &copy; 2015. All Rights Reserved</div>
				<!-- /span12 -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /footer-inner -->
</div>
<!-- /footer -->
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ URL::asset('master/js/jquery-1.7.2.min.js')}}"></script>
<script src="{{ URL::asset('master/js/bootstrap.js')}}"></script>

@yield('content_footer')
</div>
</body>
</html>