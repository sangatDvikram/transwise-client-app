<?php
//require_once '../include/system/config.php';

if(isset($_POST))
{
$register= new Register();
$ips=$register->check_input($_POST);
$error=0;
if ($register->error_exist())
{
	if ($register->register_user())
	{
		$data= "<div class='alert alert-success'> You have been registerd successfully. </div>";
	}
}
else 
{
	$error=1;
	$errs=$register->get_errors();
	$data= "<div class='alert alert-danger'>";
	foreach ($errs as $err)
	{
		$data.= "$err <br>";
	}
	$data.= "</div>";
}

echo json_encode(array("Data"=>$data,"Error"=>$error));
exit(0);
}

?>