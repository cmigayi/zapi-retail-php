<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch sales data
*/

use App\Repositories\Contracts\SaleRepositoryInterface;

class Sales{
	private $repo; 

	public function __construct(SaleRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessTransactions($businessId){
		return $this->repo->getBusinessTransactions($businessId);
	}
}