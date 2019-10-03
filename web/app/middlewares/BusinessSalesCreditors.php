<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch all business sales creditors data
*/

use App\Repositories\Contracts\SaleCreditorRepositoryInterface;

class BusinessSalesCreditors{
	private $repo;

	public function __construct(SaleCreditorRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessSalesCreditors($businessId){
		return $this->repo->loadBusinessSalesCreditors($businessId);
	}
} 