<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch all supplied products data
*/

use App\Repositories\Contracts\SuppliedProductRepositoryInterface;

class BusinessSuppliedProducts{
	private $repo;

	public function __construct(SuppliedProductRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessSuppliedProducts($businessId){
		return $this->repo->loadBusinessSuppliedProducts($businessId);
	}
}