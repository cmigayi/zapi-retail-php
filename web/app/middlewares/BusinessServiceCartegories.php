<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch business service cartegories data
*/

use App\Repositories\Contracts\ServiceCartegoryRepositoryInterface;

class BusinessServiceCartegories{
	private $repo; 

	public function __construct(ServiceCartegoryRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessServiceCartegories($businessId){
		return $this->repo->loadBusinessServiceCartegories($businessId);
	}
}