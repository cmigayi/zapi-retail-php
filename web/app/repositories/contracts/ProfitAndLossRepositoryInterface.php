<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to profit and loss repository
*/

interface ProfitAndLossRepositoryInterface{
	
	/**
	* Handle Total revenue data retrieval
	*
	* @param from Model constructor
	* @return array Total revenue info 
	*/
	public function getBusinessTotalRevenue($businessId, $startDate, $endDate);
	
	public function getBusinessTotalCostOfStockSold($businessId, $startDate, $endDate);
	
	public function getBusinessRecurringExpense($businessId, $startDate, $endDate);
	
	public function getGrossProfit($businessId, $startDate, $endDate);

}