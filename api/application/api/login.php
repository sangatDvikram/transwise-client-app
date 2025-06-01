<?php 
if($_POST)
{
	$back['message']=$_POST['username'];
	echo json_encode($back);
	exit(0);
}