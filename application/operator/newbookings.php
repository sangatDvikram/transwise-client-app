<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!Login::is_operator()&&!Login::is_admin())
{
  Login::redirect();
}

$groups=new Cars;
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/favicon.ico">

    <title> New Bookings - Operator panel</title>

      <?php include 'css.php';?>

  </head>

  <body>
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
         <?php include APPPATH.'menu.php';?>
      </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas hidden-print" id="sidebar" role="navigation">
         <?php include'sidebar.php';?>
        </div><!--/span-->
        <div class="col-xs-12 col-sm-9">
         <div class="page-header">
          <h1>New Car bookings<small>Pending Bookings</small></h1>
          </div>
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
         
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>User Name</th>
          <th>Contact</th>
           <th>Car</th>
          <th>From</th>
          <th>To</th>
          <th>Booking Date</th>
          <th>Details</th>
          <th>Operation</th>
          
        </tr>
      </thead>
      <tbody>
      <?php
      $booking=new Bookings;
      $grp=$booking->getPending();
      $i=1;
      foreach ($grp as $data) {
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>".$user=User::info($data['user'],'name')."</td>";
        echo "<td>".$user=User::info($data['user'],'contact')."</td>";
        $grp=$groups->get_car_details($data['car']);
        echo "<td>$grp[name]</td>";
        
        echo "<td>".date('d/m/Y',$data['from_date'])."</td>";
       echo "<td>".date('d/m/Y',$data['to_date'])."</td>";
       echo "<td>".date('d/m/Y',$data['date'])."</td>";
       echo "<td style='text-align:center'><a href='/operator/ticket?id=$data[booking_id]' class='btn btn-default btn-sm' >
  <span class='glyphicon glyphicon-list-alt text-info'></span></a> 
</button>
</td>";
$status=$booking->getStatus($data['booking_id']);
if($status['Status']=='Pending')
{
        echo "<td><!-- Single button -->
<div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Take Action <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>
    <li><a href='/operator/confirm?id=$data[booking_id]&operation=confirm'><span class='glyphicon glyphicon-ok'></span> Confirm</a></li>
    <li><a href='/operator/confirm?id=$data[booking_id]&operation=delete'><span class='glyphicon glyphicon-remove'></span> Cancle</a></li>
  </ul>
</div></td>

";
        
      }
      else
      {
        echo "<td>".$status['Button']."</td>";
      }
        
          # code...
         $i++;
      }
      
      


      ?>
      
        
      

    </div>
      </tbody>
    </table>



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
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets//js/bootstrap.min.js"></script>
    <script>
          
           $(document).ready(function () {
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });

$('.slisp').click(function () {
  var url=$(this).attr('href');
 // alert(url);
   child = window.open(url,'Slip', 'width=800, height=640');
   return false;
  });




  
 $('.print').click(function ()
  {
    var url=$(this).attr('href');
    alert(url);
    var myWindow=window.open(url,'','width=800,height=640');
    myWindow.focus();
    return false;
  });


});
           function print(){
          
           
           
         }
           
  </script>
  </body>
</html>

