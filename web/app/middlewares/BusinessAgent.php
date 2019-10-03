<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch business agent data
*/

use App\Repositories\Contracts\BusinessRoleRepositoryInterface;

class BusinessAgent{
	private $repo; 

	public function __construct(BusinessRoleRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessAgent($businessId,$userId){
		return $this->repo->loadBusinessAgent($businessId,$userId);
	}

}