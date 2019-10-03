<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any sale creditor data 
*/

class SaleCreditor{
	private $creditorId;
	private $businessId;
	private $customerId;
	private $amount;
	private $dateTime;

	/**
	* setter method
	*
	* @param int($creditorId) 
	*/
	public function setCreditorId($creditorId){
		$this->creditorId = $creditorId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getCreditorId(){
		return $this->creditorId;
	}

	/**
	* setter method
	*
	* @param int($businessId) 
	*/
	public function setBusinessId($businessId){
		$this->businessId = $businessId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getBusinessId(){
		return $this->businessId;
	}

	/**
	* setter method
	*
	* @param int($customerId) 
	*/
	public function setCustomerId($customerId){
		$this->customerId = $customerId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getCustomerId(){
		return $this->customerId;
	}

	/**
	* setter method
	*
	* @param decimal($amount) 
	*/
	public function setAmount($amount){
		$this->amount = $amount;
	}

	/**
	* getter method
	*
	* @return decimal($amount)
	*/
	public function getAmount(){
		return $this->amount;
	}
	
	/**
	* setter method
	*
	* @param String($dateTime) 
	*/
	public function setDateTime($dateTime){
		$this->dateTime = $dateTime;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getDateTime(){
		return $this->dateTime;
	}
}