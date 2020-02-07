<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any transaction data 
*/

class Transaction{
	private $transactionId;
	private $employeeId;
	private $transactionNumber;	
	private $businessId;
	private $cost;
	private $amountPaid;
	private $balance;
	private $paymentMode;
	private $receipt;	
	private $transactedItems;
	private $dateTime;	
	
	public function setSaleId($saleId){
		$this->saleId = $saleId;
	}
	
	public function getSaleId(){
		return $this->saleId;
	}
	
	public function setEmployeeId($employeeId){
		$this->employeeId = $employeeId;
	}
	
	public function getEmployeeId(){
		return $this->employeeId;
	}
	
	public function setTransactionNumber($transactionNumber){
		$this->transactionNumber = $transactionNumber;
	}
	
	public function getTransactionNumber(){
		return $this->transactionNumber;
	}
	
	public function setTransactionId($transactionId){
		$this->transactionId = $transactionId;
	}
	
	public function getTransactionId(){
		return $this->transactionId;
	}
	
	public function setBusinessId($businessId){
		$this->businessId = $businessId;
	}
	
	public function getBusinessId(){
		return $this->businessId;
	}
	
	public function setCost($cost){
		$this->cost = $cost;
	}
	
	public function getCost(){
		return $this->cost;
	}
	
	public function setAmountPaid($amountPaid){
		$this->amountPaid = $amountPaid;
	}
	
	public function getAmountPaid(){
		return $this->amountPaid;
	}
	
	public function setBalance($balance){
		$this->balance = $balance;
	}
	
	public function getBalance(){
		return $this->balance;
	}
	
	public function setPaymentMode($paymentMode){
		$this->paymentMode = $paymentMode;
	}
	
	public function getPaymentMode(){
		return $this->paymentMode;
	}
	
	public function getTransactedItems(){
		return $this->transactedItems;
	}
	
	public function setTransactedItems($transactedItems){
		$this->transactedItems = $transactedItems;
	}
	
	public function setReceipt($receipt){
		$this->receipt = $receipt;
	}	
	
	public function getReceipt(){
		return $this->receipt;
	}
	
	public function setDateTime($dateTime){
		$this->dateTime = $dateTime;
	}
	
	public function getDateTime(){
		return $this->dateTime;
	}	
}