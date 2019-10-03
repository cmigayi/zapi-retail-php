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

	public function loadBusinessAgent($businessId,$userId){
		return $this->businessRoleModel->getBusinessAgent($businessId,$userId);
	}
	
	public function loadBusinessAgents($businessId){
		return $this->businessRoleModel->getBusinessAgents($businessId);
	}
} 