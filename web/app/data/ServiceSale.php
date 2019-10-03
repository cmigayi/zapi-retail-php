<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any service sale data 
*/

class ServiceSale{
	private $serviceSaleId;	
	private $serviceId;
	private $businessId;
	private $sellerId;
	private $transactionNumber;
	private $fee;
	private $payment;
	private $receipt;
	private $dateTime;

	/**
	* setter method
	*
	* @param int($serviceSaleId) 
	*/
	public function setServiceSaleId($serviceSaleId){
		$this->serviceSaleId = $serviceSaleId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getServiceSaleId(){
		return $this->serviceSaleId;
	}

	/**
	* setter method
	*
	* @param int($serviceId) 
	*/
	public function setServiceId($serviceId){
		$this->serviceId = $serviceId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getServiceId(){
		return $this->serviceId;
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
	* @param int($sellerId) 
	*/
	public function setSellerId($sellerId){
		$this->sellerId = $sellerId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getSellerId(){
		return $this->sellerId;
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
	* setter method
	*
	* @param decimal($fee) 
	*/
	public function setFee($fee){
		$this->fee = $fee;
	}

	/**
	* getter method
	*
	* @return decimal($fee)
	*/
	public function getFee(){
		return $this->fee;
	}

	/**
	* setter method
	*
	* @param 
	*/
	public function setPayment($payment){
		$this->payment = $payment;
	}

	/**
	* getter method
	*
	* @return 
	*/
	public function getPayment(){
		return $this->payment;
	}

	/**
	* setter method
	*
	* @param 
	*/
	public function setReceipt($receipt){
		$this->receipt = $receipt;
	}

	/**
	* getter method
	*
	* @return 
	*/
	public function getReceipt(){
		return $this->receipt;
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