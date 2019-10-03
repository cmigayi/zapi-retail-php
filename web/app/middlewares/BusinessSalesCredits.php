<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch all business sales credits data
*/

use App\Repositories\Contracts\SaleCreditRepositoryInterface;

class BusinessSalesCredits{
	private $repo;

	public function __construct(SaleCreditRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessSalesCredits($businessId){
		return $this->repo->loadBusinessSalesCredits($businessId);
	}
} 