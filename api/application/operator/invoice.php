<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!Login::is_operator()&&!Login::is_admin())
{
  Login::redirect();
}
$groups=new Cars;
$Operator=new Operator;
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

    <title>Generate Invoice - Operator panel</title>
<?php include 'css.php';?>
     <style type="text/css">


@media print {
  body{padding: 0; margin:0;width: 100%}
  input[type="text"] {
    width: 50px;zoom:-5px;}
  label{font-size: 12px;}
   hr , h4,h3  {padding:0; margin:5px ;line-height: 1.3;}
   br{ margin: 3px ;}
   footer {display: none;}
}
table {width: 100%;margin-top: 10px ;padding: 0; margin: 0;}
tbody{border-top: none;}
.main tr{border-bottom: 1px solid  #e5e5e5; padding: 5px}
.sub tr{border-bottom: none}
.main tr:last-child {border-bottom: none}
.box{border: 1px solid #e5e5e5;min-width:60px;min-height: 20px}
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
input[type="text"] {
    width: 150px;}
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
         <div class="page-header hidden-print">
  <h1>Generate Invoice  <small> <?php if(isset($_request['slip'])){ echo '<small><a type="button" class="btn btn-default  hidden-print" onclick="window.print()"><span class="glyphicon glyphicon-print" ></span> Print</a></small>';}else{echo "<small></small>";}?></small></h1>
</div>
          <p class="pull-right visible-xs hidden-print">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
        <?php if(isset($_request['all'])||isset($_request['new'])) {?>
        
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
          <th>Invoice</th>
        
        </tr>
      </thead>
      <tbody>
      <?php
     if(isset($_request['all']))
     {
      $slip=$Operator->GetDutySlipList();
      foreach ($slip as $value) {

        $grp=$booking->booking($value['booking_id']);
        $i=1;
      
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>".$user=User::info($grp['user'],'name')."</td>";
        $grps=$groups->get_car_details($grp['car']);
        echo "<td>$grps[name]</td>";
        echo "<td>".date('d/m/Y',$grp['date'])."</td>";
        echo "<td>".date('d/m/Y',$grp['from_date'])."</td>";
       echo "<td>".date('d/m/Y',$grp['to_date'])."</td>";
        
       $status=$booking->getStatus($value['booking_id']);
       if($status['Status']!='Pending'){
        echo "<td>";
       echo $status['Button'];
        echo "</td>";
        echo "<td style='text-align:center'><a href='/operator/invoice?slip=$value[Dslip_no]' title='View Invoice Details' class=' print btn btn-default btn-sm' >
  <span class='glyphicon glyphicon-list-alt 'style='color:#088A08' ></span></a> 
</button>
</td></td>";
        
      }}
     }
        }?>
      </tbody>
  </table>
          
    <?php if(isset($_request['slip'])){  
            $Operator=new Operator();
           $slip=$Operator->getDutySlipDetails($_request['slip']);
           $booking=new Bookings;
           $groups=new Cars;
           $grp=$booking->booking($slip['booking_id']);
           $car=$groups->get_car_details($grp['car']);
           $cargroup=$groups->get_cargroups_details($car['group_id']);
           $package_info=$Operator->getpackagedetails( $grp['package_id']); 
           $package_groupe_info=$Operator->getpackagegroupdetails($package_info['cat_id']);
           $total=0;
           $total_bill=0;
           ?>
          <div class="row" style="font-size:12px;font-family:Calibri">
            
            <span style="font-size:16px"><?php echo Company::getdetails('addressline');  ?></span>
            <hr>
            <table  cellpadding="6" >
            <tr>
            <td>
            <table border="0" cellpadding="6">
            <tr >
            
            <th width="100%" colspan="3" style="border-right:0;text-align:center;font-size: 18px">Invoice
            
                </th>
            </tr>
            </table>
            </td>
            </tr>
            <tr>
            <td>
            <table border="0" cellpadding="6">
            <tr >
            
                <th width="50%" colspan="3" style="border-right:0;text-align:left;font-size: 14px;padding: 5px">To,  <br> <?php echo User::info($grp['user'],'address');?></th>
            <th width="50%" colspan="3" style="border-right:0;text-align:right;font-size: 14px;padding: 5px">Invoice no: <?php echo $slip['bill_no'];?><br> Date : <?php echo date('d/m/Y');?></th>
            </tr>
            <tr >
            
                <th width="50%" colspan="3" style="border-right:0;text-align:left;font-size: 14px;padding: 5px"><b>Booked By : </b><?php echo strtoupper( User::info($grp['confirmed_by'],'name'));?></th>
            <th width="50%" colspan="3" style="border-right:0;text-align:right;font-size: 14px;padding: 5px"><b>Alloted to : <?php echo strtoupper( User::info($grp['user'],'name')) ."\t</b>(". User::info($grp['user'],'contact').")"; ?></th>
            </tr>
            </table>
            </td>
            </tr>
             <tr>
            <td>
            <table border="0" >
            <tr width="100%" style="border-top:1px solid;border-bottom:1px solid">
            <th style="text-align:center;border-right:1px solid;border-left:1px solid">Category</th>
            <th style="text-align:center;border-right:1px solid">Model</th>
            <th style="text-align:center;width:35%;border-right:1px solid">Particulars</th>
            <th style="text-align:center;border-right:1px solid">Extra Kms</th>
            <th style="text-align:center;border-right:1px solid">Extra Hrs</th>
            <th style="text-align:center;border-right:1px solid">Rate</th>
            <th style="text-align:center;border-right:1px solid">Amount</th>
            </tr>
            <tr>
                <td style="text-align:center;padding:5px" > <?php echo $cargroup['name'];  ?> </td>
                 <td  style="text-align:center;padding:5px"> <?php echo $car['name'];  ?> </td>
                 <td  style="text-align:left;padding:5px"> <b>Rental Type :</b> <?php echo $package_groupe_info['name']; ?><br><b>Package : </b> <?php echo $package_info['name']; ?></td>
                   <td  style="text-align:center;padding:5px"><br></td>
                    <td  style="text-align:center;padding:5px"><br></td>
                     <td  style="text-align:center;padding:5px"><br> <?php echo number_format($package_info['rate'],2) ; ?></td>
                      <td  style="text-align:center;padding:5px"><br><?php
                      /*
                       * Calculation for KM's
                       */
                      $totalkm=$slip['totalkm'];
                      $rate=$package_info['rate'];
                      $upto=($package_info['enable_upto']=='1')?$package_info['upto']:'0';
                      $extrakms=($package_info['enable_upto']=='1')?($upto-$totalkm):0;
                      $extrakms=($extrakms<0)? ($extrakms*-1):"";
                      $total_kms=$totalkm-$extrakms;
                      $amount=$total_kms*$rate;
                      $total_bill=$total_bill+$amount;
                      echo number_format($amount,2);
                      /*
                       * Calculation for Hr's
                       */
                      $totalhr=$slip['exact_totalhrs'];
                      $rate_hr=$package_info['rate_hr'];
                      $upto_hr=($package_info['enable_upto_hr']=='1')?$package_info['upto_hr']:'0';
                      $extrahrs=($package_info['enable_upto_hr']=='1')?($upto_hr-$totalhr):0;
                      $extrahrs=($extrahrs<0)? ($extrahrs*-1):"";
                      $total_hrs=$totalhr-$extrahrs;
                      $amounthrs=$total_hrs*$rate_hr;
                     ?></td>
                       
            </tr>
            <?php if ($package_info['services_count']>0) { ?>
             <tr>
                <td style='text-align:left;padding:5px'colspan='2' > </td>
                  <td  style='text-align:left;padding:5px'> <b>Services Charges</b></td>
                  <td  style='text-align:center;padding:5px'></td>
                  <td  style='text-align:center;padding:5px'></td>
                  <td  style='text-align:center;padding:5px'></td>
                  <td  style='text-align:center;padding:5px'></td>  
            </tr>
            
            <?php 
            $package_services=$Operator->get_package_service_details($package_info['package_id']);
            foreach ($package_services as $services)
            {
                $services_info=$Operator->getservicedetails($services['service_id']);
                echo "<tr>
                <td style='text-align:left;padding:5px'colspan='2' > </td>
                  <td  style='text-align:left;padding:5px'> <b>$services_info[name]</b></td>
                  <td  style='text-align:center;padding:5px'></td>
                  <td  style='text-align:center;padding:5px'></td>
                  <td  style='text-align:center;padding:5px'></td>
                  <td  style='text-align:center;padding:5px'>".number_format($services['rate'],2)."</td>  
            </tr>";
                 $total_bill=$total_bill+$services['rate'];
            }
            
            
            
            
            } ?>
            <tr>
                <td style="text-align:left;padding:5px"colspan="3" > <b>Duty Slip No :</b> <?php echo $slip['Dslip_no'];  ?> </td>
                
                   <td  style="text-align:center;padding:5px"><?php echo $extrakms?></td>
                   <td  style="text-align:center;padding:5px"></td>
                   <td  style="text-align:center;padding:5px"> <?php if($extrakms>0){ echo number_format($package_info['extra_km'],2) ;} ?></td>
                    
                     
                      <td  style="text-align:center;padding:5px"><?php if($extrakms>0){ $total=$extrakms*$package_info['extra_km']; echo number_format($total,2) ; $total_bill=$total_bill+$total; }?></td>
                       
            </tr>
            <tr>
                <td style="text-align:left;padding:5px;botder-top:0px"colspan="3" > <b>Duty Slip Date : </b> <?php echo date('d/m/Y',$slip['timestamp']);  ?> </td>
                
                   <td  style="text-align:center;padding:5px"></td>
                   <td  style="text-align:center;padding:5px"><?php echo $extrahrs?> </td>
                    <td  style="text-align:center;padding:5px"><?php if($extrahrs>0){ echo number_format($package_info['extra_hr'],2) ;} ?></td>
                     
                      <td  style="text-align:center;padding:5px"><?php if($extrahrs>0){ $total=$extrahrs*$package_info['extra_hr']; echo number_format($total,2) ;  $total_bill=$total_bill+$total;}?></td>
                       
            </tr>
            </tr>
            <tr>
                <td style="text-align:left;padding:5px;botder-top:0px"colspan="2" > <b>Total Kms : </b> <?php echo $slip['totalkm'];  ?> Km  <b>Total Hrs : </b> <?php echo $slip['totalhrs'];  ?>Hrs</td>
                
                   <td  style="text-align:center;padding:5px"><?php if($slip['other_allow']>0){echo "<b>Outstation Allowance<b>"; }?></td> 
                   <td  style="text-align:center;padding:5px"></td>
                   <td  style="text-align:center;padding:5px"> </td>
                    <td  style="text-align:center;padding:5px"></td>
                     
                      <td  style="text-align:center;padding:5px"><?php if($slip['other_allow']>0){ $total=$slip['extra_charge_hrs']*$package_info['rate']; echo number_format($slip['other_allow'],2) ; $total_bill=$total_bill+$slip['other_allow']; }?></td>
                       
            </tr>
            <tr>
                <td style="text-align:left;padding:5px;botder-top:0px"colspan="7" > <hr style="margin:0"></td>
                       
            </tr>
            <?php $admin = new Admin;
            $tax=$admin->get_tax_details();
            $taxcount=  count($tax);
            
            $service_tax=0;
            $total=0;
            foreach ($tax as $tax_info)
            {
                if($tax_info['status']=="1")
                {
                    if($tax_info['name']=='Service Tax')
                     {
                        $service_tax=$total_bill*($tax_info['rate']/100);
                        $total=$service_tax;
                     }
                     else
                     {
                         $total=$service_tax*($tax_info['rate']/100);
                     }
                    echo " <tr><td style='text-align:right;padding:5px;botder-top:0px'colspan='5' ><b>Add : </b>$tax_info[name] <b> @ $tax_info[rate]% </b></td>
                    <td  style='text-align:center;padding:5px'></td>
                     
                      <td  style='text-align:center;padding:5px'>";
                      echo number_format($total,2);
                    $total_bill=$total_bill+$total;
                    echo"</td>  
            </tr>";
                }
            }
            ?>
            <tr><td style='text-align:right;padding:5px;botder-top:0px'colspan='5' ><b>Parking/Toll/Taxes</b></td>
                    <td  style='text-align:center;padding:5px'></td>
                     
                    <td  style='text-align:center;padding:5px'><?php    echo number_format($slip['toll'],2);
                      
                    $total_bill=$total_bill+$slip['toll'];?>
                    </td>  
            </tr>
             <tr>
                <td style="text-align:left;padding:5px;botder-top:0px"colspan="7" > <hr style="margin:0"></td>
                       
            </tr>
            <tr>
                <td style="text-align:right;padding:5px;botder-top:0px"colspan="5" > <b>Grand Total</b> </td>
                 <td style="text-align:left;padding:5px;botder-top:0px" > </td>
                 <td style="text-align:left;padding:5px;botder-top:0px" > <?php echo $number=number_format(round($total_bill),2);?> </td>
            </tr>
            <tr>
                <td style="text-align:right;padding:5px;botder-top:0px"colspan="6" > <p class="text-capitalize"><b>In Words : <?php $number=  str_replace(',', '', $number);
                $string = ProcessForm::convert_number_to_words(round($total_bill));        echo "$string Only";?></b> </p> </td>
                 <td style="text-align:left;padding:5px;botder-top:0px" > </td>
                 
            </tr>
            <tr>
                <td style="text-align:left;padding:5px;botder-top:0px"colspan="7" > <hr style="margin:0"></td>
                       
            </tr>
             <tr>
                 <td style="text-align:left;padding:5px;botder-top:0px"colspan="7" > E & O.E    <span class="pull-right"><strong> TRANSWISE Car Rental Service </strong></span></td>
                       
            </tr>
            </table>
            </td>
            </tr>
            
            </table>
            
          </div>

          <div class="row">
              <div class=" col-sm-8">
            <strong>  Terms and Conditions:</strong>
            <ul>
                <li>Subjected to Jurisdiction.</li>
                <li>The responsibility of signed duty slip shall Rest with us until handed
Over.</li> <li>No Objections shall be entertained pertaining to this Invoice after 7 days                         
from the date hereof.</li>
                <li>Interest @18% Shall be charged if payment not confined within     Days from
the billing date drawn.</li>
            </ul>
            <b>
PAN No: AWYPG3948F<br>
C.E.S.T</b>	<b> A</b>ssessee <b>C</b>ode: <b>AWYPG3948FSD001</b>

          </div>
              <div class=" col-sm-4" ><br><br><br><br>
                  <span class="pull-right"><strong> Authorized Signatory</strong></span>
              </div>
          </div>





 <?php } ?>

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
    <script type="text/javascript">
    $(document).ready(function () {
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });
});</script>
  </body>
</html>

