<?php
/* Connect to an ODBC database using driver invocation */
$dsn = 'mysql:dbname=vritt_testing;host=localhost';
$user = 'imtester1';
$password = 'imtester123';
$output= array('Message' =>'' ,'Error'=> '');
ini_set( "display_errors", 1);
function InsertEmail($email,$ip){

	try {
		$dbh = new PDO($GLOBALS['dsn'], $GLOBALS['user'], $GLOBALS['password']);
	    $statement="INSERT INTO  subscribed_emails (email ,ip) VALUES (:email,:ip)";
	    $sth = $dbh->prepare($statement);
	   	    if($sth->execute(array(':email'=>$email,':ip'=>$ip))){
			return true;
		    }else{
		   	return false;
		    }    
    } 
    catch (PDOException $e) {
 	 return false;
	}
}
$err=0;
$email=$_POST['email'];
//Check for Email
if(isset($email)&&filter_var($email, FILTER_VALIDATE_EMAIL)){

$split=substr($email, strpos($email, '@') + 1);//splid the email to find dns

if  (checkdnsrr($split, "MX") !== FALSE) {
if(InsertEmail($email,$_SERVER['REMOTE_ADDR'])){
 $err=0;
	$Message= "<b>Thank you for subscribing us !!</b> <br> We will keep you updated !!";
}
else{
$err=2;
	$Message= "<b>Looks like you have alredy subscribed us !! </b><br> We will keep you updated .";
}



}
else
{$err=1;

	$Message= "<b>Please Check that you have entred proper DNS for the email!!</b>";

	
}
}
else{
	$err=1;
$Message= "<b>Please Check that you have entred proper email!!</b>";
}
$output['Message']=$Message;
$output['Error']=$err;

echo json_encode($output);
exit(0);

?> 