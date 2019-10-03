<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Create/add new product cartegory
*/

use App\Repositories\Contracts\ProductCartegoryRepositoryInterface;
use App\Data\ProductCartegory;

class AddProductCartegory{
	private $repo;

	public function __construct(ProductCartegoryRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function createProductCartegory(ProductCartegory $productCartegory){
		return $this->repo->createProductCartegory($productCartegory);
	}
}