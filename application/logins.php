<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (Login::is_logged_in())
{
  Login::redirect();
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/favicon.ico">

    <title>Sign In</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/login.css" rel="stylesheet">

 <!-- Optional Bootstrap Theme -->
  <link href="data:text/css;charset=utf-8," data-href="/assets/css/bootstrap-theme.min.css" rel="stylesheet" id="bs-theme-stylesheet">


<!-- Documentation extras -->
<link href="/assets/css/docs.min.css" rel="stylesheet">
<!--[if lt IE 9]><script src="../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/assets/js/ie10-viewport-bug-workaround.js"></script>
<script src="/assets/js/ie-emulation-modes-warning.js"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->


  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
         <?php include 'menu.php';?>
      </div>
    </div>

    <div class="container">
    
  <form method="POST" action="" class="form-horizontal form-signin "  id="loginForm" role="form" >  
         
          <?php 
        if(isset($_POST['login'])){
        
        $username = trim($_POST['email']);
        $password = trim($_POST['password']);
        $login = new Login($dataBase);
        //echo $login->login_user($username, $password);
       if($login->login_user($username,$password)){
          
          $login->set_cookies($_POST['remember']);
          $login->redirect();
        
        
        }
         else 
    {
          $message = '<div class="alert alert-danger">Wrong username or password</div>';
        }
        }
        
        ?>
         <div class="omb_login">
         
      <h3 class="omb_authTitle">Login or <a href="/register">Sign up</a></h3>
    <div class="row omb_row-sm-offset-3 omb_socialButtons">
          <div class="col-xs-4 col-sm-2">
            <a href="#" class="btn btn-lg btn-block omb_btn-facebook">
              <i class="fa fa-facebook visible-xs"></i>
              <span class="hidden-xs">Facebook</span>
            </a>
          </div>
          <div class="col-xs-4 col-sm-2">
            <a href="#" class="btn btn-lg btn-block omb_btn-twitter">
              <i class="fa fa-twitter visible-xs"></i>
              <span class="hidden-xs">Twitter</span>
            </a>
          </div>  
          <div class="col-xs-4 col-sm-2">
            <a href="#" class="btn btn-lg btn-block omb_btn-google">
              <i class="fa fa-google-plus visible-xs"></i>
              <span class="hidden-xs">Google+</span>
            </a>
          </div>  
    </div>

    <div class="row omb_row-sm-offset-3 omb_loginOr">
      <div class="col-xs-12 col-sm-6">
        <hr class="omb_hrOr">
        <span class="omb_spanOr">or</span>
      </div>
    </div>

    <div class="row omb_row-sm-offset-3">
      <div class="col-xs-12 col-sm-6">  
        <?php if(isset($message)){ echo $message; }
        if(isset($_request['logout'])){ echo '<div class="alert alert-success">Loged out successfull.</div>'; } ?>
          <form class="omb_loginForm" action="" autocomplete="off" method="POST">
          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            <input type="email" class="form-control" name="email" placeholder="email address" required>
          </div>
          <span class="help-block"></span>
                    
          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            <input  type="password" class="form-control" name="password" placeholder="Password" required>
          </div>
                    <span class="help-block"></span>

          <button class="btn btn-lg btn-primary btn-block" type="submit" name="login" >Login</button>
        </form>
      </div>
      </div>
    <div class="row omb_row-sm-offset-3">
      <div class="col-xs-12 col-sm-3">
        <label class="checkbox">
          <input type="checkbox" name="remember" value="remember-me">Remember Me
        </label>
      </div>
      <div class="col-xs-12 col-sm-3">
        <p class="omb_forgotPwd">
          <a href="#">Forgot password?</a>
        </p>
      </div>
    </div>        
  </div>
     
  <hr>

     <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2014 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>
       </form>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
            // When the document is ready
            $(function () {
              
                 $("[rel=popover]").popover({
          placement : 'right', //placement of the popover. also can use top, bottom, left or right
          html: 'true',
        trigger: "focus"
    });


    $("#register").click(function()
    {
      $("#register").html("<img src='/assets/images/setting_loader_fast.gif'>");
      $("#register").attr("disabled", "disabled");
      
      $("#registerForm").submit(function(e)
      {
        $("#info").html("<center><h5>Processing.. </h5></center>");
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
        {
          url : formURL,
          type: "POST",
          data : postData,
          dataType: 'json',
          success:function(data, textStatus, jqXHR) 
          {
           // showRecaptcha() ;
            $("#info").html(data.Data);
            $("#register").removeAttr("disabled");  
            $("#register").html("Register");
            $('.username').removeClass('has-error');
            $('.password').removeClass('has-error');
            $('.cfmpassword').removeClass('has-error');
            if(data.Error==0){
           // document.getElementById("registerForm").reset();
            $(".form-signin-heading").focus();
            }
            else{
              $("#info").focus();
                  document.getElementById("registerForm").reset();
                }
            
          },
          error: function(jqXHR, textStatus, errorThrown) 
          {
            $("#info").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
          }
        });
          e.preventDefault(); //STOP default action
          
      });
        
      if($('#required').prop('checked'))
        {
        $('.required').removeClass('has-error');
          $("#registerForm").submit(); //SUBMIT FORM
        }
      else
        {
       // showRecaptcha();
            $('.required').addClass('has-error');
            $('#required').focus();
            $("#register").html("Register");
            $("#register").removeAttr("disabled");
        }
        
    });

$( "#required" ).click(function () {
        
      if($('#required').prop('checked'))
      {
    $('.required').removeClass('has-error');
      
      }
    else
      {
          $('.required').addClass('has-error');
          $('#required').focus();
       
      }
    }).change();
$( "#username" ).on('keyup',function() {
    if($('#username').val().length>=5)
    {
      var username = document.getElementById('username');
      
        var filter = /^[A-Za-z ]*$/;
    if(username.value!=null){
     if (filter.test(username.value)) {
          $('.username').removeClass('has-error');
       }else{
          $('.username').addClass('has-error');
              $('#username').focus();
       }
      }
    }
    else
    {
      $('.username').addClass('has-error');
          $('#username').focus();
    }
  });
$( "#email" ).on('keyup',function() {
    if($('#email').val().length>=5)
    {
      var username = document.getElementById('email');
      
        var filter =/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(username.value!=null){
     if (filter.test(username.value)) {
          $('.email').removeClass('has-error');
       }else{
          $('.email').addClass('has-error');
              $('#email').focus();
       }
      }
    }
    else
    {
      $('.email').addClass('has-error');
          //$('#email').focus();
    }
  });
$( "#contact" ).on('keyup',function() {
    if($('#contact').val().length>=5)
    {
      var username = document.getElementById('contact');
      
        var filter = /^[0-9]{10}$/;
    if(username.value!=null){
     if (filter.test(username.value)) {
          $('.contact').removeClass('has-error');
       }else{
          $('.contact').addClass('has-error');
              $('#contact').focus();
       }
      }
    }
    else
    {
      $('.contact').addClass('has-error');
      $('#contact').focus();
    }
  });
$( "#password" ).on('keyup',function() {
    if($('#password').val().length>=5)
    {
    $('.password').removeClass('has-error');
    }
    else
    {
      $('.password').addClass('has-error');
      $('#password').focus();
    }
  });

}); 
        </script>
  </body>
</html>
