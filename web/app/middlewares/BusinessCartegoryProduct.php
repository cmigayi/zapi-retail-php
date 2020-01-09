<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch business product cartegories data
*/

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Data\Product;

class BusinessCartegoryProduct{
	private $repo; 

	public function __construct(ProductRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessCartegoryProduct($productId){
		return $this->repo->getBusinessCartegoryProduct($productId);
	}
	
	public function updateBusinessProduct(Product $product){
		return $this->repo->updateBusinessProduct($product);		
	}
	
	public function deleteBusinessProduct($productId){
		return $this->repo->deleteBusinessProduct($productId);		
	}
}