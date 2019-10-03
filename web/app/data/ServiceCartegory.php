<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any product cartegory data 
*/

class ServiceCartegory{
	private $serviceCartegoryId;
	private $businessId;
	private $cartegoryName;
	private $cartegoryDesc;
	private $createdBy;
	private $dateTime;

	/**
	* setter method
	*
	* @param int($serviceCartegoryId) 
	*/
	public function setServiceCartegoryId($serviceCartegoryId){
		$this->serviceCartegoryId = $serviceCartegoryId;
	}
	
	/**
	* getter method
	*
	* @return int(id)
	*/
	public function getServiceCartegoryId(){
		return $this->serviceCartegoryId;
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
	* @return int
	*/
	public function getBusinessId(){
		return $this->businessId;
	}

	/**
	* setter method
	*
	* @param String($cartegoryName)
	*/
	public function setCartegoryName($cartegoryName){
		$this->cartegoryName = $cartegoryName;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getCartegoryName(){
		return $this->cartegoryName; 
	}

	/**
	* setter method
	*
	* @param String($cartegoryDesc)
	*/
	public function setCartegoryDesc($cartegoryDesc){
		$this->cartegoryDesc = $cartegoryDesc;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getCartegoryDesc(){
		return $this->cartegoryDesc; 
	}

	/**
	* setter method
	*
	* @param int($createdBy)
	*/
	public function setCreatedBy($createdBy){
		$this->createdBy = $createdBy;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getCreatedBy(){
		return $this->createdBy;
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
