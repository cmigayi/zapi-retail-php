<?php
namespace App\Common;

use App\Traits\Email;

class EmailHandler{
	private $email;
	private $body;
	
	use Email;

	public function __construct($email){
		$this->email = $email;
	}	
	
	public function supplierEmail(){
		$this->body = "Hi, ";
		
	}
}