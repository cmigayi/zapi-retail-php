<?php
namespace App\Repositories;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Manage supplier data from data source
*/

use App\Repositories\Contracts\SupplierRepositoryInterface;
use App\Data\Supplier;
use App\Models\SupplierModel;

class SupplierRepository implements SupplierRepositoryInterface{
	private $supplierModel;

	public function __construct(){
		$this->supplierModel = new SupplierModel();
	}

	public function createSupplier(Supplier $supplier){
		$this->supplierModel->setData($supplier);
		return $this->supplierModel->createSupplier();
	}
	
	public function getSupplier($supplierId){
		return $this->supplierModel->getSupplier($supplierId);
	}

	public function getBusinessSupplier($businessId){
		return $this->supplierModel->getBusinessSupplier($businessId);
	}
	
	public function loadBusinessSuppliers($businessId){
		return $this->supplierModel->getBusinessSuppliers($businessId);
	}
	
	public function updateSupplier(Supplier $supplier){
		$this->supplierModel->setData($supplier);
		return $this->supplierModel->updateSupplier();		
	}
	
	public function deleteSupplier($supplierId){		
		return $this->supplierModel->deleteSupplier($supplierId);
	}
}