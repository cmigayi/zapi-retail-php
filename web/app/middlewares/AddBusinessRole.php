<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new business
*/

use App\Repositories\Contracts\BusinessRoleRepositoryInterface;
use App\Data\BusinessRole;

class AddBusinessRole{
	private $repo;

	public function __construct(BusinessRoleRepositoryInterface $repo){
		$this->repo = $repo;
	}	

	public function createBusinessRole(BusinessRole $businessRole){
		return $this->repo->createBusinessRole($businessRole);
	}
}
