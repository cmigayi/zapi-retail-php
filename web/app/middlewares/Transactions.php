<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch Transactions data
*/

use App\Repositories\Contracts\TransactionRepositoryInterface;

class Transactions{
	private $repo; 

	public function __construct(TransactionRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessTransactions($businessId){
		return $this->repo->getBusinessTransactions($businessId);
	}
	
	public function getBusinessTransactionsBtwnDates($businessId, $startDate, $endDate){
		return $this->repo->getBusinessTransactionsBtwnDates($businessId, $startDate, $endDate);
	}
	
	public function getBusinessTotalRevenueBtwnDates($businessId, $startDate, $endDate){
		return $this->repo->getBusinessTotalRevenueBtwnDates($businessId, $startDate, $endDate);
	}
}