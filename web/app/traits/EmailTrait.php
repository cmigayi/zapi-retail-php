<?php

namespace App\Traits;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

trait Email{
	public $email; 
	public $subject;
	public $body;

	public function setEmail($email){
		$this->email = $email;
	} 

	public function setSubject($subject){
		$this->subject = $subject;
	}

	public function setBody($body){
		$this->body = $body;
	}

	public function validEmail(){

		if(empty($this->email)){
			throw new \Exception("Email cannot be empty!");
		}

		if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
			throw new \Exception("Email is invalid!");
		}
		return $this->email;
	}

	public function validSubject(){
		if(empty($this->subject)){
			throw new \Exception("Subject must not be empty!");
		}
		return $this->subject;
	}

	public function validBody(){
		if(empty($this->body)){
			throw new \Exception("Body must not be empty!");
		}
		return $this->body;
	}

	public function sendEmail(){

		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
		    //Server settings
		    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'bukswapinfo@gmail.com';                 // SMTP username
		    $mail->Password = 'bukswap2018';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom('info@bukswap.com', 'bukswap');
		    $mail->addAddress($this->email, '');     // Add a recipient
		    //$mail->addAddress('ellen@example.com');               // Name is optional
		    //$mail->addReplyTo('info@example.com', 'Information');
		    //$mail->addCC('cc@example.com');
		    //$mail->addBCC('bcc@example.com');

		    //Attachments
		    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $this->subject;
		    $mail->Body    = $this->body;
		    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    return true;
		} catch (Exception $e) {
		    // echo 'Message could not be sent.';
		    // echo 'Mailer Error: ' . $mail->ErrorInfo;
		    return false;
		}
	}
}