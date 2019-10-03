<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch all products sales data
*/

use App\Repositories\Contracts\ProductSaleRepositoryInterface;

class BusinessProductsSales{
	private $repo;

	public function __construct(ProductSaleRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessProductsSales($businessId){
		return $this->repo->loadBusinessProductsSales($businessId);
	}
} 