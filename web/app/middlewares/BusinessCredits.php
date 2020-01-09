<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch businessCredits data
*/

use App\Repositories\Contracts\BusinessCreditRepositoryInterface;

class BusinessCredits{
	private $repo; 

	public function __construct(BusinessCreditRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessCredits($businessId){
		return $this->repo->getBusinessCredits($businessId);
	}
}