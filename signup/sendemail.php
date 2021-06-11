 <?php
 				do{
				$fourRandomDigit = mt_rand(1000,9999);  
				$email=$_GET['email'];
				$to       = ''.$email;
				$subject  = 'AYNIOP ForgotPassword';
				$message  = 'Verification code is '.$fourRandomDigit;
				$headers  = 'From: ayniop@gmail.com' . "\r\n" .
							'MIME-Version: 1.0' . "\r\n" .
							'Content-type: text/html; charset=utf-8';
				$verficationcode->setcode($fourRandomDigit);
				 }while(mail($to, $subject, $message, $headers)==false)
?>