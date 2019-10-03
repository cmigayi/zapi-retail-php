<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage sale creditor data from data source
*/

use App\Repositories\Contracts\SaleCreditorRepositoryInterface;
use App\Data\SaleCreditor;
use App\Models\SaleCreditorModel;

class SaleCreditorRepository implements SaleCreditorRepositoryInterface{
	private $saleCreditorModel;

	public function __construct(){
		$this->saleCreditorModel = new SaleCreditorModel();
	}

	public function createSaleCreditor(SaleCreditor $saleCreditor){
		$this->saleCreditorModel->setData($saleCreditor);
		return $this->saleCreditorModel->createSaleCreditor();
	}
	
	public function loadBusinessSalesCreditors($businessId){
		return $this->saleCreditorModel->getBusinessSalesCreditors($businessId);
	}
}