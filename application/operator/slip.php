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
    <link rel="shortcut icon" href="/favicon.ico">

    <title>DutySlip details - Operator panel</title>

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
         <div class="page-header hidden-print ">
          <h3>Duty Slip <?php if(isset($_request['slip'])){ echo '<small><a type="button" class="btn btn-default  hidden-print" onclick="window.print()"><span class="glyphicon glyphicon-print" ></span> Print</a></small>';}else{echo "<small>Add duty slip details</small>";}?><p class="pull-right visible-xs hidden-print">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p> </h3>
          </h1>
          </div>
          <div id="info">
            <?php if(isset($_POST['dutySlip']))
            {
              
              $Operator->getData($_POST);
              $page=$Operator->InsertDutySlip();
              echo $page;
            }
            ?>
          </div>
         <?php if(isset($_request['id'])){ 

           $booking=new Bookings;
           $groups=new Cars;
           $grp=$booking->booking($_request['id']);
           $car=$groups->get_car_details($grp['car']);
           $cargroup=$groups->get_cargroups_details($car['group_id']);
      ?>
      <form role="form" action="?new" method="post">
          <div class="row form-inline">
              <div class="col-sm-6 form-group">
    <label class=" col-sm-5 control-label" >Manual Slip No.</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" pattern="\d{0,}" title="Numbers only" tabindex="1" name="Mslip_no" placeholder="Manual Slip No." required>
    </div>
  </div>
              
          </div>
          <br>
      <div class="row form-inline">
  
  <div class="col-sm-6 form-group">
  <label class="col-sm-5 control-label" >Duty Slip No.</label>
   <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="2" name="Dslip_no" placeholder="Duty Slip No." value="<?php echo ProcessForm::generate_id('transwise_duty_slip','DS-');?>" readonly>
    </div>
  </div>
  <div class="col-sm-6 form-group">
  <label class=" col-sm-5 control-label" >Duty Slip date : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="3" name="duty_slip_date" placeholder="Duty Slip date" value="<?php echo date('d/m/Y');?>" readonly>
    </div>
  </div>
</div>
<br>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class=" col-sm-5 control-label" >Booking No. : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="4" name="booking_id" placeholder="Booking No." value="<?php echo $grp['booking_id'];?>" readonly>
    </div>
  </div>
  <div class="col-xs-6 form-group">
  <label class=" col-sm-5 control-label" >Bill No. : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  title="Numbers only" tabindex="5" name="bill_no" placeholder="Bill No." value="<?php echo ProcessForm::generate_id('transwise_invoice','invoice-');?>" readonly>
    </div>
  </div>
</div>
<br>

<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class=" col-sm-5 control-label" >Customer : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="6" name="customer" placeholder="Customer" value="<?php echo User::info($grp['user'],'name'); ?>" readonly>
    </div>
   
  </div>
  <div class="col-xs-6 form-group">
  <label class=" col-sm-5 control-label" >Category : </label>
   <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="7" name="category" placeholder="Category" value="<?php echo $cargroup['name']; ?>" readonly>
    </div>
  </div>
</div>
<br>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class=" col-sm-5 control-label" >Tariff : </label>
     <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="8" name="teriff" placeholder="tariff" value="<?php echo $car['amount']; ?>" required>
    </div>
  </div>
  <div class="col-xs-6 form-group">
  <label class=" col-sm-5 control-label" >Vehicle Model : </label>
   <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="9" name="car" placeholder="Vehicle Model" value="<?php echo $car['name']; ?>" readonly>
    </div>
  </div>
</div>
<br>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class=" col-sm-5 control-label" >Vehicle No. : </label>
     <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="10" name="reg" placeholder="Vehicle No." value="<?php echo $car['Reg_num']; ?>" readonly>
    </div>
  </div>
  <div class="col-xs-6 form-group">
  <label class=" col-sm-5 control-label" >Used by : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="11" name="used_by" placeholder="Used by" required>
    </div>
  </div>
</div>
<br>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class=" col-sm-5 control-label" >Chauffeur Name : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="12" name="driver" placeholder="Chauffeur Name" value="<?php echo User::driverInfo($grp['driver_id'],'name'); ?>" readonly>
    </div>
    
  </div>
  <div class="col-xs-6 form-group">
  <label class=" col-sm-5 control-label" >Booked by : </label>
     <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="13" name="booked_by" placeholder="Booked by" value="<?php echo strtoupper( User::info($grp['confirmed_by'],'name'));?>">
    </div>
  </div>
</div>
<br>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class=" col-sm-5 control-label" >Open Kms: </label>
    <div class="col-sm-7">
      <input type="text" class="form-control" pattern="[0-9.]+" title="Numbers only" tabindex="14" name="open_km" id="open" placeholder="Open Kms" required>
    </div>
  </div>
    <div class="col-xs-6 form-group">
    <label class=" col-sm-5 control-label" >Close Kms: </label>
    <div class="col-sm-7">
      <input type="text" class="form-control" pattern="[0-9.]+" title="Numbers only" tabindex="17" name="close_km"   id="close"  placeholder="Close Kms" required>
    </div>
  </div>
  

 
</div>
  <br>
<div class="row form-inline">
  
 <div class="col-xs-6 form-group">
  <label class=" col-sm-5 control-label" >Date From: </label>
  <div class="col-sm-7">
      <input type="text" class="form-control datefrom"  tabindex="16" name="date_from" placeholder="Booking No." value="<?php echo  date("d/m/Y",$grp['from_date']); ?>" readonly>
    </div>
  </div>
  <div class="col-xs-6 form-group">
  <label class=" col-sm-5 control-label" >Date to : </label>

     <div class="col-sm-7">
    <div class='input-group date ' id='fromdate' data-date-format="YYYY/MM/DD">
                    <input type='text' autocomplete="off" tabindex="19" name="date_to" class="form-control dateto " onchange="calculatedate()" placeholder="dd/mm/yyyy" required/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
     </div>
  </div>
</div>
  <br>
  <div class="row form-inline">
 <div class="col-xs-6 form-group">
  <label class=" col-sm-5 control-label" >Time From </label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  id="time_from" tabindex="15" name="time_from" placeholder="Time From" required value="<?php echo $grp['pick_up_time']; ?>" readonly>
    </div>
  </div>
      
  <div class="col-xs-6 form-group">
  <label class=" col-sm-5 control-label" >Time to : </label>
    <div class="col-sm-7">
      <div class="form-inline">
          <input type="hidden" name="exact_totalhrs" id="exact_totalhrs" value="0">
  <select name="time_to_hrs" id="time_to_hrs" class="form-control col-sm-1" onchange="calculatedate()" > 
  <option value="01" selected>01</option>
  <option value="02">02</option>
  <option value="03">03</option>
  <option value="04">04</option>
  <option value="05">05</option>
  <option value="06">06</option>
  <option value="07">07</option>
  <option value="08">08</option>
  <option value="09">09</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  </select>

  <select name="time_to_min" id="time_to_min"  class="form-control col-sm-1" onchange="calculatedate()" > 
  <option value="00" selected>00</option>
  <option value="05">05</option>
  <option value="10">10</option>
  <option value="15">15</option>
  <option value="20">20</option>
  <option value="25">25</option>
  <option value="30">30</option>
  <option value="35">35</option>
  <option value="40">40</option>
  <option value="45">45</option>
  <option value="50">50</option>
  <option value="55">55</option>
  
  </select>
  <select name="time_to_type"  id="time_to_type" class="form-control col-sm-1" onchange="calculatedate()" > 
  <option value="AM" selected>AM</option>
  <option value="PM">PM</option>
  </select>
</div>
    </div>
  </div>
  </div>
<br>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class=" col-sm-5 control-label" >Total Kms : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control disable " pattern="[0-9.]+" title="Numbers only" tabindex="20" name="totalkm"  id="totalkm" placeholder="Total Kms" value="0" >
    </div>
  </div>
  <div class="col-xs-6 form-group">
  <label class=" col-sm-5 control-label" >Total hrs : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control" pattern="[0-9.:]+" title="Numbers only" tabindex="21" name="totalhrs" id="totalhrs" placeholder="Total hrs" value="0" >
    </div>
  </div>
</div>
<br>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class=" col-sm-5 control-label" >Min. Chg. Kms : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control" pattern="[0-9.]+" title="Numbers only" tabindex="22" name="min_charge_km" placeholder="Min. Chg. Kms" required>
    </div>
  </div>
  <div class="col-xs-6 form-group">
  <label class=" col-sm-5 control-label" >Min. Chg. Hrs : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control" pattern="[0-9.]+" title="Numbers only" tabindex="23" name="min_charge_hrs" placeholder="Min. Chg. Hrs" required>
    </div>
  </div>
</div>
<br>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class=" col-sm-5 control-label" >Extra Chg. Kms : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control" pattern="[0-9.]+" title="Numbers only" tabindex="24" name="extra_charge_km" placeholder="Extra Chg. kms" required>
    </div>
  </div>
  <div class="col-xs-6 form-group">
  <label class=" col-sm-5 control-label" >Extra Chg. Hrs : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control" pattern="[0-9.]+" tabindex="25" name="extra_charge_hrs" placeholder="Extra Chg. Hrs" required>
    </div>
  </div>
  
</div>
<br>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class=" col-sm-5 control-label" >Toll + Parking + Taxes : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control" pattern="[0-9.]+" title="Numbers only" tabindex="26" name="toll" placeholder="Toll + Parking + Taxes" required>
    </div>
  </div>  
    <div class="col-xs-6 form-group">
    <label class=" col-sm-5 control-label" >Other Allowance : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control" pattern="[0-9.]+" title="Numbers only" tabindex="28" name="other_allow" placeholder=".00" required>
    </div>
  </div>
</div>

<br>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class=" col-sm-5 control-label" >Rental Type: </label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="38" name="package_name" placeholder="Rental Type" required>
    </div>
  </div>
  <div class="col-xs-6 form-group">
  
</div>
</div>
<br>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class=" col-sm-5 control-label" >Pick Up From : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="38" name="pick_from" placeholder="Pick Up From" required>
    </div>
  </div>
  <div class="col-xs-6 form-group">
  <label class=" col-sm-5 control-label" >Drop To : </label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="39" name="drop_to" placeholder="Drop To" required>
    </div>
  </div>
</div>

<br>

<div class="row form-inline">
  <div class="col-xs-12 form-group">
    <label class=" col-sm-2 control-label" >Vehicle Type: </label>
    <input type="radio" name="vehicle_type" tabindex="42" value="Own Vehicle" required> Own Vehicle <input type="radio" tabindex="43" name="vehicle_type"  value="Hired Vehicle" required> Hired Vehicle
  </div>
 
</div>
<br>
<div class="row form-inline">
  <div class="col-xs-12 form-group">
    <label class=" col-sm-2 control-label" >Bill Type : </label>
    <input type="radio" name="bill_type" tabindex="44" value="To Be Billed" required> To Be Billed <input type="radio" name="bill_type" tabindex="45" value="Complimentary" required> Complimentary <input type="radio" name="bill_type" tabindex="46" value="Billed" required> Billed <input type="radio" name="bill_type" tabindex="47" value="Canceled" required> Canceled <input type="radio" name="bill_type" tabindex="48" value="Inter Branch" required> Inter Branch <input type="radio" name="bill_type" tabindex="49" value="Monthly" required> Monthly
  </div>
  
</div>
<br>
<hr>
<button type="submit"  tabindex="50"  name ="dutySlip" class="btn btn-primary btn-lg btn-block">Enter Duty Slip</button>

</form>




    <?php }  elseif(isset($_request['all'])||isset($_request['new'])) {?>
        
  <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>User Name</th>
           <th>Vehicle</th>
           <th>Booking Date</th>
          <th>From</th>
          <th>To</th>
          <th>Status</th>
          <th>Duty Slip</th>
        
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
        echo "<td style='text-align:center'><a href='/operator/invoice?slip=$value[Dslip_no]' title='View Duty Slip Details' class=' print btn btn-default btn-sm' >
  <span class='glyphicon glyphicon-list-alt 'style='color:#088A08' ></span></a> 
</button>
</td></td>";
        
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
     
     }
    elseif(isset($_request['new']))
    {
       $grp=$booking->getConfirmed();
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
        echo "<td style='text-align:center'><a href='/operator/slip?id=$data[booking_id]' title='Add Duty Slip Details' class=' print btn btn-default btn-sm' >
  <span class='glyphicon glyphicon-plus 'style='color:#088A08' ></span></a> 
</button>
</td></td>";
        
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
    }
     

      ?>
      
        
      


      </tbody>
    </table>
   
<?php } ?>



<?php if(isset($_request['slip'])){  

           $slip=$Operator->getDutySlipDetails($_request['slip']);
           $booking=new Bookings;
           $groups=new Cars;
           $grp=$booking->booking($slip['booking_id']);
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
            <th width="33%" style="border-right:2px;padding-left:5px">Booking No. : <?php echo $slip['booking_id'];?> </th>
            <th width="33%"  style="border-right:0;text-align:center">Duty Slip No. : <?php echo $slip['Dslip_no'];?></th>
            <th width="33% " style="border-right:0;text-align:right;padding-right:5px">Date : <?php echo date("d/m/Y",$slip['timestamp']);?></th>
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
            <td style="padding-left:5px;height:50%" ><b>Reporting Address:</b> <?php echo User::info($grp['user'],'address');?> <br> <br> </td>
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
                  <b>Reporting Time : </b>  <?php echo $slip['totalkm'];?>
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
                  <b>Start Time : </b> <?php echo $slip['time_from'];?>
                </td>
              </tr>
              <tr>
                <td style="padding:5px">
                  <b>Close Time : </b> <?php echo $slip['time_to'];?>
                </td>
              </tr>
              <tr>
                <td style="padding:5px">
                  <b>Total Hrs : </b>  <?php echo $slip['totalhrs'];?> Hrs
                </td>
              </tr>
              <tr>
                <td style="padding:5px">
                  <b>Extra Hrs : </b> <?php echo $slip['extra_charge_hrs'];?>
                </td>
              </tr>
            </table>
            </td>
            <td width="17% " style="text-align:left;">
              
              <table border="0" >
              <tr>
                <td style="padding:5px">
                  <b>Start Kms : </b> <?php echo $slip['open_km'];?>
                </td>
              </tr>
              <tr>
                <td style="padding:5px">
                  <b>Close Kms : </b> <?php echo $slip['close_km'];?>
                </td>
              </tr>
              <tr>
                <td style="padding:5px">
                  <b>Total Kms : </b> <?php echo $slip['totalkm'];?>
                </td>
              </tr>
              <tr>
                <td style="padding:5px">
                  <b>Extra Kms : </b> <?php echo $slip['extra_charge_km'];?>
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
                  <td width="30%" style="text-align:right;padding-right:5px">
                   Toll + Parking + Taxes : Rs. <?php echo $slip['toll'];?> /- <br>
                   Closing Date : <?php echo date( 'd/m/Y',$slip['date_to']);?>
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
                   <b>Place : </b><?php echo $slip['drop_to'];?>
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
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets//js/bootstrap.min.js"></script>
   <script src="/assets/js/docs.min.js"></script>
    <script src="/assets/js/bootstrap-datepicker.js"></script>
    <script>
          
           $(document).ready(function () {
            
                $('.date').datepicker({
                    format: "dd/mm/yyyy",
                   
                     todayBtn: "linked",
                     autoclose: true,
                    pickTime: false

                }); 

$('#open').on('keyup',function(){
  var open=$('#open').val();
  var close=$('#close').val();
  var total=close-open;
  if(total>0)
  $('#totalkm').val(total);
  else
   $('#totalkm').val("0");
});
$('#close').on('keyup',function(){

  var total=$('#close').val()-$('#open').val();
  if(total>0)
  $('#totalkm').val(total);
  else
   $('#totalkm').val("0");
});

  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });
  

  <?php if(isset($_request['print'])) echo "window.print();";?>
});
           function prints(){
          child = window.open('http://localhost/','Home', 'width=600, height=500');
           window.focus();
           
         }
           function calculatedate(){

        var myDate=$('.datefrom').val();
        var fromtime=$('#time_from').val();
    var hrmin = fromtime.split(" ");
       var hm= hrmin[0].split(":");
        if(hrmin[1]=="PM")
        {
         hm[0]=parseInt(hm[0],10)+12;   
        }
            myDate=myDate.split("/");
           var from = new Date(parseInt(myDate[2], 10), parseInt(myDate[1], 10) - 1 , parseInt(myDate[0]), hm[0],hm[1]);

var time_to_hr=parseInt($('#time_to_hrs option:selected').val(),10);
var time_to_min=$('#time_to_min option:selected').val();
var time_to_type=$('#time_to_type option:selected').val();
if(time_to_type=="PM"){time_to_hr=time_to_hr+12; }

        var urDate=$('.dateto').val();
            urDate=urDate.split("/");
           var to = new Date(parseInt(urDate[2], 10), parseInt(urDate[1], 10) - 1 , parseInt(urDate[0]), time_to_hr,time_to_min);
var hours =Math.abs(to - from) / 36e5;

 var diff = to - from;

    var diffSeconds = diff/1000;
    var HH = Math.floor(diffSeconds/3600);
    var MM = Math.floor(diffSeconds%3600)/60;

    var formatted = ((HH < 10)?("0" + HH):HH) + ":" + ((MM < 10)?("0" + MM):MM)
  //
  $('#exact_totalhrs').val(hours.toFixed(2));
  $('#totalhrs').val(formatted);


}
  </script>
  </body>
</html>

