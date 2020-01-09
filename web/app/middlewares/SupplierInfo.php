<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch business supplier data
*/
use App\Data\Supplier;
use App\Repositories\Contracts\SupplierRepositoryInterface;

class SupplierInfo{
	private $repo; 

	public function __construct(SupplierRepositoryInterface $repo){
		$this->repo = $repo;
	}
	
	public function getSupplier($supplierId){
		return $this->repo->getSupplier($supplierId);
	}

	public function getBusinessSupplier($businessId){
		return $this->repo->getBusinessSupplier($businessId);
	}
	
	public function updateSupplier(Supplier $supplier){
		return $this->repo->updateSupplier($supplier);		
	}
	
	public function deleteSupplier($supplierId){		
		return $this->repo->deleteSupplier($supplierId);
	}
}