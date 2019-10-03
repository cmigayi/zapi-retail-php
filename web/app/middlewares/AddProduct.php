<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new product
*/

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Data\Product;

class AddProduct{
	private $repo; 

	public function __construct(ProductRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function createProduct(Product $product){
		return $this->repo->createProduct($product);
	}
}