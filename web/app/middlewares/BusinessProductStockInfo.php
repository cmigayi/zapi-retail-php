<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch stock data
*/
use App\Data\ProductStock;
use App\Repositories\Contracts\ProductStockRepositoryInterface;

class BusinessProductStockInfo{
	private $repo; 

	public function __construct(ProductStockRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getStock($productStockId){
		return $this->repo->getStock($productStockId);
	}
	
	public function updateStock(ProductStock $productStock){
		return $this->repo->updateStock($productStock);
	}
	
	public function deleteStock($productStockId){
		return $this->repo->deleteStock($productStockId);
	}
}