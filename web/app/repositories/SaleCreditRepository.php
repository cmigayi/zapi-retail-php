<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage sale credit data from data source
*/

use App\Repositories\Contracts\SaleCreditRepositoryInterface;
use App\Data\SaleCredit;
use App\Models\SaleCreditModel;

class SaleCreditRepository implements SaleCreditRepositoryInterface{
	private $saleCreditModel;

	public function __construct(){
		$this->saleCreditModel = new SaleCreditModel();
	}

	public function createSaleCredit(SaleCredit $saleCredit){
		$this->saleCreditModel->setData($saleCredit);
		return $this->saleCreditModel->createSaleCredit();
	}
	
	public function loadBusinessSalesCredits($businessId){
		return $this->saleCreditModel->getBusinessSalesCredits($businessId);
	}
}