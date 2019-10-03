<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any supplier data 
*/

class Supplier{

	private $supplierId;
	private $businessId;	
	private $supplierName;
	private $phone;
	private $email;
	private $dateTime;

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
	* @param String($supplierName) 
	*/
	public function setSupplierName($supplierName){
		$this->supplierName = $supplierName;
	}

	/**
	* getter method
	*
	* @return String($supplierName)
	*/
	public function getSupplierName(){
		return $this->supplierName;
	}

	/**
	* setter method
	*
	* @param String($email) 
	*/
	public function setEmail($email){
		$this->email = $email;
	}

	/**
	* getter method
	*
	* @return String($email)
	*/
	public function getEmail(){
		return $this->email;
	}

	/**
	* setter method
	*
	* @param String($phone) 
	*/
	public function setPhone($phone){
		$this->phone = $phone;
	}

	/**
	* getter method
	*
	* @return String($phone)
	*/
	public function getPhone(){
		return $this->phone;
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
	* @return String($dateTime)
	*/
	public function getDateTime(){
		return $this->dateTime;
	}
}