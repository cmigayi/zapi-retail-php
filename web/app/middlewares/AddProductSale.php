<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new product sale
*/

use App\Repositories\Contracts\ProductSaleRepositoryInterface;
use App\Data\ProductSale;

class AddProductSale{
	private $repo; 

	public function __construct(ProductSaleRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function createProductSale(ProductSale $productSale){
		return $this->repo->createProductSale($productSale);
	}
}