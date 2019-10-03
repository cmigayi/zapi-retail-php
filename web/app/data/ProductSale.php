<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any product sale data 
*/

class ProductSale{
	private $productSaleId;	
	private $productId;
	private $businessId;
	private $sellerId;
	private $transactionNumber;
	private $quantity;
	private $cost;
	private $payment;
	private $receipt;
	private $dateTime;

	/**
	* setter method
	*
	* @param int($productSaleId) 
	*/
	public function setProductSaleId($productSaleId){
		$this->productSaleId = $productSaleId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getProductSaleId(){
		return $this->productSaleId;
	}

	/**
	* setter method
	*
	* @param int($productId) 
	*/
	public function setProductId($productId){
		$this->productId = $productId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getProductId(){
		return $this->productId;
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
	* @param int($quantity) 
	*/
	public function setQuantity($quantity){
		$this->quantity = $quantity;
	}

	/**
	* getter method
	*
	* @return int($quantity)
	*/
	public function getQuantity(){
		return $this->quantity;
	}

	/**
	* setter method
	*
	* @param decimal($cost) 
	*/
	public function setCost($cost){
		$this->cost = $cost;
	}

	/**
	* getter method
	*
	* @return decimal($cost)
	*/
	public function getCost(){
		return $this->cost;
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