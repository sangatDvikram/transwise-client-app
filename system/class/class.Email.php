<?php 

 class Email
 {

		

		public function SendMail($id,$address)
		{
									// Set PHPMailer to use the sendmail transport
						$mail = new PHPMailer();
						$mail->setFrom('admin@transwise.vritt.com', 'Ticket Master');
						//Set an alternative reply-to address
						$mail->IsHTML(true);
						//Set who the message is to be sent to
						$mail->addAddress($address);
						//Set the subject line
						$mail->Subject = "Booking Confirmed - $id  ";
						//Read an HTML message body from an external file, convert referenced images to embedded,
						//convert HTML into a basic plain-text alternative body
						$body=file_get_contents("http://$_SERVER[HTTP_HOST]/PrintTicket?id=$id");
						$mail->Body=$body;
						//Replace the plain text body with one created manually
						$mail->AltBody = 'This is a plain-text message body';

						//$mail->addAttachment('assets/img/avatar_homer.png');

						//Attach an image file
						//$mail->addAttachment('images/phpmailer_mini.png');

						//send the message, check for errors
						if (!$mail->send()) {
						    die( "Mailer Error: " . $mail->ErrorInfo);
						} 
		}
 }