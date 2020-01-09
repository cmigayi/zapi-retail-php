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
	private $employeeId;
	private $businessId;
	private $roleLabel;
	private $rolePrevileges;
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
	* @param int($employeeId) 
	*/
	public function setEmployeeId($employeeId){
		$this->employeeId = $employeeId;
	}

	/**
	* getter method
	*
	* @return int
	*/
	public function getEmployeeId(){
		return $this->employeeId;
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
	* @param String($roleLabel) 
	*/
	public function setRoleLabel($roleLabel){
		$this->roleLabel = $roleLabel;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getRoleLabel(){
		return $this->roleLabel;
	}

	/**
	* setter method
	*
	* @param String($rolePrevileges) 
	*/
	public function setRolePrevileges($rolePrevileges){
		$this->rolePrevileges = $rolePrevileges;
	}

	/**
	* getter method
	*
	* @return String
	*/
	public function getRolePrevileges(){
		return $this->rolePrevileges;
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

