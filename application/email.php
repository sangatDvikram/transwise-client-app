<?php

	//Mail.php

	$to = 'v.sangat98@gmail.com';   


$subject = 'Website Html Page ';

$headers = "From: " . strip_tags('admin@transwise.vritt.com') . "\r\n";
$headers .= "Reply-To: ". strip_tags('admin@transwise.vritt.com') . "\r\n";

$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	

	$message = file_get_contents('http://transwise.vritt.com/PrintTicket?id=booking-3537656330');    

	

	mail($to, $subject, $message, $headers);

?>