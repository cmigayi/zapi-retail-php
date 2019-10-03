<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch business product cartegories data
*/

use App\Repositories\Contracts\ProductCartegoryRepositoryInterface;

class BusinessProductCartegories{
	private $repo; 

	public function __construct(ProductCartegoryRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessProductCartegories($businessId){
		return $this->repo->loadBusinessProductCartegories($businessId);
	}
}