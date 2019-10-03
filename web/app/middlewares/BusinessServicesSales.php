<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch all products sales data
*/

use App\Repositories\Contracts\ServiceSaleRepositoryInterface;

class BusinessServicesSales{
	private $repo;

	public function __construct(ServiceSaleRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessServicesSales($businessId){
		return $this->repo->loadBusinessServicesSales($businessId);
	}
} 