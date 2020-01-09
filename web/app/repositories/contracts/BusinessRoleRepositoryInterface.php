<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to business role repository
*/
use App\Data\BusinessRole;

interface BusinessRoleRepositoryInterface{

	/**	
	* Create new business role
	*
	* @param $businessRole object
	* @return BusinessRole object
	*/
	public function createBusinessRole($businessRole);	
	
	/**
	* Get roles in specific business
	* 
	* @param pass int($businessRoleId)
	*/
	public function getBusinessRoles($businessId);
	
	/**
	* Get roles for specific business
	* 
	* @param pass int($businessId)
	*/
	public function getBusinessRole($businessRoleId);
	
	/**
	* Get role for specific employee
	* 
	* @param pass int($employeeId)
	*/
	public function getEmployeeRole($employeeId);
	
	/**
	* Handle specific business role data update
	*
	* @param none
	* @return business role info 
	*/
	public function updateBusinessRole(BusinessRole $businessRole);
	
	/**
	* Handle specific business role data delete
	*
	* @param businessRoleId
	* @return boolean 
	*/
	public function deleteBusinessRole($businessRoleId);

}