<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch business cartegory service data
*/

use App\Repositories\Contracts\ServiceRepositoryInterface;

class BusinessCartegoryService{
	private $repo; 

	public function __construct(ServiceRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessCartegoryService($serviceId){
		return $this->repo->loadBusinessCartegoryService($serviceId);
	}
}