<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch business agents data
*/

use App\Repositories\Contracts\BusinessRoleRepositoryInterface;

class BusinessAgents{
	private $repo; 

	public function __construct(BusinessRoleRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessAgents($businessId){
		return $this->repo->loadBusinessAgents($businessId);
	}

}