<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!Login::is_operator()&&!Login::is_admin())
{
  Login::redirect();
}

$groups=new Cars;
 $booking=new Bookings;
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="./favicon.ico">

    <title> All Bookings - Operator panel</title>

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
          <h1>Car bookings till now</h1>
          </div>
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
         <div>
            <?php if(isset($_POST['confirmB']))
            {
              
              $booking->getData($_POST);
              $page=$booking->confirm_booking();
              echo $page;
            }
            ?>
          </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>User Name</th>
           <th>Car</th>
           <th>Booking Date</th>
          <th>From</th>
          <th>To</th>
          <th>Status</th>
          <th>Print Duty Slip</th>
          <th>Print Ticket </th>
        </tr>
      </thead>
      <tbody>
      <?php
     
      $grp=$booking->booking();
      $i=1;
      foreach ($grp as $data) {
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>".$user=User::info($data['user'],'name')."</td>";
        $grp=$groups->get_car_details($data['car']);
        echo "<td>$grp[name]</td>";
        echo "<td>".date('d/m/Y',$data['date'])."</td>";
        echo "<td>".date('d/m/Y',$data['from_date'])."</td>";
       echo "<td>".date('d/m/Y',$data['to_date'])."</td>";
        
       $status=$booking->getStatus($data['booking_id']);
       if($status['Status']!='Pending'){
        echo "<td>";
       echo $status['Button'];
        echo "</td>";
        if($status['Status']=='Completed'){
        echo "<td style='text-align:center'><a href='/operator/slip?slip=$data[duty_slip]&print' class=' print btn btn-default btn-sm' >
  <span class='glyphicon glyphicon-print text-warning'></span></a> 
</button>
</td></td>";
  }else
  {
    echo "<td style='text-align:center'><a href='/operator/dutyslip?id=$data[booking_id]&print' class=' print btn btn-default btn-sm' >
  <span class='glyphicon glyphicon-print text-warning'></span></a> 
</button>
</td></td>";
  }
        echo "<td style='text-align:center'><a href='/operator/ticket?id=$data[booking_id]&print' class='btn print btn-default btn-sm ' >
  <span class='glyphicon glyphicon-list-alt text-primary'></span> 
</a>
</td>";
        }
        else
        {
           echo "<td>";
       echo $status['Button'];
        echo "</td>";
         echo "<td>";
      
        echo "</td>";
         echo "<td>";
       
        echo "</td>";
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
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets//js/bootstrap.min.js"></script>
    <script src=".//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
    <script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
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
   // alert(url);
    
   
  });


});
           function print(){
          
           
           
         }
           
  </script>
  </body>
</html>

