<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Developed by Mohammed Abdus Sattar Shoag, Mail: shohag.cse@hotmail.com">
    <title>School Management System</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="{{ URL::asset('master/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('master/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
          rel="stylesheet">
    <link href="{{ URL::asset('master/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('master/css/style.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('master/css/pages/signin.css')}}" rel="stylesheet" type="text/css">

</head>

<body>

<div class="navbar navbar-fixed-top">

    <div class="navbar-inner">

        <div class="container">

            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <a class="brand" href="">
               <?php echo Config::get('schoolname.school');?>
            </a>

        </div> <!-- /container -->

    </div> <!-- /navbar-inner -->

</div> <!-- /navbar -->



<div class="account-container">

    <div class="content clearfix">

        {{Form::open(['url'=>'postlogin'])}}

            <h1>Login</h1>

            <div class="login-fields">

@if (Session::has('errors'))
  <div class="alert alert-danger">
    {{ Session::get('errors'); }}
  </div>
@endif

                <p>Please provide your details</p>

                <div class="field">
                    <label for="username">Username</label>
                    <input type="text" id="email" name="email" value="" placeholder="Registration ID" class="login username-field" />
                </div> <!-- /field -->

                <div class="field">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
                </div> <!-- /password -->

            </div> <!-- /login-fields -->

            <div class="login-actions">

                <button class="button btn btn-success btn-large">Sign In</button>

            </div> <!-- .actions -->



        {{Form::close()}}

    </div> <!-- /content -->

</div> <!-- /account-container -->

<div class="col-sm-16" style="margin-top:5%; margin-left:0%"><center>
   <table>
     <tr>
      <td>
       <table>
          <tr>
            <td style="font-size:14px"><b>Powered by:</b></td>
            <td style="margin-left:4%"><a target="_blank" href="http://iteams.com.bd"><img width=70px src="http://iteams.com.bd/iteams_logo.png" /></a></td>
           </tr>
       </table>
      </td>
      <td style="width:25%"></td> 
       
      <td>
       <table>
         <tr>
            <td style="font-size:14px"><b>Developed by:</b></td>
            <td style="margin-left:2%"><a target="_blank" href="http://fourdbd.com"><img width=60px src="http://iteams.com.bd/fdcl_logo.png" /></a></td>
          </tr>
       </table>
     </td>
   </tr>
  </table><center>
   
</div>

<script src="{{ URL::asset('master/js/jquery-1.7.2.min.js')}}"></script>
<script src="{{ URL::asset('master/js/bootstrap.js')}}"></script>

<script src="{{ URL::asset('master/js/signin.js')}}"></script>

</body>

</html>