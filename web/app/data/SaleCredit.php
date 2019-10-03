<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any sale credit data 
*/

class SaleCredit{
	private $creditId;
	private $creditorId;
	private $saleId;
	private $businessId;
	private $transactionNumber;
	private $itemType;
	private $amount;
	private $dateTime;

	/**
	* setter method
	*
	* @param int($creditId) 
	*/
	public function setCreditId($creditId){
		$this->creditId = $creditId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getCreditId(){
		return $this->creditId;
	}

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
	* @param int($saleId) 
	*/
	public function setSaleId($saleId){
		$this->saleId = $saleId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getSaleId(){
		return $this->saleId;
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
	* @param int($transactionNumber) 
	*/
	public function setTransactionNumber($transactionNumber){
		$this->transactionNumber = $transactionNumber;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getTransactionNumber(){
		return $this->transactionNumber;
	}

	/**
	* setter method
	*
	* @param String($itemType) 
	*/
	public function setItemType($itemType){
		$this->itemType = $itemType;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getItemType(){
		return $this->itemType;
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