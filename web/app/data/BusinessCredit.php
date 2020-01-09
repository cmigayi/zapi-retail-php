<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any business credit data 
*/

class BusinessCredit{
	private $businessCreditId;
	private $businessId;
	private $owedPersonId;
	private $type;
	private $amount;
	private $reason;
	private $dateTime;
	
	/**
	* setter method
	*
	* @param int($businessCreditId) 
	*/
	public function setBusinessCreditId($businessCreditId){
		$this->businessCreditId = $businessCreditId;
	}

	/**
	* getter method
	*
	* @return int
	*/
	public function getBusinessCreditId(){
		return $this->businessCreditId;
	}
	
	/**
	* setter method
	*
	* @param int($id) 
	*/
	public function setBusinessId($id){
		$this->businessId = $id;
	}	

	/**
	* getter method
	*
	* @return int
	*/
	public function getBusinessId(){
		return $this->businessId;
	}
	
	/**
	* getter method
	*
	* @return int
	*/
	public function getOwedPersonId(){
		return $this->owedPersonId;
	}
	
	/**
	* setter method
	*
	* @param int($owedPersonId) 
	*/
	public function setOwedPersonId($owedPersonId){
		$this->owedPersonId = $owedPersonId;
	}
	
	/**
	* getter method
	*
	* @return String
	*/
	public function getCreditType(){
		return $this->type;
	}
	
	/**
	* setter method
	*
	* @param string($type) 
	*/
	public function setCreditType($type){
		$this->type = $type;
	}
	
	/**
	* getter method
	*
	* @return String
	*/
	public function getAmount(){
		return $this->amount;
	}
	
	/**
	* setter method
	*
	* @param string($amount) 
	*/
	public function setAmount($amount){
		$this->amount = $amount;
	}
	
	/**
	* getter method
	*
	* @return String
	*/
	public function getReason(){
		return $this->reason;
	}
	
	/**
	* setter method
	*
	* @param string($reason) 
	*/
	public function setReason($reason){
		$this->reason = $reason;
	}
	
	/**
	* setter method
	*
	* @param String($type) Date and time the business was inserted to app db
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