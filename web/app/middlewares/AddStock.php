<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new product stock
*/

use App\Repositories\Contracts\ProductStockRepositoryInterface;
use App\Data\ProductStock;

class AddStock{
	private $repo; 

	public function __construct(ProductStockRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function createProductStock(ProductStock $productStock){
		return $this->repo->createProductStock($productStock);
	}
}