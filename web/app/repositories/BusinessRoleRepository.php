<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage business role data from data source
*/

use App\Repositories\Contracts\BusinessRoleRepositoryInterface;
use App\Data\BusinessRole;
use App\Models\BusinessRoleModel;

class BusinessRoleRepository implements BusinessRoleRepositoryInterface{
	private $businessRoleModel;	

	public function __construct(){
		$this->businessRoleModel = new BusinessRoleModel();
	}

	public function createBusinessRole($businessRole){
		$this->businessRoleModel->setData($businessRole);
		return $this->businessRoleModel->createBusinessRole();
	}
	
	/**
	* Get roles in specific business
	* 
	* @param pass int($businessId)
	*/
	public function getBusinessRoles($businessId){
		return $this->businessRoleModel->getBusinessRoles($businessId);				
	}
	
	/**
	* Get roles for specific business
	* 
	* @param pass int($businessId)
	*/
	public function getBusinessRole($businessRoleId){
		return $this->businessRoleModel->getBusinessRole($businessRoleId);
	}
	
	/**
	* Get role for specific employee
	* 
	* @param pass int($employeeId)
	*/
	public function getEmployeeRole($employeeId){
		return $this->businessRoleModel->getEmployeeRole($employeeId);
	}
	
	/**
	* Handle specific business role data update
	*
	* @param none
	* @return business role info 
	*/
	public function updateBusinessRole(BusinessRole $businessRole){
		$this->businessRoleModel->setData($businessRole);
		return $this->businessRoleModel->updateBusinessRole();
	}
	
	/**
	* Handle specific business role data delete
	*
	* @param businessRoleId
	* @return boolean 
	*/
	public function deleteBusinessRole($businessRoleId){
		return $this->businessRoleModel->deleteBusinessRole($businessRoleId);
	}
} 