<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!Login::is_operator()&&!Login::is_admin())
{
  Login::redirect();
}

$groups=new Cars;
$Operator=new Operator;
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/favicon.ico">

    <title>DutySlip details - Operator panel</title>

      <?php include 'css.php';?>
      <style type="text/css">
body {padding:0;padding-top: 5px; line-height: 1.3;}
@media print {
  body{padding: 0; margin:0;}
  input[type="text"] {
    width: 50px;}
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
       <div class="container">

      <div class="row">
        <div class="col-xs-12 col-sm-12">
         <div class="page-header hidden-print">
          <h3>Duty Slip <small><a type="button" class="btn btn-default  hidden-print" onclick="window.print()"><span class='glyphicon glyphicon-print '></span> Print</a></small> </h3>
          </h1>
          </div>
          <p class="pull-right visible-xs hidden-print">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
         <?php if(isset($_request['id'])){ 

           $booking=new Bookings;
           $groups=new Cars;
           $grp=$booking->booking($_request['id']);
           $car=$groups->get_car_details($grp['car']);
           $cargroup=$groups->get_cargroups_details($car['group_id']);
      ?>
    <div class="row" style="font-size:12px;font-family:Calibri">
            
            <span style="font-size:16px"><?php echo Company::getdetails('addressline');  ?></span>
            <hr>
            <table  cellpadding="6" >
            <tr style="border:1px solid" >
            <td>
            <table border="0" cellpadding="6">
            <tr >
            <th width="33%" style="border-right:2px;padding-left:5px">Booking No. : <?php echo $grp['booking_id'];?> </th>
            <th width="33%"  style="border-right:0;text-align:center">Duty Slip No. : <?php echo "DS-".$grp['booking_id'];?></th>
            <th width="33% " style="border-right:0;text-align:right;padding-right:5px">Date : <?php echo date("d/m/Y",time());?></th>
            </tr>
            </table>
            </td>
            </tr>
            <tr>
            <td>
            <table border="0" cellpadding="6">
            <tr style="border:1px solid;border-top:0px">
            <td width="50%" style="border-right:2px;padding-left:5px"><b>Alloted to : <?php echo strtoupper( User::info($grp['user'],'name')) ."\t</b>(". User::info($grp['user'],'contact').")"; ?> </td>
            
            <td width="50% " style="border-right:0;text-align:right;padding-right:5px"><b>Booked By : </b><?php echo strtoupper( User::info($grp['confirmed_by'],'name'));?></td>
            </tr>
            </table>
            </td>
            </tr>
            <tr >
            <td valign="center">
            <table border="0" >
            <tr style="border:1px solid;border-top:0px">
            <td width="40%" style="border-right:1px solid;">
            <table border="0" >
            <tr  style="border-bottom:1px solid;border-top:0px" >
            <td style="padding-left:5px;height50%" ><b>Reporting Address:</b> <?php echo User::info($grp['user'],'address');?> <br> <br> </td>
            </tr>
             <tr >
            <td style="padding-left:5px" ><b>Vehical Category : </b><?php echo $cargroup['name'];  ?> <br> <b>Model : </b><?php echo $car['name'];  ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Mode of Payment : </b></td>
            </tr>
            </table>

             </td>
            <td width="26%" style="border-right:1px solid;">
            <table border="0" >
              <tr>
                <td style="padding:5px" >
                  <b>Vehicle No : </b> <?php echo $car['Reg_num'];  ?>
                </td>
              </tr>
              <tr>
                <td style="padding:5px">
                  <b>Chauffeur Name : </b> <?php echo User::driverInfo($grp['driver_id'],'name');  ?>
                </td>
              </tr>
              <tr>
                <td style="padding:5px">
                  <b>Reporting Time : </b>  
                </td>
              </tr>
              <tr>
                <td style="padding:5px">
                  <b>Rental Type : </b> 
                </td>
              </tr>
            </table>
            </td>
            <td width="17%" style="border-right:1px solid;"> 
            <table border="0" >
              <tr>
                <td style="padding:5px">
                  <b>Start Time : </b> 
                </td>
              </tr>
              <tr>
                <td style="padding:5px">
                  <b>Close Time : </b> 
                </td>
              </tr>
              <tr>
                <td style="padding:5px">
                  <b>Total Hrs : </b>  
                </td>
              </tr>
              <tr>
                <td style="padding:5px">
                  <b>Extra Hrs : </b> 
                </td>
              </tr>
            </table>
            </td>
            <td width="17% " style="text-align:left;">
              
              <table border="0" >
              <tr>
                <td style="padding:5px">
                  <b>Start Kms : </b> 
                </td>
              </tr>
              <tr>
                <td style="padding:5px">
                  <b>Close Kms : </b> 
                </td>
              </tr>
              <tr>
                <td style="padding:5px">
                  <b>Total Kms : </b> 
                </td>
              </tr>
              <tr>
                <td style="padding:5px">
                  <b>Extra Kms : </b> 
                </td>
              </tr>
            </table>
            </td>
            
            </tr>
            </table>
            </td>
            </tr>
            <tr style="border:1px solid;border-top:0px">
            <td style="text-align:center">
             <table border="0">
               <tr>
                 <td width="70%" style="text-align:left;padding-left:5px" >
                   <b>INSTRUCTIONS : </b>
                 </td>
                  <td width="30%" style="text-align:right">
                   Toll + Parking + Taxes : &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<br>
                   Closing Date : &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                 </td>
               </tr>
             </table>
            </td>
            </tr>
            <tr style="border:1px solid;border-top:0px">
            <td style="text-align:center">
             <b> Following To Be Filled By The Guest</b>
            </td>
            </tr>
            <tr style="border:1px solid;border-top:0px">
            <td style="text-align:center">
             <table border="0">
               <tr>
                 <td width="36%" style="text-align:left;padding-left:5px">
                   <b>Reporting Time : </b><br>
                   <b>Reporting Kms : </b>
                 </td>
                 <td width="36%" style="text-align:left;padding-left:5px">
                   <b>Releasing Time : </b><br>
                   <b>Releasing Kms : </b>
                 </td>
                 <td width="25%" style="text-align:left;padding-left:5px">
                   <b> </b><br>
                   <b>Place : </b>
                 </td>
                  
               </tr>
             </table>
            </td>
            </tr>
             <tr style="border:1px solid;border-top:0px">
            <td style="text-align:center">
             <table border="0">
               <tr>
                 <td width="50%" style="text-align:left;padding-left:5px;border-right:1px solid" >
                   <b>FEEDBACK : </b><br><br><br>
                   <b>FUTURE Requirement : </b><br>
                 </td>
                  <td width="50%" style="text-align:left;padding-left:5px;padding-right:5px;">
                   Hereby I agree and concur above details,Also accept terms and conditions of payment associated responsibly.<br><br><br>
                   <span class="pull-right"><b>Guest Signature</b></span>
                 </td>
               </tr>
             </table>
            </td>
            </tr>
            <tr><td style="text-align:center;font-size:14px"><b> Thank You <br> We Look Forward To Serve You Again</b></td></tr>
            </table>

          </div>








    <?php } ?>
        
      

    </div>
     



        </div><!--/span-->

      </div><!--/row-->


    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets//js/bootstrap.min.js"></script>
    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
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

  <?php if(isset($_request['print'])) echo "window.print();";?>
});
           function prints(){
          child = window.open('http://localhost/','Home', 'width=600, height=500');
           window.focus();
           
         }
           
  </script>
  </body>
</html>

