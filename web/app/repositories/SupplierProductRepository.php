<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage supplier product data from data source
*/

use App\Repositories\Contracts\SupplierProductRepositoryInterface;
use App\Data\SupplierProduct;
use App\Models\SupplierProductModel;

class SupplierProductRepository implements SupplierProductRepositoryInterface{
	private $supplierProductModel;

	public function __construct(){
		$this->supplierProductModel = new SupplierProductModel();
	}

	public function createSupplierProduct(SupplierProduct $supplierProduct){
		$this->supplierProductModel->setData($supplierProduct);
		return $this->supplierProductModel->createSupplierProduct();
	}
	
	public function loadBusinessSupplierProducts($businessId){
		return $this->supplierProductModel->getBusinessSupplierProducts($businessId);
	}
}