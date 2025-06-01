<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title> </title>
      <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">

      <?php echo CSS; ?>

 
  <!-- FOOTER -->
      <body>

<div class='container'>
          <div class="card people">
     <div class="card-top blue">
        <a href="#">
           <img src="assets/img/silhouette_homer.png" alt=""/>
        </a>
     </div>
     <div class="card-info">
        <a class="title" href="#">Homer Simpson</a>
        <div class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
     </div>
     <div class="card-bottom">
        <button class="btn btn-block">Follow</button>
     </div>
  </div>

  <div class="card hovercard">
     <img src="assets/img/the-simpsons.png" alt=""/>
      <div class="avatar">
      <img src="assets/img/bill.png" alt="" />
   </div>
    
     <div class="info">
        <div class="title">
           Titolo
        </div>
        <div class="desc">Lorem ipsum</div>
        <div class="desc">Lorem ipsum</div>
        <div class="desc">Lorem ipsum</div>
     </div>
     <div class="bottom">
        <button class="btn">Add</button>
     </div>
  </div>
</div>

        <?php echo FOOTER; ?>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>
