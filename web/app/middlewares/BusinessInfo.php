<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch business data
*/

use App\Repositories\Contracts\BusinessRepositoryInterface;

class BusinessInfo{
	private $repo; 

	public function __construct(BusinessRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusiness($businessId){
		return $this->repo->loadBusiness($businessId);
	}

}