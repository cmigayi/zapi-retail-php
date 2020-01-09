<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch customerCredits data
*/

use App\Repositories\Contracts\CustomerCreditRepositoryInterface;

class CustomerCredits{
	private $repo; 

	public function __construct(CustomerCreditRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getCustomerCredits($customerId){
		return $this->repo->getCustomerCredits($customerId);
	}
	
	public function getBusinessCustomerCredits($businessId){
		return $this->repo->getBusinessCustomerCredits($businessId);
	}
}