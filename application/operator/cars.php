<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

if (! Login::is_operator () && ! Login::is_admin ()) {
	Login::redirect ();
}

$groups = new Cars ();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="/favicon.ico">

<title>Manage Car - Operator panel</title>

<!-- Bootstrap core CSS -->
    <?php include 'css.php';?>
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

			<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar"
				role="navigation">
         <?php include'sidebar.php';?>
        </div>
			<!--/span-->
			<div class="col-xs-12 col-sm-9">
				<div class="page-header">
					<h1>
						Manage Cars<small> Modify car information.</small>
					</h1>
				</div>
				<p class="pull-right visible-xs">
					<button type="button" class="btn btn-primary btn-xs"
						data-toggle="offcanvas">Toggle nav</button>
				</p>
				<div id="info">
            <?php echo("<script>alert('updating car info');</script>");
												if (isset ( $_POST ['addgroup'] )) {
													
													$groups->getData ( $_POST );
													$page = $groups->insert_car_group ();
													echo $page;
												}
												if (isset ( $_POST ['updatecar'] )) {
													echo("<script>alert('updating car info');</script>");
													$groups->getData ( $_POST );
													$page = $groups->updateCar ( $_POST ['id'] );
													echo $page;
												}
												if (isset ( $_POST ['delete'] )) {
													
													$groups->getData ( $_POST );
													$page = $groups->deletecar ( $_POST ['id'] );
													echo $page;
												}
												
												if (isset ( $_request ['delete'] )) {
													$data = $groups->get_cargroups_details ( $_request ['delete'] );
													?>

            <div class="bs-callout bs-callout-warning">
      You Realy want to delete car <?php echo "$data[name]";?> ? <br>
						<p class='text-danger'>Note: You cannot retrive any car
							information once it is deleted.</p>
						<form class="form-inline" role="form" action='/operator/groups '
							method='post' id="<?php echo "$data[id]";?>">
							<input type="hidden" name='id' <?php echo "value=$data[id]";?>>
							<button type='submit' class='btn btn-danger yes' name="delete"
								id="<?php echo "$data[id]";?>">Yes</button>
							<a class="btn btn-default" href="/operator/groups" role="button"><span
								class="glyphicon glyphicon-remove"></span> No</a>
						</form>
					</div>
      <?php } ?>
          
          </div>
          <?php
										
if (isset ( $_request ['id'] )) {
											$details = $groups->get_car_details ( $_request ['id'] ); // bring all car data as a object
											if(count($details)<1){die("Car Not Found");}
											?>
   <form class="form-horizontal" role="form" action="" method="post">

					<table class="noborder noborder" style="text-align: left;"
						cellpadding="5" cellspacing="5">
						<tr>
							<td width="50%">
								<div class="form-group">
									<label class="  col-sm-5 control-label">Name :</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" tabindex="1"
											name="name" placeholder="Car Name" required value="<?php echo $details['name'];?>">
									</div>
								</div>
							</td>
							<td width="50%">
								<div class="form-group ">
									<label class="col-sm-5 control-label">Owner Name :</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" tabindex="2"
											name="owner" placeholder="Owner Name" required value="<?php echo $details['owner'];?>">
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td width="50%">
								<div class="form-group ">
									<label for="inputEmail3" class="col-sm-5 control-label">Car
										Group</label>
									<div class="col-sm-7">
										<select class="form-control" name='group' tabindex="3"
											required>
      <?php
											
											$data = $groups->cargroups ();
											foreach ( $data as $value ) {
													if($value['id']==$details['group_id']){
														echo "<option value='$value[name]' Selected>$value[name]</option>";
													}else{
												echo "<option value='$value[name]'>$value[name]</option>";
												}
											}
											
											?>
  
  
</select>
									</div>
								</div>
							</td>
							<td width="50%">
								<div class="form-group ">
									<label class="col-sm-5 control-label">Registration Number :</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" tabindex="4"
											name="Reg_num" placeholder="Registration Number" required value="<?php echo $details['Reg_num'];?>">
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td width="50%">
								<div class="form-group">
									<label class="  col-sm-5 control-label">Purchased From :</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" tabindex="5"
											name="pfrom" placeholder="Purchased From" required value="<?php echo $details['pfrom'];?>">
									</div>
								</div>
							</td>
							<td width="50%">
								<div class="form-group ">
									<label class="col-sm-5 control-label">Date of Purchase :</label>
									<div class="col-sm-7">
										<div class='input-group date' id='Ldate'
											data-date-format="YYYY/MM/DD">
											<input type='text' autocomplete="off" tabindex="6"
												class="form-control Ldate " placeholder="dd/mm/yyyy"
												name="Dop" required value="<?php echo $details['Dop'];?>"/> <span class="input-group-addon"><span
												class="glyphicon glyphicon-calendar"></span> </span>
										</div>
									</div>
								</div>
							</td>
						</tr>

						<tr>
							<td width="50%">
								<div class="form-group">
									<label class="  col-sm-5 control-label">Engine Number :</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" tabindex="7"
											name="Engine_number" placeholder="Engine Number" required value="<?php echo $details['Engine_number'];?>">
									</div>
								</div>
							</td>
							<td width="50%">
								<div class="form-group ">
									<label class="col-sm-5 control-label">Chesis Number :</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" tabindex="8"
											name="Chesis_number" placeholder="Chesis Number" required value="<?php echo $details['Chesis_number'];?>">
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td width="50%">
								<div class="form-group">
									<label class="  col-sm-5 control-label">RTO Tax From :</label>
									<div class="col-sm-7">
										<div class='input-group date' id='Ldate'
											data-date-format="YYYY/MM/DD">
											<input type='text' autocomplete="off" tabindex="9"
												class="form-control Ldate " placeholder="dd/mm/yyyy"
												name="RTO_from" required value="<?php echo $details['RTO_from'];?>"/> <span class="input-group-addon"><span
												class="glyphicon glyphicon-calendar"></span> </span>
										</div>
									</div>
								</div>
							</td>
							<td width="50%">
								<div class="form-group ">
									<label class="col-sm-5 control-label">RTO Tax To :</label>
									<div class="col-sm-7">
										<div class='input-group date' id='Ldate'
											data-date-format="YYYY/MM/DD">
											<input type='text' autocomplete="off" tabindex="10"
												class="form-control Ldate " placeholder="dd/mm/yyyy"
												name="RTO_to" required value="<?php echo $details['RTO_to'];?>"/> <span class="input-group-addon"><span
												class="glyphicon glyphicon-calendar"></span> </span>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>

							<td width="50%">
								<div class="form-group">
									<label class="  col-sm-5 control-label">Inc. Dt. From :</label>
									<div class="col-sm-7">
										<div class='input-group date' id='Ldate'
											data-date-format="YYYY/MM/DD">
											<input type='text' autocomplete="off" tabindex="11"
												class="form-control Ldate " placeholder="dd/mm/yyyy"
												name="INC_from" required value="<?php echo $details['INC_from'];?>"/> <span class="input-group-addon"><span
												class="glyphicon glyphicon-calendar"></span> </span>
										</div>
									</div>
								</div>
							</td>
							<td width="50%">
								<div class="form-group ">
									<label class="col-sm-5 control-label">Inc. Dt. To :</label>
									<div class="col-sm-7">
										<div class='input-group date' id='Ldate'
											data-date-format="YYYY/MM/DD">
											<input type='text' autocomplete="off" tabindex="12"
												class="form-control Ldate " placeholder="dd/mm/yyyy"
												name="INC_to" required value="<?php echo $details['INC_to'];?>"/> <span class="input-group-addon"><span
												class="glyphicon glyphicon-calendar"></span> </span>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>

							<td width="50%">
								<div class="form-group">
									<label class="  col-sm-5 control-label">Permit Dt. From :</label>
									<div class="col-sm-7">
										<div class='input-group date' id='Ldate'
											data-date-format="YYYY/MM/DD">
											<input type='text' autocomplete="off" tabindex="13"
												class="form-control Ldate " placeholder="dd/mm/yyyy"
												name="Per_from" required value="<?php echo $details['Per_from'];?>"/> <span class="input-group-addon"><span
												class="glyphicon glyphicon-calendar"></span> </span>
										</div>
									</div>
								</div>
							</td>
							<td width="50%">
								<div class="form-group ">
									<label class="col-sm-5 control-label">Permit Dt. To :</label>
									<div class="col-sm-7">
										<div class='input-group date' id='Ldate'
											data-date-format="YYYY/MM/DD">
											<input type='text' autocomplete="off" tabindex="14"
												class="form-control Ldate " placeholder="dd/mm/yyyy"
												name="Per_to" required value="<?php echo $details['Per_to'];?>"/> <span class="input-group-addon"><span
												class="glyphicon glyphicon-calendar"></span> </span>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>

							<td width="50%">
								<div class="form-group">
									<label class="  col-sm-5 control-label">Auth. Dt. From :</label>
									<div class="col-sm-7">
										<div class='input-group date' id='Ldate'
											data-date-format="YYYY/MM/DD">
											<input type='text' autocomplete="off" tabindex="15"
												class="form-control Ldate " placeholder="dd/mm/yyyy"
												name="Auth_from" required value="<?php echo $details['Auth_from'];?>"/> <span class="input-group-addon"><span
												class="glyphicon glyphicon-calendar"></span> </span>
										</div>
									</div>
								</div>
							</td>
							<td width="50%">
								<div class="form-group ">
									<label class="col-sm-5 control-label">Auth. Dt. To :</label>
									<div class="col-sm-7">
										<div class='input-group date' id='Ldate'
											data-date-format="YYYY/MM/DD">
											<input type='text' autocomplete="off" tabindex="16"
												class="form-control Ldate " placeholder="dd/mm/yyyy"
												name="Auth_to" required value="<?php echo $details['Auth_to'];?>"/> <span class="input-group-addon"><span
												class="glyphicon glyphicon-calendar"></span> </span>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>

							<td width="50%">
								<div class="form-group">
									<label class="  col-sm-5 control-label">Inc Number :</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" tabindex="17"
											name="INC_numb" placeholder="Inc Number" required value="<?php echo $details['INC_numb'];?>">
									</div>
								</div>
							</td>
							<td width="50%">
								<div class="form-group ">
									<label class="col-sm-5 control-label">Permit Number :</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" tabindex="18"
											name="Per_numb" placeholder="Permit Number" required value="<?php echo $details['Per_numb'];?>">
									</div>
								</div>
							</td>
						</tr>
						<tr>

							<td width="50%">
								<div class="form-group">
									<label class="  col-sm-5 control-label">Auth. Number:</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" tabindex="19"
											name="Auth_numb" placeholder="Auth. Number" required value="<?php echo $details['Auth_numb'];?>">
									</div>
								</div>
							</td>
							<td width="50%"></td>
						</tr>
						<tr>
							<td width="50%">
								<div class="form-group">
									<label class="  col-sm-5 control-label">PUC. Dt. From :</label>
									<div class="col-sm-7">
										<div class='input-group date' id='Ldate'
											data-date-format="YYYY/MM/DD">
											<input type='text' autocomplete="off" tabindex="20"
												class="form-control Ldate " placeholder="dd/mm/yyyy"
												name="PUC_from" required value="<?php echo $details['PUC_from'];?>"/> <span class="input-group-addon"><span
												class="glyphicon glyphicon-calendar"></span> </span>
										</div>
									</div>
								</div>
							</td>
							<td width="50%">
								<div class="form-group ">
									<label class="col-sm-5 control-label">PUC. Dt. to :</label>
									<div class="col-sm-7">
										<div class='input-group date' id='Ldate'
											data-date-format="YYYY/MM/DD">
											<input type='text' autocomplete="off" tabindex="21"
												class="form-control Ldate " placeholder="dd/mm/yyyy"
												name="PUC_to" required value="<?php echo $details['PUC_to'];?>"/> <span class="input-group-addon"><span
												class="glyphicon glyphicon-calendar"></span> </span>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td width="50%">
								<div class="form-group">
									<label class="  col-sm-5 control-label">Car Color:</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" tabindex="22"
											name="color" placeholder="Car Color" required value="<?php echo $details['color'];?>">
									</div>
								</div>
							</td>
							<td width="50%">
								<div class="form-group ">
									<label class="col-sm-5 control-label">Car Type :</label>
									<div class="col-sm-7">
										<select class="form-control" name="type" tabindex="23">
											<option <?php echo $details['type']==="Diesel"? 'Selected':'';?>>Diesel</option>
											<option <?php echo $details['type']==="Petrol"? 'Selected':'';?>>Petrol</option>
											<option <?php echo $details['type']==="CNG"? 'Selected':'';?>>CNG</option>
										</select>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td width="50%">
								<div class="form-group">
									<label class="  col-sm-5 control-label">Approximate Fair:</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" tabindex="24"
											name="amount" placeholder="Approximate Fair" required value="<?php echo $details['amount'];?>" />
									</div>
								</div>
							</td>
							<td width="50%">
								<div class="form-group">
									<label class="  col-sm-5 control-label">Approximate Persons:</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" tabindex="25"
											name="persons" placeholder="Approximate Persons" required value="<?php echo $details['persons'];?>"/>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2">

								<div class="form-group ">
									<label class="col-sm-2 control-label">Car Description :</label>
									<div class="col-sm-10">
										<textarea name="details" cols='30' rows='5' tabindex="26"
											required><?php echo $details['details'];?></textarea>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2">

								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-9">
										<input type="submit" class="btn btn-success" tabindex="27"
											name='addcar' value="Update Info"/>
									</div>
								</div>
							</td>
						</tr>
					</table>

				</form>

            <?php
										} else if (isset ( $_request ['car'] )) {
											
											$details = $groups->get_car_details ( $_request ['car'] );
											
											?>
             <ul class="pager">
					<li class="previous"><a href="/operator/cars">&larr; Back</a></li>

				</ul>
				<form class="form-horizontal" role="form" action="/operator/cars"
					method="post">

					<div class="form-group ">
						<label for="inputEmail3" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-4">
							<p class="form-control-static"><?php echo "$details[name]";?></p>
						</div>

					</div>

					<div class="form-group ">
						<label for="inputEmail3" class="col-sm-2 control-label">Car Group</label>
						<div class="col-sm-4">
							<p class="form-control-static"><?php  $grp=$groups->get_cargroups_details($details['group_id']); echo"$grp[name]";?></p>
						</div>
					</div>

					<div class="form-group ">
						<label for="inputEmail3" class="col-sm-2 control-label">Approximate
							Fair</label>
						<div class="col-sm-4">
							<p class="form-control-static"><?php echo "$details[amount]";?></p>
							<span class="help-block">Its Approximate fair will be charged for
								this perticular car / day.</span>
						</div>
					</div>
					<div class="form-group ">
						<label for="inputEmail3" class="col-sm-2 control-label">In Stock</label>
						<div class="col-sm-4">
							<p class="form-control-static"><?php echo "$details[quantity]";?></p>
							<span class="help-block">How many cars of this type are currently
								available ?</span>
						</div>
					</div>
					<div class="form-group">
						<label for="disabledTextInput">Car Description</label>
						<p class="form-control-static"><?php echo "$details[details]";?></p>
					</div>
         



          <?php
										} else 

										{
											?>
          
    <table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Group</th>
								<th>Amount</th>
								<th>In Stock</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
      <?php
											$grp = $groups->car ();
											$i = 1;
											foreach ( $grp as $data ) {
												echo "<tr>";
												echo "<td>$i</td>";
												echo "<td><a href='/operator/cars?car=$data[id]'>$data[name]</a></td>";
												$grp = $groups->get_cargroups_details ( $data ['group_id'] );
												echo "<td>$grp[name]</td>";
												echo "<td>$data[amount]</td>";
												echo "<td>" . $data ['quantity'] . "</td>";
												echo "<td><a href='/operator/cars?id=$data[id]'>
												 <span class='glyphicon glyphicon-pencil'></span> Edit</a> | 
												<span class='glyphicon glyphicon-trash'></span>
												 <a href='/operator/cars?delete=$data[id]' > Delete</a> </td>";
        # code...
         $i++;
      
      
}

      ?>
      
        
      

    </div>
						</tbody>
					</table>

<?php }?>

        
			
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
});
  </script>
</body>
</html>

