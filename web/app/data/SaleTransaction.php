<?php
namespace App\Data;

class SaleTransaction{
	private $saleTransactionId;
	private $businessId;
	private $transactionNumber;
	private $paymentAmount;
	private $amountPaid;
	private $balance;
	private $paymentMode;
	private $dateTime;

	/**
	* setter method
	*
	* @param int($saleTransactionId) 
	*/
	public function setSaleTransactionId($saleTransactionId){
		$this->saleTransactionId = $saleTransactionId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getSaleTransactionId(){
		return $this->saleTransactionId;
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
	* @param decimal($paymentAmount) 
	*/
	public function setPaymentAmount($paymentAmount){
		$this->paymentAmount = $paymentAmount;
	}

	/**
	* getter method
	*
	* @return decimal($paymentAmount)
	*/
	public function getPaymentAmount(){
		return $this->paymentAmount;
	}

	/**
	* setter method
	*
	* @param decimal($amountPaid) 
	*/
	public function setAmountPaid($amountPaid){
		$this->amountPaid = $amountPaid;
	}

	/**
	* getter method
	*
	* @return decimal($amountPaid)
	*/
	public function getAmountPaid(){
		return $this->amountPaid;
	}

	/**
	* setter method
	*
	* @param decimal($balance) 
	*/
	public function setBalance($balance){
		$this->balance = $balance;
	}

	/**
	* getter method
	*
	* @return decimal($balance)
	*/
	public function getBalance(){
		return $this->balance;
	}

	/**
	* setter method
	*
	* @param String($paymentMode) 
	*/
	public function setPaymentMode($paymentMode){
		$this->paymentMode = $paymentMode;
	}

	/**
	* getter method
	*
	* @return decimal($paymentMode)
	*/
	public function getPaymentMode(){
		return $this->paymentMode;
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