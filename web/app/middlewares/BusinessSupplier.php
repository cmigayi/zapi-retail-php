<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch business supplier data
*/

use App\Repositories\Contracts\SupplierRepositoryInterface;

class BusinessSupplier{
	private $repo; 

	public function __construct(SupplierRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessSupplier($businessId){
		return $this->repo->loadBusinessSupplier($businessId);
	}
}