<?php
namespace App\Common;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Handle phone info
*/

use App\Common\ErrorLogger;

class Phone{
	protected $number;

	private $log;

	public function __construct(){
		$this->log = new ErrorLogger("Phone");
		$this->log = $this->log->initLog();
	}

	/**
	* Setter
	*
	* @param String (number)
	* @return void
	*/
	public function setPhoneNumber($number){
		$this->number = $number;
	} 

	/**
	* Phonenumber validation
	*
	* @param void
	* @return String (phonenumber)
	*/
	public function validPhoneNumber(){
		$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";

		if(empty($this->number)){
			$this->log->error("Phone cannot be empty!");
			//throw new \Exception("Phone cannot be empty!");
		}

		if(!preg_match($regex, $this->number)){
			$this->log->error("Phone number is invalid!");
			//throw new \Exception("Phone number is invalid!");
		}
		return $this->number;
	}
}