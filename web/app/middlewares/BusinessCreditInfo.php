<?php
namespace App\Middlewares;

/**
* @author: Cecil Migayi
* @email: migayicecil@gmail.com
* @copyright: zapi, 2018
*
* Fetch businessCredit data
*/
use App\Data\BusinessCredit;
use App\Repositories\Contracts\BusinessCreditRepositoryInterface;

class BusinessCreditInfo{
	private $repo; 

	public function __construct(BusinessCreditRepositoryInterface $repo){
		$this->repo = $repo;
	}

	public function getBusinessCredit($businessId){
		return $this->repo->getBusinessCredit($businessId);
	}
	
	public function getSupplierBusinessCredit($supplierId){
		return $this->repo->getSupplierBusinessCredit($supplierId);
	}
	
	public function getCustomerBusinessCredit($customerId){
		return $this->repo->getCustomerBusinessCredit($customerId);		
	}
	
	public function updateBusinessCredit(BusinessCredit $businessCredit){
		return $this->repo->updateBusinessCredit($businessCredit);
	}
	
	public function deleteBusinessCredit($businessCreditId){
		return $this->repo->deleteBusinessCredit($businessCreditId);
	}
}