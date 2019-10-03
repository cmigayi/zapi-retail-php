<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any supplier product data 
*/

class SupplierProduct{
	private $supplierProductId;	
	private $supplierId;
	private $productId;
	private $businessId;
	private $dateTime;

	/**
	* setter method
	*
	* @param int($supplierProductId) 
	*/
	public function setSupplierProductId($supplierProductId){
		$this->supplierProductId = $supplierProductId;
	}

	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getSupplierProductId(){
		return $this->supplierProductId;
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