<?php 
$groups=new Cars;
$booking=new Bookings;
?>
<html lang="en" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-family: sans-serif;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-size: 62.5%;-webkit-tap-highlight-color: rgba(0,0,0,0);overflow-x: hidden;">
  <head style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <meta charset="utf-8" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <meta name="viewport" content="width=device-width, initial-scale=1" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <meta name="description" content="" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <meta name="author" content="" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <link rel="shortcut icon" href="./favicon.ico" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">

    <title style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Bookings details - Operator panel</title>

      
    <!-- Bootstrap core CSS -->
    <link href="http://transwise.vritt.com/assets/css/bootstrap.min.css" rel="stylesheet" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <link href="http://transwise.vritt.com/assets/css/docs.min.css" rel="stylesheet" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <link href="http://transwise.vritt.com/assets/css/offcanvas.css" rel="stylesheet" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <link href="http://transwise.vritt.com/assets/css/datepicker.css" rel="stylesheet" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->      

  </head>

  <body style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 0;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.3;color: #333;background-color: #fff;position: relative;overflow-x: hidden;padding-top: 70px;padding: 0;">
    
    <div class="container" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-right: auto;margin-left: auto;padding-left: 15px;padding-right: 15px;">

      <div class="row row-offcanvas row-offcanvas-right" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-left: -15px;margin-right: -15px;">

       
        <div class="col-xs-12 col-sm-12" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;float: left;width: 100%;">
         <div class="page-header hidden-print " style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding-bottom: 9px;margin: 40px 0 20px;border-bottom: 1px solid #eee;">
          <h1 style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-size: 36px;margin: .67em 0;font-family: inherit;font-weight: 500;line-height: 1.1;color: inherit;margin-top: 20px;margin-bottom: 10px;">Booking Details <small style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-size: 65%;font-weight: 400;line-height: 1;color: #999;"><a type="button" class="btn btn-default" href="<?php echo"http://$_SERVER[HTTP_HOST]/PrintTicket?id=$_request[id]&print";?>"style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;background: 0 0;color: #333;text-decoration: underline;display: inline-block;margin-bottom: 0;font-weight: 400;text-align: center;vertical-align: middle;cursor: pointer;background-image: none;border: 1px solid transparent;white-space: nowrap;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;border-radius: 4px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;background-color: #fff;border-color: #ccc;"><span class="glyphicon glyphicon-print " style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;position: relative;top: 1px;display: inline-block;font-family: 'Glyphicons Halflings';font-style: normal;font-weight: 400;line-height: 1;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;"></span> Print</a></small> </h1>
          </div>
           <?php if(isset($_request['id'])){ 

           
           $groups=new Cars;
           $grp=$booking->booking($_request['id']);
           $car=$groups->get_car_details($grp['car']);
           $cargroup=$groups->get_cargroups_details($car['group_id']);
      ?>
               <table class="main" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border-collapse: collapse;border-spacing: 0;max-width: 100%;background-color: transparent;width: 100%;margin-top: 10px;">
      <tbody style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border-top: none;">
      <tr style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;page-break-inside: avoid;border-bottom: 1px solid  #e5e5e5;">
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;"><p class="text-left" style="font-size: 18px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;"><img <?php echo "src='http://$_SERVER[HTTP_HOST]".Company::getdetails('image')."'";?> width="32" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 0;vertical-align: middle;page-break-inside: avoid;max-width: 100%!important;"><b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;"><?php echo Company::getdetails('Name')."</b>"; ?> | E Ticket</p></td>
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;"><p class="text-right" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: right;"><b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;">Need help?</b><br style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 3px;"><span style="font-size: 11px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"><?php echo trim(Company::getdetails('Contact')) ; ?></span></p></td>
      </tr>

      <tr style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;page-break-inside: avoid;border-bottom: 1px solid  #e5e5e5;">
      <td width="50%" colspan="2" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <p class="text-left" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;">
      <h4 style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-family: inherit;font-weight: 500;line-height: 1.3;color: inherit;margin-top: 10px;margin-bottom: 10px;font-size: 18px;padding: 0;margin: 5px;"><b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;">Booking id: <?php echo $grp['booking_id']; ?></b></h4> 
      <br style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin: 3px;">
      From :  <b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;"><?php echo date("l , jS F Y",$grp['from_date']); ?></b> To : <b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;"><?php echo date("l , jS F Y",$grp['to_date']);  ?> </b></p>
      </td>
      </tr>
      <tr style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;page-break-inside: avoid;border-bottom: 1px solid  #e5e5e5;">
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <table class="sub" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border-collapse: collapse;border-spacing: 0;max-width: 100%;background-color: transparent;width: 100%;margin-top: 10px;">
      <tbody style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border-top: none;">
      <tr style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;page-break-inside: avoid;border-bottom: none;">
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <p class="text-left" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;"><b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;"><?php echo $cargroup['name'];  ?></b></p>
      <p class="text-left text-muted" style="font-size: 12px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;color: #999;"> Car Group</p>
      </td>
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <p class="text-left" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;"> <b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;"><?php echo $car['name'];  ?></b></p>
      <p class="text-left text-muted" style="font-size: 12px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;color: #999;"> Car </p>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <table class="sub" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border-collapse: collapse;border-spacing: 0;max-width: 100%;background-color: transparent;width: 100%;margin-top: 10px;">
      <tbody style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border-top: none;">
      <tr style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;page-break-inside: avoid;border-bottom: none;">
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <p class="text-left" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;"><b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;"><?php echo $car['Reg_num'];  ?></b></p>
      <p class="text-left text-muted" style="font-size: 12px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;color: #999;"> Car Registration No.</p>
      </td>
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <p class="text-left" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;"> <b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;"><?php echo $car['type'];  ?></b></p>
      <p class="text-left text-muted" style="font-size: 12px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;color: #999;"> Car Type</p>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      <tr style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;page-break-inside: avoid;border-bottom: 1px solid  #e5e5e5;">
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <table class="sub" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border-collapse: collapse;border-spacing: 0;max-width: 100%;background-color: transparent;width: 100%;margin-top: 10px;">
      <tbody style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border-top: none;">
      <tr style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;page-break-inside: avoid;border-bottom: none;">
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <p class="text-left" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;"><b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;"><?php echo User::driverInfo($grp['driver_id'],'name');  ?></b></p>
      <p class="text-left text-muted" style="font-size: 12px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;color: #999;">Driver Name</p>
      </td>
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <p class="text-left" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;"> <b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;"><?php echo User::driverInfo($grp['driver_id'],'contact');  ?></b></p>
      <p class="text-left text-muted" style="font-size: 12px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;color: #999;"> Driver Contact </p>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <table class="sub" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border-collapse: collapse;border-spacing: 0;max-width: 100%;background-color: transparent;width: 100%;margin-top: 10px;">
      <tbody style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border-top: none;">
      <tr style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;page-break-inside: avoid;border-bottom: none;">
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <p class="text-left" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;"><b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;"><?php echo User::driverInfo($grp['driver_id'],'licence');  ?></b></p>
      <p class="text-left text-muted" style="font-size: 12px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;color: #999;"> Driver Licence Number</p>
      </td>
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <p class="text-left" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;"> <b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;"><?php echo User::driverInfo($grp['driver_id'],'pan');  ?></b></p>
      <p class="text-left text-muted" style="font-size: 12px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;color: #999;"> Driver Pan Number</p>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      <tr class="last" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;page-break-inside: avoid;border-bottom: none;">
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <table class="sub" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border-collapse: collapse;border-spacing: 0;max-width: 100%;background-color: transparent;width: 100%;margin-top: 10px;">
      <tbody style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border-top: none;">
      <tr style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;page-break-inside: avoid;border-bottom: none;">
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <p class="text-left" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;"><b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;"><?php echo User::info($grp['user'],'name');  ?></b></p>
      <p class="text-left text-muted" style="font-size: 12px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;color: #999;"> Name</p>
      </td>
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <p class="text-left" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;"> <b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;"><?php echo User::info($grp['user'],'contact');  ?></b></p>
      <p class="text-left text-muted" style="font-size: 12px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;color: #999;"> Contact </p>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <table class="sub" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border-collapse: collapse;border-spacing: 0;max-width: 100%;background-color: transparent;width: 100%;margin-top: 10px;">
      <tbody style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border-top: none;">
      <tr style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;page-break-inside: avoid;border-bottom: none;">
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <p class="text-left" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;"><b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;"><b><?php echo $grp['persons'];  ?></b></p>
      <p class="text-left text-muted" style="font-size: 12px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;color: #999;"> No of Persons</p>
      </td>
      <td width="50%" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding: 0;border-top: none;">
      <p class="text-left" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;orphans: 3;widows: 3;margin: 0 0 10px;text-align: left;"> <b style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;"><?php echo User::info($grp['user'],'address'); ?></b></p>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
<div class="row omb_row-sm-offset-3 omb_loginOr" style="position: relative;font-size: 18px;color: #aaa;margin-top: 1em; margin-bottom: 1em;padding-top: 0.5em;padding-bottom: 0.5em;">
      <div class="col-xs-12 col-sm-12" style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;float: left;width: 100%;">
        <hr class="omb_hrOr" style="background-color: #cdcdcd;height: 1px;margin-top: 0px !important;margin-bottom: 0px !important;">
        <span class="omb_spanOr" style="display: block;position: absolute;left: 40%;top: -0.6em;margin-left: -1.5em;background-color: white;width: 11em;text-align: center;">Terms And Conditions</span>
      </div>
    </div>
            
      

    <?php } ?>



        </div><!--/span-->

      </div><!--/row-->

      
      <hr style="-webkit-box-sizing: border-box;-moz-box-sizing: content-box;box-sizing: content-box;height: 0;margin-top: 20px;margin-bottom: 20px;border: 0;border-top: 1px solid #eee;padding: 0;margin: 5px;line-height: 1.3;">

    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo "http://$_SERVER[HTTP_HOST]";?>/assets/js/jquery.js"></script>
    <script src="<?php echo "http://$_SERVER[HTTP_HOST]";?>/assets/js/bootstrap.min.js"></script>
  
    <script>
  <?php if(isset($_request['print'])) echo "window.print();";?>
  </script>
  </body>
</html>