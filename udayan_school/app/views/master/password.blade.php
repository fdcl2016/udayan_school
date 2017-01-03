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
						class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href=""><?php echo Config::get('schoolname.school');?></a>

			<!-- /container -->
		</div>
		<!-- /main-inner -->
	</div>
	<div style="text-align: center; margin-bottom: 40px; margin-top: 40px; margin-left: 0%;">
	    <h2>Password generator</h2><br>
	    Click the button to generate password for the students and teachers.
<table style="margin-left: 34%">
<tr><td>
        {{Form::open(['url'=>'password'])}}
<center><br> <br><button type="submit" class="btn btn-info" id="publishbtn" style="width:200px;" ><i class="icon-ok"></i> Generate Password</button></center>
        {{Form::close()}}

</td><td>{{Form::open(['url'=>'/'])}}

         <center><br> <br><button type="submit" class="btn btn-info" id="hashbtn" style="width:200px; margin-left: 10px;" ><i class="icon-ok"></i> Admin Home</button></center>
                 {{Form::close()}}</td></tr></table>
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