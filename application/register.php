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

    <title>Register With Us</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/docs.min.css" rel="stylesheet">
    <link href="/assets/css/register.css" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
         <?php include 'menu.php';?>
      </div>
    </div>

    <div class="container">
    <div class="page-header">
  <form method="POST" action="api/api.register" class="form-horizontal form-signin " id="registerForm" role="form" >
    
          <h2 class="form-signin-heading">Join Us</h2>
          <hr>

       <div class="form-group">
        <div class="col-sm-offset-4 col-sm-9">
          <div id="info">
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
<hr>
     <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2014 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

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
            
                  document.getElementById("registerForm").reset();
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
$( "#cfmpassword" ).on('keyup',function() {
    if($.trim($('#cfmpassword').val())==$.trim($('#password').val()))
    {
      
          $('.cfmpassword').removeClass('has-error');
        
    }
    else
    {
      $('.cfmpassword').addClass('has-error');
          $('#cfmpassword').focus();
    }
  });
            }); 
        </script>
  </body>
</html>
