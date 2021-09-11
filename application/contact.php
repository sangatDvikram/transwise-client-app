<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

    <title>Contact Us</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/docs.min.css" rel="stylesheet">
   

<style type="text/css">
  
     #map_canvas {
        
        height: 200px;
      }
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

    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container">
         <?php include 'menu.php';?>
      </div>
    </div>
<div class="container">
<div class="row">
                <div class="col-md-7" id="divMain">
  <h1>Contact Us</h1>
                    <h3 style="color:#FF6633;"></h3>
          <hr>
      <!--Start Contact form -->                                                    
<form name="enq" class="form-horizontal" method="post" action="email/" onsubmit="return validation();">
  <fieldset>
    <div class="form-group">
  <input type="text" name="name" id="name" value=""  class="input-block-level form-control" placeholder="Name" />
  </div>
  <div class="form-group">
    <input type="text" name="email" id="email" value="" class="input-block-level form-control" placeholder="Email" />
    </div>
    <div class="form-group">
    <textarea rows="11" name="message" id="message" class="input-block-level form-control" placeholder="Comments"></textarea>
    </div>
    <div class="actions">
  <input type="submit" value="Send Your Message" name="submit" id="submitButton" class="btn btn-info pull-right" title="Click here to submit your message!" />
  </div>
  
  </fieldset>
</form>          
      <!--End Contact form -->                       
                </div>
        
      <!--Edit Sidebar Content here-->  
                <div class="col-md-4 col-md-offset-1 well">
                  <div id="map_canvas"></div>
                    <div class="sidebox">
                        <h3 class="sidebox-title">Get to Us</h3>
                    <p>
                        <address><strong>TRANSWISE Car Rental Service,</strong><br />
                        Rohan Plaza, C-Wing, Sh No. 25,<br />
                        Near Amanora Park Town/DSK Toyota<br />
                        Sade Satra Nali, Hadapsar,<br />
                        Pune. 411028<br />
                        <abbr title="Phone">P:</abbr>  +91 20 6060 6006 , +91 775592 6006</address> 
                        <address>  <strong>Email</strong><br />
                        <a href="mailto:Transwise.cars@transwise.co.in">Transwise.cars@transwise.co.in</a></address>  
                    </p>     
                     
           <!-- Start Side Categories -->
        <h4 class="sidebox-title">Sidebar Categories</h4>
        <ul>
          <li><a href="#">Quisque diam lorem sectetuer adipiscing</a></li>
          <li><a href="#">Interdum vitae, adipiscing dapibus ac</a></li>
          <li><a href="#">Scelerisque ipsum auctor vitae, pede</a></li>
          <li><a href="#">Donec eget iaculis lacinia non erat</a></li>
          <li><a href="#">Lacinia dictum elementum velit fermentum</a></li>
          <li><a href="#">Donec in velit vel ipsum auctor pulvinar</a></li>
        </ul>
          <!-- End Side Categories -->
                              
                    </div>
          
          
                    
                </div>
      <!--/End Sidebar Content-->
        
        
            </div>  
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
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
      function initialize() {
        var map_canvas = document.getElementById('map_canvas');
        var map_options = {
          center: new google.maps.LatLng(18.510452, 73.939849),
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(map_canvas, map_options);
         var myLatlng = new google.maps.LatLng("18.510452", "73.939849");
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: "TRANSWISE Car Rental Service"
        });
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </body>
</html>
