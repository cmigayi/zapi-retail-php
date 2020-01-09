<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch business data
*/
use App\Data\Business;
use App\Repositories\Contracts\BusinessRepositoryInterface;

class BusinessInfo{
	private $repo; 

	public function __construct(BusinessRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusiness($businessId){
		return $this->repo->loadBusiness($businessId);
	}
	
	public function updateBusiness(Business $business){
		return $this->repo->updateBusiness($business);
	}
	
	public function deleteBusiness($businessId){
		return $this->repo->deleteBusiness($businessId);
	}
}