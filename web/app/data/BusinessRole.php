<?php
namespace App\Data;

/**
* @Author: Cecil Migayi
* @Email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* This class assist in handling any business role 
*/

class BusinessRole{
	private $businessRoleId;
	private $userId;
	private $businessId;
	private $businessRole;
	private $dateTime;

	/**
	* setter method
	*
	* @param int($id) 
	*/
	public function setBusinessRoleId($businessRoleId){
		$this->businessRoleId = $businessRoleId;
	}

	/**
	* getter method
	*
	* @return int
	*/
	public function getBusinessRoleId(){
		return $this->businessRoleId;
	}

	/**
	* setter method
	*
	* @param int($userId) 
	*/
	public function setUserId($userId){
		$this->userId = $userId;
	}

	/**
	* getter method
	*
	* @return int
	*/
	public function getUserId(){
		return $this->userId;
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
	* @return String
	*/
	public function getBusinessId(){
		return $this->businessId;
	}

	/**
	* setter method
	*
	* @param String($businessRole) 
	*/
	public function setBusinessRole($businessRole){
		$this->businessRole= $businessRole;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getBusinessRole(){
		return $this->businessRole;
	}	

	/**
	* setter method
	*
	* @param String($type)
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

