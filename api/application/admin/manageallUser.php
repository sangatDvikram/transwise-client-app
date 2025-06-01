<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!Login::is_admin())
{
  Login::redirect();
}
    $message='';
if(Input::exists()){
 $userInsert=myDB::getInstance()->insert('transwise_user',array(
                'user_id'=>ProcessForm::generate_id('transwise_user','user-'),
                'name'=>Input::get('name'),
                'password'=>md5(Input::get('passsword')),
                'email'=>Input::get('email'),
                'contact'=>Input::get('contact'),
                'address'=>Input::get('address'),
                'timestamp'=>time(),
        'type'=>2,
        'company_id'=>1
    ));
if($userInsert){
    $message="<div class='alert alert-success'> New User Added successfuly.</div>";
}
    else{
        $message ="<div class='alert alert-success'>Something went wrong Please try again.</div>";
    }
}

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="./favicon.ico">

    <title>Add New User - Admin panel</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
     <link href="./assets/css/docs.min.css" rel="stylesheet">
    <link href="./assets/css/offcanvas.css" rel="stylesheet">
    <link href="./assets/css/datepicker.css" rel="stylesheet">
<style type="text/css">
  body
  {
    padding-top:70px;
  }
    
      #accordion .glyphicon { margin-right:10px; }
      .panel-collapse>.list-group .list-group-item:first-child {border-top-right-radius: 0;border-top-left-radius: 0;}
      .panel-collapse>.list-group .list-group-item {border-width: 1px 0;}
      .panel-collapse>.list-group {margin-bottom: 0;}
      .panel-collapse .list-group-item {border-radius:0;}

      .panel-collapse .list-group .list-group {margin: 0;margin-top: 10px;}
      .panel-collapse .list-group-item li.list-group-item {margin: 0 -15px;border-top: 1px solid #ddd;border-bottom: 0;padding-left: 30px;}
      .panel-collapse .list-group-item li.list-group-item:last-child {padding-bottom: 0;}

      .panel-collapse div.list-group div.list-group{margin: 0;}
      .panel-collapse div.list-group .list-group a.list-group-item {border-top: 1px solid #ddd;border-bottom: 0;padding-left: 30px;}
      .panel-body .btn:not(.btn-block) { width:120px;margin-bottom:10px; }
</style>
   
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
         <?php include APPPATH.'menu.php';?>
      </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
         <?php include'adminsidebar.php';?>
        </div><!--/span-->
        <div class="col-xs-12 col-sm-6">
          
           <div class="page-header">
          <h1>Add New Users<small><p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p></small></h1>
          </div>

<!--  form-->
           <form method="POST" action="" class="form-horizontal form-signin " id="registerForm" role="form" >
    <div class="form-group">
        <div class="col-sm-12">
          <div id="info"> <?php echo $message;?>
          </div>
        </div>
      </div>


      <div class="form-group username">
      <label for="username" class="col-sm-4 control-label ">Full Name <span class="text-danger">*</span> </label>
      <div class="col-sm-8">
        <input type="text" class="form-control first" id="username" tabindex="1" autocomplete="off" name="name" data-container="body" rel="popover" data-content='Enter Your Full Name ' data-original-title="<center><b>Username</b></center>" placeholder="Full Name" required>
      </div> 
    </div>
    <div class="form-group email">
      <label for="email" class="col-sm-4 control-label ">Email <span class="text-danger">*</span></label>
      <div class="col-sm-8">
        <input type="email" class="form-control middle" id="email" autocomplete="off" tabindex="2"  name="email" placeholder="something@host.com" data-container="body" rel="popover" data-content='Active email address only <br> All Booking Related information will be sent here.' data-original-title="<center><b>Email</b></center>" required>
      </div>
    </div>
    <div class="form-group contact">
      <label for="contact" class="col-sm-4 control-label ">Contact Number <span class="text-danger">*</span> </label>
      <div class="col-sm-8">
        <input type="tel" pattern="\d{10}" class="form-control middle" id="contact" tabindex="3"  autocomplete="off" name="contact" placeholder="Eg:0123456789" data-container="body" rel="popover" data-content='Current contact number to confirm your bookings.' data-original-title="<center><b>Contact Number</b></center>" required >
      </div>
    </div>
    <div class="form-group">
    <label for="contact" class="col-sm-4 control-label ">Address <span class="text-danger">*</span> </label>
      <div class="col-sm-8">
      <textarea class="form-control middle"  tabindex="4" rows="3" cols="7" placeholder="Address"  name='address'required></textarea>
    </div>
  </div>
    <div class="form-group password">
      <label for="password" class="col-sm-4 control-label ">Password  <span class="text-danger">*</span> </label>
      <div class="col-sm-8">
        <input type="password" class="form-control middle" id="password" tabindex="5"  autocomplete="off" name="password" placeholder="Password" data-container="body" rel="popover" data-content='Use minimum 6 Be Tricky!!' data-original-title="<center><b>Password</b></center>" required >
      </div>
    </div>
    <div class="form-group cfmpassword">
      <label for="cfmpassword" class="col-sm-4 control-label ">Confirm Passoword <span class="text-danger">*</span> </label>
      <div class="col-sm-8">
        <input type="password" class="form-control last" id="cfmpassword" tabindex="6"  autocomplete="off" name="cfmpassword" placeholder="Confirm Password" data-container="body" rel="popover" data-content='Use Same as above :) !!' data-original-title="<center><b>Confirm Password</b></center>" required>
      </div>
    </div>
    <div class="form-group required">
      <div class="col-sm-offset-4 col-sm-9">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="required"  tabindex="7 "  id="required"> I agree Terms and condition
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-4 ">
        <button class="btn btn-lg btn-primary btn-block" tabindex="8"  name="RegisterME" id="register" type="submit">Register</button>
      </div>
    </div>
    </form>
<!-- /form end-->
        </div><!--/span-->

      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2014</p>
      </footer>

    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script> $(document).ready(function () {
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  }); }); </script>
  </body>
</html>

