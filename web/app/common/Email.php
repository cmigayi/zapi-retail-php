<?php
namespace App\Common;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle email info
*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Common\ErrorLogger;

class Email{
	public $email; 
	public $subject;
	public $body;

	private $log;

	public function __construct(){
		$this->log = new ErrorLogger("Email");
		$this->log = $this->log->initLog();
	}

	/**
	* Setter
	*
	* @param String (email)
	* @return void
	*/
	public function setEmail($email){
		$this->email = $email;
	} 

	/**
	* Setter
	*
	* @param String (subject)
	* @return void
	*/
	public function setSubject($subject){
		$this->subject = $subject;
	}

	/**
	* Setter
	*
	* @param String (body)
	* @return void
	*/
	public function setBody($body){
		$this->body = $body;
	}

	/**
	* Email address validation
	*
	* @param void
	* @return String (email)
	*/
	public function validEmail(){

		if(empty($this->email)){
			$this->log->error("Email cannot be empty!");
			//throw new \Exception("Email cannot be empty!");
		}

		if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
			$this->log->error("Email is invalid!");
			//throw new \Exception("Email is invalid!");
		}
		return $this->email;
	}

	/**
	* Email subject validation
	*
	* @param void
	* @return String (subject)
	*/
	public function validSubject(){
		if(empty($this->subject)){
			$this->log->error("Subject must not be empty!");
			//throw new \Exception("Subject must not be empty!");
		}
		return $this->subject;
	}

	/**
	* Email body validation
	*
	* @param void
	* @return String (subject)
	*/
	public function validBody(){
		if(empty($this->body)){
			$this->log->error("Body must not be empty!");
			//throw new \Exception("Body must not be empty!");
		}
		return $this->body;
	}

	/**
	* Email subject validation
	*
	* @param void
	* @return boolean (sent email status)
	*/
	public function sendEmail(){

		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
		    //Server settings
		    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = '';                 // SMTP username
		    $mail->Password = '';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom('', '');
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
		    // logger
		    $this->log->error('Mailer Error: ' . $mail->ErrorInfo);

		    return false;
		}
	}
}