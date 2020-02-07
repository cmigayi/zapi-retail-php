<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch businessRoles data
*/

use App\Repositories\Contracts\BusinessRoleRepositoryInterface;

class BusinessRoles{
	private $repo; 

	public function __construct(businessRoleRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessRoles($businessId){
		return $this->repo->getBusinessRoles($businessId);
	}
}