<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch business supplier products data
*/

use App\Repositories\Contracts\SupplierProductRepositoryInterface;

class BusinessSupplierProducts{
	private $repo; 

	public function __construct(SupplierProductRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessSupplierProducts($businessId){
		return $this->repo->loadBusinessSupplierProducts($businessId);
	}
}