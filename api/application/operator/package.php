<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

if (! Login::is_operator () && ! Login::is_admin ()) {
	Login::redirect ();
}

$groups = new Cars ();
$Operator = new Operator ();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="./favicon.ico">

<title>Manage Package - Operator panel</title>

      <?php include 'css.php';?><style type="text/css">
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

.service table,.service  th,.service  td {
	border: 1px solid #cdcdcd;
}

.input-group-btn select {
	border-color: #ccc;
	margin-top: 0px;
	margin-bottom: 0px;
	padding-top: 7px;
	padding-bottom: 7px;
}
</style>
</head>

<body>
	<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
		<div class="container">
         <?php include APPPATH.'menu.php';?>
      </div>
		<!-- /.container -->
	</div>
	<!-- /.navbar -->

	<div class="container">

		<div class="row row-offcanvas row-offcanvas-right">

			<div class="col-xs-6 col-sm-3 sidebar-offcanvas hidden-print"
				id="sidebar" role="navigation">
         <?php include'sidebar.php';?>
        </div>
			<!--/span-->
			<div class="col-xs-12 col-sm-9">
				<div class="page-header">
					<h1>
						Manage Package <small>Add , Modify or Delete Package</small>
					</h1>
					<p class="pull-right visible-xs">
						<button type="button" class="btn btn-primary btn-xs"
							data-toggle="offcanvas">Toggle nav</button>
					</p>
				</div>

				<div id="info">
            <?php
												if (isset ( $_POST ['addPackage'] )) {
													
													$Operator->getData ( $_POST );
													
													// echo "<pre>"; print_r($_POST); echo "</pre>";
													
													$page = $Operator->insert_package ();
													echo $page;
												}
												if (isset ( $_POST ['EditPackage'] )) {
													
													$Operator->getData ( $_POST );
													$page = $Operator->update_package ();
													echo $page;
												}
												if (isset ( $_POST ['delete'] )) {
													
													$Operator->getData ( $_POST );
													$page = $Operator->delete_package ();
													echo $page;
												}
												
												if (isset ( $_request ['delete'] )) {
													$data = $Operator->getpackagedetails ( $_request ['delete'] );
													?>

            <div class="bs-callout bs-callout-warning">
						You Realy want to delete package <b><?php echo "$data[name]";?></b>
						? <br>
						<p class='text-danger'>Note: You cannot retrive any package
							information once it is deleted.</p>
						<form class="form-inline" role="form"
							action='/operator/package?all ' method='post'
							id="<?php echo "$data[package_id]";?>">
							<input type="hidden" name='package_id'
								<?php echo "value=$data[package_id]";?>>
							<button type='submit' class='btn btn-danger yes' name="delete"
								id="<?php echo "$data[package_id]";?>">Yes</button>
							<a class="btn btn-default" href="./operator/groups" role="button"><span
								class="glyphicon glyphicon-remove"></span> No</a>
						</form>
					</div>
      <?php } ?>
          
          </div>

<?php

if (isset ( $_request ['add'] ) || isset ( $_request ['edit'] )) {
	$data = '';
	if (isset ( $_request ['edit'] )) {
		$data = $Operator->getpackagedetails ( $_request ['edit'] );
	}
	
	?>
<form class="form-horizontal" role="form" action="/operator/package?all"
					method="post">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Package ID</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="inputEmail3"
								name="package_id" placeholder="Package ID"
								<?php if(isset($_request['edit'])) { echo "value='$data[package_id]' readonly";  } else { echo "value=". ProcessForm::generate_id('transwise_package','pkg-')."";} ?>>
						</div>
					</div>
					<div class="form-group ">
						<label for="inputEmail3" class="col-sm-2 control-label">Package
							Group</label>
						<div class="col-sm-4">
							<select class="form-control" name='cat_id' required>
      <?php
	
	$datas = $Operator->getpackagegroupdetails ();
	foreach ( $datas as $value ) {
		
		echo "<option value='$value[cat_id]'>$value[name]</option>";
	}
	
	?>
  
  
</select>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Package
							Name</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="inputEmail3" required
								name="package" placeholder="Package Name"
								<?php if(isset($_request['edit'])) { echo "value='$data[name]'";  } ?>>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Applicable
							To</label>
						<div class="col-sm-5 form-inline">
							<div class="radio">
            
            <?php
	
	$applicable = '';
	$individual = "";
	$company = "";
	if (isset ( $_request ['edit'] )) {
		$applicable = $data ['applicable_to'];
		if ($applicable == '00') {
			$individual = 'checked';
			$company = 'checked';
		}
		if ($applicable == '01') {
			$individual = 'checked';
		}
		if ($applicable == '99') {
			$company = 'checked';
		}
	}
	?>
  <label> <input type="checkbox" name="Individual"
									<?php echo "$individual";?>> Individual
								</label>
							</div>
							<div class="radio">
								<label> <input type="checkbox" name="Company"
									<?php echo "$company";?>> Company
								</label>
							</div>
						</div>
					</div>
					<table class="other" width="100%">
						<tbody>
							<tr>
								<td colspan="2">
									<div class="row omb_row-sm-offset-3 omb_loginOr">
										<div class="col-xs-12 col-sm-12">
											<hr class="omb_hrOr">
											<span class="omb_spanOr">Select Vehicle Model </span>
										</div>

									</div>
								</td>
							</tr>
							<tr>
								<td width="50%">
									<div class="form-group ">
										<label for="inputEmail3" class="col-sm-5 control-label">Vehicle
											Model Group</label>
										<div class="col-sm-7">
											<select class="form-control group" name='car_group_id'
												required>
												<option value="x">Vehicle Model Group</option>
      <?php
	
	$datass = $groups->cargroups ();
	if (isset ( $_request ['edit'] )) {
		$details = $groups->get_cargroups_details ( $data ['car_group_id'] );
	}
	foreach ( $datass as $value ) {
		if (isset ( $details ['name'] ) && $value ['name'] == $details ['name']) {
			echo "<option value='$value[id]' selected>$value[name]</option>";
		} else {
			echo "<option value='$value[id]'>$value[name]</option>";
		}
	}
	
	?>
  
  
</select>
										</div>
									</div>
								</td>
								<td width="50%">
									<div class="driverinfo">
										<div class="form-group ">
											<label for="inputEmail3" class="col-sm-5 control-label">Vehicle
												Model </label>
											<div class="col-sm-7">
												<select class="form-control car" name="car_id[]"
													multiple="multiple" required>
													
	<?php
	if (isset ( $_request ['edit'] )) {
$groupinfo=new Cars;
		$carslist = $groupinfo->car_details ( '*', 'group_id', $data ['car_group_id'] );
		
		$mycars = explode ( "|", $data ['car_id'] );
		
		foreach ( $carslist as $value1 ) {
			if (in_array ( $value1['id'], $mycars )) {
				echo "<option value='$value1[id]' Selected>$value1[name]</option>";
			} else {
				echo "<option value='$value1[id]'>$value1[name]</option>";
			}
		}
	}
	?>
	  </select>
											</div>
										</div>
									</div>
								</td>
							</tr>

							<tr>
								<td colspan="2">
									<div class="row omb_row-sm-offset-3 omb_loginOr">
										<div class="col-xs-12 col-sm-12">
											<hr class="omb_hrOr">
											<span class="omb_spanOr">Primary Rates </span>
										</div>

									</div>
								</td>
							</tr>
							<tr>
								<td width="50%">
									<div class="form-group ">
										<label for="inputEmail3" class="col-sm-4 control-label">Rate
											KM : </label>
										<div class="col-sm-8 form-inline">

											<div class="input-group">
												<input class="form-control" type="text" name='rate'
													maxlength="10" placeholder="Rate Km" pattern="[0-9.]+"
													title="Numbers only"
													<?php if(isset($_request['edit'])) { echo "value='$data[rate]'";  } ?>>
												<span class="input-group-btn"> <select class="btn"
													name='rate_type'>
														<option value="Km" selected>Per Km</option>
												</select>
												</span>
											</div>


										</div>
									</div>
								</td>
								<td width="50%">
									<div class="form-group ">
										<label for="inputEmail3" class="col-sm-4 control-label"><input
											type="checkbox" name="enable_upto"
											<?php if(isset($_request['edit'])) { echo ($data['enable_upto']=='1')?'checked':'';  } ?>>
											Upto : </label>
										<div class="col-sm-8 form-inline">
											<div class="input-group">
												<input class="form-control" type="text" name='upto'
													maxlength="10" placeholder="Upto" pattern="[0-9.]+"
													title="Numbers only"
													<?php if(isset($_request['edit'])) { echo "value='$data[upto]'";  } ?>>
												<span class="input-group-btn"> <select class="btn"
													name='upto_type'>
														<option value="Km" selected>Km</option>
														<option value="Hr">Hr</option>
														<option value="Days">Days</option>
														<option value="Persons">Person</option>
												</select>
												</span>
											</div>

										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td width="50%">
									<div class="form-group ">
										<label for="inputEmail3" class="col-sm-4 control-label">Rate
											Hr : </label>
										<div class="col-sm-8 form-inline">

											<div class="input-group">
												<input class="form-control" type="text" name='rate_hr'
													maxlength="10" placeholder="Rate Hr" pattern="[0-9.]+"
													title="Numbers only"
													<?php if(isset($_request['edit'])) { echo "value='$data[rate_hr]'";  } ?>>
												<span class="input-group-btn"> <select class="btn"
													name='rate_type'>

														<option value="Hr" selected>Per Hr</option>

												</select>
												</span>
											</div>


										</div>
									</div>
								</td>
								<td width="50%">
									<div class="form-group ">
										<label for="inputEmail3" class="col-sm-4 control-label"><input
											type="checkbox" name="enable_upto_hr"
											<?php if(isset($_request['edit'])) { echo ($data['enable_upto_hr']=='1')?'checked':'';  } ?>>
											Upto : </label>
										<div class="col-sm-8 form-inline">
											<div class="input-group">
												<input class="form-control" type="text" name='upto_hr'
													maxlength="10" placeholder="Upto" pattern="[0-9.]+"
													title="Numbers only"
													<?php if(isset($_request['edit'])) { echo "value='$data[upto_hr]'";  } ?>>
												<span class="input-group-btn"> <select class="btn"
													name='upto_type'>

														<option value="Hr" selected>Hr</option>

												</select>
												</span>
											</div>

										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td width="50%">
									<div class="form-group ">
										<label for="inputEmail3" class="col-sm-4 control-label">Extra
											Rate KM: </label>
										<div class="col-sm-8 form-inline">


											<div class="input-group">
												<input class="form-control" type="text" name='extra_km'
													maxlength="10" placeholder="Extra Rate KM"
													pattern="[0-9.]+" title="Numbers only"
													<?php if(isset($_request['edit'])) { echo "value='$data[extra_km]'";  } ?>>
												<span class="input-group-btn"> <select class="btn"
													name='secondary_type'>
														<option value="Km" selected>Per Km</option>

												</select>
												</span>
											</div>
										</div>
									</div>
								</td>
								<td width="50%">
									<div class="form-group ">
										<label for="inputEmail3" class="col-sm-4 control-label">Extra
											Rate HR: </label>
										<div class="col-sm-8 form-inline">


											<div class="input-group">
												<input class="form-control" type="text" name='extra_hr'
													maxlength="10" placeholder="Extra Rate HR"
													pattern="[0-9.]+" title="Numbers only"
													<?php if(isset($_request['edit'])) { echo "value='$data[extra_hr]'";  } ?>>
												<span class="input-group-btn"> <select class="btn"
													name='secondary_type'>

														<option value="Hr" selected>Per Hr</option>

												</select>
												</span>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="row omb_row-sm-offset-3 omb_loginOr">
										<div class="col-xs-12 col-sm-12">
											<hr class="omb_hrOr">
											<span class="omb_spanOr">Services Select</span>
										</div>
										<input id="servicecount" name="servicecount" type="hidden"
											<?php if(isset($_request['edit'])) { echo "value='$data[services_count]'";  } else {      echo 'value="0"'; } ?>>
									</div>
								</td>
							</tr>
							<tr>
								<table class="service" width="100%" id="service"
									cellpadding="10" cellspacing="2">
									<thead>
										<tr>
											<th width="10%" style="text-align: center">
												<button type="button" id="anc_add" class="btn btn-default">
													<span class="glyphicon glyphicon-plus"></span>
												</button>
											</th>
											<th width="50%" style="text-align: center">Services</th>
											<th width="20%" style="text-align: center">Rate</th>
											<th width="20%" style="text-align: center">Per</th>
										</tr>
									</thead>
									<tbody>
       <?php
	
	if (isset ( $_request ['edit'] )) {
		if ($data ['services_count'] > 0) {
			$details = $Operator->get_package_service_details ( $data ['package_id'] );
			$i = 1;
			foreach ( $details as $value ) {
				echo '<tr>';
				$name = $Operator->getservicedetails ( $value ['service_id'] );
				$services = "<div class='col-sm-10'><select class='form-control' name='service_id$i' required>";
				$services .= "<option value='$value[service_id]'>$name[name]</option>";
				$services .= "</select></div>";
				$button = " <button type='button'  class='btn btn-default deleteIt'  id='$value[service_id]'title='Delete the Serivice' ><span class='glyphicon glyphicon-remove'></span></button>";
				$rate = "<div class='col-sm-12'><input type='text'  class='form-control' name=rate$i  maxlength='9' placeholder='Rate' value='$value[rate]'></div>";
				$type = "<div class='col-sm-12'> <select name='type$i'  class='form-control col-sm-1' id='exampleInputEmail2'><option value='Km' selected> Per Km</option><option value='Hr'> Per Hr</option><option value='Days'> Per Days</option><option value='Persons'> Per Person</option></select></div>";
				echo "<td style='text-align:center;padding:10px'></td><td style='text-align:center;padding:10px'>$services</td><td>$rate</td><td>$type</td>";
				echo '</tr>';
				$i ++;
			}
		}
	}
	?>
     </tbody>
								</table>


							</tr>
						</tbody>
					</table>
					<br>
					<div class="form-group">
						<label>Package Description</label>
						<textarea name="desc" cols='60' rows='10' tabindex="3"><?php if(isset($_request['edit'])) { echo $data['details'];  }?> </textarea>
					</div>

					<br>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
    <?php
	
	if (isset ( $_request ['edit'] )) {
		echo '<button type="submit" class="btn btn-warning" name="EditPackage">Update Package Details</button>';
	} else {
		echo '<button type="submit" class="btn btn-success" name="addPackage">Add Package </button>';
	}
	?>
      
    </div>
					</div>
				</form>

<?php
}

if (isset ( $_request ['all'] ) || isset ( $_request ['delete'] )) {
	?>


<div class="table-responsive">
					<table class="table">
						<thead>
							<th>Sr.</th>
							<th>Name</th>
							<th>Group</th>
							<th>Description</th>
							<th>Options</th>
						</thead>
						<tbody>
     <?php
	
	$data = $Operator->getpackagedetails ();
	
	$i = 1;
	foreach ( $data as $data ) {
		echo "<tr>";
		echo "<td>$i</td>";
		echo "<td>$data[name]</td>";
		$grp = $Operator->getpackagegroupdetails ( $data ['cat_id'] );
		echo "<td>$grp[name]</td>";
		echo "<td>$data[details]</td>";
		echo "<td><a href='/operator/package?edit=$data[package_id]'> <span class='glyphicon glyphicon-pencil text-success'></span>Edit</a> | <span class='glyphicon glyphicon-trash text-danger'></span> <a href='/operator/package?delete=$data[package_id]' >Delete</a> </td></td>";
		echo "</tr>";
		$i ++;
	}
	?>
   </tbody>
					</table>
					<a type="button" class="btn btn-success btn-lg"
						href="./operator/package?add"> <span
						class="glyphicon glyphicon-plus"></span> Add New Pacakge
					</a>
				</div>

<?php } ?>
        </div>
			<!--/span-->

		</div>
		<!--/row-->

		<hr>

		<footer>
			<p>&copy; Company 2014</p>
		</footer>

	</div>
	<!--/.container-->



	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="./assets/js/jquery.js"></script>
	<script src="./assets/js/bootstrap.min.js"></script>
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




 var cnt = 1;
  $("#anc_add").click(function(){
$("#servicecount").val(cnt);
var services="<div class='col-sm-10'><select class='form-control' name='service_id"+cnt+"' required>"<?php $datas=$Operator->getservicedetails();foreach ($datas as $value) { echo '+"';echo "<option value='$value[service_id]'>$value[name]</option>";echo '"+""';} ?>+"</select></div>";
  var rate="<div class='col-sm-12'><input type='text'  class='form-control' name=rate"+cnt+"  maxlength='9' placeholder='Rate'></div>";
  var type="<div class='col-sm-12'> <select name='type"+cnt+"'  class='form-control col-sm-1' id='exampleInputEmail2'><option value='Km' selected> Per Km</option><option value='Hr'> Per Hr</option><option value='Days'> Per Days</option><option value='Persons'> Per Person</option></select></div>";
  var button=" <button type='button'  class='btn btn-default btnDel' ><span class='glyphicon glyphicon-remove'></span></button>";

 $('#service tr').last().after('<tr style="padding:10px"><td style="text-align:center;padding:10px">'+button+'</td><td>'+services+'</td><td>'+rate+'</td><td>'+type+'</td></tr>');
 cnt++;

 });
 
$("body").on("click",".btnDel",function(){
if($('#service tr').size()>1){
$(this).parent().parent().remove();
$("#servicecount").val(($("#servicecount").val()-1));

}
 });

$(".group").change(function()
{
$("#main").hide();
$(".car").fadeTo(250, 0.33);
$(".group").attr("disabled", "disabled");
$(".car").attr("disabled", "disabled");
$(".itemoptions").html('');
$(".loader").show();
var id=$(this).val();
var dataString = 'group='+ id+'&groupinfo=1';
$.ajax
({
type: "POST",
url: "/api/api.groupinfo",
data: dataString,
cache: false,
dataType: 'json',
success: function(html)
{
$(".car").fadeTo(250,1);
$(".car").html(html.Cars);
$(".info").html(html.Data);
$(".loader").hide();
$(".car").removeAttr("disabled");
$(".group").removeAttr("disabled");
} 
});

});


});
  </script>

</body>
</html>

