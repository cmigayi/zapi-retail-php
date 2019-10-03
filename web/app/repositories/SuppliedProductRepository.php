<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage supplied product data from data source
*/

use App\Repositories\Contracts\SuppliedProductRepositoryInterface;
use App\Data\SuppliedProduct;
use App\Models\SuppliedProductModel;

class SuppliedProductRepository implements SuppliedProductRepositoryInterface{
	private $suppliedProductModel;

	public function __construct(){
		$this->suppliedProductModel = new SuppliedProductModel();
	}

	public function createSuppliedProduct(SuppliedProduct $suppliedProduct){
		$this->suppliedProductModel->setData($suppliedProduct);
		return $this->suppliedProductModel->createSuppliedProduct();
	}
	
	public function loadBusinessSuppliedProducts($businessId){
		return $this->suppliedProductModel->getBusinessSuppliedProducts($businessId);
	}
}