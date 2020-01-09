<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any customer data 
*/

class Customer{
	private $customerId;
	private $businessId;
	private $fname;
	private $lname;
	private $nationalId;
	private $phone;
	private $email;
	private $dateTime;

	public function setCustomerId($customerId){
		$this->customerId = $customerId;
	}

	public function getCustomerId(){
		return $this->customerId;
	}
	
	public function setBusinessId($businessId){
		$this->businessId = $businessId;
	}

	public function getBusinessId(){
		return $this->businessId;
	}

	public function setFname($fname){
		$this->fname = $fname;
	}

	public function getFname(){
		return $this->fname;
	}

	public function setLname($lname){
		$this->lname = $lname;
	}

	public function getLname(){
		return $this->lname;
	}

	public function setNationalId($nationalId){
		$this->nationalId = $nationalId;
	}

	public function getNationalId(){
		return $this->nationalId;
	}

	public function setPhone($phone){
		$this->phone = $phone;
	}

	public function getPhone(){
		return $this->phone;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setDateTime($dateTime){
		$this->dateTime = $dateTime;
	}

	public function getDateTime(){
		return $this->dateTime;
	}
}