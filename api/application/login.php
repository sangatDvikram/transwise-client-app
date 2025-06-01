<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>Sign in </title>
      <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">

    <!-- Le styles -->
      <?php 
echo CSS;
      ?>
      <style type="text/css">
      body {
        
        background-color: #E5E5E5;
      }

      .form-signin {
         border: 1px solid #D8D8D8;
         border-bottom-width: 2px;
         border-top-width: 0;
         background-color: #FFF;
         max-width: 350px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        margin-top: 60px;
        border: 1px solid #F5F5F5;
        -webkit-border-radius: 3px;
           -moz-border-radius: 3px;
                border-radius: 3px;
      }
      .form-signin .form-signin-heading {
         font-size: 24px;
         font-weight: 300;
      }

      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

      </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

      <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
      <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <![endif]-->

                                  
  </head>

  <body>
 <!-- NAVBAR
    ================================================== -->
   
        <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="navbar-inner">
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?php echo $linklocation ;?>/"><?php echo PROJECT ; ?></a>
            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
            <div class="nav-collapse collapse">
              <ul class="nav">
                <li ><a href="<?php echo $linklocation ;?>/"><i class="icon-home"></i> Home</a></li>
                  <li class="divider-vertical"></li>

                <li><a href="<?php echo $linklocation ;?>/about"><i class="icon-list"></i> About us</a></li>
                <li><a href="<?php echo $linklocation ;?>/contact"><i class="icon-phone"></i> Contact</a></li>
                <li><a href="<?php echo $linklocation ;?>/gallery"><i class="icon-camera-retro"></i> Galley</a></li>
                <!-- Read about Bootstrap dropdowns at http://twitter.github.com/bootstrap/javascript.html#dropdowns -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="icon-chevron-down"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li class="nav-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li>
              </ul>
               <ul class="nav pull-right">
                        <li ><a href="<?php echo $linklocation ;?>/register"><b class="icon-pencil"></b> Register</a></li>
                      <li class="active"><a href="<?php echo $linklocation ;?>/login"><b class="icon-key"></b> Login</a></li>
               </ul>
            </div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->
    <div class="container">

      <form class="form-signin" method='POST' action="<?php echo $linklocation ;?>/api/login">
        <h2 class="form-signin-heading">Sign in</h2>
       <div class="status">
       </div>
        <input type="text" name="username" class="input-block-level" placeholder="Username">
        <input type="password" name="password" class="input-block-level" placeholder="Password">
        <label class="checkbox">
          <input type="checkbox" name="rember-me" > Remember me
        </label>
        <button class="btn btn-primary" type="submit">
           Sign in
           <i class="icon-circle-arrow-right"></i>
        </button>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <script src="<?php echo $linklocation ;?>/assets/js/jquery.js"></script>
    <script src="<?php echo $linklocation ;?>/assets/js/bootstrap.js"></script>
    <script src="<?php echo $linklocation ;?>/assets/js/jquery.form.js"></script>
    <script type="text/javascript">
    // prepare the form when the DOM is ready 
$(document).ready(function() { 
    var options = { 
         dataType:  'json', 
        beforeSubmit: validate ,  // pre-submit callback 
        success: processJson  // post-submit callback 
        
    }; 
 
    // bind to the form's submit event 
    $('.form-signin').submit(function() { 
        // inside event callbacks 'this' is the DOM element so we first 
        // wrap it in a jQuery object and then invoke ajaxSubmit 
        $(this).ajaxSubmit(options); 
 
        // !!! Important !!! 
        // always return false to prevent standard browser submit and page navigation 
        return false; 
    }); 
});
function validate(formData, jqForm, options) { 
    // formData is an array of objects representing the name and value of each field 
    // that will be sent to the server;  it takes the following form: 
    // 
    // [ 
    //     { name:  username, value: valueOfUsernameInput }, 
    //     { name:  password, value: valueOfPasswordInput } 
    // ] 
    // 
    // To validate, we can examine the contents of this array to see if the 
    // username and password fields have values.  If either value evaluates 
    // to false then we return false from this method. 
    $(".btn-primary").attr("disabled", "disabled");
    for (var i=0; i < formData.length; i++) { 
        if (!formData[i].value) { 
            $('.status').html('<div class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>Warning!</strong> Please enter a value for both Username and Password</div>');
            $(".btn-primary").removeAttr("disabled"); 
            return false; 
        } 
    } 

    $('.status').html(''); 
}
function processJson(data) { 
    // 'data' is the json object returned from the server 
    $(".btn-primary").removeAttr("disabled");
    alert(data.message); 
}


 </script>
  </body>
</html>
