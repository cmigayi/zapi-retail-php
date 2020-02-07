<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage ProfitAndLoss data from data source
*/

use App\Repositories\Contracts\ProfitAndLossRepositoryInterface;
use App\Data\Transaction;
use App\Models\ProfitAndLossModel;

class ProfitAndLossRepository implements ProfitAndLossRepositoryInterface{
	private $profitAndLossModel;	

	public function __construct(){
		$this->profitAndLossModel = new ProfitAndLossModel();
	}
	
	public function getBusinessTotalRevenue($businessId, $startDate, $endDate){
		return $this->profitAndLossModel->getBusinessTotalRevenue($businessId, $startDate, $endDate);
	}
	
	public function getBusinessTotalCostOfStockSold($businessId, $startDate, $endDate){
		return $this->profitAndLossModel->getBusinessTotalCostOfStockSold($businessId, $startDate, $endDate);
	}
	
	public function getBusinessRecurringExpense($businessId, $startDate, $endDate){
		return $this->profitAndLossModel->getBusinessRecurringExpense($businessId, $startDate, $endDate);
	}
	
	public function getGrossProfit($businessId, $startDate, $endDate){
		return $this->profitAndLossModel->getGrossProfit($businessId, $startDate, $endDate);
	}
}