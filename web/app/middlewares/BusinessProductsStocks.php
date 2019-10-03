<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch all products stocks data
*/

use App\Repositories\Contracts\ProductStockRepositoryInterface;

class BusinessProductsStocks{
	private $repo;

	public function __construct(ProductStockRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessProductsStocks($businessId){
		return $this->repo->loadBusinessProductsStocks($businessId);
	}
}