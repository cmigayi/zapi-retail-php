<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch ProfitAndLoss data
*/

use App\Repositories\Contracts\ProfitAndLossRepositoryInterface;

class ProfitAndLoss{
	private $repo; 

	public function __construct(ProfitAndLossRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessTotalRevenue($businessId, $startDate, $endDate){
		return $this->repo->getBusinessTotalRevenue($businessId, $startDate, $endDate);
	}
	
	public function getBusinessTotalCostOfStockSold($businessId, $startDate, $endDate){
		return $this->repo->getBusinessTotalCostOfStockSold($businessId, $startDate, $endDate);
	}
	
	public function getBusinessRecurringExpense($businessId, $startDate, $endDate){
		return $this->repo->getBusinessRecurringExpense($businessId, $startDate, $endDate);
	}
	
	public function getGrossProfit($businessId, $startDate, $endDate){
		return $this->repo->getGrossProfit($businessId, $startDate, $endDate);
	}

}