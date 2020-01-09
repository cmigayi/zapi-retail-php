<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any product data 
*/

class Product{
	private $productId;
	private $productCartegoryId;
	private $businessId;
	private $employeeId;
	private $productName;
	private $productDesc;
	private $price;
	private $createdBy;
	private $dateTime;

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
	* @param int($productCartegoryId) 
	*/
	public function setProductCartegoryId($productCartegoryId){
		$this->productCartegoryId = $productCartegoryId;
	}
	
	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getProductCartegoryId(){
		return $this->productCartegoryId;
	}
	
	public function setEmployeeId($employeeId){
		$this->employeeId = $employeeId;
	}

	public function getEmployeeId(){
		return $this->employeeId;
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
	* @param String($productName)
	*/
	public function setProductName($productName){
		$this->productName = $productName;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getProductName(){
		return $this->productName; 
	}

	/**
	* setter method
	*
	* @param String($productDesc)
	*/
	public function setProductDesc($productDesc){
		$this->productDesc = $productDesc;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getProductDesc(){
		return $this->productDesc; 
	}

	/**
	* setter method
	*
	* @param decimal($price) 
	*/
	public function setPrice($price){
		$this->price = $price;
	}

	/**
	* getter method
	*
	* @return decimal(id)
	*/
	public function getPrice(){
		return $this->price;
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