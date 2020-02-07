<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any customer credit data 
*/

class CustomerCredit{
	private $customerCreditId;
	private $customerId;
	private $businessId;
	private $transactionNumber;
	private $amount;
	private $dateTime;
	
	/**
	* setter method
	*
	* @param int($customerCreditId) 
	*/
	public function setCustomerCreditId($customerCreditId){
		$this->customerCreditId = $customerCreditId;
	}

	/**
	* getter method
	*
	* @return int
	*/
	public function getCustomerCreditId(){
		return $this->customerCreditId;
	}
	
	/**
	* setter method
	*
	* @param int($id) 
	*/
	public function setCustomerId($id){
		$this->customerId = $id;
	}	

	/**
	* getter method
	*
	* @return int
	*/
	public function getCustomerId(){
		return $this->customerId;
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
	* setter method
	*
	* @param int($transactionNumber) 
	*/
	public function setTransactionNumber($transactionNumber){
		$this->transactionNumber = $transactionNumber;
	}

	/**
	* getter method
	*
	* @return int($transactionNumber)
	*/
	public function getTransactionNumber(){
		return $this->transactionNumber;
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