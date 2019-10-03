<?php
namespace App\Data;

class ProductStock{
	private $stockId;
	private $productId;
	private $businessId;
	private $quantity;
	private $dateTime;

	/**
	* setter method
	*
	* @param int($stockId) 
	*/
	public function setStockId($stockId){
		$this->stockId = $stockId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getStockId(){
		return $this->stockId;
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
	* @param int($quantity) 
	*/
	public function setQuantity($quantity){
		$this->quantity = $quantity;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getQuantity(){
		return $this->quantity;
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