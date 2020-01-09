<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch business product cartegories data
*/

use App\Repositories\Contracts\ServiceRepositoryInterface;

class BusinessServices{
	private $repo; 

	public function __construct(ServiceRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessServices($businessId){
		return $this->repo->loadBusinessServices($businessId);
	}
}