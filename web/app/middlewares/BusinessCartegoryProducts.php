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

class BusinessCartegoryProducts{
	private $repo; 

	public function __construct(ProductRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessCartegoryProducts($productCartegoryId){
		return $this->repo->loadBusinessCartegoryProducts($productCartegoryId);
	}
}