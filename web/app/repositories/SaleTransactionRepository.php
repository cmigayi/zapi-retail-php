<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage sale transaction data from data source
*/

use App\Repositories\Contracts\SaleTransactionRepositoryInterface;
use App\Data\SaleTransaction;
use App\Models\SaleTransactionModel;

class SaleTransactionRepository implements SaleTransactionRepositoryInterface{
	private $saleTransactionModel;

	public function __construct(){
		$this->saleTransactionModel = new SaleTransactionModel();
	}

	public function createSaleTransaction(SaleTransaction $saleTransaction){
		$this->saleTransactionModel->setData($saleTransaction);
		return $this->saleTransactionModel->createSaleTransaction();
	}
	
	public function loadBusinessSalesTransactions($businessId){
		return $this->saleTransactionModel->getBusinessSalesTransactions($businessId);
	}
}