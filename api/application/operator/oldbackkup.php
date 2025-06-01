http://www.redbus.in/PrintControlPagert.aspx?
onwardTIN=gtxfDjIG57EHpjTIfQbN8A%3d%3d&
returnTIN=&
enctId=GN8m8GXXdOrb4E2MikbfQud068TN32hnVL9LoJzKwVQTaNbGHwUeDB4aGxClEmqzsTAeA4ltZeCBuIKiy0JQGDt0OltI1y%2fM0ugjp4vas4JZfdFOnAGu3w%3d%3d&
tcCode=G


<div class="row form-inline">
  <div class="col-xs-4 form-group">
    <label class="control-label" >Manual Slip No.</label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['Mslip_no'];?>;</span>
  </div>
  <div class="col-xs-4 form-group">
  <label class="control-label" >Duty Slip No.</label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['Dslip_no'];?></span>
  </div>
  <div class="col-xs-4 form-group">
  <label class="control-label" >Duty Slip date : </label>
    <span class="" style="width:50px;height:40px"><?php echo date("d/m/Y",$slip['timestamp']);  ?></span>
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Booking No. : </label>
    <span class="" style="width:50px;height:40px"><b><?php echo $slip['booking_id'];?></b></span>
  </div>
  <div class="col-xs-6 form-group">
  <label class="control-label" >Bill No. : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['bill_no'];?></span>
  </div>
</div>

<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Custmer : </label>
    <span class="" style="width:50px;height:40px"><?php echo User::info($grp['user'],'name');  ?></span>
  </div>
  <div class="col-xs-6 form-group">
  <label class="control-label" >Category : </label>
    <span class="" style="width:50px;height:40px"><?php echo $cargroup['name'];  ?></span>
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Tariff : </label>
    <span class="" style="width:50px;height:40px"><?php echo $car['amount'];  ?></span>
  </div>
  <div class="col-xs-6 form-group">
  <label class="control-label" >Car Name : </label>
    <span class="" style="width:50px;height:40px"><?php echo $car['name'];  ?></span>
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Car Number : </label>
    <span class="" style="width:50px;height:40px"><?php echo $car['Reg_num'];  ?></span>
  </div>
  <div class="col-xs-6 form-group">
  <label class="control-label" >Used by : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['used_by'];?></span>
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Driver Name : </label>
    <span class="box" style="width:50px;height:40px"><?php echo User::driverInfo($grp['driver_id'],'name');  ?></span>
  </div>
  <div class="col-xs-6 form-group">
  <label class="control-label" >Booked by : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['booked_by'];?></span>
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-4 form-group">
    <label class="control-label" >Open Kms : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['open_km'];?></span>
  </div>
  <div class="col-xs-4 form-group">
  <label class="control-label" >Time From </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['time_from'];?></span>
  </div>
  <div class="col-xs-4 form-group">
  <label class="control-label" >Date From: </label>
    <span class="box" style="width:50px;height:40px"><?php echo date("d/m/Y",$slip['date_from']); ?></span>
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-4 form-group">
    <label class="control-label" >Close Kms : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['close_km'];?></span>
  </div>
  <div class="col-xs-4 form-group">
  <label class="control-label" >Time to </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['time_to'];?></span>
  </div>
  <div class="col-xs-4 form-group">
  <label class="control-label" >Date to: </label>
    <span class="box" style="width:50px;height:40px"><?php echo date("d/m/Y",$slip['date_to']);?></span>
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Total Kms : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['totalkm'];?></span>
  </div>
  <div class="col-xs-3 form-group">
  <label class="control-label" >Total hrs : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['totalhrs'];?></span>
  </div>
  <div class="col-xs-3 form-group">
  
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Min. Chg. Kms : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['min_charge_km'];?></span>
  </div>
  <div class="col-xs-6 form-group">
  <label class="control-label" >Min. Chg. Hrs : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['min_charge_hrs'];?></span>
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Extra Chg. Kms : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['extra_charge_km'];?></span>
  </div>
  <div class="col-xs-6 form-group">
  <label class="control-label" >Extra Chg. Hrs : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['extra_charge_hrs'];?></span>
  </div>
  
</div>

<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Night stay : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['night_stay'];?></span>
  </div>
  <div class="col-xs-6 form-group">
  <label class="control-label" >Day Stay : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['day_stay'];?></span>
  </div>
  
</div>

<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Meal Allowance : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['meal_allow'];?></span>
  </div>
  <div class="col-xs-6 form-group">
  <label class="control-label" >Parking Charges : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['parking'];?></span>
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Other St. Taxes : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['other_st_charges'];?></span>
  </div>
  <div class="col-xs-6 form-group">
  <label class="control-label" >Fuel Charges : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['fuel_charges'];?></span>
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Handling Charges : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['handling_charges'];?></span>
  </div>
  <div class="col-xs-6 form-group">
  <label class="control-label" >Misc. Charges : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['misc_charges'];?></span>
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Permit Charge : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['permit_charge'];?></span>
  </div>
  <div class="col-xs-6 form-group">
  <label class="control-label" >Guide Charges : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['guide_charge'];?></span>
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Driver Allowance : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['driver_allow'];?></span>
  </div>
  <div class="col-xs-6 form-group">
  <label class="control-label" >Department : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['dept'];?></span>
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Pick Up From : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['pick_from'];?></span>
  </div>
  <div class="col-xs-6 form-group">
  <label class="control-label" >Drop To : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['drop_to'];?></span>
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-6 form-group">
    <label class="control-label" >Token No. : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['token_no'];?></span>
  </div>
  <div class="col-xs-6 form-group">
  <label class="control-label" >Slip Amount : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['slip_amount'];?></span>
  </div>
</div>
<div class="row form-inline">
  <div class="col-xs-12 form-group">
    <label class="control-label" >Vehicle Type: </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['vehicle_type'];?></span>
  </div>
 
</div>

<div class="row form-inline">
  <div class="col-xs-12 form-group">
    <label class="control-label" >Bill Type : </label>
    <span class="box" style="width:50px;height:40px"><?php echo $slip['bill_type'];?></span>
  </div>
  
</div>

