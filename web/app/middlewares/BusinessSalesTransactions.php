<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch all business sales transactions data
*/

use App\Repositories\Contracts\SaleTransactionRepositoryInterface;

class BusinessSalesTransactions{
	private $repo;

	public function __construct(SaleTransactionRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessSalesTransactions($businessId){
		return $this->repo->loadBusinessSalesTransactions($businessId);
	}
} 