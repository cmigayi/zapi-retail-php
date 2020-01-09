<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch businessRole data
*/

use App\Repositories\Contracts\BusinessRoleRepositoryInterface;
use App\Data\BusinessRole;

class BusinessRoleInfo{
	private $repo; 

	public function __construct(BusinessRoleRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessRole($businessRoleId){
		return $this->repo->getBusinessRole($businessRoleId);
	}
	
	public function getEmployeeRole($employeeId){
		return $this->repo->getEmployeeRole($employeeId);
	}
	
	public function updateBusinessRole(BusinessRole $businessRole){
		return $this->repo->updateBusinessRole($businessRole);
	}
	
	public function deleteBusinessRole($businessRoleId){
		return $this->repo->deleteBusinessRole($businessRoleId);
	}
}