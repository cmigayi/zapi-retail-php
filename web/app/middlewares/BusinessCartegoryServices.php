<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch business service cartegories data
*/

use App\Repositories\Contracts\ServiceRepositoryInterface;

class BusinessCartegoryServices{
	private $repo; 

	public function __construct(ServiceRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessCartegoryServices($serviceCartegoryId){
		return $this->repo->loadBusinessCartegoryServices($serviceCartegoryId);
	}
}