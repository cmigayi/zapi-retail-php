<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage product sale data from data source
*/

use App\Repositories\Contracts\ServiceSaleRepositoryInterface;
use App\Data\ServiceSale;
use App\Models\ServiceSaleModel;

class ServiceSaleRepository implements ServiceSaleRepositoryInterface{
	private $serviceSaleModel;

	public function __construct(){
		$this->serviceSaleModel = new ServiceSaleModel();
	}

	public function createServiceSale(ServiceSale $serviceSale){
		$this->serviceSaleModel->setData($serviceSale);
		return $this->serviceSaleModel->createServiceSale();
	}
	
	public function loadBusinessServicesSales($businessId){
		return $this->serviceSaleModel->getBusinessServicesSales($businessId);
	}
}