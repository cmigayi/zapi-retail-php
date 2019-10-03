<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any supplied product data 
*/

class SuppliedProduct{
	private $suppliedProductId;	
	private $productId;
	private $supplierId;
	private $businessId;
	private $quantity;
	private $unitPrice;
	private $paymentStatus;
	private $dateTime;

	/**
	* setter method
	*
	* @param int($suppliedProductId) 
	*/
	public function setSuppliedProductId($suppliedProductId){
		$this->suppliedProductId = $suppliedProductId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getSuppliedProductId(){
		return $this->suppliedProductId;
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
	* @param int($supplierId) 
	*/
	public function setSupplierId($supplierId){
		$this->supplierId = $supplierId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getSupplierId(){
		return $this->supplierId;
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
	* @param decimal($unitPrice) 
	*/
	public function setUnitPrice($unitPrice){
		$this->unitPrice = $unitPrice;
	}

	/**
	* getter method
	*
	* @return decimal($unitPrice)
	*/
	public function getUnitPrice(){
		return $this->unitPrice;
	}

	/**
	* setter method
	*
	* @param 
	*/
	public function setPaymentStatus($paymentStatus){
		$this->paymentStatus = $paymentStatus;
	}

	/**
	* getter method
	*
	* @return 
	*/
	public function getPaymentStatus(){
		return $this->paymentStatus;
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