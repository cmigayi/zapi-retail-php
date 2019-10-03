<?php
namespace App\Repositories\Contracts;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Contract to sale transaction repository
*/

use App\Data\SaleTransaction;

interface SaleTransactionRepositoryInterface{

	public function createSaleTransaction(SaleTransaction $saleTransaction);
	
	public function loadBusinessSalesTransactions($businessId);
}