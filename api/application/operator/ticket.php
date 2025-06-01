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

    <title>Bookings details - Operator panel</title>

      <?php include 'css.php';?>
      <style type="text/css">

@media print {
  body {padding:0; margin:0 ;line-height: 1.3;}
   hr , h4,h3  {padding:0; margin:5px ;line-height: 1.3;}
   br{ margin: 3px ;}
   footer {display: none;}
}
table {width: 100%;margin-top: 10px}
tbody{border-top: none;}
.main tr{border-bottom: 1px solid  #e5e5e5; }
.sub tr{border-bottom: none}
.main tr:last-child {border-bottom: none}

td{border-top: none;}
td:before , td:after{border:none;}
.omb_loginOr {
  position: relative;
  font-size: 18px;
  color: #aaa;
  margin-top: 1em;
  margin-bottom: 1em;
  padding-top: 0.5em;
  padding-bottom: 0.5em;
}
 .omb_loginOr .omb_hrOr {
  background-color: #cdcdcd;
  height: 1px;
  margin-top: 0px !important;
  margin-bottom: 0px !important;
}
 .omb_loginOr .omb_spanOr {
  display: block;
  position: absolute;
  left: 40%;
  top: -0.6em;
  margin-left: -1.5em;
  background-color: white;
  width: 11em;
  text-align: center;
}
      </style>

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
         <div class="page-header hidden-print ">
          <h1>Booking Details <small><?php $status=$booking->getStatus($_request['id']); 
          if($status['Status']=='Confirmed') { ?><a type="button" class="btn btn-default" onclick="window.print()"><span class='glyphicon glyphicon-print '></span> Print</a><?php } else { echo $status['Button']; }?></small> </h1>
          </div>
          <p class="pull-right visible-xs hidden-print">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
         <?php if(isset($_request['id'])){ 

           
           $groups=new Cars;
           $grp=$booking->booking($_request['id']);
           $car=$groups->get_car_details($grp['car']);
           $cargroup=$groups->get_cargroups_details($car['group_id']);
      ?>
      <table  class="main" >
      <tbody>
      <tr>
      <td width="50%"><p class="text-left" style='font-size:18px'><?php echo "<img src='".Company::getdetails('image')."' width='160'>"; ?> | E Ticket</p></td>
      <td width="50%"><p class="text-right"><b>Need help?</b><br><span style="font-size:11px"><?php echo trim(Company::getdetails('Contact')) ; ?></span></p></td>
      </tr>

      <tr>
      <td width="50%" colspan="2">
      <p class="text-left">
      <h4><b>Booking id: <?php echo $grp['booking_id']; ?></b></h4> 
      <br>
      From :  <b><?php echo date("l , jS F Y",$grp['from_date']); ?></b> To : <b><?php echo date("l , jS F Y",$grp['to_date']);  ?> </b></p>
      </td>
      </tr>
      <tr>
      <td width="50%">
      <table class="sub">
      <tbody>
      <tr>
      <td width="50%">
      <p class="text-left"><b><?php echo $cargroup['name'];  ?></b></p>
      <p class="text-left text-muted" style="font-size:12px"> Car Group</p>
      </td>
      <td width="50%">
      <p class="text-left"> <b><?php echo $car['name'];  ?></b></p>
      <p class="text-left text-muted" style="font-size:12px"> Car </p>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      <td width="50%">
      <table class="sub">
      <tbody>
      <tr>
      <td width="50%">
      <p class="text-left"><b><?php echo $cargroup['name'];  ?></b></p>
      <p class="text-left text-muted" style="font-size:12px"> Car Registration No.</p>
      </td>
      <td width="50%">
      <p class="text-left"> <b><?php echo $car['name'];  ?></b></p>
      <p class="text-left text-muted" style="font-size:12px"> Car No</p>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      <tr>
      <td width="50%">
      <p class="text-left"><b><?php echo User::driverInfo($grp['driver_id'],'name')  ?></b></p>
      <p class="text-left text-muted" style="font-size:12px"> Driver Name</p>
      </td>
      <td width="50%">
      <p class="text-left"> <b><?php echo User::driverInfo($grp['driver_id'],'contact')  ?></b></p>
      <p class="text-left text-muted" style="font-size:12px"> Driver No </p>
      </td>
      </tr>
      <tr class="last">
      <td width="50%">
      <table class="sub">
      <tbody>
      <tr>
      <td width="50%">
      <p class="text-left"><b><?php echo User::info($grp['user'],'name');  ?></b></p>
      <p class="text-left text-muted" style="font-size:12px"> Name</p>
      </td>
      <td width="50%">
      <p class="text-left"> <b><?php echo User::info($grp['user'],'contact');  ?></b></p>
      <p class="text-left text-muted" style="font-size:12px"> Contact </p>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      <td width="50%">
      <table class="sub">
      <tbody>
      <tr>
      <td width="50%">
      <p class="text-left"><b><?php echo $grp['persons'];  ?></b></p>
      <p class="text-left text-muted" style="font-size:12px"> No of Persons</p>
      </td>
      <td width="50%">
      <p class="text-left"> <b><?php echo User::info($grp['user'],'address'); ?></b></p>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
<div class="row omb_row-sm-offset-3 omb_loginOr">
      <div class="col-xs-12 col-sm-12">
        <hr class="omb_hrOr">
        <span class="omb_spanOr">Terms And Conditions</span>
      </div>
    </div>
    <?php } ?>
        
      

    



        </div><!--/span-->

      </div><!--/row-->

      
      <hr>

      <footer >
        <p>&copy; Company 2014</p>
      </footer>

    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets//js/bootstrap.min.js"></script>
  
    <script>
         
           $(document).ready(function () {
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });

  <?php if(isset($_request['print'])) echo "window.print();";?>
});
           function prints(){
          child = window.open('http://localhost/','Home', 'width=600, height=500');
           window.focus();
           
         }
           
  </script>
  </body>
</html>

